<?php
// api/src/Controller/CreateBookPublication.php
namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class UserForgottenPwdController extends AbstractController
{
    public function __invoke(User $user): User
    {
        $sibUrl = "https://api.sendinblue.com/v3/smtp/email";
        $data = array(
            "sender" => array("name" => "test", "email" => "rivo.jonathan98@gmail.com"),
            "to" => array("name" => "Jonathan", "email" => "rivo.jonathan98@gmail.com"),
            "subject"=>"Test",
            "htmlContent"=>"new Password"
        );
        //post request with "api-key" and "Content-Type: application/json" headers
        $options = array(
            'http' => array(
                'header'  => "Content-Type: application/json",
                'method'  => 'POST',
            )
        );

        // $context  = stream_context_create($options);
        // $result = file_get_contents($sibUrl, false, $context);
        return $user;
    }
}
