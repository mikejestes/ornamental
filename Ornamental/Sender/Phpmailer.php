<?php

namespace Ornamental\Sender;

class Phpmailer
{
    public $smtpHost;
    public $smtpUsername;
    public $smtpPassword;
    public $smtpSecure;
    public $smtpPort = 25;

    public function send($message)
    {
        $mail = new PHPMailer();

        if ($this->smtpHost) {
            $mail->IsSMTP();
            $mail->Host = $this->smtpHost;
            $mail->Port = $this->smtpPort;
            $mail->SMTPAuth = true;
            $mail->Username = $this->smtpUsername;
            $mail->Password = $this->smtpPassword;
            $mail->SMTPSecure = $this->smtpSecure;
        }

        $mail->From = $message->from;
        $mail->AddAddress($message->to);

        $mail->IsHTML(true);
        $mail->Subject = $message->subject;
        $mail->Body    = $message->renderHtml();
        $mail->AltBody = $message->renderText();
    }
}
