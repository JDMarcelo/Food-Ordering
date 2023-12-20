<?php
session_start();

// Set the content type
header('Content-type: image/png');

// Generate a random string for the CAPTCHA
$captchaText = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"), 0, 6);

// Store the CAPTCHA string in the session for verification
$_SESSION['captcha'] = $captchaText;

// Create an image
$image = imagecreatetruecolor(120, 40);

// Set background color
$bgColor = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $bgColor);

// Set text color
$textColor = imagecolorallocate($image, 0, 0, 0);

// Add text to the image
imagettftext($image, 20, 0, 10, 30, $textColor, 'path/to/your/font.ttf', $captchaText);

// Output the image
imagepng($image);
imagedestroy($image);
?>
