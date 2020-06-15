<?php 
	include('freelancer_session_check.php');

	$con=mysqli_connect("localhost","root","","freelancer");

	$message = "";

	$q="Select * from project_application where freelancer_id='" . $_SESSION['freelancer_userid'] . "'" ;
	
	$res=mysqli_query($con,$q); 
		 		 		 	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Applied Project List By Freelancer</title>
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
							<h2 class="section-title">Applied Projects...</h2>
							
						</header>

						<div class="posts-list">
						
						<?php												
						
							while($row=mysqli_fetch_array($res))
							{
								$project_id = $row['project_id'];
								
								$applied_q="Select project.*,employer.name employername from project join employer on employer.sr_no=project.employer where id='$project_id' order by id desc" ;
	
								$applied_res=mysqli_query($con,$applied_q);
								
								$applied_row=mysqli_fetch_array($applied_res);
								?>
						
							<div class="post">
								<div class="post-content">									
									<h3><?php echo $applied_row['title']; ?></h3>
									<p><strong>Applied On:</strong> <?php echo $row['date']; ?></p>
									<p ><strong>Skills:</strong>									
									<?php
									
									$skill_ar = explode(',',$applied_row['skills']); 
					   
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
									<p><strong>Time Limit:</strong> <?php echo $applied_row['time']; ?> Months<br></p>
									
									<p><strong>Rs:</strong> <?php echo $applied_row['budget']; ?><br></p>

									<p><strong>Status:</strong> 
									<?php
									
									if($applied_row['selected_freelancer']==0)
									{
										echo "Active";
									}
									else if($applied_row['selected_freelancer']==$_SESSION['freelancer_userid'])
									{
										if($applied_row['payment_done']==0)
										{
											echo "Accepted";
										}
										else
										{
											echo "Payment Received";
										}																						
									}
									else
									{
										echo "Rejected";
									}
									
									?>
									</p>	
									
								</div>
							</div>
							
							<?php
							}
							
							?>
							
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