<?php

	require_once ('../includes/sql_connect.php');
	session_start();
	
	if(isset($_SESSION['exam_start']) && isset($_SESSION['exam_start'])){
		$q = "SELECT * FROM applicants WHERE (e_add='" . mysql_real_escape_string($_SESSION['exam_start']) . "' AND exam_key='" . mysql_real_escape_string($_SESSION['exam_start2']) . "')";
		mysql_query($q);
		
		if (mysql_affected_rows() != 1) {
			header("Location: ../index.html");
		}
	}
	else{
		session_destroy(); 
		header("Location: ../index.html");
	}
	
	function antiinject($var){
		if (get_magic_quotes_gpc())
			$var1=stripslashes($var);
		else
			$var1=$var;
					
		return mysql_real_escape_string(strip_tags($var1));
	}
	
//PART I
	//phrasal
	if(isset($_REQUEST['A#1']))
		$A1 = $_REQUEST['A#1'];
	else
		$A1 = 'X';
	if(isset($_REQUEST['A#2']))
		$A2 = $_REQUEST['A#2'];
	else
		$A2 = 'X';
	if(isset($_REQUEST['A#3']))
		$A3 = $_REQUEST['A#3'];
	else
		$A3 = 'X';
	if(isset($_REQUEST['A#4']))
		$A4 = $_REQUEST['A#4'];
	else
		$A4 = 'X';
	if(isset($_REQUEST['A#5']))
		$A5 = $_REQUEST['A#5'];
	else
		$A5 = 'X';
	if(isset($_REQUEST['A#6']))
		$A6 = $_REQUEST['A#6'];
	else
		$A6 = 'X';
	if(isset($_REQUEST['A#7']))
		$A7 = $_REQUEST['A#7'];
	else
		$A7 = 'X';
	if(isset($_REQUEST['A#8']))
		$A8 = $_REQUEST['A#8'];
	else
		$A8 = 'X';
	if(isset($_REQUEST['A#9']))
		$A9 = $_REQUEST['A#9'];
	else
		$A9 = 'X';
	if(isset($_REQUEST['A#10']))
		$A10 = $_REQUEST['A#10'];
	else
		$A10 = 'X';
	
	//vocab
	if(isset($_REQUEST['B#1']))
		$B1 = $_REQUEST['B#1'];
	else
		$B1 = 'X';
	if(isset($_REQUEST['B#2']))
		$B2 = $_REQUEST['B#2'];
	else
		$B2 = 'X';
	if(isset($_REQUEST['B#3']))
		$B3 = $_REQUEST['B#3'];
	else
		$B3 = 'X';
	if(isset($_REQUEST['B#4']))
		$B4 = $_REQUEST['B#4'];
	else
		$B4 = 'X';
	if(isset($_REQUEST['B#5']))
		$B5 = $_REQUEST['B#5'];
	else
		$B5 = 'X';
	if(isset($_REQUEST['B#6']))
		$B6 = $_REQUEST['B#6'];
	else
		$B6 = 'X';
	if(isset($_REQUEST['B#7']))
		$B7 = $_REQUEST['B#7'];
	else
		$B7 = 'X';
	if(isset($_REQUEST['B#8']))
		$B8 = $_REQUEST['B#8'];
	else
		$B8 = 'X';
	if(isset($_REQUEST['B#9']))
		$B9 = $_REQUEST['B#9'];
	else
		$B9 = 'X';
	if(isset($_REQUEST['B#10']))
		$B10 = $_REQUEST['B#10'];
	else
		$B10 = 'X';
	
	//multiple choice
	if(isset($_REQUEST['C#1']))
		$C1 = $_REQUEST['C#1'];
	else
		$C1 = 'X';
	if(isset($_REQUEST['C#2']))
		$C2 = $_REQUEST['C#2'];
	else
		$C2 = 'X';
	if(isset($_REQUEST['C#3']))
		$C3 = $_REQUEST['C#3'];
	else
		$C3 = 'X';
	if(isset($_REQUEST['C#4']))
		$C4 = $_REQUEST['C#4'];
	else
		$C4 = 'X';
	if(isset($_REQUEST['C#5']))
		$C5 = $_REQUEST['C#5'];
	else
		$C5 = 'X';
	if(isset($_REQUEST['C#6']))
		$C6 = $_REQUEST['C#6'];
	else
		$C6 = 'X';
	if(isset($_REQUEST['C#7']))
		$C7 = $_REQUEST['C#7'];
	else
		$C7 = 'X';
	if(isset($_REQUEST['C#8']))
		$C8 = $_REQUEST['C#8'];
	else
		$C8 = 'X';
	if(isset($_REQUEST['C#9']))
		$C9 = $_REQUEST['C#9'];
	else
		$C9 = 'X';
	if(isset($_REQUEST['C#10']))
		$C10 = $_REQUEST['C#10'];
	else
		$C10 = 'X';
	
	//comparative
	if(isset($_REQUEST['D#1']))
		$D1 = $_REQUEST['D#1'];
	else
		$D1 = 'X';
	if(isset($_REQUEST['D#2']))
		$D2 = $_REQUEST['D#2'];
	else
		$D2 = 'X';
	if(isset($_REQUEST['D#3']))
		$D3 = $_REQUEST['D#3'];
	else
		$D3 = 'X';
	if(isset($_REQUEST['D#4']))
		$D4 = $_REQUEST['D#4'];
	else
		$D4 = 'X';
	if(isset($_REQUEST['D#5']))
		$D5 = $_REQUEST['D#5'];
	else
		$D5 = 'X';
	if(isset($_REQUEST['D#6']))
		$D6 = $_REQUEST['D#6'];
	else
		$D6 = 'X';
	if(isset($_REQUEST['D#7']))
		$D7 = $_REQUEST['D#7'];
	else
		$D7 = 'X';
	if(isset($_REQUEST['D#8']))
		$D8 = $_REQUEST['D#8'];
	else
		$D8 = 'X';
	if(isset($_REQUEST['D#9']))
		$D9 = $_REQUEST['D#9'];
	else
		$D9 = 'X';
	if(isset($_REQUEST['D#10']))
		$D10 = $_REQUEST['D#10'];
	else
		$D10 = 'X';
	
	//word order
	if(isset($_REQUEST['E#1']))
		$E1 = $_REQUEST['E#1'];
	else
		$E1 = 'X';
	if(isset($_REQUEST['E#2']))
		$E2 = $_REQUEST['E#2'];
	else
		$E2 = 'X';
	if(isset($_REQUEST['E#3']))
		$E3 = $_REQUEST['E#3'];
	else
		$E3 = 'X';
	if(isset($_REQUEST['E#4']))
		$E4 = $_REQUEST['E#4'];
	else
		$E4 = 'X';
	if(isset($_REQUEST['E#5']))
		$E5 = $_REQUEST['E#5'];
	else
		$E5 = 'X';
	if(isset($_REQUEST['E#6']))
		$E6 = $_REQUEST['E#6'];
	else
		$E6 = 'X';
	if(isset($_REQUEST['E#7']))
		$E7 = $_REQUEST['E#7'];
	else
		$E7 = 'X';
	if(isset($_REQUEST['E#8']))
		$E8 = $_REQUEST['E#8'];
	else
		$E8 = 'X';
	if(isset($_REQUEST['E#9']))
		$E9 = $_REQUEST['E#9'];
	else
		$E9 = 'X';
	if(isset($_REQUEST['E#10']))
		$E10 = $_REQUEST['E#10'];
	else
		$E10 = 'X';

//PART II
	//
	if(isset($_REQUEST['F#1']))
		$F1 = $_REQUEST['F#1'];
	else
		$F1 = 'X';
	if(isset($_REQUEST['F#2']))
		$F2 = $_REQUEST['F#2'];
	else
		$F2 = 'X';
	if(isset($_REQUEST['F#3']))
		$F3 = $_REQUEST['F#3'];
	else
		$F3 = 'X';
	if(isset($_REQUEST['F#4']))
		$F4 = $_REQUEST['F#4'];
	else
		$F4 = 'X';
	if(isset($_REQUEST['F#5']))
		$F5 = $_REQUEST['F#5'];
	else
		$F5 = 'X';
	if(isset($_REQUEST['F#6']))
		$F6 = $_REQUEST['F#6'];
	else
		$F6 = 'X';
	if(isset($_REQUEST['F#7']))
		$F7 = $_REQUEST['F#7'];
	else
		$F7 = 'X';
	if(isset($_REQUEST['F#8']))
		$F8 = $_REQUEST['F#8'];
	else
		$F8 = 'X';
	if(isset($_REQUEST['F#9']))
		$F9 = $_REQUEST['F#9'];
	else
		$F9 = 'X';
	if(isset($_REQUEST['F#10']))
		$F10 = $_REQUEST['F#10'];
	else
		$F10 = 'X';
	if(isset($_REQUEST['F#11']))
		$F11 = $_REQUEST['F#11'];
	else
		$F11 = 'X';
	if(isset($_REQUEST['F#12']))
		$F12 = $_REQUEST['F#12'];
	else
		$F12 = 'X';
	if(isset($_REQUEST['F#13']))
		$F13 = $_REQUEST['F#13'];
	else
		$F13 = 'X';
	if(isset($_REQUEST['F#14']))
		$F14 = $_REQUEST['F#14'];
	else
		$F14 = 'X';
	if(isset($_REQUEST['F#15']))
		$F15 = $_REQUEST['F#15'];
	else
		$F15 = 'X';
	if(isset($_REQUEST['F#16']))
		$F16 = $_REQUEST['F#16'];
	else
		$F16 = 'X';
	if(isset($_REQUEST['F#17']))
		$F17 = $_REQUEST['F#17'];
	else
		$F17 = 'X';
	if(isset($_REQUEST['F#18']))
		$F18 = $_REQUEST['F#18'];
	else
		$F18 = 'X';
	if(isset($_REQUEST['F#19']))
		$F19 = $_REQUEST['F#19'];
	else
		$F19 = 'X';
	if(isset($_REQUEST['F#20']))
		$F20 = $_REQUEST['F#20'];
	else
		$F20 = 'X';
	if(isset($_REQUEST['F#21']))
		$F21 = $_REQUEST['F#21'];
	else
		$F21 = 'X';
	if(isset($_REQUEST['F#22']))
		$F22 = $_REQUEST['F#22'];
	else
		$F22 = 'X';
	if(isset($_REQUEST['F#23']))
		$F23 = $_REQUEST['F#23'];
	else
		$F23 = 'X';
	if(isset($_REQUEST['F#24']))
		$F24 = $_REQUEST['F#24'];
	else
		$F24 = 'X';
	if(isset($_REQUEST['F#25']))
		$F25 = $_REQUEST['F#25'];
	else
		$F25 = 'X';
	if(isset($_REQUEST['F#26']))
		$F26 = $_REQUEST['F#26'];
	else
		$F26 = 'X';
	if(isset($_REQUEST['F#27']))
		$F27 = $_REQUEST['F#27'];
	else
		$F27 = 'X';
	if(isset($_REQUEST['F#28']))
		$F28 = $_REQUEST['F#28'];
	else
		$F28 = 'X';
	if(isset($_REQUEST['F#29']))
		$F29 = $_REQUEST['F#29'];
	else
		$F29 = 'X';
	if(isset($_REQUEST['F#30']))
		$F30 = $_REQUEST['F#30'];
	else
		$F30 = 'X';

	
	$res_I = $A1.$A2.$A3.$A4.$A5.$A6.$A7.$A8.$A9.$A10.$B1.$B2.$B3.$B4.$B5.$B6.$B7.$B8.$B9.$B10.$C1.$C2.$C3.$C4.$C5.$C6.$C7.$C8.$C9.$C10.$D1.$D2.$D3.$D4.$D5.$D6.$D7.$D8.$D9.$D10.$E1.$E2.$E3.$E4.$E5.$E6.$E7.$E8.$E9.$E10;	//Examin results
	$res_II = $F1.$F2.$F3.$F4.$F5.$F6.$F7.$F8.$F9.$F10.$F11.$F12.$F13.$F14.$F15.$F16.$F17.$F18.$F19.$F20.$F21.$F22.$F23.$F24.$F25.$F26.$F27.$F28.$F29.$F30;
	
	//number 17
	$XF = "";
	
//PART III
	//1
	$G1 = antiinject($_REQUEST['G#1']);
	//2s
	$G2 = antiinject($_REQUEST['G#2']);

	/**************************************/
	
	$q = "UPDATE applicants SET `A` = '".$res_I."',`B` = '".$res_II."',`C` = '".$G1."',`D` = '".$G2."',exam_key = NULL WHERE (e_add='" . mysql_real_escape_string($_SESSION['exam_start']) . "' AND exam_key='" . mysql_real_escape_string($_SESSION['exam_start2']) . "')";
	
	mysql_query($q);
		

	if(mysql_affected_rows()==1){
		session_destroy();
		echo "<script type='text/javascript'>";
		echo 	'alert("Your Application and Exam results have been sent.\nThank you.");';
		echo 	'document.location = "../index.html";';
		echo "</script>";
	}
	else{
		echo "<script type='text/javascript'>";
		echo 'alert("Sorry, something went wrong.\nPlease contact us about this issue.");';
		echo "</script>";
	}
?>