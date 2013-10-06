<?php
mb_internal_encoding('UTF-8');
$pageTitle = 'Вход';
require 'includes' . DIRECTORY_SEPARATOR . 'header.php';

if (count($_SESSION) > 0 && $_SESSION['isLogged']) {
    header('Location: contents.php');
    exit;

} else {
    if ($_POST) {
        $username = trim(str_replace('<EOF>', '', $_POST['username']));
        $pass = trim(str_replace('<EOF>', '', $_POST['pass']));
        $data = file('database/userData.txt');
        $numberOfUsers = count($data);
        for ($i = 0; $i < $numberOfUsers; $i++) {
            $row = explode('<EOF>', $data[$i]);
            if ($username == $row[0] && $pass == $row[1]) {
                $_SESSION['isLogged'] = true;
                $_SESSION['user'] = $row;
                header('Location: index.php');
                exit;
            }
        }
        echo '<p style="color:red">Въведените данни са грешни!</p>';
    }
    ?>
    <a href="registration.php">Регистрирай се</a>
    <form  method = "POST">
        <table>
            <tr>
                <td><label for="username">Потребител:</label></td> 
                <td><input type="text" name ="username" value ="user"/></td>
            </tr>
            <tr>
                <td><label for="pass">Парола:</label></td>
                <td><input type="password" name ="pass" value ="qwerty"/></td>
            </tr>
            <tr>
                <td></td>
                <td><input type ="submit" value="Влез"/></td>
            </tr>
        </table>
    </form>
    <?php
}
require 'includes' . DIRECTORY_SEPARATOR . 'footer.php';
?>