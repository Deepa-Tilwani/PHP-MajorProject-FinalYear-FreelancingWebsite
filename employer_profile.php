<?php 
include('employer_session_check.php');

$con=mysqli_connect("localhost","root","","freelancer");

$message = "";

if($_SERVER["REQUEST_METHOD"]=="POST")
{		
		$name=$_POST['name'];		
		$password=$_POST['password'];
		        
		$dob=$_POST['dob'];
		$email=$_POST['email'];
		$number=$_POST['number'];
		$address=$_POST['address'];		
		$gender=$_POST['gender'];
	   
        				 				 		 			      
				
		

		   $qe="update employer set pass='$password',name='$name',dob='$dob',gender='$gender',email='$email', number='$number',address='$address' where sr_no='".$_SESSION['employer_userid']."'";
		
		//echo $qe;
		 mysqli_query($con,$qe) or exit('error');
		 
		 $message="Your Information Sucessfully Updated";		 		 
		 		 
		
}
else
{
	
	$sql="Select * from employer  where sr_no='".$_SESSION['employer_userid']."'";
	
		$res=mysqli_query($con,$sql);
		while($row=mysqli_fetch_array($res))	
		 {
			$id=$row['sr_no'];
			$name=$row['name'];
			$email=$row['email'];
			$password=$row['pass'];			
			$dob=$row['dob'];
			$gender=$row['gender'];
			$number=$row['number'];
			$address=$row['address'];			
		 }	 
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Employer Profile</title>
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
Employer Profile
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
											<label for="#">Your name:</label>
											<input type="text" name="name" value="<?php echo $name; ?>">
										</div> <!-- .field -->
										<div class="field-column row">
											<div class="col-sm-6">
												<div class="field">
													<label for="">Email:</label>
													<input type="text" name="email" value="<?php echo $email; ?>">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="field">
													<label for="">Password:</label>
													<input type="password" name="password" value="<?php echo $password; ?>" >
												</div>
											</div>
										</div>
										<div class="field-column row">
											<div class="col-sm-6">
												<div class="field">
													<label for="">DOB:</label>
													<input type="date" name="dob" value="<?php echo $dob; ?>">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="field">
													<label for="">Gender:</label>
													<div>
														<input type="radio" name="gender" value="male" style="display:inline; width:auto; vertical-align:middle;" 
														
														<?php
														
														if($gender=="male")
														{
															echo "checked ";
														}
														
														?>
														
														> <label style="display:inline;width:auto; margin-right:20px;">Male</label>
														<input type="radio" name="gender" value="female" style="display:inline; width:auto; vertical-align:middle;" 
														
														<?php
														
														if($gender=="female")
														{
															echo "checked ";
														}
														
														?>
														
														>
														<label style="display:inline;width:auto;">Female</label>
													</div>
												</div>
											</div>
										</div> <!-- .field-column -->
										<div class="field">
											<label for="#">Address:</label>
											<input type="text" name="address" value="<?php echo $address; ?>" >
										</div> <!-- .field -->											
										<div class="field">
											<label for="#">Contact No:</label>
											<input type="text" name="number" value="<?php echo $number; ?>">
										</div> <!-- .field -->
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