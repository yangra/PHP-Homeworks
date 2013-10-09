<?php
$pageTitle = 'Регистрация';
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';

if ($_POST) {
    $username = mysqli_real_escape_string($connection, trim($_POST['user']));
    $pass = mysqli_real_escape_string($connection, trim($_POST['pass']));
    $error = false;

    if (mb_strlen($username) < 5) {
        echo '<p class="error" >Потребителското име е твърде късо!</p>';
        $error = true;
    }

    if (mb_strlen($pass) < 5) {
        echo '<p class="error" >Паролата е твърде къса!</p>';
        $error = true;
    }

    if (mb_strlen($username) > 50 || mb_strlen($pass) > 50) {
        echo '<p class="error" >Полетата поддържат максимум 50 символа!</p>';
        $error = true;
    }

    $stmt_check = mysqli_prepare($connection, "SELECT user_name FROM users WHERE user_name= ? ");
    mysqli_stmt_bind_param($stmt_check,'s', $username);
    mysqli_stmt_execute($stmt_check);
    if (mysqli_stmt_fetch($stmt_check)) {
        echo '<p class="error" >Потребителското име е заето!</p>';
        $error = true;
    }

    if (!$error) {
        $stmt_user = mysqli_prepare($connection, "INSERT INTO users (user_name, user_pass) 
                                                 VALUES ( ?, ? );");
        mysqli_stmt_bind_param($stmt_user,'ss', $username, $pass);
        if (mysqli_stmt_execute($stmt_user)) {
            echo '<p>Вие се регистрирахте успешно!</p>';
            echo '<p>Ще бъдете автоматичо пренасочени към страницата за вход.</p>';
            header("Refresh: 2; url=index.php");  //stays on page 2 seconds before redirecting
            exit; 
         } else {
            echo '<p class="error" >Грешка при запис! Моля опитайте пак!</p>';
        }
    }
}
$button = 'Регистрирай се';
require 'includes' . DIRECTORY_SEPARATOR . 'form.php';
include 'includes' . DIRECTORY_SEPARATOR . 'footer.php';
?>