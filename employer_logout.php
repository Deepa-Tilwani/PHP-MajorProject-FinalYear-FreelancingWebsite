<?php
session_start();

unset($_SESSION['employer_username']);
unset($_SESSION['employer_userid']);
session_unset(); 

session_destroy();

header ('Location: login.php');
exit();
?>