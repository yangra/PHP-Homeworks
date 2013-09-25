<?php
$pageTitle = 'Списък';
include 'includes/header.php';
require 'includes/indexFunctions.php';
require 'includes/commonFunctions.php'
?>

<a href="form.php">Добави нов разход</a>
<form method="POST">
    <select name="month">
        <option>Месец</option>
        <?php
        for ($i = 1; $i < 13; $i++) {
            echo '<option value="' . $i . '">' . $i . '</option>';
        }
        ?>
    </select>
    <select name="year">
        <option>Година</option>
        <?php
        for ($i = 2000; $i < 2014; $i++) {
            echo '<option value="' . $i . '">' . $i . '</option>';
        }
        ?>
    </select>
    <select name="filter">
        <option>Всички</option>
        <?php
        printTypes();
        ?>
    </select>
    <input type="submit" value="Филтър">
</form>
<form method="POST">
    <table >
        <tr>
            <th></th>
            <th>Дата</th>
            <th>Описание</th>
            <th>Сума</th>
            <th>Вид</th>
        </tr>
        <?php
        require 'includes/processPOST.php';
        ?>
        <tr>
            <td></td>
            <td>-</td>
            <td>-</td>
            <td><b><?php echo number_format($sum, 2, '.', ''); ?></b></td>
            <td>-</td>
        </tr>
    </table>
    <?php
    if (count($_SESSION) < 2 && (empty($_POST) || (array_key_exists('delete', $_POST) && $_POST['delete'] == 'Изтрий') ||
            (array_key_exists('month', $_POST) && $_POST['month'] == 'Месец' && $_POST['year'] == 'Година' && $_POST['filter'] == 'Всички'))) {
        echo '<input type="submit" value ="Изтрий" name="delete">';
        echo '<input type="submit" value ="Промени" name="edit">';
    }
    ?>

</form>
<?php
include 'includes/footer.php';
//echo '<pre>'.print_r($_POST,true).'</pre>';
//echo '<pre>'.print_r($_SESSION,true).'</pre>';
?>

