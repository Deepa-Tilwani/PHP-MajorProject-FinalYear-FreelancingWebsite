<?php
session_start();

$con=mysqli_connect("localhost","root","","freelancer");

$register_message="";

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$pass = $_POST['password'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$address = $_POST['address'];
	$registertype = $_POST['registertype'];
	
	$sql="";
	
	if($registertype=='freelancer')
	{
		$sql = "insert into freelancer(name,email,pass,dob,gender,address) values('$name','$email','$pass','$dob','$gender','$address')";			
	}
	else
	{
		$sql = "insert into employer(name,email,pass,dob,gender,address) values('$name','$email','$pass','$dob','$gender','$address')";
	}	
	
	if (mysqli_query($con,$sql))
	{
		$register_message= "Registered Successfully...";
	}
	else
	{
		$register_message= "Error in Registration...";
	}
	
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>FREELANCER </title>
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
					<div class="hero-half-background" data-bg-image="dummy/hero.jpg"></div>
					<div class="container">
						<div class="row">
							<div class="col-md-5">
								<div class="hero-content">
									<h2 class="hero-title">
Hire expert freelancers</h2>
									
									<span class="arrow"></span>
								</div>
							</div> <!-- .col-md-5 -->
							<div class="col-md-5 col-md-offset-2">
								<div class="request-form">
									<h2>Register</h2>
									<p style="color:yellow;">
									<?php
									
									if($register_message!="")
									{
										echo $register_message;
									}
									
									?>
									</p>

									<form method="post">
										<div class="field">
											<label for="#">Your name:</label>
											<input type="text" name="name">
										</div> <!-- .field -->
										<div class="field-column row">
											<div class="col-sm-6">
												<div class="field">
													<label for="">Email:</label>
													<input type="text" name="email">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="field">
													<label for="">New Password:</label>
													<input type="password" name="password" >
												</div>
											</div>
										</div>
										<div class="field-column row">
											<div class="col-sm-6">
												<div class="field">
													<label for="">DOB:</label>
													<input type="date" name="dob">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="field">
													<label for="">Gender:</label>
													<div>
														<input type="radio" name="gender" value="male" style="display:inline; width:auto; vertical-align:middle;" checked> <label style="display:inline;width:auto; margin-right:20px;">Male</label>
														<input type="radio" name="gender" value="female" style="display:inline; width:auto; vertical-align:middle;">
														<label style="display:inline;width:auto;">Female</label>
														</div>
												</div>
											</div>
										</div> <!-- .field-column -->
										<div class="field">
											<label for="#">Address:</label>
											<input type="text" name="address" >
										</div> <!-- .field -->										
										
										<div class="field">
											<label for="">Register As:</label>
											<div>
												<input type="radio" name="registertype" value="freelancer" style="display:inline; width:auto; vertical-align:middle;" checked> <label style="display:inline;width:auto; margin-right:20px;">Freelancer</label>
												<input type="radio" name="registertype" value="employer" style="display:inline; width:auto; vertical-align:middle;">
												<label style="display:inline;width:auto;">Employer</label>
												</div>
										</div>
											
										
										<input type="submit" value="Register">
										<center>Already have a Account ? <a href="login.php" style="color:white;">Login Here</a></center>
									</form>
								</div> <!-- .request-form -->
							</div> <!-- .col-md-5 -->
						</div> <!-- .row -->
					</div> <!-- .container -->
				</div> <!-- .hero -->

				<div class="fullwidth-block">
					<div class="container">
						<header>
							<h2 class="section-title">Hire expert freelancers for your job, online Millions of small businesses use Freelancer to turn their ideas into reality.</h2>
							<p class="section-desc">We have millions of Freelancers for thousands of jobs: from web design, mobile app development, and product manufacturing, to graphic design and data entry. Whatever your needs, there will be an expert to get it done.</p>
						</header>

						<h1>How do you benefit?</h1>


						<div class="row">
							<div class="col-md-6">
								<ul class="circle-numbered-feature">
									<li>
										<h3>You’ll receive obligation free bids from our talented freelancers within seconds.</h3>
										
									</li>
									<li>
										<h3>Keeping up-to-date is easy with our 24/7 support, time tracker, and mobile app.
</h3>
										
									</li>
									<li>
										<h3>Browse samples of previous work.</h3>
										
									</li>
									<li>
										<h3>Only pay for the work when it is completed in a safe and secure manner. Release your payment when you are 100% satisfied with the work provided.</h3>
										
									</li>
								</ul>
							</div>
							<div class="col-md-5 col-md-offset-1">
								<figure>
									<img src="images/1-11.jpg" alt="">
								</figure>
							</div>
						</div>
					</div>
				</div> <!-- .fullwidth-block -->

				
				

				<div class="fullwidth-block">
					<div class="container">
						

						<div class="cta">
							<header>
								<h2 class="section-title"> </h2>
								<p class="section-desc">  </p>
							</header>

							<p><a href="tel:1234567890" class="tel">Call us: (123) 456 789 100</a></p>
							<p><a href="mailto:office@freelancer.com" class="email">office@freelancer.com</a></p>

						</div>
					</div> <!-- .container -->
				</div> <!-- .fullwidth-block -->
			</main> <!-- .main-content -->
			
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