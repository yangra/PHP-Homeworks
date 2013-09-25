<?php
$pageTitle = 'Форма';
include 'includes/header.php';
require 'includes/formFunctions.php';
require 'includes/commonFunctions.php';

if ($_POST) {
    $date = date("d.m.Y");
    $describtion = str_replace('|', '', trim($_POST['describtion']));
    $cost = str_replace(',', '.', trim($_POST['cost']));
    $selectedGroup = (int) $_POST['type'];

    if (isValid($cost, $describtion, $selectedGroup)) {
        $cost = number_format(round($cost, 2), 2, '.', '');
        $result = $date . '|' . $describtion . '|' . $cost . '|' . $selectedGroup . "\n";
        if (file_put_contents('data.txt', $result, FILE_APPEND)) {
            echo '<p>Записът е успешен</p>';
        }
    }
}
?>
<a href="index.php">Списък</a>
<form method="POST">
    <table id="form">
        <tr>
            <td id="form"><label for="describtion">Описание:</label></td>
            <td id="form"><input type="text" name="describtion" /></td>
        </tr>
        <tr>
            <td><label for="cost">Сума:</label></td>
            <td><input type="text" name="cost" /></td>
        </tr>
        <tr>
            <td><label for="cost">Вид:</label></td>
            <td><select name="type">
<?php
printTypes();
?>
                </select>
            </td>
        </tr>
        <tr>
            <td id="form"></td>
            <td id="form"><input type="submit" value="Добави" /></td>
        </tr>
    </table>
</form>
<?php
include 'includes/footer.php';
//echo '<pre>' . print_r($_POST, true) . '</pre>';
?>
