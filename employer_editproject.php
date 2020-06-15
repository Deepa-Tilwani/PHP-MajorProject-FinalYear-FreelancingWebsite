<?php 
include('employer_session_check.php');

$con=mysqli_connect("localhost","root","","freelancer");

$message = "";

if($_SERVER["REQUEST_METHOD"]=="POST")
{		
		
		$id=$_POST['id'];	
		
		$title=$_POST['title'];		
		$description=$_POST['description'];		
		$budget=$_POST['budget'];		       
		$time=$_POST['time'];
		$submission=$_POST['submission'];
        
		$skills='';
		if(!empty($_POST['skills']))
		 {
			foreach($_POST['skills'] as $js)
			{
				$skills = $skills . $js . ',';
			}
		 }
		 
		$qualification='';
		if(!empty($_POST['qualification']))
		 {
			foreach($_POST['qualification'] as $jq)
			{
				$qualification = $qualification . $jq . ',';
			}
		 }
				
		

		   $qe="update project set title = '$title', description = '$description', skills = '$skills', budget = '$budget', time = '$time', submission = '$submission', qualification = '$qualification' where id = '$id'";		   
		
		//echo $qe;
		 mysqli_query($con,$qe) or exit('error');
		 
		 $message="Your Project Requirement Sucessfully Submitted.";		 		 
		 		 		
}
else
{
	$sql="Select * from project where id='".$_GET['id']."'";
	
		$res=mysqli_query($con,$sql);
		while($row=mysqli_fetch_array($res))	
		 {
			$id=$row['id'];			
			$title=$row['title'];	
			$description=$row['description'];		
			$budget=$row['budget'];		       
			$time=$row['time'];
			$submission=$row['submission'];			
			$skills=$row['skills'];						
			$qualification=$row['qualification'];			
		 }	 
}


?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Employer New Project</title>
		<!-- Loading third party fonts -->
		<link href="http://fonts.googleapis.com/css?family=Titillium+Web:200,300,400,700|" rel="stylesheet" type="text/css">
		<link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Loading main css file -->
		<link rel="stylesheet" href="style.css">
		
		<!--[if lt IE 9]>
		<script src="js/ie-support/html5.js"></script>
		<script src="js/ie-support/respond.js"></script>
		<![endif]-->

	</head>


	<body class="homepage">
		
		<div id="site-content">

			<header class="site-header">
				<div class="container">
					<div id="branding">
						<img src="images/logo.png" alt="" class="logo">
						<h1 class="site-title"><a href="index.php">FREELANCER</a></h1>
						<small class="site-description">GET WORK.. GET PAID..</small>
					</div>
				</div>
			</header> <!-- .site-header -->
			
			
			<main class="main-content">
				<div class="hero">
					<div class="featured-image" data-bg-image="dummy/home.jpg" style="background-image: url(&quot;dummy/home.jpg&quot;);">
						<a href="employer_profile.php" class="button">Profile</a>
						<a href="employer_projectlist.php" class="button">Project List</a>
						<a href="employer_newproject.php" class="button">Add New Project</a>
						<a href="employer_logout.php" class="button">Logout (<?php echo $_SESSION['employer_username']; ?>)</a>
					</div>
				</div> <!-- .hero -->

				<div class="fullwidth-block content">
					<div class="container">
										
<center><h1>
Edit Project
</h1></center>
						<div class="price-area">
							<div class="row">
							<p style="margin-left:50px;">
							<?php
							
							if($message!="")
							{
								echo $message;
							}							
							?>
							</p>
							
							<form enctype="multipart/form-data" method="post">
								<div class="col-md-10 col-md-offset-1">
									<div class="request-form">
										<div class="field">
											<label for="#">Title:</label>
											<input type="hidden" name="id" value="<?php echo $id; ?>">
											<input type="text" name="title" value="<?php echo $title; ?>" >
										</div> <!-- .field -->
										<div class="field">
											<label for="#">Project Specification:</label>							
											<textarea name="description"  ><?php echo $description; ?></textarea>
										</div> <!-- .field -->
										<div class="field-column row">
											<div class="col-sm-6">
												<div class="field">
													<label for="">Project Budget:</label>
													<input type="text" name="budget" value="<?php echo $budget; ?>">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="field">
													<label for="">Time Limitation:</label>
													<input type="text" name="time" value="<?php echo $time; ?>" >
												</div>
											</div>
										</div>
										<div class="field-column row">
											<div class="col-sm-6">
												<div class="field">
													<label for="">Submission Date:</label>
													<input type="date" name="submission" value="<?php echo $submission; ?>">
												</div>
											</div>											
										</div> <!-- .field-column -->

<div class="field-column row">
											<div class="col-sm-6">
												<div class="field">
													<label for="">Qualification:</label>
													<br>
													<?php
					   $qualification_ar = explode(',',$qualification); 
					   
					   $q='Select * from qualification_table where active="1"';
					   $res=mysqli_query($con,$q); 
					   while($r = mysqli_fetch_array($res))
					   {
						   $checkskillmatch=0;
						   foreach($qualification_ar as $singlequali)
						   {
							   if($singlequali==$r['id'])
							   {
								   $checkskillmatch=1;
								   break;
							   }
						   }
						   
						   if($checkskillmatch==1)
						   {
							   echo " &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input style='display:inline; width:auto; vertical-align:middle;'  type='checkbox' checked='checked' name='qualification[]' value='".$r['id']."'>"
								.$r['qualification']."<br>";
						   }
						   else
						   {
							   echo " &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input style='display:inline; width:auto; vertical-align:middle;'  type='checkbox' name='qualification[]' value='".$r['id']."'>".$r['qualification']."<br>";
						   }
											 
					   }
					  ?>
													
													
												</div>
											</div>
											<div class="col-sm-6">
												<div class="field">
													<label for="">Skills:</label>
													<div>
														<?php
					   $skill_ar = explode(',',$skills); 
					   
					   $q='Select * from skill_table where active="1"';
					   $res=mysqli_query($con,$q); 
					   while($r = mysqli_fetch_array($res))
					   {
						   $checkskillmatch=0;
						   foreach($skill_ar as $singleSkill)
							{
							   if($singleSkill==$r['id'])
								{
								   $checkskillmatch=1;
								   break;
								}
							}
						   
						   if($checkskillmatch==1)
						   {
							   echo " &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input style='display:inline; width:auto; vertical-align:middle;'  type='checkbox' checked='checked' name='skills[]' value='".$r['id']."'>".$r['skill']."<br>";
						   }
						   else
						   {
							   echo " &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input style='display:inline; width:auto; vertical-align:middle;'  type='checkbox' name='skills[]' value='".$r['id']."'>".$r['skill']."<br>";
						   }
						}
						
					  ?> 
													</div>
												</div>
											</div>
										</div> <!-- .field-column -->										
										
									</div>
								</div>

								
								<div class="col-md-offset-1" style="clear:both;">
							<input type="submit" value="Update">	
							</div>
							</form>
							
							</div>
							
						</div>
					</div>
				</div> <!-- .fullwidth-block -->

			</main>
			
			
			<footer class="site-footer">
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<div class="widget">
								<h3 class="widget-title">Contact</h3>
								<strong>FREELANCER</strong>
								<address>GWECA AJMER</address>
								<a href="tel:1234567890">(123) 456 789 100</a> <br>
								<a href="mailto:office@freelancer.com">office@freelancer.com</a>
							</div> <!-- .widget-title -->
						</div>
						<div class="col-md-4">
							<div class="widget">
								<h3 class="widget-title">Social Media</h3>
								<div class="social-links">
									<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
									<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
									<a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
									<a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a>
								</div>
							</div> <!-- .widget-title -->
						</div>
						<div class="col-md-4">
							<div class="widget">
								<h3 class="widget-title">Join US</h3>
								<form action="#" class="subscribe">
									<input type="email" placeholder="Enter your email...">
									<input type="submit" value="sign up">
								</form>
							</div> <!-- .widget-title -->
						</div>
					</div> <!-- .row -->
					<div class="copy">
						<p>Copyright 2017 FREELANCER,  All rights reserved</p>
					</div>
				</div> <!-- .container -->
			</footer> <!-- .site-footer -->

		</div> <!-- #site-content -->

		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/plugins.js"></script>
		<script src="js/app.js"></script>
		
	</body>

</html>