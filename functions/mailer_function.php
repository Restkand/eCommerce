<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';


function sendNotificationPaymentEmailtoCustomer($customerName, $customerEmail, $invoiceNumber)
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
        $mail->Body = "Halo Kak, kami dari Meonthrift ingin reminder nih untuk Kak $customerName,<br><br>Mohon segera lakukan pembayaran dan mengirim bukti pembayaran pesananannya.<br><br>Pelanggan: " . $customerName . "<br>Email: " . $customerEmail . "<br>Dengan Nomor Invoice Pesanan: " . $invoiceNumber . "<br><br>Terima Kasih";

        // Kirim email
        $mail->send();
        echo 'Email notifikasi telah berhasil dikirim.';
    } catch (Exception $e) {
        echo 'Gagal mengirim email notifikasi: ' . $mail->ErrorInfo;
    }
}

?>