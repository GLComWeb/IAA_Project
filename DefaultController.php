<?php

// src/Controller/DefaultController.php
namespace App\Controller;

use App\Service\EmailSender;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function sendEmail(EmailSender $emailSender)
    {
        $emailSender->sendEmail(1); // ID de l'utilisateur à envoyer l'e-mail
        return new Response('E-mail envoyé !');
    }
}

?>