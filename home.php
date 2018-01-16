<?php
	session_start();
	require 'dbconfig/config.php';
	$query="select username,email from user where username='".$_SESSION['username']."'";
	$query_run=mysqli_query($con,$query);
			
	if(mysqli_num_rows($query_run)>0){
		
		while($row=mysqli_fetch_assoc($query_run)){
			echo "<div align=\"center\">";
			echo "<br>Your <b><i>Profile</i></b> is as follows:<br>";
			echo "<b>Username:</b>".$row['username'];
			echo "<br/><b>Email:</b>".$row['email'];
			echo "</div>";
			
		}

	}
	else{
		echo "No results found";
	}
?>
	 
<!DOCTYPE html>
<html>
<head>
<title><b>Home Page</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>

<link rel="stylesheet" href="css/style.css">
</head>
<body >
	<div class="container">
	<center>
	<h2><b>Complete Your Profile</h2>
	<h3><b>Welcome <?php echo $_SESSION['username'] ?></h3>
	<?php
	echo '<img class="down" src="'.$_SESSION["imglink"].'">';
	?>
	</center>
	
	<form class="myform" action="home.php" method="post">
		
		
	
	
		<label><b>Fullname:</label><br>
		<input name="fullname" type="text" class="inputvalues" placeholder="Type your name" required /><br>
		
	  <label><b>Email-Id:</label><br>
		<input name="email" type="email" class="inputvalues" placeholder="Your email id" required /><br> 
		
		<label><b>Address:</label><br>
		<input name="address" type="text" class="inputvalues" placeholder="Your address" required /><br>
		
		<label><b>Contact_no:</label><br>
		<input name="contact_no" type="text" class="inputvalues" placeholder="your contact no" required /><br>
		
		<input name="submit" type="submit" id="submit" value="Submit" /><br>
		
	    <a href="last.php"><input type="button" id="next_btn" value="Next"/></a> 
		
	</form>
	  
	
	<?php
	    
		if(isset($_POST['submit'])){
			//echo '<script type="text/javascript"> alert("submit button clicked")</script>';
		    
	       $fullname=$_POST['fullname'];
		   $email=$_POST['email'];
		  //email=$_SESSION['email'];
		   $address=$_POST['address'];
		   $contact_no=$_POST['contact_no'];
		   
		    
	            $mobileregex="/^[6-9][0-9]{9}$/";
				$abc=preg_match($mobileregex,$contact_no)==1;
			
	      
	  if($_SESSION['email']!=$email){
		  echo '<script type="text/javascript"> alert("enter valid email-id for user")</script>';
	  }
      else if($abc==False){
		  echo '<script type="text/javascript"> alert("enter valid phone number")</script>';
	  }
	  else{
	  $query="insert into profile values ('$fullname','$email','$address','$contact_no')";
		$query_run=mysqli_query($con,$query);
		if($query_run>0){
			echo '<script type="text/javascript"> alert("user info added successfully")</script>';
			
		}
		else{
			echo '<script type="text/javascript"> alert("Error!")</script>';
		}
		}
		}
		
	
	?>
	</div>
</body>
</html>	