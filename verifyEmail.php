<?php
require_once("connect.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require_once './PHPMailer-master/src/Exception.php';
require_once './PHPMailer-master/src/PHPMailer.php';
require_once './PHPMailer-master/src/SMTP.php';

$message = [];
$success = false;
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $query = $db->query("SELECT * FROM users WHERE email = '" . $db->real_escape_string($email) . "'");
    $row = $query->fetch_assoc();
    if (!$email) {
        $message['email'] = 'Input required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message['email'] = 'Invalid email';
    } elseif (!$row) {
        $message['email'] = 'The account does not exist.';
    } else {
        $code = uniqid();
        $db->query("UPDATE users SET reset_password_token = '".$code."' WHERE email = '".$db->real_escape_string($email)."'");

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'cosmintestphp@gmail.com';
        $mail->Password   = 'whpwxksnpzejyqul'; // sa tii minte asta ca nu cred ca mai poti o vezi si trebuie sa faci alta.
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port= 465;
        $mail->setFrom('cosminmorari99@yahoo.com');
        $mail->addAddress($_POST['email']);
        $mail->isHTML(true);
        $mail->Subject='Code';
        $mail->Body= '<p>Ai solicitat recuperarea parolei. Acceseaza <a href="'.BASE_URL.'/newPassword.php?token='.$code.'">link-ul acesta</a> pentru actualizarea ei.</p>';
        
        if($mail->send()) {
            $success = true;
        } else {
            $message['error_mail'] = 'Nu am putut trimite email-ul. Te rugam incearca din nou!';
        }

    }
}
