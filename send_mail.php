<?php

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];


    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "your email";
    $mail->Password = "password";
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";

    $mail->isHTML(true);
    $mail->setFrom($email);
    $mail->addAddress("your email");
    $mail->Subject = ("$email($subject)");
    $mail->Body = $message;

    if ($mail->send()) {
        $status = 'success';
        $response = "Mail sent.";
    } else {
        $status = 'failed';
        $response = "Something went wrong" . $mail->ErrorInfo;
    }

    exit(json_encode(array("status" => $status, "response" => $response)));
}
