<?php
$pageTitle = 'Вход';
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';

if (isset($_SESSION['isLogged'])) {
    header('Location: msgList.php');
    exit;
}

if ($_POST) {
    $username = mysqli_real_escape_string($connection, trim($_POST['user']));
    $pass = mysqli_real_escape_string($connection, trim($_POST['pass']));
    
    $query = mysqli_query($connection,"SELECT user_id, user_name FROM users 
                            WHERE user_name='".$username."' AND user_pass='".$pass."'");
    if (mysqli_num_rows($query)>0) {
        $user = mysqli_fetch_row($query);
        $_SESSION['isLogged'] = true;
        $_SESSION['user_id'] = $user[0];
        $_SESSION['user_name'] = $user[1];
        $_SESSION['sort'] = "DESC";
        header('Location: msgList.php');
        exit;
    }  else {
        echo '<p class="error">Въведените потребител и/или парола са невалидни!</p>';
        }
}
$button = 'Влез';
require 'includes'.DIRECTORY_SEPARATOR.'form.php';
include 'includes'.DIRECTORY_SEPARATOR.'footer.php';
?>