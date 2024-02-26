<?php

include 'PHPMailer/src/PHPMailer.php';
include 'PHPMailer/src/SMTP.php';
include 'PHPMailer/src/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



function print_array(...$array): void
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }


switch ($_POST['action']) {
        case 'email':

            
            if(empty($_POST['name'])) die(json_encode(['status' => false, 'message' => 'is required!', 'id'=>'error_name']));
            if(empty($_POST['phone'])) die(json_encode(['status' => false, 'message' => 'is required!', 'id'=>'error_phone']));
            if(empty($_POST['email'])) die(json_encode(['status' => false, 'message' => 'is required!', 'id'=>'error_email']));
           
            
            $mail = new PHPMailer(true);

        $clientEmail = $_POST['email'];
        
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'email';                     //SMTP username
            $mail->Password   = 'secret';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('itvalik24@gmail.com', 'IT-valik');
            //$mail->addAddress($_POST['email'], 'Name');
            $mail->addAddress('edvard.borovkov@gmail.com', 'Joe User');   //Add a recipient
            //$mail->addAddress('tigersone.onix@gmail.com');               //Name is optional
            //$mail->addAddress($Email, 'Client Name'); // Адрес клиента
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('temp@ad-it.ru');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
            //$mail->addAttachment($destinationFolder.$fileName);


            //Content
            //$mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = '';
            $mail->Body    = 'Сообщение';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            // Build the email body with user's selected options and message
            $emailBody = "Name: {$_POST['name']}\n";
            $emailBody .= "Phone: {$_POST['phone']}\n";
            $emailBody .= "Email: {$_POST['email']}\n";
            $emailBody .= "Selected Options:\n";
            foreach ($_POST['options'] as $option) {
                $emailBody .= "- $option\n";
            }
            $emailBody .= "Message: {$_POST['message']}\n";

            //$adminMail->Body = $emailBody;

            // Send the email to the admin
            //$adminMail->send();
        } catch (Exception $e) {
            echo "Admin email could not be sent. Mailer Error: {$adminMail->ErrorInfo}";
        }

        // Return a JSON response indicating success
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'message' => 'Emails sent successfully',
        ]);

        break;

    default:
        echo json_encode([
            'success' => false,
            'message' => 'Emails not sent',
        ]);

        break;
}