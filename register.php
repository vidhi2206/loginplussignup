<?php
require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Registeration Page</title>
<link rel="stylesheet" href="css/style.css">

<script type="text/javascript">
function PreviewImage(){
	var oFReader= new FileReader();
	oFReader.readAsDataURL(document.getElementById("imglink").files[0]);
	
	oFReader.onload= function(oFREvent){
		document.getElementById("uploadPreview").src=oFREvent.target.result;
	};
};
</script>

</head>
<body >
<form class="myform" action="register.php" method="post" enctype="multipart/form-data">
	<div id="main-wrapper">
	<center><h2>Registeration Form</h2>
	<img id="uploadPreview" src="imgs/download.png" class="down"/><br>
	<input type="file" id="imglink" name="imglink" accept=".jpg,.jpeg,.png" onchange="PreviewImage();"/>
	</center>
	
	
		<label><b>Username:</label><br>
		<input name="username" type="text" class="inputvalues" placeholder="Type your username" required /><br>
		
		<label><b>Email-Id:</label><br>
		<input name="email" type="email" class="inputvalues" placeholder="Your email id" required /><br>
		
		<label><b>Password:</label><br>
		<input name="password" type="password" class="inputvalues" placeholder="Your password" required /><br>
		
		<label><b>Confirm Password:</label><br>
		<input name="cpassword" type="password" class="inputvalues" placeholder="Confirm password" required /><br>
		
		<input name="submit_btn" type="submit" id="signup_btn" value="Sign Up"/><br>

		<a href="index.php"><input type="button" id="back_btn" value="Back"/></a>
		<p>Go Back to Login</p>
	</form>
	<?php
		if(isset($_POST['submit_btn'])){
		// echo '<script type="text/javascript"> alert("signup button clicked")</script>';
		
		$username=$_POST['username'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$cpassword=$_POST['cpassword'];
       
	    $img_name=$_FILES['imglink']['name'];
		$img_size=$_FILES['imglink']['size'];
	    $img_tmp=$_FILES['imglink']['tmp_name'];
	
        $directory='uploads/';
		$target_file=$directory.$img_name;
		
	
		if($password==$cpassword){
			$query="select * from user WHERE username='$username'";
			$query_run=mysqli_query($con,$query);
			
			if(mysqli_num_rows($query_run)>0){
				// there is already a user with the same username
				echo '<script type="text/javascript"> alert("User already exists..try another username")</script>';
			}
			else if(file_exists($target_file)){
				echo '<script type="text/javascript"> alert("Image file already exists..try another image file")</script>';
			}
			else if($img_size>2097152){
				echo '<script type="text/javascript"> alert("Image file size larger than 2 MB...try another image file")</script>';
			}
			else{
				move_uploaded_file($img_tmp,$target_file);
				$query="insert into user values('$username','$password','$email','$target_file')";
				$query_run=mysqli_query($con,$query);
				if($query_run>0){
					echo '<script type="text/javascript"> alert("user registered..Go to login page to login")</script>';
					
				}
				else{
					echo '<script type="text/javascript"> alert("Error!")</script>';
				}
				
				
				
			}
		}
		else{
			echo '<script type="text/javascript"> alert("password and confirm password does not match!") </script>';
		}
		
		}
	?>
	</div>
</body>
</html>	