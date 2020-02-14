<?php
	require_once ('includes/sql_connect.php');

	function antiinject($var){	//function for input stripslashes
		if (get_magic_quotes_gpc())
			$var1=stripslashes($var);
		else
			$var1=$var;
		
		return mysql_real_escape_string(strip_tags($var1));
	}

	$lname = antiinject($_REQUEST['element_1']);
	$fname = antiinject($_REQUEST['element_2']);
	$mname = antiinject($_REQUEST['element_3']);
	
	$age = antiinject($_REQUEST['element_4']);
	$mobi = antiinject($_REQUEST['element_5']);
	$bday = antiinject($_REQUEST['element_6']);
	
	$h_add = antiinject($_REQUEST['element_7']);
	$e_add = antiinject($_REQUEST['element_8']);
	$land = antiinject($_REQUEST['element_9']);
	
	$school = antiinject($_REQUEST['element_10']);
	
	$comment = antiinject($_REQUEST['element_11']);
	
	$gen = $_REQUEST['element_12'];
	
	$stat = $_REQUEST['element_14'];
	$educ = $_REQUEST['element_15'];
	$exp = $_REQUEST['element_16'];
	$prev_emp = antiinject($_REQUEST['element_17']);
	$pas_exp = antiinject($_REQUEST['element_18']);
	$crime = antiinject($_REQUEST['element_19']);
	$avail = antiinject($_REQUEST['element_20']);
	$pos = $_REQUEST['element_21'];
	$soon = $_REQUEST['element_22'];

	$check = "SELECT ID FROM applicants WHERE fname = '$fname' AND lname = '$lname'";
	//$show = "SELECT * FROM applicants ORDER BY ID DESC";	//looks through the table if the applicants name is already present
	$result = mysql_query($check);
			
	if(mysql_num_rows($result)==0){	//if the user doesn't exist in the table
	
		$a = md5(uniqid(rand(), true));//exam_key
		$ins = "INSERT INTO `applicants` (`ID`, `lname`, `fname`, `mname`, `age`, `mobi`, `bday`, `h_add`, `e_add`, `land`, `school`, `comment`, `gen`, `stat`, `educ`, `exp`, `prev_emp`, `pas_exp`, `crime`, `avail`, `pos`, `soon`, `app_date`, `exam_key`) VALUES (NULL, '$lname', '$fname', '$mname', '$age', '$mobi','$bday', '$h_add', '$e_add', '$land', '$school','$comment', '$gen', '$stat', '$educ', '$exp','$prev_emp', '$pas_exp', '$crime', '$avail', '$pos', '$soon', NOW(), '$a')";
		
		mysql_query($ins);

		if (mysql_affected_rows() == 1){
			$body = "Dear ".$fname." ".$lname.",\n\n\tThank you for applying here in InFuturo Inc., the information you have entered in the application form has been recorded.\nCompleting the online application form is the first step in the application process.\nThe second step is to take the online exam. Copy the following link and enter it in another window to take the online exam:\n\n";
			$body .= 'http://www.infuturo.net23.net/exam/exam_page.php?x=' . urlencode($e_add) . "&y=$a\n\n";
			$body .= "From:\nInFuturo Inc. Admin";
			
			//echo $body;
			mail($e_add, 'Application Form Completion', $body, 'From: InFuturo Inc.');
			
			echo "<script type='text/javascript'>";
			echo 	'alert("Thank you for filling out the form.\nPlease check the email address you provided for further details.");';
			echo 	'document.location = "index.html";';
			echo "</script>";
		}
		else{
			echo "<script type='text/javascript'>";
			echo 'alert("Sorry, Something went wrong, please try again.");';
			echo 'document.location = "index.html";';
			echo "</script>";
		}
			

	}
	else{
		$_SESSION['exam_key'] = 1;
		echo "<script type='text/javascript'>";
		echo 'alert("Sorry, It seems that you have previously registered.\nPlease Send us a message to resolve this.");';
		echo 'document.location = "index.html";';
		echo "</script>";
	}
?>