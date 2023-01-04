<?php
// api/src/Controller/BookController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\User;


#[AsController]
class RegisterController extends AbstractController
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher, private EntityManagerInterface $entityManager)
    {
    }

    public function __invoke(Request $request, ValidatorInterface $validator)
    {
        $request_content = json_decode($request->getContent());
        $email = $request_content->email;
        $password = $request_content->password;
        $roles = $request_content->roles;
        $user = new User();
        $user->setEmail($email);
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));
        $user->setRoles($roles);
        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            return new JsonResponse((string) $errors, 400);
        }
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return new JsonResponse('The user is created', 201);
    }
}