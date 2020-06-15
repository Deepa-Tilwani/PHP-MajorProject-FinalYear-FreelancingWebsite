<?php
session_start();

if($_SESSION['employer_username']=="")
{
	header('Location: login.php');
	exit();
}
?>