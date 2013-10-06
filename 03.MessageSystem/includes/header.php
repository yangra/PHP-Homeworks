<?php
session_set_cookie_params(3600, '/', 'localhost', false, true);
session_start();
mb_internal_encoding('UTF-8');
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $pageTitle; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="includes/style.css" type="text/css"/>
    </head>
    <body>
        <div align="center">
            <?php
            if ($pageTitle == 'Вход') {
                echo '<a href="registration.php">Регистрирай се</a>';
            } else if ($pageTitle == 'Регистрация') {
                echo '<a href="index.php">Вход</a>';
            } else if ($pageTitle == 'Списък') {
                echo '<a href="post.php">Създай съобщение</a> ';
                echo '<a href="logout.php">Изход</a>';
            } else {
                echo '<a href="msgList.php">Списък съобщения</a> ';
                echo '<a href="logout.php">Изход</a>';
            }
            ?>