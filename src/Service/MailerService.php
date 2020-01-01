<?php
namespace App\Service;

use Swift_Mailer;
use Swift_Message;

class MailerService
{
    const ADMIN_MAIL = 'jeremy.bourgin@etu.umontpellier.fr';
    const DEFAULT_TYPE = 'text/plain';

    private $mailer;

    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMail(string $from, string $object, string $message, string $type = self::DEFAULT_TYPE, string $to = self::ADMIN_MAIL): void
    {
        $message = (new Swift_Message())
            ->setSubject($object)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($message, $type);
        
        $this->mailer->send($message);
    }
}