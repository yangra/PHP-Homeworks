<form method="POST">
    <table>
        <tr>
            <td>Потребител: </td>
            <td><input type="text" name="user"/><?php if ($pageTitle=='Регистрация') 
                                                            echo ' Минимум 5 символа'?></td>
        </tr>
        <tr>
            <td> Парола: </td>
            <td><input type="password" name="pass"/><?php if ($pageTitle=='Регистрация') 
                                                            echo ' Минимум 5 символа'?></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="<?php echo $button; ?>"/></td>
        </tr>
    </table>   
</form>
