<?php
$pageTitle = 'Качване';
require 'includes' . DIRECTORY_SEPARATOR . 'header.php';
require 'includes' . DIRECTORY_SEPARATOR . 'functions.php';

if (isset($_SESSION['isLogged'])) {

    if (count($_FILES) > 0 && $_FILES['file']['error'] == 4) {
        echo '<p style="color:red">Моля първо изберете файл!</p>';
    
    } else if (count($_FILES) > 0) {

        $filename = trim(str_replace('./', '', str_replace('../', '', $_FILES['file']['name'])));
        $directory = $_SESSION['user'][0];

        if (isset($_POST['rewrite']) && $_POST['rewrite'] == true) {
            $rewrite = true;    
        } else {
            $rewrite = false;
        }

        if (is_dir('database' . DIRECTORY_SEPARATOR . $directory)) {
            AddNewFile($filename, $directory, $rewrite);
        } else {
            echo '<p style="color:red">Непозволена директория!</p>';
        }
    }
} else {
    header('Location: index.php');
    exit;
}
?>
<form method ="POST" enctype="multipart/form-data">
    <table id="sub">
        <tr>
            <td><input type="file" name="file"/></td>
            <td><input type="submit" value ="Качи"/></td>
        </tr>
    </table>

    <p><input id="rewrite" type="checkbox"  name="rewrite" value ="true"/>
        <label for="rewrite">Позволено презаписване</label></p>
</form>
<?php
require 'includes' . DIRECTORY_SEPARATOR . 'footer.php';
?>