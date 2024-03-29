<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendNotificationEmailtoAdmin($customerName, $customerEmail, $invoiceNumber)
{
    $mail = new PHPMailer(true);

    try {
        // Konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'meonthrift@gmail.com'; 
        // $mail->Password = 'gpnpbaljwvhzafhd'; // Password Reiskand07@gmail.com
        $mail->Password = 'zslnfzmvjhldvahn'; // Password Meonthrift@gmail.com
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Pengaturan email
        $mail->setFrom('reiskand07@gmail.com', 'Meonthrift'); 
        $mail->addAddress('reiskand07@gmail.com'); 

        // Konten email
        $mail->isHTML(true);
        $mail->Subject = 'Pesanan Baru di Meonthrift';
        $mail->Body = "Halo Admin,<br><br>Ada pesanan baru di toko Meonthrift.<br><br>Pelanggan: " . $customerName . "<br>Email: " . $customerEmail . "<br>Berikut Nomor Invoice Pesanan: " . $invoiceNumber;

        // Kirim email
        $mail->send();
        echo 'Email notifikasi telah berhasil dikirim.';
    } catch (Exception $e) {
        echo 'Gagal mengirim email notifikasi: ' . $mail->ErrorInfo;
    }
}

function sendNotificationEmailtoCustomer($customerName, $customerEmail, $invoiceNumber)
{
    $mail = new PHPMailer(true);

    try {
        // Konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'meonthrift@gmail.com'; 
        // $mail->Password = 'gpnpbaljwvhzafhd'; // Password Reiskand07@gmail.com
        $mail->Password = 'zslnfzmvjhldvahn'; // Password Meonthrift@gmail.com
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Pengaturan email
        $mail->setFrom('reiskand07@gmail.com', 'Meonthrift'); 
        $mail->addAddress($customerEmail, $customerName); 

        // Konten email
        $mail->isHTML(true);
        $mail->Subject = 'Pesanan Baru di Meonthrift';
        $mail->Body = "Halo Kak $customerName,<br><br>Terima kasih telah berbelanaja di Meonthrift.<br><br>Pelanggan: " . $customerName . "<br>Email: " . $customerEmail . "<br>Berikut Nomor Invoice Pesanan Anda: " . $invoiceNumber;

        // Kirim email
        $mail->send();
        echo 'Email notifikasi telah berhasil dikirim.';
    } catch (Exception $e) {
        echo 'Gagal mengirim email notifikasi: ' . $mail->ErrorInfo;
    }
}

?>