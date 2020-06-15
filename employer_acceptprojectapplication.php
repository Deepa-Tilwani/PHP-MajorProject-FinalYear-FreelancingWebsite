<?php 
include('employer_session_check.php');

	$con=mysqli_connect("localhost","root","","freelancer");

	$selected_freelancer = $_GET['freelancer_id'];
	$project_id = $_GET['id'];
	
	
	
	
	$sql="update project set selected_freelancer='$selected_freelancer' where id='$project_id'";
	
	$res=mysqli_query($con,$sql);
	
	$_SESSION['message'] = "Project Application Accepted Successfully... ";
		
	header('Location: employer_viewapplication.php?id='.$project_id);	
				
?>
