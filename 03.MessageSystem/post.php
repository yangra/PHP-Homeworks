<?php
$pageTitle = 'Публикувай';
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';

if (!isset($_SESSION['isLogged'])) {
    header('Location: index.php');
    exit;
}
if ($_POST) {
    $title = mysqli_real_escape_string($connection, trim($_POST['title']));
    $msg = mysqli_real_escape_string($connection, trim($_POST['text']));
    $group = $_POST['group'];
    $date = date('Y-m-d H:i:s');
    $error = false;
    $stmt_check = mysqli_prepare($connection,"SELECT msg_title, msg_text FROM messages WHERE msg_title= ? AND msg_text= ?;");
    mysqli_stmt_bind_param($stmt_check, 'ss', $title, $msg);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_bind_result($stmt_check, $msg_title, $msg_text);
    if (empty($title)|| empty($msg)) {
        $error = true;
        echo '<p class="error">Моля попълнете всички полета!</p>';
    }
    if ($group==0) {
        $error = true;
        echo '<p class="error">Моля изберете група!</p>';
    }
    if (mysqli_stmt_fetch($stmt_check)) {
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
        $stmt_add = mysqli_prepare($connection, "INSERT INTO messages (user_id, msg_date, msg_title, msg_text,msg_group)
                                                 VALUES (?, ?, ?, ?, ?);");
        mysqli_stmt_bind_param($stmt_add, 'isssi', $_SESSION['user_id'], $date, $title, $msg, $group);

        if (mysqli_stmt_execute($stmt_add)) {
           header('Location: msgList.php');
           exit; 
        }  else {
           echo '<p class="error">Грешка при запис!</p>';
        }
    }
}

?>
<form method="POST">
    <table>
        <tr>
            <td><input class="post" type="text" value="
<?php 
echo (!empty($_POST['title']))?$_POST['title']:'';
?>
" placeholder="Заглавие" name="title" />
            </td>
        </tr>
        <tr>
            <td>
                <textarea class="post" name ="text" placeholder="Напишете съобщението си тук..." >
<?php 
echo (!empty($_POST['text']))?$_POST['text']:'';
?>
</textarea>
            </td>
        </tr>
        <tr>
           <td>Моля изберете група: 
<?php
require 'includes/select.php';
?>
           </td>
        </tr>
        <tr>
            <td><input class="post" type="submit" value="Публикувай"/></td>
        </tr>
    </table>    
</form>
<?php
include 'includes'.DIRECTORY_SEPARATOR.'footer.php';
?>