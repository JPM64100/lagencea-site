<?php
// Formulaire de contact — hébergement OVH (PHP mail)
$to = "jpm@lagencea.com";
if ($_SERVER["REQUEST_METHOD"] !== "POST" || !empty($_POST["website"])) { header("Location: /"); exit; }
$clean = function($s){ return trim(str_replace(["\r","\n"], " ", strip_tags($s))); };
$name = $clean($_POST["name"] ?? "");
$email = filter_var($_POST["email"] ?? "", FILTER_VALIDATE_EMAIL);
$type = $clean($_POST["type"] ?? "");
$msg = trim(strip_tags($_POST["message"] ?? ""));
if (!$name || !$email || !$msg) { http_response_code(400); echo "Please fill in all fields. <a href='/#contact'>Back</a>"; exit; }
$subject = "=?UTF-8?B?" . base64_encode("[lagencea.com] $type — $name") . "?=";
$body = "Name: $name\nEmail: $email\nProject: $type\n\n$msg\n";
$headers = "From: no-reply@lagencea.com\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8\r\n";
$ok = mail($to, $subject, $body, $headers);
?><!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>agence ä</title>
<style>body{font-family:Arial,sans-serif;display:grid;place-items:center;min-height:100vh;margin:0;text-align:center}a{color:#000}</style></head>
<body><div><h1><?php echo $ok ? "Thank you!" : "Something went wrong."; ?></h1><p><?php echo $ok ? "Your message has been sent. I will get back to you shortly." : "Please write to jpm@lagencea.com."; ?></p><p><a href="/">← Back to agence ä</a></p></div></body></html>
