<?php

namespace Ornamental\Sender;

use Psr\Log\LoggerInterface;

class Logger implements \Ornamental\Sender
{
    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function send($message)
    {
        $payload = array(
            'to' => $message->to,
            'subject' => $message->subject,
            'body' => $message->renderHTML(),
            'text' => $message->renderText(),
        );
        $this->logger->info("An email was sent.", $payload);
    }
}
