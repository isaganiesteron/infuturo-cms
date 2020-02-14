
<?php
	require_once ('includes/sql_connect.php');
	
	function antiinject($var){
		if (get_magic_quotes_gpc())
			$var1=stripslashes($var);
		else
			$var1=$var;
		
		return mysql_real_escape_string(strip_tags($var1));
	}
	
	$cont_name = $_REQUEST['nam'];
	$cont_email = $_REQUEST['add'];
	$cont_message = antiinject($_REQUEST['mess']);
	

	/*adds content into table*/
	$insert = "INSERT INTO messages (ID, name, email, message, user_level, app_date) VALUES ('', '$cont_name', '$cont_email', '$cont_message','', NOW())";
	mysql_query($insert);
	if(mysql_affected_rows()==1){
		echo "<script type='text/javascript'>";
		echo 'alert("Your message has been sent.\nThank You.");';
		echo 'document.location = "index.html";';
		echo "</script>";
		}
	else{
		echo "<script type='text/javascript'>";
		echo 'alert("Sorry, something went wrong.\nPlease try again.");';
		echo 'document.location = "index.html";';
		echo "</script>";
	}

?>