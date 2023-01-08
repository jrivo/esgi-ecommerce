<?php
// api/src/Controller/BookController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class RoleCheckerController extends AbstractController
{
    public function check(){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->json(['message' => 'OK']);
    }
}