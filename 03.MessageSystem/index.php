<?php
$pageTitle = 'Вход';
include 'includes'.DIRECTORY_SEPARATOR.'header.php';
require 'includes'.DIRECTORY_SEPARATOR.'constants.php';
if (isset($_SESSION['isLogged'])) {
    header('Location: msgList.php');
    exit;
}
if ($_POST) {
    $username = trim($_POST['user']);
    $pass = trim($_POST['pass']);
    $query = mysqli_query($connection,"SELECT user_id FROM users 
                            WHERE user_name='".$username."' AND user_pass='".$pass."'");
    if ($query->num_rows>0) {
        $user = $query->fetch_row();
        $_SESSION['isLogged'] = true;
        $_SESSION['user'] = $user[0];
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