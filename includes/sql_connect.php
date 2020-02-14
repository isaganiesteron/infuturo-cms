<?php
	// Define these as constants so that they can’t be changed
	DEFINE ('DBUSER', 'root');
	DEFINE ('DBPW', '');
	DEFINE ('DBHOST', 'localhost');
	DEFINE ('DBNAME', 'inf');
	/*$host="localhost"; // Host name$username="root"; // Mysql username$password=""; // Mysql password$db_name="pma"; // Database name$tbl_name="record"; // Table namemysql_connect("$host", "$username", "$password")or die("cannot connect");mysql_select_db("$db_name")or die("cannot select DB");
	$mysql_host = "mysql4.000webhost.com";
	$mysql_database = "a7300895_inf";
	$mysql_user = "a7300895_inf";
	$mysql_password = "infuturo123";
	*/
	
	if ($dbc = mysql_connect (DBHOST, DBUSER, DBPW)) {
		if (!mysql_select_db (DBNAME)) { // If it can’t select the database.
			trigger_error("Could not select the database!<br />");
		exit();
		}
	}
	else{
		trigger_error("Could not connect to MySQL!");
		exit();
	}
	
	function escape_data ($data) {		//security purposes against msql injection
		if (function_exists('mysql_real_escape_string')) {
			global $dbc; // Need the connection.
			$data = mysql_real_escape_string (trim($data), $dbc);
			$data = strip_tags($data);
		} 
		else{
			$data = mysql_escape_string (trim($data));
			$data = strip_tags($data);
		}
		return $data;
	}
?>