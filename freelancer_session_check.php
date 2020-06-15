<?php
session_start();

if($_SESSION['freelancer_username']=="")
{
	header('Location: login.php');
	exit();
}
?>