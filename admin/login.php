<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php

require_once ('../includes/sql_connect.php');
session_start();

if (isset($_REQUEST['submitted'])) {
	
	// Validate the email address:
	if (!empty($_REQUEST['usr'])) {
		$e = mysql_real_escape_string ($_REQUEST['usr']);
	} else {
		$e = FALSE;
		echo '<p class="error">You forgot to enter your email address!</p>';
	}
	
	// Validate the password:
	if (!empty($_REQUEST['pass'])) {
		$p = mysql_real_escape_string ($_REQUEST['pass']);
	} else {
		$p = FALSE;
		echo '<p class="error">You forgot to enter your password!</p>';
	}
	
	if ($e && $p) { // If everything's OK.
	
		// Query the database:
		$q = "SELECT * FROM users WHERE (email='$e' AND pass=SHA1('$p'))";		
		$r = mysql_query ($q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysql_error($dbc));
		
		if (mysql_num_rows($r) == 1) { // A match was made.

			// Register the values & redirect:
			$_SESSION = mysql_fetch_array ($r, MYSQL_ASSOC); 
			mysql_free_result($r);
			mysql_close($dbc);
							
			//$url = BASE_URL . 'index.php'; // Define the URL:
			ob_end_clean(); // Delete the buffer.
			header("Location: index.php");
			exit(); // Quit the script.
				
		} else { // No match was made.
			echo '<p class="error">Either the email address and password entered do not match those on file or you have not yet activated your account.</p>';
			
		}
		
	} else { // If everything wasn't OK.
		echo '<p class="error">Please try again.</p>';
	}
	
	mysqli_close($dbc);

} // End of SUBMIT conditional.
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Admin - InFuturo Inc.</title>
	<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
	<!--  jquery core -->
	<script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>

	<!-- Custom jquery scripts -->
	<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>

	<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
	<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function(){
		$(document).pngFix( );
		});
	</script>
</head>
<body id="login-bg"> 
 
<!-- Start: login-holder -->
<div id="login-holder">

	<!-- start logo -->
	<div id="logo-login">
		<a href="index.html"><img src="images/logo.png" width="156" height="40" alt="" /></a>
	</div>
	<!-- end logo -->
	
	<div class="clear"></div>
	
	<!--  start loginbox ................................................................................. -->
	<div id="loginbox">
	
	<!--  start login-inner -->
	<div id="login-inner">
		<form method="POST" action="login.php">
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<th>E-mail</th>
					<td><input type="text"  value="UserName"  onfocus="this.value=''" class="login-inp" name="usr" /></td>
				</tr>
				<tr>
					<th>Password</th>
					<td><input type="password" value="************"  onfocus="this.value=''" class="login-inp" name="pass" /></td>
				</tr>
				<tr>
					<th></th>
					<td valign="top"><input disabled type="checkbox" class="checkbox-size" id="login-check" /><label for="login-check">Remember me</label></td>
				</tr>
				<tr>
					<th></th>
					<td><input type="submit" class="submit-login" name="submitted" /></td>
				</tr>
			</table>
		</form>
	</div>
 	<!--  end login-inner -->
	<div class="clear"></div>
	<!--a href="" class="forgot-pwd">Forgot Password?</a-->
 </div>
 <!--  end loginbox -->
 

</div>
<!-- End: login-holder -->
</body>
</html>