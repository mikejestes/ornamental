<?php

namespace Ornamental\Sender;

class Phpmailer implements \Ornamental\Sender
{
    public $smtpHost;
    public $smtpUsername;
    public $smtpPassword;
    public $smtpSecure;
    public $smtpPort = 25;

    public function send($message)
    {
        $mail = new \PHPMailer();

        if ($this->smtpHost) {
            $mail->isSMTP();
            $mail->Host = $this->smtpHost;
            $mail->Port = $this->smtpPort;
            $mail->SMTPAuth = true;
            $mail->Username = $this->smtpUsername;
            $mail->Password = $this->smtpPassword;
            $mail->SMTPSecure = $this->smtpSecure;
        }

        $mail->From = $message->from;
        $mail->FromName = $message->fromName;
        foreach (explode(',', $message->to) as $email) {
            $mail->AddAddress($email);
        }

        $mail->isHTML(true);
        $mail->Subject = $message->subject;
        $mail->Body    = $message->renderHtml();
        $mail->AltBody = $message->renderText();
        $mail->send();
    }
}
