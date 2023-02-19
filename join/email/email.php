<?php

include 'PHPMailer/src/Exception.php';
include 'PHPMailer/src/PHPMailer.php';
include 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
/*
 * AUTHOR : YOUNGMINJUN
 *
 * $EMAIL : 보내는 사람 메일 주소
 * $NAME : 보내는 사람 이름
 * $SUBJECT : 메일 제목
 * $CONTENT : 메일 내용
 * $MAILTO : 받는 사람 메일 주소
 * $MAILTONAME : 받는 사람 이름 
 */

function sendMail($EMAIL, $SUBJECT, $CONTENT, $MAILTO, $MAILTONAME){
    $mail = new PHPMailer();
    $body = $CONTENT;

    $mail->IsSMTP(); // telling the class to use SMTP
    // $mail->Host       = "www.coolio.so"; // SMTP server
    $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                               // 1 = errors and messages
                                               // 2 = messages only
    $mail->CharSet    = "utf-8";
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
    $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
    $mail->Username   = "qsefthuko98765@gmail.com";             // GMAIL username
    $mail->Password   = "yibzyxycezssagri";              // GMAIL password

    $mail->SetFrom($EMAIL);

    $mail->AddReplyTo($EMAIL);

    $mail->Subject = $SUBJECT;

    $mail->MsgHTML($body);

    $address = $MAILTO;
    $mail->AddAddress($address, $MAILTONAME);

    if(!$mail->Send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
      echo "Message sent!";
    }
}

$email = $_GET['email'];
$id = $_GET['id'];
$pw = $_GET['pw'];

$check = '<form action="localhost/p4c_6/join/email/join.php?email='.$email.'&id='.$id.'&pw='.$pw.'" method="post"><input type="submit" value="이메일 인증"></form>';

sendMail("qsefthuko98765@gmail.com", "p4c_6 이메일 인증", $check, $email, "HongKyungMin");

echo "<script> alert('이메일을 확인해 주세요'); </script>";

echo "<script>window.location.replace('http://localhost/p4c_6/login/login_page.php')</script>";

?>