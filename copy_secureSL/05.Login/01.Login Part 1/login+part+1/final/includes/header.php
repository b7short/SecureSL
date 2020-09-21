<?php require_once("db.php"); ?>
<?php require_once("functions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $currentPage; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
    require_once("vendor/autoload.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com";
    $mail->Port = "465";
    $mail->SMTPSecure = "ssl";

    $mail->Username = "barikbuddyi@gmail.com";
    $mail->Password = "DevAbdulBarik@";

    $mail->setFrom("barikbuddyi@gmail.com");
    $mail->addReplyTo("no-reply@barikbuddy.com");
    $mail->isHTML();