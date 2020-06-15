<?php
session_start();

unset($_SESSION['freelancer_username']);
unset($_SESSION['freelancer_userid']);
session_unset(); 

session_destroy();

header ('Location: login.php');
exit();
?>