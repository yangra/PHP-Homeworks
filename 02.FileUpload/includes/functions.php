<?php

if (!isset($_SESSION['isLogged'])) {
    header('Location:index.php');
}

function AddNewFile($filename, $directory, $rewrite) {
    $uploaded = false;

    if ($rewrite) {
        WriteFile($filename, $directory);
    } else {
        $folderContents = scandir('database' . DIRECTORY_SEPARATOR . $directory);
        $numberOfFiles = count($folderContents);
        for ($i = 0; $i < $numberOfFiles; $i++) {
            if ($folderContents[$i] === $filename) {
                $uploaded = true;
                break;
            }
        }
        if ($uploaded) {
            echo '<p style="color:red">Вече има качен файл с такова име!</p>';
        } else {
            WriteFile($filename, $directory);
        }
    }
}

function WriteFile($filename, $directory) {

    if (move_uploaded_file($_FILES['file']['tmp_name'], 'database' . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR . $filename)) {
        echo '<p>Файлът е записан успешно!</p>';
    } else {
        echo '<p style="color:red">Грешка при запис!</p>';
    }
}

function ConvertToUnits($size) {
    $unit = 0;
    while ($size > 1024) {
        $size/=1024.0;
        $unit++;
    }
    $size = round($size, 2);
    if ($unit == 0)
        $size = $size . ' bytes';
    else if ($unit == 1)
        $size = $size . ' KB';
    else if ($unit == 2)
        $size = $size . ' MB';
    else if ($unit == 3)
        $size = $size . ' GB';
    else if ($unit == 4)
        $size = $size . ' TB';

    return $size;
}

?>
