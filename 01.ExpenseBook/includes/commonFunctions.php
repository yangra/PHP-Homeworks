<?php

function printTypes() {
    require 'includes/variables.php';
    foreach ($type as $key => $val) {
        echo '<option value="' . $key . '">' . $val . '</option>';
    }
}

?>
