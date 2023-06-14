<?php

// Including Connect File
include('../includes/connect.php');

function notif_email_payment (){
    global $con;

    $to = 'gameemeta@gmail.com';
    $subject = 'Notifikasi Pembayaran Meonthrift';
    $message = 'Halo, Silakan lakukan pembayaran Anda segera.';
    $headers = 'From: reiskand07@gmail.com' . "\r\n" .
    'Reply-To: reiskand07@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers)) {
    echo "<script>alert('Email notifikasi berhasil dikirim')</script>";
} else {
    echo "<script>alert('Gagal mengirim email notifikasi')</script>";
}
}


?>