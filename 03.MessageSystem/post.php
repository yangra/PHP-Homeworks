
<?php
$pageTitle = 'Публикувай';
include 'includes'.DIRECTORY_SEPARATOR.'header.php';
require 'includes'.DIRECTORY_SEPARATOR.'constants.php';
if (!isset($_SESSION['isLogged'])) {
    header('Location: index.php');
    exit;
}
if ($_POST) {
    $title = mysqli_real_escape_string($connection, trim($_POST['title']));
    $msg = mysqli_real_escape_string($connection, trim($_POST['text']));
    $date = date('Y-m-d H:i:s');
    $error = false;
    $query = mysqli_query($connection,"SELECT msg_title, msg_text FROM messages WHERE msg_title='".$title."' AND msg_text='".$msg."';");
    if (empty($title)|| empty($msg)) {
        $error = true;
        echo '<p class="error">Моля попълнете всички полета!</p>';
    }
    if (mysqli_fetch_row($query)>0) {
        $error = true;
        echo '<p class="error">Това съобщение е вече публикувано!</p>';
    }
    if (mb_strlen($title)>50) {
        $error = true;
        echo '<p class="error">Максималната дължина на заглавието е 50 символа!';
    }
    if (mb_strlen($msg)>250) {
        $error = true;
        echo '<p class="error">Максималната дължина на съобщението е 250 символа!';
    }
    
    if (!$error) {
        if (mysqli_query($connection,"INSERT INTO messages (user_id, msg_date, msg_title, msg_text)
            VALUES ('".$_SESSION['user']."', '".$date."', '".$title."', '".$msg."');")) {
          echo '<p>Успешна публикация</p>';  
        } else  {
            echo '<p class="error">Грешка при запис!</p>';
            echo mysqli_error($connection);
        }
    }
}
?>
<form method="POST">
    <table>
        <tr>
            <td><input type="text" name="title" placeholder="Заглавие" style="width:450px;"/></td>
        </tr>
        <tr>
            <td><textarea name ="text" placeholder="Напишете съобщението си тук..." style="width:450px;height:400px;"></textarea></td>
        </tr>
        <tr>
            <td><input type="submit" value="Публикувай"/></td>
        </tr>
    </table> 
</form>
<?php
include 'includes'.DIRECTORY_SEPARATOR.'footer.php';
?>