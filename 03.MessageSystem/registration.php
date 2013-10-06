<?php
$pageTitle = 'Регистрация';
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';
require 'includes' . DIRECTORY_SEPARATOR . 'constants.php';
if ($_POST) {
    $username = mysqli_real_escape_string($connection, trim($_POST['user']));
    $pass = mysqli_real_escape_string($connection, trim($_POST['pass']));
    $error = false;

    if (mb_strlen($username) < 5) {
        echo '<p class="error" >Потребителското име е твърде късо!</p>';
        $error = true;
    }
    
    $query = mysqli_query($connection,"SELECT user_name FROM users WHERE user_name='".$username."'");
    if ($query->num_rows>0) {
         echo '<p class="red" >Потребителското име е заето!</p>';
        $error = true;   
        }

    if (mb_strlen($pass) < 5) {
        echo '<p class="error" >Паролата е твърде къса!</p>';
        $error = true;
    }
    
    if (!$error) {
        $createUser = mysqli_query($connection, "INSERT INTO users (user_name, user_pass) 
                                                 VALUES ('" . $username . "','" . $pass . "');");
        if ($createUser) {
            echo '<p>Вие се регистрирахте успешно!</p>';
            echo '<p>Ще бъдете автоматичо пренасочени към страницата за вход.</p>';
            header("Refresh: 3; url=index.php");  //stays on page 3 seconds before redirecting
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