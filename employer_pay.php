<?php 
include('employer_session_check.php');

	$con=mysqli_connect("localhost","root","","freelancer");
	
	$project_id = $_GET['id'];
	
	
	
	
	$sql="update project set payment_done=1 where id='$project_id'";
	
	$res=mysqli_query($con,$sql);
	
	$_SESSION['message'] = "Project Payment Transferred Successfully... ";
		
	header('Location: employer_viewapplication.php?id='.$project_id);	
				
?>
