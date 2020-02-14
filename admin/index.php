<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	require_once ('../includes/sql_connect.php');
	// Start output buffering:
	ob_start();

	// Initialize a session:
	session_start();

	// If no first_name session variable exists, redirect the user:
	if (!isset($_SESSION['first_name'])) {
		
		//$url = BASE_URL . 'login.php'; // Define the URL.
		ob_end_clean(); // Delete the buffer.
		header("Location: login.php");
		exit(); // Quit the script.
		
	}

	if(isset($_REQUEST['pg'])){
		$pg = $_REQUEST['pg'];
				
		switch($pg){
			case 01:
				$url = "app.php";
			break;
			case 02:
				$url = "mess.php";
			break;
			case 03:
				$url = "teach.php";
			break;
			case 04:
				$url = "users.php";
			break;
			case 05:
				$url = "cont.php";
			break;
		}
	}
	else{
		$pg = 01;
		$url = "app.php";
	}
?>
<html>
<head>
	<link rel="shortcut icon" href="favicon.ico" />
	<title>Admin</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
</head>
<body>
<div id="main">
	<div id="header">
		<a href="index.php" class="logo"><img src="img/logo.gif" height="50" alt="" /></a>
		<ul id="top-navigation">
			<li class="<?php if(isset($pg) && $pg == 01) echo 'active';?>"><span><span><a href="index.php?pg=01">Applicants</a></span></span></li>
			<li class="<?php if(isset($pg) && $pg == 02) echo 'active';?>"><span><span><a href="index.php?pg=02">Messages</a></span></span></li>
			<li class="<?php if(isset($pg) && $pg == 03) echo 'active';?>"><span><span><a href="index.php?pg=03">Teachers</a></span></span></li>
			<li class="<?php if(isset($pg) && $pg == 04) echo 'active';?>"><span><span><a href="index.php?pg=04">Users</a></span></span></li>
			<li class="<?php if(isset($pg) && $pg == 05) echo 'active';?>"><span><span><a href="index.php?pg=05">Website</a></span></span></li>
		</ul>
	</div>
	<div id="middle">
		
		<?php
			include "$url";
		?>

		<div id="right-column">
			<strong class="h">INFO</strong>
			<div class="box">
				<p>Hello!, <?php echo $_SESSION['first_name']." ".$_SESSION['last_name'];?></p>
				<p><a href="logout.php">Logout</a></p>
			</div>
		</div>
	</div>
	<div id="footer">
		<p><span>Copyright &copy; InFuturo Inc. Designed by Isagani Esteron</span></p>
	</div>
</div>
</body>
</html>
<?php // Flush the buffered output.
	ob_end_flush();
?>