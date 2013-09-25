<?php

mb_internal_encoding('UTF-8');

function filterData(&$sum, $filter, $month = 'Месец', $year = 'Година') {
    require 'includes/variables.php';
    if (file_exists('data.txt')) {
        $result = file('data.txt');
        $lineNumber = 1;
        foreach ($result as $value) {
            $columns = explode('|', $value);
            $date = explode('.', $columns[0]);
            if ($filter === '#') {
                printRow($columns, $lineNumber, $sum);
            } else if (array_key_exists($filter, $type) && $month != 'Месец' && $year != 'Година') {
                if ((int) $columns[3] === $filter && $month == (int) $date[1] && $year == $date[2]) {
                    printRow($columns, $lineNumber, $sum);
                }
            } else if (array_key_exists($filter, $type) && $month != 'Месец') {
                if ((int) $columns[3] === $filter && $month == (int) $date[1]) {
                    printRow($columns, $lineNumber, $sum);
                }
            } else if (array_key_exists($filter, $type) && $year != 'Година') {
                if ((int) $columns[3] === $filter && $year == $date[2]) {
                    printRow($columns, $lineNumber, $sum);
                }
            } else if ($month != 'Месец' && $year != 'Година') {
                if ($month == (int) $date[1] && $year == $date[2]) {
                    printRow($columns, $lineNumber, $sum);
                }
            } else if (array_key_exists($filter, $type)) {
                if ((int) $columns[3] === $filter) {
                    printRow($columns, $lineNumber, $sum);
                }
            } else if ($month != 'Месец') {
                if ($month == (int) $date[1]) {
                    printRow($columns, $lineNumber, $sum);
                }
            } else if ($year != 'Година') {
                if ($year == $date[2]) {
                    printRow($columns, $lineNumber, $sum);
                }
            }
        }
    }
}

function printRow($columns, &$rowNumber, &$sum) {
    require 'includes/variables.php';
    echo '<tr>
         <td><input type="checkbox" name ="' . $rowNumber . '" value="' . $rowNumber . '"></td>
         <td>' . $columns[0] . '</td>
         <td>' . $columns[1] . '</td>
         <td>' . $columns[2] . '</td>
         <td>' . $type[trim($columns[3])] . '</td>
         </tr>';
    $sum+=(float) ($columns[2]);
    $rowNumber++;
}

function deleteRows($lines) {
    $data = file('data.txt');
    foreach ($lines as $line) {
        $data[$line - 1] = '';
    }
    file_put_contents('data.txt', $data);
}

?>