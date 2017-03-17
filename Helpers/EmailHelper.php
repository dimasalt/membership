<?php

namespace Membership\Helpers;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class EmailHelper
{
    public function SendEmail($subject, $body, $body_text, $to)
    {
        //get configs
        //$config = include INC_ROOT . '/app/config.php';
        $config = include CONFIG_URL;


        // Create the message
        $message = Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($config['mail']['from'])
            ->setTo($to)
            ->setBody($body, 'text/html');
        
        if(!empty($body_text))
            $message->addPart($body_text, 'text/plain');         


        $protocol = '';
        if($config['mail']['ssl'])
            $protocol = 'ssl';
        else if($config['mail']['tls'])
            $protocol = 'tls';

        $transport = Swift_SmtpTransport::newInstance($config["mail"]["host"], $config["mail"]["port"], $protocol)
            ->setUsername($config["mail"]["username"])
            ->setPassword($config["mail"]["password"]);

        // Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);

        // Send the message
        if($mailer->send($message))
            return true;
        else return false;

    }
}