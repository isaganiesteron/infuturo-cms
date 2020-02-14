<?php
	session_start();

	if (!isset($_SESSION['first_name'])) {
		
		ob_end_clean(); // Delete the buffer.
		header("Location: index.php");
		exit(); // Quit the script.
		
	} else { // Log out the user.
		
		$_SESSION = array(); // Destroy the variables.
		session_destroy(); // Destroy the session itself.
		setcookie (session_name(), '', time()-300); // Destroy the cookie.
		
	}
	echo "<script type='text/javascript'>";
	echo 'alert("You are now logged out");';
	echo 'location.href=".."';
	echo "</script>";

?>