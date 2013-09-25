<?php

mb_internal_encoding('UTF-8');

function isValid($cost, $describtion, $selectedGroup) {
    require 'includes/variables.php';
    $error = false;
    if (!is_numeric($cost) || (float) $cost <= 0) {
        echo '<p style="color:red">Невалидна цена</p>';
        $error = true;
    }
    if (mb_strlen($describtion) < 4 || mb_strlen($describtion) > 50) {
        echo '<p style="color:red">Невалиднo описание (повече от 50 или под под 4 символа)</p>';
        $error = true;
    }
    if (!array_key_exists($selectedGroup, $type)) {
        echo '<p style="color:red">невалидна група</p>';
        $error = true;
    }
    return !$error;
}

?>
