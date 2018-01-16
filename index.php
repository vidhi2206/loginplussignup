<?php
    session_start();
	 require 'dbconfig/config.php';
?>
<!DOCTYPE html>

<html>
<head>

<title>Login page</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<link rel="stylesheet" href="css/style.css"> 

 



</head>





<body>

    <form class="myform" action="index.php" method="post">
    <center><h2>Login Form</h2></center>
    <div class="imgcontainer" >
	
	
	<img src="imgs/download.png" class="down">
	</div>
	<div class="container">
	
	
	
		<label><b>Username:</label><br>
		<input name="username" type="text" class="inputvalues" placeholder="Type your username" required /><br>
		<label><b>Password:</label><br>
		<input name="password" type="password" class="inputvalues" placeholder="Type your password" required /><br>
		
		
		<input name="login" type="submit" id="login_btn" value="Login"/><br>
		
		
		<hr align="center"><br>
		<a href="register.php"><input type="button"id="register_btn" value="Register"/></a>
		<p>New User?..click Register</p>
		
	</form>
	<?php
		if(isset($_POST['login'])){
			$username=$_POST['username'];
		    $password=$_POST['password'];
			
			$query="select * from user where username='$username'";
			
			$query_run=mysqli_query($con,$query);
			
			if(mysqli_num_rows($query_run)>0){
				$row=mysqli_fetch_assoc($query_run);
			#	print "hashedPass = ${row['password']}";
			#	print "password: " . $password;
				if(password_verify($password, $row['password'])){
					 print "Password match";
					 
					 $_SESSION['username']=$row['username'];
				     $_SESSION['imglink']=$row['imglink'];
				     $_SESSION['email']=$row['email'];
				     header('location:home.php');
					 
					 
				}
				else
					echo '<script type="text/javascript">alert("username or password does not match")</script>';
        
				
				
			}
			else{
				echo '<script type="text/javascript">alert("invalid credentials")</script>';
				
			}
		}
	?>
	</div>
</body>
</html>	