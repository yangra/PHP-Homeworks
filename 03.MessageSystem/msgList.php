<?php

$pageTitle = 'Съобщения';
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';

if (!isset($_SESSION['isLogged'])) {
    header('Location: index.php');
    exit;
}
$offset = 0;
$perPage = 5;

if (count($_GET) > 0) {
    $offset = $_GET['page'];
}

if (count($_POST) > 0 && isset($_POST['del'])) {
    $index = $_POST['del'];
    $q_del = "DELETE FROM messages WHERE msg_id =" . $index;
    mysqli_query($connection, $q_del);
    unset($_POST['del']);
    header('Location: msgList.php');
}

echo '<br/><div class="filter">
        <form method="POST">';
require 'includes/select.php';
echo '<input type="submit" value="Филтрирай"/>
       </form></div>';

if (!empty($_POST['sort'])) {
    if ($_SESSION['sort'] === "DESC") {
        $_SESSION['sort'] = "ASC";
        unset($_POST['sort']);
    } else {
        $_SESSION['sort'] = "DESC";
        unset($_POST['sort']);
    }
}
$sort = $_SESSION['sort'];
$sort_button = $sort == "DESC" ? 'Най-старите най-отпред' : 'Най-новите най-отпред';
echo '<div class="sort">
        <form method="POST">
            <input type="hidden" name="sort" value="1"/> 
            <input type="submit" value="' . $sort_button . '" />
        </form>
     </div>';

$group = (!empty($_POST['group']) && (int) $_POST['group'] != 0) ? " WHERE msg_group=" . $_POST['group'] : "";

$stmt_msg = mysqli_prepare($connection, "SELECT users.user_name,
                                                messages.msg_id,
                                                DATE_FORMAT(messages.msg_date, '%d.%m.%Y %H:%i:%s'),
                                                messages.msg_title, 
                                                messages.msg_text,
                                                messages.msg_group
                                         FROM messages 
                                         INNER JOIN users 
                                         ON messages.user_id=users.user_id 
                                         " . $group . "
                                         ORDER BY messages.msg_date " . $sort . " 
                                         LIMIT ? OFFSET ?");
//if (!$stmt_msg) {
//    exit;
//}
mysqli_stmt_bind_param($stmt_msg, 'ii', $perPage, $offset);
mysqli_stmt_execute($stmt_msg);
mysqli_stmt_bind_result($stmt_msg, $user_name, $msg_id, $date, $msg_title, $msg_text, $msg_group);

$no_msgs = true;
while (mysqli_stmt_fetch($stmt_msg)) {
    $no_msgs = false;
    $id = ' id="group' . $msg_group . '"';
    echo '<p></p>';
    echo '<table ' . $id . ' class="list">
          <tr><td>Публикувано от ' . $user_name . ' на ' . $date . '</td>';
    if ($_SESSION['user_name'] === 'admin') {
        echo '<td><form method="POST">
              <input type="hidden" value="' . $msg_id . '" name="del"/>
              <input type="submit" value="Изтрий"/>
              </form></td>';
    }
    echo '</tr>
          </table>';
    echo '<p class="title">' . $msg_title . '</p>';
    echo '<p class="msg">' . $msg_text . '</p>';
}
if ($no_msgs) {
    echo '<p>Няма публикувани съобщения!</p>';
}

$query = mysqli_query($connection, "SELECT * FROM messages" . $group);
$msgNum = $query->num_rows;
for($count = 0; $count < $msgNum; $count++){
    if ($count % $perPage === 0) {
        if ($offset == $count) {
            echo '<div class="page">' . ($count / $perPage + 1) . '</div>';
        } else {
            echo '<div class="page"><a href="msgList.php?page=' . $count . '">' . ($count / $perPage + 1) . '</a></div>';
        }
    }
}
include 'includes' . DIRECTORY_SEPARATOR . 'footer.php';
?>