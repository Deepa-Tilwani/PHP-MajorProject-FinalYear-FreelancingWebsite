<?php 
include('employer_session_check.php');

	$con=mysqli_connect("localhost","root","","freelancer");

	$sql="delete from project where id='".$_GET['id']."'";
	
	$res=mysqli_query($con,$sql);
	
	$_SESSION['message'] = "Project Successfully Deleted... ";
		
	header('Location: employer_projectlist.php');	
				
?>
