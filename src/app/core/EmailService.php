<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService 
{
    private $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->setup();
    }

    private function setup()
    {
        try {
            $this->mailer->isSMTP();
            $this->mailer->Host = SMTP_HOST;
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = SMTP_USER;
            $this->mailer->Password = SMTP_PASS;
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port = SMTP_PORT;

            $this->mailer->setFrom(FROM_EMAIL, FROM_NAME);
        } catch (Exception $e) {
            throw new Exception('Error setting up mailer: ' . $e->getMessage());
        }
    }

    public function sendEmail($recipientEmail, $recipientName, $subject, $body, $altBody)
    {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->addAddress($recipientEmail, $recipientName);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;
            $this->mailer->AltBody = $altBody;

            $this->mailer->send();
        } catch (Exception $e) {
            throw new Exception('Error sending email: ' . $this->mailer->ErrorInfo);
        }
    }

    public function sendVerificationToken($recipientEmail, $recipientName, $token)
    {
        $verificationLink = ROOT . "/authentication/verifyToken?token=$token";

        $subject = 'Autentificare cu Link';
        $body = "Salut $recipientName,<br><br>Contul tau poate fi verificat folosind acest link: <a href=\"$verificationLink\">Link de verificare</a><br><br>Mulțumim!";
        $altBody = "Poți verifica direct contul folosind acest link: $verificationLink\n\nMulțumim!";

        $this->sendEmail($recipientEmail, $recipientName, $subject, $body, $altBody);
    }

    public function sendContactMessage($fromEmail, $subject, $message)
    {
        try {
            $toEmail = FROM_EMAIL;
            $toName  = FROM_NAME;

            $body = "Mesaj primit de la: $fromEmail <br><br>$message";
            $altBody = "Mesaj primit de la: $fromEmail\n\n$message";

            $this->sendEmail($toEmail, $toName, $subject, $body, $altBody);
        } catch (Exception $e) {
            throw new Exception('Eroare la trimiterea mesajului de contact: ' . $this->mailer->ErrorInfo);
        }
    }
}
