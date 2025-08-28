<?php
session_start();

// Generate new captcha if not set or forced refresh
if (!isset($_SESSION['captcha']) || isset($_GET['new'])) {
    $_SESSION['captcha'] = substr(str_shuffle('0123456789'), 0, 6); // Hanya angka
}
$code = $_SESSION['captcha'];

// Image size
$width = 150;
$height = 50;
$image = imagecreatetruecolor($width, $height);

// Colors
$bg        = imagecolorallocate($image, 255, 255, 255);
$textColor = imagecolorallocate($image, 80, 3, 7);
$lineColor = imagecolorallocate($image, 207, 182, 81);

// Fill background
imagefilledrectangle($image, 0, 0, $width, $height, $bg);
// Add text (built-in font)
imagestring($image, 5, 40, 18, $code, $textColor);

// Prevent caching
header('Content-Type: image/png');
header('Cache-Control: no-cache, must-revalidate');
header('Expires: 0');

// Output
imagepng($image);
imagedestroy($image);
?>
