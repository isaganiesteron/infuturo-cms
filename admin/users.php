<div id="left-column">
	<h3>View</h3>
	<ul class="nav">
		<li><a href="index.php?pg=04&y=01">ALL</a></li>
		<li><a href="index.php?pg=04&y=02">Admin</a></li>
		<li class="last"><a href="index.php?pg=04&y=03">Teacher</a></li>
	</ul>
</div>
<?php
	if(!isset($_REQUEST['y'])){
		$view = "ORDER by user_level ASC";
		$area = "";
	}
	else{
		if($_REQUEST['y']==1){
			$view = "ORDER by user_level";
			$area = "&y=01";
		}
		else if($_REQUEST['y']==2){
			$view = "WHERE user_level=0";
			$area = "&y=02";
		}
		else{
			$view = "WHERE user_level=1";
			$area = "&y=03";
		}
	}
?>
<div id="center-column">
	<div class="top-bar">
		<!--a href="#" class="button">ADD NEW </a-->
		<h1>This is where the USERS of the system can be seen.</h1>
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
				$select_query = "SELECT * FROM users ".$view;
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
						echo "<td><a href='index.php?pg=04".$area."&ed=".$row['user_id']."'><img src='img/edit-icon.gif' width='16' height='16' alt='edit' /></a>";
						if(!($row['first_name'].$row['last_name']==$_SESSION['first_name'].$_SESSION['last_name']))
							echo "&nbsp&nbsp<a href='index.php?pg=04".$area."&de=".$row['user_id']."'><img src='img/hr.gif' width='16' height='16' alt='edit' /></a></td>";
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
										echo "<td class='last'><input value='change' type='submit' name='edit'><a href='index.php?pg=04".$area."'>Cancel</a></td>";
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

											// Add the user to the database:\
											$q = "UPDATE users SET first_name='$fn', last_name='$ln', email='$e', pass=SHA1('$p') WHERE user_id='$id' LIMIT 1";
											$r = mysql_query ($q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysql_error($dbc));

											if (mysql_affected_rows($dbc) == 1) { // If it ran OK.

												// Finish the page:
												echo "<script type='text/javascript'>";
												echo 'alert("User information has been changed.");';
												echo 'document.location = "index.php?pg=04";';
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
						
						if(isset($_REQUEST['de'])){  //delete users
							if($_REQUEST['de']==$row['user_id']){
								echo "<form method='post' action=''>";
									echo "<tr>";
									echo "<td colspan='5'><span class='error'>Are you sure you want to delete ".$row['first_name']." ".$row['last_name']." as a user?</span></td>";
									echo "<td class='last'><input type='submit' value='Delete' name='delete'><a href='index.php?pg=04".$area."'>Cancel</a></td>";
									echo "</tr>";
								echo "</form>";
								
								if(isset($_REQUEST['delete'])){
									$del = "DELETE from users where user_id='".$row['user_id']."'";
									mysql_query($del);
									
									if(mysql_affected_rows($dbc) == 1){
										echo "<script type='text/javascript'>";
										echo 'alert("User deleted");';
										echo 'document.location = "index.php?pg=04'.$area.'";';
										echo "</script>";
									}
									else{
										echo "<script type='text/javascript'>";
										echo 'alert("User not deleted");';
										echo "</script>";
									} 
								}
							}
						}
				}
			?>
		</table>
	</div><br />
	<?php
	

	if(isset($_REQUEST['add'])){
		$val = TRUE;
		// Check for a first name:
		if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $_REQUEST['first_name'])) {
			$fn = mysql_real_escape_string ($_REQUEST['first_name']);
		} else {
			$val = FALSE;
			echo '<p class="error">Please enter your first name!</p>';
		}
		
		// Check for a last name:
		if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $_REQUEST['last_name'])) {
			$ln = mysql_real_escape_string ($_REQUEST['last_name']);
		} else {
			$val = FALSE;
			echo '<p class="error">Please enter your last name!</p>';
		}
		
		// Check for an email address:
		if (preg_match ('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $_REQUEST['email'])) {
			$e = mysql_real_escape_string ($_REQUEST['email']);
		} else {
			$val = FALSE;
			echo '<p class="error">Please enter a valid email address!</p>';
		}

		// Check for a password and match against the confirmed password:
		if (preg_match ('/^\w{4,20}$/', $_REQUEST['password1']) ) {
			if ($_REQUEST['password1'] == $_REQUEST['password2']) {
				$p = mysql_real_escape_string ($_REQUEST['password1']);
			} else {
			$val = FALSE;
				echo '<p class="error">Your password did not match the confirmed password!</p>';
			}
		} else {
			$val = FALSE;
			echo '<p class="error">Please enter a valid password!</p>';
		}
		
		$ul = $_REQUEST['user_level'];
		
		if ($val) { // If everything's OK...

			// Make sure the email address is available:
			$q = "SELECT user_id FROM users WHERE email='$e'";
			$r = mysql_query ($q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysql_error($dbc));
			
			if (mysql_num_rows($r) == 0) { // Available.

				// Add the user to the database:
				$q = "INSERT INTO users (email, pass, first_name, last_name, registration_date, user_level) VALUES ('$e', SHA1('$p'), '$fn', '$ln', NOW() ,$ul)";
				$r = mysql_query ($q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysql_error($dbc));

				if (mysql_affected_rows($dbc) == 1) { // If it ran OK.

					// Finish the page:
					echo "<script type='text/javascript'>";
					echo 'alert("New User has been added.");';
					echo 'document.location = "index.php?pg=04'.$area.'";';
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
?>
	<div class="table">
		<form method="post" action="" name="add">
			<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
			<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
			<table class="listing form" cellpadding="0" cellspacing="0">
				<tr>
					<th class="full" colspan="2">Add New User</th>
				</tr>
				<tr>
					<td class="first" width="172"><strong>First Name</strong></td>
					<td class="last"><input type="text" name="first_name" class="text" /><span id="element_1"></span></td>
				</tr>
				<tr class="bg">
					<td class="first"><strong>Last Name</strong></td>
					<td class="last"><input type="text" name="last_name" class="text" /><span id="element_2"></span></td>
				</tr>
				<tr>
					<td class="first"><strong>Email/Username</strong></td>
					<td class="last"><input type="text" name="email" class="text" /><span id="element_3"></span></td>
				</tr>
				<tr class="bg">
					<td class="first"><strong>Password</strong></td>
					<td class="last"><input type="password" name="password1" class="text" /><span id="element_4"></span></td>
				</tr>
				<tr>
					<td class="first"><strong>Retype Password</strong></td>
					<td class="last"><input type="password" name="password2" class="text" /></td>
				</tr>
				<tr>
					<td class="first"><input type="submit" name="add" value="Add" /></td>
					<td class="last"><input checked type="radio" value="0" name="user_level" /><label>Admin</label></br><input type="radio" value="1" name="user_level" /><label>Teacher</label></td>
				</tr>
			</table>
		<p>&nbsp;</p>
		</form>
	</div>

</div>