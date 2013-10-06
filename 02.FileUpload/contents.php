<?php
$pageTitle = 'Качени файлове';
require 'includes' . DIRECTORY_SEPARATOR . 'header.php';
require 'includes' . DIRECTORY_SEPARATOR . 'functions.php';
?>

<?php
if (isset($_SESSION['isLogged'])) {

    $folder = scandir('database' . DIRECTORY_SEPARATOR . $_SESSION['user'][0]);
    $numberOfFiles = count($folder);
    if ($numberOfFiles < 3) {
        echo '<p>Няма качени файлове!</p>';
    } else {
?>

    <table>
        <tr>
            <th></th>
            <th>File name</th>
            <th> File size</th>
        </tr>
<?php
    for ($i = 2; $i < $numberOfFiles; $i++) {
        $path = realpath('database' . DIRECTORY_SEPARATOR . $_SESSION['user'][0]);
        $size = ConvertToUnits(filesize($path . DIRECTORY_SEPARATOR . $folder[$i]));
        $filename = $folder[$i];
        echo '<tr>
                <td>' . ($i - 1) . '</td>
                <td><a href="download.php?file=' . $filename . '">' . $filename . '</a></td>
                <td>' . $size . '</td>
              </tr>';
            }
        }
    ?>
    </table>

<?php
} else {
    header('Location: index.php');
    exit;
}
require 'includes' . DIRECTORY_SEPARATOR . 'footer.php';
?>
