<?php
$pageTitle = 'Списък';
include 'includes'.DIRECTORY_SEPARATOR.'header.php';
require 'includes'.DIRECTORY_SEPARATOR.'constants.php';
if (!isset($_SESSION['isLogged'])) {
    header('Location: index.php');
    exit;
}

$query = mysqli_query($connection,"SELECT * FROM messages ORDER BY msg_date DESC LIMIT 0,2");
if ($query->num_rows>0) {
    
while ($row = $query->fetch_assoc()) {
    $user_q = mysqli_query($connection,"SELECT user_name FROM users WHERE user_id='".$row['user_id']."'");
    $username = mysqli_fetch_row($user_q);
    $date_q = mysqli_query($connection,"SELECT DATE_FORMAT('".$row['msg_date']."', '%d.%m.%Y %H:%i:%s')");
    $date = mysqli_fetch_row($date_q);
    echo '<table class="list">
          <tr style="border:1px;"><td>Публикувано от '.$username[0].' на '.$date[0].'</td></tr>
          </table>';
    echo '<p><h5>'.$row['msg_title'].'</h5></p>';
    echo '<p class="msg">'.$row['msg_text'].'</p>';  
}
}else {
    echo '<p>Няма въведени съобщения!</p>';
}

include 'includes'.DIRECTORY_SEPARATOR.'footer.php';
?>