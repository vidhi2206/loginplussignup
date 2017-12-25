<?php
	 session_start();
	 require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Last page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div id="main-wrapper">
	<center>
	
	<h3>Logout  <?php echo $_SESSION['username'] ?></h3>
	<?php
	echo '<img class="down" src="'.$_SESSION["imglink"].'">';
	?>
	</center>
	<form class="myform" action="last.php" method="post">
	<input name="logout" type="submit" id="logout_btn" value="Log Out"/><br>
	</form>
	<?php
	if(isset($_POST['logout'])){
		session_destroy();
		header('location:index.php');
	}
	?>
	</div>
</body>
</html>	