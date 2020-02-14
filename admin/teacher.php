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

?>
<html>
<head>
	<link rel="shortcut icon" href="favicon.ico" />
	<title>Teacher Area</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript">
		function show_confirm(){
			var r=confirm("WARNING:\nIt seems you have already uploaded your DPR today.\nAny file that you proceed to upload will become your single DPR for Today.\n\nAre you sure you want to upload?");
			if (r!=true){
				location.href='teacher.php?pg=01'
			}
		}
	</script>
	
	<script type="text/javascript">	
		function show(x){
			if(x.getAttribute("id")=='menu'){
				hide2.style.display = "block";
			}
			else
				hide3.style.display = "block";
		}
		function hide(x){
			if(x.getAttribute("id")=='menu'){
				hide2.style.display = "none";
			}
			else
				hide3.style.display = "none";
				
		}
	</script>
	
	<script type="text/javascript">	
		function show_confirm2(frm){
		var s = frm.req.value;
		var t = frm.com.value;
		var u = frm.hiding.value;
		if(s=="")
			alert("You didn't choose any request form.");
		else{
			if(t=="")
				var r = confirm("You didn't enter a comment?\nAre you sure you want to send a "+ s +" request form?");
			else
				var r = confirm("Are you sure you want to send a "+ s +" request form?\nWith the following comment:\n" + t);
			if (r==true){
				document.req_frm.submit()
			}
		}
		}
	</script>
</head>
<body>
<div id="main">
	<div id="header">
		<a href="teacher.php" class="logo"><img src="img/logo.gif" height="50" alt="" /></a>
	</div>
	<div id="middle">
	
		<div id="left-column">
			<div id = "menu" onmouseover="show(this)" onmouseout="hide(this)">
				<h3>Menu</h3>
				<span id = 'hide2' hidden>
					<ul class="nav">
						<li><a href="teacher.php?pg=01">Control Panel</a></li>
						<li class="last"><a href="teacher.php?pg=02">Account Information</a></li>
					</ul>
				</span>
			</div>
			</br>
			<div id = "messages" onmouseover="show(this)" onmouseout="hide(this)">
				<h3>Messages</h3>
					<span id = 'hide3' hidden>
						<ul class="nav">
						<li><a href='teacher.php?pg=01&y=1'>Compose Message</a></li>
						<!--li style="text-align:center;" onclick="top()" onmouseover="show()" onmouseout="hide()">Up</li-->
						<?php
							$select_query = "SELECT * FROM messages WHERE user_level=".$_SESSION['user_id']." order by app_date desc";
							$result = mysql_query($select_query);
							
							while($row = (mysql_fetch_array($result))){
								if($row['email']=="Admin"){
									echo "<li>";
										echo "<b>You wrote/replied to Admin: </b></br>".$row['message']."</br>";
										echo "<b>Replied On:</b></br>".$row['app_date']."</br>";
										echo "</br>";
										echo "<a href='teacher.php?x=".$row['ID']."'>Delete</a>";
									echo "</li>";
								}
								else{
									echo "<li>";
										echo "<b>From:</b></br>".$row['name']."</br>";
										echo "<b>Message:</b></br>".$row['message']."</br>";
										echo "<b>Sent On:</b></br>".$row['app_date']."</br>";
										echo "</br>";
										echo "<a href='teacher.php?y=".$row['name']."'>Reply</a>";
										if($row['email']=='Teacher')
											echo "</br><a href='teacher.php?x=".$row['ID']."'>Delete</a>";
									echo "</li>";
								}
							}
						?>
						<!--li class="last" style="text-align:center;" onclick="more()"><span id="view">Hide</span></li-->
						</ul>
					</span>
			</div>
			</br>
			<div>
				<?php
					if(isset($_REQUEST['y'])){
					?>
						<h3>Compose Message:</h3>
						<ul class="nav">
							<li>
							<?php
								if(isset($_REQUEST['message'])){
									$mess_teach = $_REQUEST['mess'];
									$from = $_SESSION['first_name']." ".$_SESSION['last_name'];

									if(isset($_REQUEST['to'])){//when composes new message
										$rece = $_REQUEST['to'];
										if($_REQUEST['to']==$_SESSION['user_id'])
											$sub = "Admin";
										else
											$sub = "Teacher";
									}
									else{//when replied
										if($_REQUEST['y']=="ADMIN"){
											$rece = $_SESSION['user_id'];
											$sub = "Admin";
										}
										else{
											$sub = "Teacher";
											$select_query = "SELECT * FROM users where user_level=1";
											$result = mysql_query($select_query);
											while($row = (mysql_fetch_array($result))){
												if($_REQUEST['y']==$row['first_name']." ".$row['last_name'])
													$rece = $row['user_id'];
											}
										}
									}
									
									$insert = "INSERT INTO messages (ID, name, email, message, user_level, app_date) VALUES ('', '$from', '$sub', '$mess_teach','$rece', NOW())";

									//echo $insert;
									mysql_query($insert);

									if(mysql_affected_rows()==1){
										echo "<script type='text/javascript'>";
										echo 'alert("Your message has been sent.\nThank You.");';
										echo 'document.location = "teacher.php";';
										echo "</script>";
										}
									else{
										echo "<script type='text/javascript'>";
										echo 'document.location = "teacher.php";';
										echo "</script>";
									}
									

								}
							?>
								<form method='post' action=''>
									<label><b>TO:</b></label></br>
									<?php
										if($_REQUEST['y']=='1'){
											echo "<select name='to'>";
											$select_query = "SELECT * FROM users where user_level=1";
											$result = mysql_query($select_query);
											echo "<option value='".$_SESSION['user_id']."'>Admin</option>";
											while($row = (mysql_fetch_array($result))){
												if($row['user_id']!=$_SESSION['user_id'])
													echo "<option value='".$row['user_id']."'>".$row['first_name']." ".$row['last_name']."</option>";
											}
											echo "</select>";
										}
										else
											echo $_REQUEST['y'];
									?>
									
									</br>
									<label><b>Message:</b></label></br><textarea name="mess" rows="10" cols="20%"></textarea></br></br>
									<input type="submit" name="message" value="Send" /></br>
									<a href='teacher.php'>Cancel</a>
								</form>
							</li>
						</ul>
					<?php
					}
					if(isset($_REQUEST['x'])){
						echo "<p class='error'>are you sure you want to delete this message?</p>";
						echo "<a href='teacher.php?x=".$_REQUEST['x']."&del_mel=true'>Yes</a></br>";
						echo "<a href='teacher.php'>Cancel</a>";
						
						if(isset($_REQUEST['del_mel'])){
							if($_REQUEST['del_mel']){
								$del = "DELETE from messages where ID='".$_REQUEST['x']."'";
								mysql_query($del);
								
								if(mysql_affected_rows($dbc) == 1){
									echo "<script type='text/javascript'>";
									echo 'alert("Message deleted");';
									echo 'document.location = "teacher.php";';
									echo "</script>";
								}
								else{
									echo "<script type='text/javascript'>";
									echo 'alert("Message not deleted");';
									echo "</script>";
								} 
							}
						}
					}
				?>
			</div>
		</div>
		<div id="center-column">
			<?php
			if(!isset($_REQUEST['pg']))
				$pg = 1;
			else
				$pg = $_REQUEST['pg'];
			/*  teacher area content  */
			if($pg==1)
			{?>
				<div class="top-bar">
					<!--a href="#" class="button">ADD NEW </a-->
					<h1>Control Panel</h1>
				</div>

				<div class="table">
					<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
						<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
						<table class="listing" cellpadding="0" cellspacing="0">
							<form name="dp" method="post" action="" enctype="multipart/form-data">
								<tr>
									<th class="first" width="50%">DPR</th>
									<th class="last"> <input type="submit" name="dpr" value="Upload"/> <a href="teacher.php">Cancel</a></th>
								</tr>
								<tr>
									<td class="first" width="50%">DPR for <?php echo date("F d Y")?></td>
									<td class="last"><input type="file" name="file" id="file" /></td>
								</tr>
								</table>
								<?php
									function upload($fi, $tmp_n){
										if(move_uploaded_file($tmp_n, "DPR/" . $fi))
											echo "<h4>Successfully Uploaded</br>Saved as: " . $fi . "</h4>";
										else
											echo "<h4>Not Uploaded</h4>";
									}
									
									if(isset($_REQUEST['dpr'])){			
										unset($_REQUEST['x']);
										unset($_REQUEST['y']);
										if ((($_FILES["file"]["type"] == "application/vnd.ms-excel") || ($_FILES["file"]["type"] == "application/x-excel") || ($_FILES["file"]["type"] == "application/x-msexcel")  || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") && ($_FILES["file"]["size"] < 20000))){
											if ($_FILES["file"]["error"] > 0){
												echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
											}
											else{
												$ext = strstr($_FILES["file"]["name"], '.');
												$file = date("mdy")."_".strtolower($_SESSION['first_name']).$ext;
												$exi = 0;
												$tmp = $_FILES["file"]["tmp_name"];

												if($ext=='.xls'){
													$file2 = date("mdy")."_".strtolower($_SESSION['first_name']).".xlsx";
													if(file_exists("DPR/" . $file2))
														$exi = 1;
												}
												else{
													$file2 = date("mdy")."_".strtolower($_SESSION['first_name']).".xls";
													if(file_exists("DPR/" . $file2))
														$exi = 1;
												}

												if (file_exists("DPR/" . $file) || $exi==1){
													echo '<script type="text/javascript">';
													echo 'show_confirm();';
													echo '</script>';
													
													if($exi==1)
														unlink("DPR/" . $file2);
													else
														unlink("DPR/" . $file);
													
													echo "</br>File Chosen: " . $_FILES["file"]["name"] . "<br />";
													echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
													upload($file, $tmp);
												}												
												else{
													echo "</br>File Chosen: " . $_FILES["file"]["name"] . "<br />";
													echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
													upload($file, $tmp);
												}
											}
										}
										else{
										  echo "<span class='error'>Invalid file</span>";
										}
									}

								?>
							</form>
				</div>

						<?php
							if(isset($_REQUEST['month'])){
								echo "<span class='error'>You are not viewing the current month of ".Date('F').".</br></span><a href='teacher.php'>View month of ".Date('F')."?</a></br>";
								$mon = $_REQUEST['month'];
								switch($mon){
									case '01':
										$mon_dis = "January";
										break;
									case '02':
										$mon_dis = "February";
										break;
									case '03':
										$mon_dis = "March";
										break;
									case '04':
										$mon_dis = "April";
										break;
									case '05':
										$mon_dis = "May";
										break;
									case '06':
										$mon_dis = "June";
										break;
									case '07':
										$mon_dis = "July";
										break;
									case '08':
										$mon_dis = "August";
										break;
									case '09':
										$mon_dis = "September";
										break;
									case '10':
										$mon_dis = "October";
										break;
									case '11':
										$mon_dis = "November";
										break;
									case '12':
										$mon_dis = "December";
										break;
								}
							}
							else{
								$mon = Date('m');
								$mon_dis = Date('F');
							}
							$mon_dis = $mon_dis . Date(' Y');
						?>
				</br>
				<div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
					<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
						<table class="listing" cellpadding="0" cellspacing="0">
							<tr>
								<th class="first" width="20%">Month of <strong><?php echo $mon_dis?></strong></th>
								<th width="30%">ACTUAL Daily Wage</th>
								<th width="20%">Month of <?php echo $mon_dis?></th>
								<th class="last" width="30%">ACTUAL Daily Wage</th>
							</tr>
							<?php //print from database

								$tot1 = 0;
								$tot2 = 0;
								
								for($c=0;$c<16;$c++){
									if(($c+1)<10)
										$co1 = $mon ."0".($c+1) . date('y');
									else
										$co1 = $mon . ($c+1) . date('y');
										
									$co2 = $mon . ($c+17) . date('y');
									$row = 1;
									
									$dw1 = '--';
									$dw2 = '--';
									
									if(file_exists("DPR/" . $co1 ."_".strtolower($_SESSION['first_name']).".csv")){
										$file = $co1 ."_".strtolower($_SESSION['first_name']).".csv";
										if (($handle = fopen("DPR/$file", "r")) !== FALSE) {
											while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
												$num = count($data);
												$row++;
												for ($i=0; $i < $num; $i++) {
													if($data[$i] == "ACTUAL Daily Wage"){
														$dw1 = $data[$i+5];
														$tot1 = $tot1 + $dw1;
													}
												}
											}
											fclose($handle);
										}
									}

									if(file_exists("DPR/" . $co2 ."_".strtolower($_SESSION['first_name']).".csv")){
										$file2 = $co2 ."_".strtolower($_SESSION['first_name']).".csv";
										if (($handle = fopen("DPR/$file2", "r")) !== FALSE) {
											while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
												$num = count($data);
												$row++;
												for ($i=0; $i < $num; $i++) {
													if($data[$i] == "ACTUAL Daily Wage"){
														$dw2 = $data[$i+5];
														$tot2 = $tot2 + $dw2;
													}
												}
											}
											fclose($handle);
										}
									}
										
									echo "<tr>";
									echo "	<td class='first'><b>".($c+1)."</b></td>";
									if($dw1!='--')
										echo "	<td ><a href='DPR/$file'>".$dw1."</a></td>";
									else
										echo "	<td >".$dw1."</td>";
									echo "	<td ><b>".($c+17)."</b></td>";
									if($dw2!='--')
										echo "	<td class='last'><a href='DPR/$file2'>".$dw2."</a></td>";
									else
										echo "	<td class='last'>".$dw2."</td>";
									echo "</tr>";
								}
								
								echo "<tr class='bg'>";
								echo "	<td class='first'>TOTAL:</td>";
								echo "	<td >".number_format($tot1, 2, '.', '')."</td>";
								echo "	<td >TOTAL:</td>";
								echo "	<td class='last'>".number_format($tot2, 2, '.', ',')."</td>";
								echo "</tr>";
							?>
						</table>
						<div class="select">
							<strong>Month of </strong>
							<form method='' action=''>
								<select name="month" onchange='this.form.submit()'>
									<option value="">..</option>
									<option value="01">Jan</option>
									<option value="02">Feb</option>
									<option value="03">Mar</option>
									<option value="04">Apr</option>
									<option value="05">May</option>
									<option value="06">Jun</option>
									<option value="07">Jul</option>
									<option value="08">Aug</option>
									<option value="09">Sep</option>
									<option value="10">Oct</option>
									<option value="11">Nov</option>
									<option value="12">Dec</option>
								</select>
							</form>
						</div>
				</div>			
				
				<div class="table">
					<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
						<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
						<table class="listing" cellpadding="0" cellspacing="0">
							<form method="post" action="" enctype="multipart/form-data">
								<tr>
									<th class="first" width="50%">Bio Data</th>
									<th class="last">
										<?php 
										if (!(file_exists("biodata/" . strtolower($_SESSION['first_name']."_".$_SESSION['last_name']) . ".xls" )))
											echo "<input type='submit' name='bio' value='Upload' /><a href='teacher.php'>Cancel</a>";
										else
											echo "You have already submitted your Bio Data";
										?>
									</th>
								</tr>
								<tr>
									<td class="first" width="50%"><a href='biodata/Biodata.xls'>Download bio data excel file here.</a></td>
									<td class="last"><input type="file" name="file" id="file" /> </td>
								</tr>
							</form>
						</table>
					<?php
						if(isset($_REQUEST['bio'])){
							if ((($_FILES["file"]["type"] == "application/vnd.ms-excel") || ($_FILES["file"]["type"] == "application/x-excel") || ($_FILES["file"]["type"] == "application/x-msexcel")  || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") && ($_FILES["file"]["size"] < 20000))){
							  if ($_FILES["file"]["error"] > 0)
								{
								echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
								}
							  else
								{
								echo "Upload: " . $_FILES["file"]["name"] . "<br />";
								echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";

								
								$ext = strstr($_FILES["file"]["name"], '.');
								$file = strtolower($_SESSION['first_name']."_".$_SESSION['last_name']) . $ext;
								
								if (file_exists("biodata/" . $file))
								  {
								  echo "<span class='error'>" . $file . " already exists.</span>";
								  }
								else
								  {
								  move_uploaded_file($_FILES["file"]["tmp_name"], "biodata/" . $file);
								  echo "Stored as: " . $file;
								  echo "<h4>Successfully Uploaded</br>Saved as: " . $file . "</h4>";
								  }
								}
							}
							else{
							  echo "<span class='error'>Invalid file</span>";
							}
						}
					?>
				</div>
				<div class="table">
					<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
						<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
						<table class="listing" cellpadding="0" cellspacing="0">
							<tr>
								<th class="first" width="50%">Requests forms</th>
								<th class="last"></th>
							</tr>
							<tr>
							<form name='req_frm' action='' method='post'>
								<td class="first" width="50%">
								<select name="req">
									<option value="">Choose</option>
									<option value="Leave">Leave</option>
									<option value="Absent">Absent</option>
									<option value="Complaint">Complaint</option>
								</select>
								</br><label>Comment:</label></br>
								<textarea name="com" rows="10" cols="80%"></textarea>
								<td class="last"><input name="hiding" type="hidden" value="hide" /><input type="button" name="req_sub" value="Request" onclick="show_confirm2(this.form)"/> </td>
							</form>
							</tr>
						</table>
				</div>
				
			<?php
				if(isset($_REQUEST['hiding'])){
					$comm = $_REQUEST['com'];
					$req_type = $_REQUEST['req'];
					$user_name = $_SESSION['first_name']." ".$_SESSION['last_name'];
					$insert = "INSERT INTO messages (ID, name, email, message, user_level, app_date) VALUES ('', '$user_name', '$req_type  REQUEST FORM', '$comm','3', NOW())";
					mysql_query($insert);
					if(mysql_affected_rows()==1){
						echo "<script type='text/javascript'>";
						echo 'alert("Your request form has been sent.\nThank You.");';
						echo 'document.location = "teacher.php?pg=01";';
						echo "</script>";
						}
					else{
						echo "<script type='text/javascript'>";
						echo 'document.location = "teacher.php?pg=01";';
						echo "</script>";
					}
				}
			}
			else
			{?>
				<div class="top-bar">
					<!--a href="#" class="button">ADD NEW </a-->
					<h1>Account Information</h1>
				</div>

				<div class="table">
					<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
					<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
					<table class="listing" cellpadding="0" cellspacing="0">
						<tr>
							<th class="first" width="177">First Name</th>
							<th>Last Name</th>
							<th>Email/Username</th>
							<th>User Level</th>
							<th>Edit Delete</th>
							<th class="last">Date of Registration</th>
						</tr>
					<?php
					$select_query = "SELECT * FROM users WHERE user_id = ".$_SESSION['user_id'];
					$result = mysql_query($select_query);
					$bg = true;
					
						while($row = (mysql_fetch_array($result))){
								if($bg){
									$bg = false;
									echo "<tr class='bg'>";
								}
								else{
									$bg = true;
									echo "<tr>";
								}
									echo "<td>".$row['first_name']."</td>";
									echo "<td>".$row['last_name']."</td>";
									echo "<td>".$row['email']."</td>";
									if($row['user_level']==0)
										echo "<td>Admin</td>";
									else
										echo "<td>Teacher</td>";
									echo "<td><a href='teacher.php?pg=02&ed=".$row['user_id']."'><img src='img/edit-icon.gif' width='16' height='16' alt='edit' /></a></td>";
									echo "<td class='last'>".$row['registration_date']."</td>";
									echo "</tr>";
									
						if(isset($_REQUEST['ed'])){ //edit users
							if($_REQUEST['ed']==$row['user_id']){
								echo "<form method='post'>";
									echo "<tr>";
										echo "<td><input type='text' size='5' name='first_name_ed' value='".$row['first_name']."'></td>";
										echo "<td><input type='text' size='5' name='last_name_ed' value='".$row['last_name']."'></td>";
										echo "<td><input type='text' size='8' name='email_ed' value='".$row['email']."'></td>";
										echo "<td><input type='password' size='5' name='password1_ed'></td>";
										echo "<td><input type='password' size='5' name='password2_ed' ></td>";
										echo "<td class='last'><input value='change' type='submit' name='edit'><a href='teacher.php?pg=02'>Cancel</a></td>";
									echo "</tr>";
								echo "</form>";
								if(isset($_REQUEST['edit'])){
								//$ed = "UPDATE users SET first_name='$_REQUEST['first_name_ed']', last_name='$_REQUEST['last_name_ed']', email='$_REQUEST['email']' WHERE user_id='".$_REQUEST['ed']."'";
									$val = TRUE;
									// Check for a first name:
									if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $_REQUEST['first_name_ed'])) {
										$fn = mysql_real_escape_string ($_REQUEST['first_name_ed']);
									} else {
										$val = FALSE;
										echo '<p class="error">Please enter your first name!</p>';
									}
									
									// Check for a last name:
									if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $_REQUEST['last_name_ed'])) {
										$ln = mysql_real_escape_string ($_REQUEST['last_name_ed']);
									} else {
										$val = FALSE;
										echo '<p class="error">Please enter your last name!</p>';
									}
									
									// Check for an email address:
									if (preg_match ('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $_REQUEST['email_ed'])) {
										$e = mysql_real_escape_string ($_REQUEST['email_ed']);
									} else {
										$val = FALSE;
										echo '<p class="error">Please enter a valid email address!</p>';
									}

									// Check for a password and match against the confirmed password:
									if (preg_match ('/^\w{4,20}$/', $_REQUEST['password1_ed']) ) {
										if ($_REQUEST['password1_ed'] == $_REQUEST['password2_ed']) {
											$p = mysql_real_escape_string ($_REQUEST['password1_ed']);
										} else {
										$val = FALSE;
											echo '<p class="error">Your password did not match the confirmed password!</p>';
										}
									} else {
										$val = FALSE;
										echo '<p class="error">Please enter a valid password!</p>';
									}
									
									if ($val) { // If everything's OK...
											
										// Make sure the email address is available:
										$id = $row['user_id'];
										$q = "SELECT user_id FROM users WHERE email='$e' AND user_id!='$id'";
										$r = mysql_query ($q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysql_error($dbc));
										
										if (mysql_num_rows($r) == 0) { // Available.
											//UPDATE  `users` SET  `first_name` =  'Ganisadf' WHERE  `users`.`user_id` =10 LIMIT 1
											// Add the user to the database:
											$q = "UPDATE users SET first_name='$fn', last_name='$ln', email='$e', pass=SHA1('$p') WHERE user_id='$id' LIMIT 1";
											$r = mysql_query ($q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysql_error($dbc));

											if (mysql_affected_rows($dbc) == 1) { // If it ran OK.

												// Finish the page:
												echo "<script type='text/javascript'>";
												echo 'alert("User information has been changed.");';
												echo 'document.location = "teacher.php?pg=02";';
												echo "</script>";
												
											} else { // If it did not run OK.
												echo '<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
											}
											
										} else { // The email address is not available.
											echo '<p class="error">That email address has already been registered.</p>';
										}
									} else { // If one of the data tests failed.
										echo '<p class="error">Please re-enter your passwords and try again.</p>';
									}
								}
							}
						}


							}
						?>
					</table>
				</div>
			<?php
			}
			?>
		</div>
		<div id="right-column">
			<strong class="h">INFO</strong>
			<div class="box">
				<p><h3>Hello!, <?php echo $_SESSION['first_name']." ".$_SESSION['last_name'];?></h3></p>
				<p><a href="logout.php">Logout</a></p>
			</div>
		</div>
	</div>
	<div id="footer">
		<p><span>Copyright &copy; InFuturo Inc. Designed by Isagani Esteron</span></p>
	</div>
</div>
</body>
</html>
<?php // Flush the buffered output.
	ob_end_flush();
?>