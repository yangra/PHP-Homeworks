<?php
session_set_cookie_params(3600, '/', 'localhost', false, true);
session_start();
mb_internal_encoding('UTF-8');
$connection = mysqli_connect('localhost', 'admin', 'password', '03.msgsys');
if (!$connection) {
    echo '<p style="text-align: center; color:red;">Fatal error! No connection to the database! Please try later.</p>';
    exit;
}
mysqli_set_charset($connection, 'utf8');
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
                echo '<p class="menu" ><a href="registration.php">Регистрирай се</a></p>';
            } else if ($pageTitle == 'Регистрация') {
                echo '<p class="menu" ><a href="index.php">Вход</a></p>';
            } else if ($pageTitle == 'Съобщения') {
                echo '<p class="menu" ><a href="post.php">Ново съобщение</a></p> ';
                echo '<p class="menu" ><a href="logout.php">Изход</a></p>';
            } else {
                echo '<p class="menu" ><a href="msgList.php">Списък съобщения</a></p> ';
                echo '<p class="menu" ><a href="logout.php">Изход</a></p>';
            }
            ?>