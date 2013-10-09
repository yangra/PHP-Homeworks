<?php
$kind = array( 1=>'Забавни', 2=>'Драматични', 3=>'Важни', 4=>'Интересни');

echo '<select name="group">
        <option value="0" >Всички</option>';
foreach ($kind as $key => $value) {
    echo '<option value="'.$key.'" >'.$value.'</option>';
}
echo   '</select>';
?>