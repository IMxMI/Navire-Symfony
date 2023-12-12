<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use App\Entity\Message;

class GestionContact {

    private EntityManagerInterface $em;
    private MailerInterface $mailer;

    public function __construct(EntityManagerInterface $em, MailerInterface $mailer) {
        $this->em = $em;
        $this->mailer = $mailer;
    }

    public function creerContact(Message $message) {
        $message->setDateMessage(new \DateTime());
        $this->em->persist($message);
        $this->em->flush();
    }

    public function envoieMailContact(Message $message) {
        $email = (new TemplatedEmail())
                ->from(new Address('mxm.vernoux@gmail.com', 'Contact Symfony'))
                ->to($message->getMail())
                ->subject('Demande de renseignement')
                ->text('Bonjour')
                //->attachFromPath('assets/pdf/presentation.pdf', 'Présentation')
                ->htmlTemplate('mails/Contact.html.twig')
                ->context([
            'contact' => $message
        ]);
        $this->mailer->send($email);
    }
}
