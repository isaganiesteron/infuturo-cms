<?php

require_once ('includes/sql_connect.php');
session_start();

if(isset($_REQUEST['submitted'])){
	$e = mysql_real_escape_string($_REQUEST['user']);
	$p = mysql_real_escape_string($_REQUEST['pwd']);
	if ($e && $p) { // If everything's OK.
		// Query the database:
		$q = "SELECT * FROM users WHERE (email='$e' AND pass=SHA1('$p') AND user_level=1)";		
		$r = mysql_query ($q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysql_error($dbc));

		if (mysql_num_rows($r) == 1) { // A match was made.
			
			// Register the values & redirect:
			
			$_SESSION = mysql_fetch_array ($r, MYSQL_ASSOC); 
			mysql_free_result($r);
			mysql_close($dbc);
	
			ob_end_clean(); // Delete the buffer.
			header("Location: admin/teacher.php");

			exit(); // Quit the script.
				
		} else { // No match was made.
			echo '<p class="error">Either the email address and password entered do not match those on file.</p>';
		}
			
	} else { // If everything wasn't OK.
		echo '<p class="error">Please try again.</p>';
	}
}
else
	header("location: index.html");
?>