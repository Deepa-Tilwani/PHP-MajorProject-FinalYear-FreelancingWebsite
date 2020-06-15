<?php 
include('freelancer_session_check.php');

$con=mysqli_connect("localhost","root","","freelancer");

$message = "";

if($_SERVER["REQUEST_METHOD"]=="POST")
{		
		$name=$_POST['name'];		
		$password=$_POST['password'];
		$ptmp_name=$_FILES['photo']['tmp_name'];	
        /*$q="select max(sr_no)+1 from freelancer";
		$res=mysqli_query($con,$q);
		$row=mysqli_fetch_row($res);
		$id=$row[0];*/
		$photo=$_SESSION['freelancer_userid']."_.jpg";
		$c=count($_FILES['photo']['name']);
		$location="upload/$photo";
		move_uploaded_file($ptmp_name,$location);
		$dob=$_POST['dob'];
		$email=$_POST['email'];
		$number=$_POST['number'];
		$address=$_POST['address'];
		$college=$_POST['college'];
		$experience=$_POST['experience'];
		$gender=$_POST['gender'];
	   // Add the Multiple checkboxes value in Database and seprate   by comma(,) sign.
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
		 		
		 		 			 
        // update the student information when new photo and resume are not uploaded	 
		$extra_line = "";
		if($photo!='')  
		{
			$extra_line = $extra_line . ",image='$location'";
		}
				
		

		   $qe="update freelancer set pass='$password',name='$name',dob='$dob',gender='$gender',email='$email', number='$number',address='$address',qualification='$qualification',skills='$skills',college='$college',experience='$experience'". $extra_line ." where sr_no='".$_SESSION['freelancer_userid']."'";
		
		//echo $qe;
		 mysqli_query($con,$qe) or exit('error');
		 
		 $message="Your Information Sucessfully Updated";		 		 
		 
		 $photo="upload/$photo";
		
}
else
{
	
	$sql="Select * from freelancer  where sr_no='".$_SESSION['freelancer_userid']."'";
	
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
			$college=$row['college'];
			$experience=$row['experience'];			
			$resume=$row['resume'];
			$skills=$row['skills'];
			$qualification=$row['qualification'];			
			$photo=$row['image'];
		 }	 
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>FREELANCER Profile</title>
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
						<a href="freelancer_profile.php" class="button">Profile</a>
						<a href="freelancer_availableprojectlist.php" class="button">Available Projects</a>
						<a href="freelancer_appliedprojectlist.php" class="button">Applied Projects</a>
						<a href="freelancer_logout.php" class="button">Logout (<?php echo $_SESSION['freelancer_username']; ?>)</a>
					</div>
				</div> <!-- .hero -->

				<div class="fullwidth-block content">
					<div class="container">
										
<center><h1>
Freelancer Profile
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
								<div class="col-md-5 col-md-offset-1">
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
											<label class="control-label" >Photo Upload</label><br>
											<img src="<?php echo $photo ?>" height="120px" width="120px"><br>
											<input type="file" accept="image/*" name="photo"><br>
										</div>
									</div>
								</div>

								<div class="col-md-5 ">
									<div class="request-form">
										<div class="field">
											<label for="#">Contact No:</label>
											<input type="text" name="number" value="<?php echo $number; ?>">
										</div> <!-- .field -->
										<div class="field-column row">
											<div class="col-sm-6">
												<div class="field">
													<label for="">College:</label>
													<input type="text" name="college" value="<?php echo $college; ?>">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="field">
													<label for="">Experience:</label>
													<input type="text" name="experience" value="<?php echo $experience; ?>" >
												</div>
											</div>
										</div>
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
					   echo " <br>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input style='display:inline; width:auto; vertical-align:middle;' type='checkbox' checked='checked' name='qualification[]' value='".$r['id']."'>"
					    .$r['qualification']."<br>";
				   }
				   else
				   {
					   echo " &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input style='display:inline; width:auto; vertical-align:middle;' type='checkbox' name='qualification[]' value='".$r['id']."'>".$r['qualification']."<br>";
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
					   echo " &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input style='display:inline; width:auto; vertical-align:middle;' type='checkbox' checked='checked' name='skills[]' value='".$r['id']."'>".$r['skill']."<br>";
				   }
				   else
				   {
					   echo " &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input style='display:inline; width:auto; vertical-align:middle;' type='checkbox' name='skills[]' value='".$r['id']."'>".$r['skill']."<br>";
				   }
				}
			  ?>
													</div>
												</div>
											</div>
										</div> <!-- .field-column -->
										
											
											
										
									</div> <!-- .request-form -->
									
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