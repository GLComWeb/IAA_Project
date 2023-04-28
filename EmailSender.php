<?php

// src/Service/EmailSender.php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Swift_Mailer;
use Swift_Message;

class EmailSender
{
    private $mailer;
    private $entityManager;

    public function __construct(Swift_Mailer $mailer, EntityManagerInterface $entityManager)
    {
        $this->mailer = $mailer;
        $this->entityManager = $entityManager;
    }

    public function sendEmail($userId)
    {
        // Récupérer les données de l'utilisateur
        $user = $this->entityManager->getRepository(User::class)->find($userId);

        if (!$user) {
            throw $this->createNotFoundException('Utilisateur introuvable');
        }

        // Adresse e-mail de destination
        $to = $user->getEmail();

        // Message de l'email
        $subject = "Bienvenue sur notre site !";
        $message = "Bonjour " . $user->getPrenom() . " " . $user->getNom() . ",\n\nBienvenue sur notre site web !";

        // Créer un message SwiftMailer
        $email = (new Swift_Message($subject))
            ->setFrom('webmaster@example.com')
            ->setTo($to)
            ->setBody($message);

        // Envoyer l'email
        $this->mailer->send($email);
    }
}

?>