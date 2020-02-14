<?php

	require_once ('../includes/sql_connect.php');
	session_start();
	
	$x = FALSE;
	$y = FALSE;
	
	
		if (isset($_GET['x']) && preg_match ('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $_GET['x']) ) {
			$x = $_GET['x'];
		}
		
		if (isset($_GET['y']) && (strlen($_GET['y']) == 32 ) ) {
			$y = $_GET['y'];
		}
		
	if ($x && $y){
		$q = "SELECT * FROM applicants WHERE (e_add='" . mysql_real_escape_string($x) . "' AND exam_key='" . mysql_real_escape_string($y) . "')";
		
		mysql_query($q);
		
		if (mysql_affected_rows() != 1) {
			header("Location: ../index.html");
		}
		else{
			$_SESSION['exam_start'] = $x;
			$_SESSION['exam_start2'] = $y;
		}
	}
	else{
		header("Location: ../index.html");
	}
?>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=7" />
	<title>Infuturo EXAMINATION</title>
	<link rel="stylesheet" type="text/css" href="styles.css" />
	<script type="text/javascript">
		function show_confirm(){
		var r=confirm("After pressing OK you cannot exit go back to the exam.\nDo you wish to continue?");
		if (r==true){
			location.href='exam_A.php'
		}
		}
	</script>
</head>
<body>
	<div class="main">
		<div class="header">
			<table width="100%" height="100%">
				<tr>
					<td width="70%"><h1>Infuturo, Inc.</h1></td>
					<td width="30%"><h2>EXAMINATION</h2></td>
				</tr>
			</table>
		</div>
		<div class="content">
			<table width="100%" height="100%">
				<tr>
					<td align="center">
						<h1>Welcome to the InFuturo Inc. online exam.</h1>
							<p>Thank you for completing the online application form. Here you will complete the online examination.</p>
						<h2>Please Read the Instructions Carefully:</h2>
						<ol align="left">
							<li>After you press the "Begin Exam now" button, you will be redirected to the examination page.</li>
							<li>You are given 75 minutes to complete the examination.</li>
							<li>If you exit or refresh the webpage or click back, the timer will still be running until you have pressed submit or the time runs out.</li>
							<li>The passing percentage is 80%</li>
						</ol>
							<input type="button" value="Begin Exam now" onClick="show_confirm()" />
					</td>
				</tr>
			</table>	
		</div>
		<div class="footer">
			<label>2012-2013 Infuturo, Inc</label></br>
			<h2>EXAM A</h2>
		</div>
	</div>
</body>
</html>