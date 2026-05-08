<?php

require_once __DIR__ . '/../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

class MailHelper {

    private static function sendEmail($to, $subject, $htmlBody, $replyTo = null) {
        $config = require __DIR__ . '/../../config/smtp.php';
        $smtp = $config['smtp'];

        $mail = new PHPMailer(true);

        try {
            // Serverinställningar
            $mail->isSMTP();
            $mail->Host = $smtp['host'];
            $mail->SMTPAuth = true;
            $mail->Username = $smtp['username'];
            $mail->Password = $smtp['password'];
            $mail->SMTPSecure = $smtp['encryption'];
            $mail->Port = $smtp['port'];

            // Mottagare
            $mail->setFrom($smtp['from_email'], $smtp['from_name']);
            $mail->addAddress($to);
            if ($replyTo) {
            $mail->addReplyTo($replyTo);
        }

            // Innehåll
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $htmlBody;
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Mailer Error: {$mail->ErrorInfo}");
            return false;
        }
    }

    public static function sendResetEmail($to, $resetLink) {
        $subject = 'Återställning av enhet';
        $body = "
            <p>Hej!</p>
            <p>Klicka på länken nedan för att återställa din enhet:</p>
            <p><a href=\"$resetLink\">$resetLink</a></p>
            <p>Om du inte begärt detta kan du ignorera detta mejl.</p>
        ";
        return self::sendEmail($to, $subject, $body, 'Förrådsappen');
    }

    public static function sendConfirmEmail($to, $confirmLink) {
        $subject = 'Bekräfta din registrering';
        $body = "
            <p>Välkommen till Fönsterfabriken!</p>
            <p>Klicka på länken nedan för att bekräfta din registrering:</p>
            <p><a href=\"$confirmLink\">$confirmLink</a></p>
            <p>Om du inte har registrerat dig kan du ignorera detta mejl.</p>
        ";
        return self::sendEmail($to, $subject, $body);
    }
    
    public static function sendBookingConfirm($to) {
        $subject = 'Din bokning är mottagen';
        $body = "
        <h4>Tack för din bokning!</h4>
        <p>Så fort vi har granskat din ansökan kommer du få en bekräftelse!</p>
        ";
        
        return self::sendEmail($to, $subject, $body);
    }
    
    public static function sendForm($to, $subject, $body, $replyTo) {
        $htmlBody = "
        <h4>Kontaktmeddelande från hemsidan</h4>
        <p><strong>Meddelande:</strong><br>{$body}</p>
        <hr>
        <p>Du kan svara direkt till: <a href='mailto:{$replyTo}'>{$replyTo}</a></p>
    ";
        
        return self::sendEmail($to, $subject, $htmlBody, $replyTo);
    }
    
}
