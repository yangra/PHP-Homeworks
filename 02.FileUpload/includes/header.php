<?php
session_set_cookie_params(86400, '/', 'localhost', false, true);
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $pageTitle; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css"/>
    </head>
    <body>
        <div align="center">
            <?php
            if (count($_SESSION) > 0 && $_SESSION['isLogged']) {

                echo' <a href="upload.php">Качи файл</a>  ';
                echo '<a href="contents.php">Списък с качените файлове</a>  ';
                echo '<a href="exit.php">Изход</a>';

                echo '<p> Здравей, ' . $_SESSION['user'][2] . '</p>';
            }

