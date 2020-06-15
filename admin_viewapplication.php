<?php 
	include('admin_session_check.php');

	$id = $_GET['id'];
	
	$con=mysqli_connect("localhost","root","","freelancer");

	$message = "";

	$fq = "select * from project where id='$id'";
	
	$fqres = mysqli_query($con,$fq);
	
	$fqrow=mysqli_fetch_array($fqres);
	
	$selected_freelancer = $fqrow['selected_freelancer'];		
	$payment_done = $fqrow['payment_done'];		
	
	$q="Select project_application.*, freelancer.sr_no sr_no, freelancer.name name from project_application inner join freelancer on project_application.freelancer_id = freelancer.sr_no where project_id = '$id'";
	
	$res=mysqli_query($con,$q); 
		 		 		 	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Employer Project Application List</title>
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
						<a href="admin_projectlist.php" class="button">Project List</a>
						<a href="admin_employerlist.php" class="button">Employer List</a>
						<a href="admin_freelancerlist.php" class="button">Freelancer List</a>
						<a href="admin_logout.php" class="button">Logout (<?php echo $_SESSION['admin_username']; ?>)</a>
					</div>
				</div> <!-- .hero -->

				<div class="fullwidth-block content">
					<div class="container">
										
<center><h1>
Project Application List For Project No: <?php echo $id; ?>

</h1></center>
						<div class="" style="padding:10px; border:2px solid gray; box-shadow:3px 3px 5px gray;">
							<div class="row">
							<p>
							<?php
							
							if($message!="")
							{
								echo $message;
							}						

							if(isset($_SESSION['message']) && $_SESSION['message']!="")
							{
								echo $_SESSION['message'];
								$_SESSION['message'] = "";
							}						
							
							?>
							</p>
							
							<div class="col-md-12">
                                    <div class="table-responsive">
										<table class="table table-striped table-bordered table-hover" id="dataTables-example">
											<thead>
												<tr>
													<th>ID</th>
													<th>Freelancer</th>
													<th>Message</th>													
													<th >Date</th>
													<th ><center>Action</center></th>						
												</tr>
											</thead>   

											<tbody>
													
											<?php	
												while($row=mysqli_fetch_array($res))
												{
												echo "<tr class='even gradeA'>";
												echo "<td>$row[0]</td>";
												echo"<td >".$row['name']."</td>";
												echo "<td>".$row['message']."</td>";
												echo "<td>".$row['date']."</td>";											
												
												if($selected_freelancer==0)
												{
												echo "<td><a href='employer_acceptprojectapplication.php?id=".$row['project_id']."&freelancer_id=".$row['sr_no']."'>Accept</a> </td></tr>";
												}
												else if($selected_freelancer==$row['sr_no'])
												{
													if($payment_done==0)
													{
														echo "<td>Accepted <br>	</td></tr>";
													}
													else
													{
														echo "<td>Payment Done.</td></tr>";
													}
													
												}
												else
												{
													echo "<td></td></tr>";
												}
												}	
											?>

											</tbody>
										</table>
									</div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
							
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