<?php

$data = file('data.txt');
$errorChangingDate = false;
$errorChangingDesc = false;
$errorChangingCost = false;
foreach ($toEdit as $lineNum) {
    if (!empty($_POST[$lineNum])) {
        $line = explode('|', $data[$lineNum - 1]);
        if (!empty($_POST['date'])) {
            if (strpos($_POST['date'], '.') !== false) {
                $newDate = explode('.', $_POST['date']);
                if (checkdate($newDate[1], $newDate[0], $newDate[2])) {
                    $line[0] = $_POST['date'];
                }
            } else {
                $errorChangingDate = true;
            }
        }
        if (!empty($_POST['describtion'])) {
            $describtion = str_replace('|', '', trim($_POST['describtion']));
            if (mb_strlen($describtion) > 3 || mb_strlen($describtion) <= 50) {
                $line[1] = $describtion;
            } else {
                $errorChangingDesc = true;
            }
        }
        if (!empty($_POST['cost'])) {
            $cost = number_format(round(str_replace(',', '.', trim($_POST['cost'])), 2), 2, '.', '');
            if (is_numeric($cost) && (float) $cost > 0) {
                $line[2] = $cost;
            } else {
                $errorChangingCost = true;
            }
        }
        if (!empty($_POST['type'])) {
            $selectedGroup = $_POST['type'];
            if (!array_key_exists($selectedGroup, $type)) {
                //echo '<p style="color:red">невалидна група</p>';
            } else {
                $line[3] = $selectedGroup;
            }
        }

        $result = $line[0] . '|' . $line[1] . '|' . $line[2] . '|' . $line[3] . "\n";
        $data[$lineNum - 1] = $result;
        unset($toEdit[$lineNum]);
        unset($_SESSION['toEdit'][$lineNum]);
        if (file_put_contents('data.txt', $data) && !$errorChangingCost && !$errorChangingDate && !$errorChangingDesc) {
            echo 'Промяната е успешна';
        }
        if ($errorChangingCost) {
            echo '<p style="color:red">Невалидна цена</p>';
        }
        if ($errorChangingDate) {
            echo '<p style="color:red">Невалидна дата</p>';
        }
        if ($errorChangingDesc) {
            echo '<p style="color:red">Невалиднo описание (повече от 50 или под 4 символа)</p>';
        }
    }
}
?>
