<?php
mb_internal_encoding('UTF-8');
$pageTitle = 'Регистрация';
require 'includes' . DIRECTORY_SEPARATOR . 'header.php';

if ($_POST) {

    $username = trim(str_replace('<EOF>', '', str_replace('.', '', str_replace('\\', '', str_replace('/', '', $_POST['username'])))));
    $pass = trim(str_replace('<EOF>', '', $_POST['pass']));
    $name = trim(str_replace('<EOF>', '', $_POST['name']));
    $error = false;

    if (mb_strlen($username) < 4) {
        echo '<p style="color:red">Потребителското име е твърде късо!</p>';
        $error = true;
    }

    $data = file('database/userData.txt');
    $numberOfUsers = count($data);
    for ($i = 0; $i < $numberOfUsers; $i++) {
        $row = explode('<EOF>', $data[$i]);
        if ($username === $row[0]) {
            echo '<p style="color:red">Потребителското име е заето!</p>';
            $error = true;
            break;
        }
    }

    if (mb_strlen($pass) < 6) {
        echo '<p style="color:red">Паролата е твърде къса!</p>';
        $error = true;
    }

    if (mb_strlen($name) < 3) {
        echo '<p style="color:red">Името ви е твърде късо!</p>';
        $error = true;
    }

    if (!$error) {
        $result = $username . '<EOF>' . $pass . '<EOF>' . $name . "\n";
        if (file_put_contents('database/userData.txt', $result, FILE_APPEND)) {
            mkdir('database' . DIRECTORY_SEPARATOR . $username);
            echo '<p>Регистрирахте се успешно!</p>';
            echo '<p>потербител: ' . $username . '    Парола: ' . $pass . '</p>';
            echo'<a href="index.php">Сега можете да влезете в профила си</a>';
            exit;
        } else {
            echo '<p style="color:red">Грешка при регистрация, моля опитайте пак!</p>';
        }
    }
}
?>
<a href="index.php">Вход</a>
<form  method = "POST">
    <table>
        <tr>
            <td><label for="username">Потребител:</label></td> 
            <td><input type="text" name ="username"/> Минимум 4 символа - непозволени символи (<b> . / \</b> )</td>
        </tr>
        <tr>
            <td><label for="pass">Парола:</label></td>
            <td><input type="password" name ="pass"/> Минимум 6 символа</td>
        </tr>
        <tr>
            <td><label for="name">Име:</label></td>
            <td><input type="text" name ="name"/> Минимум 3 символа</td>
        </tr>
        <tr>
            <td></td>
            <td><input id="reg" type ="submit" value="Регистрирай се"/></td>
        </tr>
    </table>
</form>

<?php
require 'includes' . DIRECTORY_SEPARATOR . 'footer.php';
?>