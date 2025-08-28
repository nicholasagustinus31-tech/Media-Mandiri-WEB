<?php
session_start();

// Validate captcha (numbers only)
if (!isset($_POST['captcha'], $_SESSION['captcha']) || $_POST['captcha'] !== $_SESSION['captcha']) {
    echo '<script>alert("Captcha salah. Silakan coba lagi."); window.history.back();</script>';
    exit;
}

// Get form data (with basic sanitization)
$email   = isset($_POST['email']) ? trim($_POST['email']) : '';
$service = isset($_POST['service']) ? trim($_POST['service']) : '';
$budget  = isset($_POST['budget']) ? trim($_POST['budget']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Validate required fields
if (empty($email) || empty($service) || empty($budget) || empty($message)) {
    echo '<script>alert("Semua field wajib diisi."); window.history.back();</script>';
    exit;
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '<script>alert("Format email tidak valid."); window.history.back();</script>';
    exit;
}

// Send email
$to      = 'gavinprasetya2003@gmail.com'; // Ganti dengan email tujuan
$subject = 'Contact Form Submission';
$body    = "Email: $email\nService: $service\nBudget: $budget\nMessage: $message";
$headers = "From: $email\r\nReply-To: $email";

if (mail($to, $subject, $body, $headers)) {
    echo '<script>alert("Pesan berhasil dikirim!"); window.location.href="index.html";</script>';
} else {
    echo '<script>alert("Gagal mengirim pesan. Silakan coba lagi."); window.history.back();</script>';
}
?>
