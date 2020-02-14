<?php
	require_once ('../includes/sql_connect.php');
	$q = "SELECT * FROM applicants WHERE ID='".$_REQUEST['x']."';";
	$result = mysql_query($q);
	
	while($row = (mysql_fetch_array($result))){
		$lname = $row['lname'];
		$fname = $row['fname'];
		$e_add = $row['e_add'];
		$exam_key = $row['exam_key'];
	}
?>
<html>
<head>

</head>
<body>
	<fieldset>
		<legend><h3>Email to <?php echo $e_add;?></h3></legend><?php
		echo "Dear ".$fname." ".$lname.",<br/><br/>&nbsp&nbsp&nbspThank you for applying here in InFuturo Inc., the information you have entered in the application form has been recorded.<br/>Completing the online application form is the first step in the application process.<br/>The second step is to take the online exam. Copy the following link and enter it in another window to take the online exam:<br/><br/>";
		echo 'http://www.infuturo.net23.net/exam/exam_page.php?x=' . urlencode($e_add) . "&y=$exam_key<br/><br/>";
		echo "From:\nInFuturo Inc. Admin";
	?>
	</fieldset>
	<!--fieldset>
		<legend><h3>Resend through website</h3></legend>
		<form action="resend.php">
			<input type="button" value="resend" name="resend"/>
		</form>
		<!--?php
			if (isset($_REQUEST['resend'])){
				$q = "SELECT * FROM applicants WHERE ID='".$_REQUEST['x']."';";
				$result = mysql_query($q);
					
				while($row = (mysql_fetch_array($result))){
					$lname = $row['lname'];
					$fname = $row['fname'];
					$e_add = $row['e_add'];
					$exam_key = $row['exam_key'];
				}
				$body = "Dear ".$fname." ".$lname.",\n\n\tThank you for applying here in InFuturo Inc., the information you have entered in the application form has been recorded.\nCompleting the online application form is the first step in the application process.\nThe second step is to take the online exam. Copy the following link and enter it in another window to take the online exam:\n\n";
				$body .= 'http://www.infuturo.net23.net/exam/exam_page.php?x=' . urlencode($e_add) . "&y=$exam_key\n\n";
				$body .= "From:\nInFuturo Inc. Admin";
				echo $body;
				//mail($e_add, 'Application Form Completion', $body, 'From: InFuturo Inc.');
			}
		?>
	</fieldset-->
</body>
</html>