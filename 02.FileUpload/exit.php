<?php

session_set_cookie_params(86400, '/', 'localhost', false, true);
session_start();
session_destroy();
header('Location: index.php');
exit;
?>
