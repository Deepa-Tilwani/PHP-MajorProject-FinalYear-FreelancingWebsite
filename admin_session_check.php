<?php
session_start();

if($_SESSION['admin_username']=="")
{
	header('Location: admin_login.php');
	exit();
}
?>