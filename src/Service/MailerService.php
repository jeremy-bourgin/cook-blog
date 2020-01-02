<?php
namespace App\Service;

use Swift_Mailer;
use Swift_Message;

class MailerService
{
    const DEFAULT_TYPE = 'text/plain';

    private $mailer;

    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMail(string $from, string $to, string $object, string $message, string $type = self::DEFAULT_TYPE): void
    {
        $message = (new Swift_Message())
            ->setSubject($object)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($message, $type);
        
        $this->mailer->send($message);
    }
}