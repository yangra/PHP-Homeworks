<?php

require 'includes/variables.php';
$sum = 0.00;
if (!empty($_POST['filter'])) {
    $filter = (int) $_POST['filter'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    if (array_key_exists($filter, $type) === false && $month === 'Месец' && $year === 'Година') {
        filterData($sum, '#');
    } else {
        filterData($sum, $filter, $month, $year);
    }
} else if (!empty($_POST['delete'])) {
    $toDelete = $_POST;
    array_pop($toDelete);
    deleteRows($toDelete);
    filterData($sum, '#');
} else if (!empty($_POST['edit'])) {
    $toEdit = $_POST;
    array_pop($toEdit);
    require 'editForm.php';
    $_SESSION['edit'] = true;
    $_SESSION['toEdit'] = $toEdit;
} else if (count($_SESSION) > 0 && $_SESSION['edit']) {
    if (count($_SESSION) === 1) {
        $_SESSION['edit'] = false;
    } else {
        $toEdit = $_SESSION['toEdit'];
        require 'editRow.php';
        if (count($_SESSION['toEdit']) > 0) {
            require 'editForm.php';
        } else {
            unset($_SESSION['toEdit']);
            $_SESSION['edit'] = false;
            session_destroy();
            $_POST['filter'] = 0;
            echo '<script>document.location.replace("index.php");</script>';
        }
    }
} else {
    filterData($sum, '#');
}
?>
