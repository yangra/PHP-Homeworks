<?php

session_set_cookie_params(86400, '/', 'localhost', false, true);
session_start();

if (isset($_SESSION['isLogged'])) {

    $file = $_GET['file'];
    $file = 'database' . DIRECTORY_SEPARATOR . $_SESSION['user'][0] . DIRECTORY_SEPARATOR . $file;

    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=" . basename($file));
    header("Content-Type: application/octet-stream");
    header("Content-Transfer-Encoding: binary");
    
    readfile($file);
} else {
    header('Location: index.php');
    exit;
}
?>