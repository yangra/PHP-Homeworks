<?php

$data = file('data.txt');
//$finalSum = 0.00;
//$rowNumber = 1;

foreach ($data as $key => $record) {
    $columns = explode('|', $record);
    if (array_key_exists($key + 1, $toEdit)) {
        echo '<form method="POST"><tr>
             <td><input type="submit" name="' . ($key + 1) . '" value="Edit"></td>
             <td><input type="text" placeholder="' . $columns[0] . '" name="date"></td>
             <td><input type="text" placeholder="' . $columns[1] . '" name="describtion"></td>
             <td><input type="text" placeholder="' . $columns[2] . '" name="cost"></td>
             <td><select name="type">';
        printTypes();
        echo '</selection></td>
                </tr></form>';
    } else {
        //printRow($columns, $rowNumber, $finalSum);
    }
}
?>
