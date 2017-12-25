<?php
    session_start();
	 require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Login page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

	<div id="main-wrapper">
	<center><h2>Login Form</h2>
	<img src="imgs/download.png" class="down"/>
	</center>
	
	<form class="myform" action="index.php" method="post">
		<label><b>Username:</label><br>
		<input name="username" type="text" class="inputvalues" placeholder="Type your username" required /><br>
		<label><b>Password:</label><br>
		<input name="password" type="password" class="inputvalues" placeholder="Type your password" required /><br>
		
		<input name="login" type="submit" id="login_btn" value="Login"/><br>
		<p>Already a member?..click to Login</p>
		
		<hr align="center"><br><br><br>
		<a href="register.php"><input type="button"id="register_btn" value="Register"/></a>
		<p>Not a member yet?..click Register to register yourself</p>
		
	</form>
	<?php
		if(isset($_POST['login'])){
			$username=$_POST['username'];
		    $password=$_POST['password'];
			
			$query="select * from user where username='$username' AND password='$password'";
			
			$query_run=mysqli_query($con,$query);
			
			if(mysqli_num_rows($query_run)>0){
				$row=mysqli_fetch_assoc($query_run);
				$_SESSION['username']=$row['username'];
				$_SESSION['imglink']=$row['imglink'];
				$_SESSION['email']=$row['email'];
				header('location:home.php');
			}
			else{
				echo '<script type="text/javascript">alert("invalid credentials")</script>';
				
			}
		}
	?>
	</div>
</body>
</html>	