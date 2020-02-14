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
		header("Location: ../index.html");
		exit(); // Quit the script.
	}
	
	$select_query = "SELECT * FROM messages WHERE name='ADMIN' AND user_level=".$_SESSION['user_id'];
	$result = mysql_query($select_query);
	
	while($row = (mysql_fetch_array($result))){
		echo "<b>Message:</b></br>".$row['message']."</br>";
		echo "<b>Sent On:</b></br>".$row['app_date']."</br>";
		echo "</br>";
	}

	// Flush the buffered output.
	ob_end_flush();
?>