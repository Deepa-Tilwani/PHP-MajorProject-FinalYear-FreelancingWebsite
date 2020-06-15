<?php
session_start();

unset($_SESSION['admin_username']);
unset($_SESSION['admin_userid']);
session_unset(); 

session_destroy();

header ('Location: admin_login.php');
exit();
?>