<?php 
	include('freelancer_session_check.php');

	$con=mysqli_connect("localhost","root","","freelancer");

	
if($_SERVER["REQUEST_METHOD"]=="POST")
{		
		
		$project_id=$_POST['project_id'];	
				
		$message=$_POST['message'];		

		$date=date("Y/m/d") ;
		
		$qe="insert into project_application(project_id,freelancer_id,date,message,status) values('$project_id','". $_SESSION['freelancer_userid'] . "', '$date', '$message', 1)";		   
		
		//echo $qe;
		 mysqli_query($con,$qe) or exit('error');
		 
		 $post_message="Your Application Successfully Submitted.";		
		
}

	if($_SERVER["REQUEST_METHOD"]=="GET")
	{
		$id = $_GET['id'];
	}
	else
	{
		$id = $_POST['project_id'];	
	}
	
	$message = "";

	$q="Select project.*,employer.name employername from project join employer on employer.sr_no=project.employer where id='".$_GET['id'] ."'" ;
	
	$res=mysqli_query($con,$q); 
		 		 		 	
	$row=mysqli_fetch_array($res);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Available Project List For Freelancer</title>
		<!-- Loading third party fonts -->
		<link href="http://fonts.googleapis.com/css?family=Titillium+Web:200,300,400,700|" rel="stylesheet" type="text/css">
		<link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Loading main css file -->
		<link href="assets/css/bootstrap.css" rel="stylesheet" />
		<!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
	
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
						<a href="freelancer_profile.php" class="button">Profile</a>
						<a href="freelancer_availableprojectlist.php" class="button">Available Projects</a>
						<a href="freelancer_appliedprojectlist.php" class="button">Applied Projects</a>
						<a href="freelancer_logout.php" class="button">Logout (<?php echo $_SESSION['freelancer_username']; ?>)</a>
					</div>
				</div> <!-- .hero -->

				<div class="fullwidth-block" data-bg-color="#2f2e3c"> 
					<div class="container">
						<header bg-dark>
							<h2 class="section-title"> <?php echo $row['title'] ?></h2>
							
						</header>

						<div class="posts-list">
						
						
							<div class="post" style="width:50%;">
								<div class="post-content">		
								<p><strong>Employer:</strong> <?php echo $row['employername']; ?> <br></p>
								<p><strong>Posted On:</strong> <?php echo $row['submission']; ?> <br></p>																	
								<p ><strong>Skills:</strong>									
									<?php
									
									$skill_ar = explode(',',$row['skills']); 
					   
								$q='Select * from skill_table where active="1" order by id desc';
					   $res1=mysqli_query($con,$q); 
					   while($r = mysqli_fetch_array($res1))
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
							   echo $r['skill']." | ";
						   }
						   
						}
						
					  ?> 

									</p>
										<p><strong>Time Limit:</strong> <?php echo $row['time']; ?> Months<br></p>		
									<p><strong>Rs:</strong> <?php echo $row['budget']; ?><br></p>							
									<p><strong>Description:</strong> <?php echo $row['description']; ?><br></p>
									<p><strong>Qualification Required:</strong> 
									
									<?php 
									
									$qualification_ar = explode(',',$row['qualification']); 
					   
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
							   echo $r['qualification']." | ";
						   }
						   
											 
					   }
					  
									
									?>
									
									
									
									<br></p>							
								</div>
							</div>
							
							<div class="col-md-5">
								
								
								<?php
								
								if($_SERVER['REQUEST_METHOD']=="GET")
								{
									$q="Select * from project_application where project_id='$id' and freelancer_id='" . $_SESSION['freelancer_userid'] . "'" ;
		
									//echo $q;
									
									$res=mysqli_query($con,$q); 
									
									$nor = mysqli_num_rows($res);
									
									if($nor>0)
									{
										echo "You have Already Applied for this Project..";
									}
									else
									{
										?>
										<form  method="post">
										<div class="col-md-12 col-md-offset-1">
											<div class="request-form">										
												<div class="field">
													<p>Application Message:</p>
													<input type="hidden" name="project_id" value="<?php echo $id; ?>" >
													<textarea name="message" rows="8"></textarea>
												</div> <!-- .field -->

												<div class="col-md-offset-1" style="clear:both;">
													<input type="submit" value="Submit Application">	
												</div>

											</div>
										</div>
										</form>
								
										<?php
										
									}
								}
								else
								{
									if($post_message!="")
									{
										echo $post_message;
									}
									else
									{
										echo "Problem while applying for this project";
									}
								}
								
								
								?>
								
								
							</div>
							
							
						</div>

						
					</div> <!-- .container -->
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
		<script src="assets/js/bootstrap.min.js"></script>
		 <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>

		
	</body>

</html>