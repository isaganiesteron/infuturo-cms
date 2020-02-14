<div id="left-column">

	<h3>File Manager</h3>
	<ul class="nav">
		<li><a href="index.php?pg=03&y=01">DPR</a></li>
		<li class="last"><a href="index.php?pg=03&y=02">Bio Data</a></li>
	</ul>
	
</div>
<?php
	if(isset($_REQUEST['y']))
		$fi_man = "&y=".$_REQUEST['y'];
	else
		$fi_man = "";
?>
<div id="center-column">
	<div class="top-bar">
		<!--a href="#" class="button">ADD NEW </a-->
		<h1>Online Teachers</h1>
	</div>

	<div class="select-bar">
		<form action="index.php?pg=03<?php echo $fi_man?>" method="post">
			<select name="teach_id">
				<option value='0'>Select Teacher</option>
				<?php
				$select_query = "SELECT * FROM users where user_level=1";
				$result = mysql_query($select_query);
				
				if($fi_man!="")
					echo "<option value='--'>All Teachers</option>";
				while($row = (mysql_fetch_array($result))){
					echo "<option value='".$row['user_id']."'>".$row['first_name']." ".$row['last_name']."</option>";
				}
				?>
			</select>
			<input type="submit" name="teach" value="View"/>
			<?php
				if(isset($_REQUEST['y'])){
					if($_REQUEST['y']=='01')
						echo "<h4>View teachers DPR</h4>";
					else
						echo "<h4>View teachers Bio Data</h4>";
				}
				else
					echo "<h4>View teacher Information</h4>";
			?>
		</form>
	</div><br />

	<?php
		if(isset($_REQUEST['teach_id']) && $_REQUEST['teach_id']!='0'){
			if($fi_man!=""){
			
				if($_REQUEST['y']=='1'){
					$dir = "DPR/";
					$dir2 = "DPR";
				}
				else{
					$dir = "biodata/";
					$dir2 = "Biodata";
				}
				
				if($_REQUEST['teach_id']=='--'){//view for all teachers
					?>
					
					<div class="table">
						<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
						<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
						<table class="listing" cellpadding="0" cellspacing="0">
							<tr>
								<th class="first" width="90%"><?php echo $dir2?> for All Teachers</th>
								<th class="last">Delete</th>
							</tr>
					<?php
					
					if (is_dir($dir)) {
						if ($dh = opendir($dir)) {
							while (($file = readdir($dh)) !== false) {
								if(filetype($dir . $file)!="dir")
									echo "<tr><td class='full'><a href='$dir$file'>$file</a></td><td><a href='index.php?pg=03&teach_id=".$_REQUEST['teach_id'].$fi_man."&del=".$dir.$file."'><img src='img/hr.gif' width='16' height='16' alt='edit' /></a></td></tr>";
								if(isset($_REQUEST['del'])){
									if($_REQUEST['del'] == $dir.$file)
										echo "<tr><td><p class='error'>Are you sure you want to delete ".$_REQUEST['del']."?</p></td><td><a href='index.php?pg=03&teach_id=".$_REQUEST['teach_id'].$fi_man."&del_fil=".$dir.$file."'>Yes<a/></br></br><a href='index.php?pg=03&teach_id=".$_REQUEST['teach_id'].$fi_man."'>Cancel<a/></td></tr>";
								}	
							}
							closedir($dh);
						}
					}
					?>
						</table>
					</div>
					
					<?php
					if(isset($_REQUEST['del_fil'])){
						unlink($_REQUEST['del_fil']);
						
						echo "<script type='text/javascript'>";
						echo 'alert("File has been deleted.");';
						echo 'document.location = "index.php?pg=03&teach_id='.$_REQUEST['teach_id'].$fi_man.'";';
						echo "</script>";
					}
				}
				else{//view for not all teachers
				
					$select_query = "SELECT * FROM users WHERE user_id= " . $_REQUEST['teach_id'];
					$result = mysql_query($select_query);
					
					if($_REQUEST['y']=='01')
						$dpr = true;
					else
						$dpr = false;
						
					while($row = (mysql_fetch_array($result))){
						$teach_name = $row['first_name']." ".$row['last_name'];
						if($dpr)
							$files = strtolower("_" . $row['first_name']);
						else
							$files = substr(strtolower($row['first_name']."_".$row['last_name']), 1);
					}
					?>
					<div class="table">
						<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
						<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
						<table class="listing" cellpadding="0" cellspacing="0">
							<tr>
								<th class="first" width="90%"><?php echo $dir2." for ". $teach_name?> </th>
								<th class="last">Delete</th>
							</tr>
					<?php
					if (is_dir($dir)) {
						if ($dh = opendir($dir)) {
							while (($file = readdir($dh)) !== false) {
								if(filetype($dir . $file)!="dir"){
									if (strpos($file,$files))
										echo "<tr><td class='full'><a href='$dir$file'>$file</a><td><a href='index.php?pg=03&teach_id=".$_REQUEST['teach_id'].$fi_man."&del=".$dir.$file."'><img src='img/hr.gif' width='16' height='16' alt='edit' /></a></td></tr>";
									if(isset($_REQUEST['del'])){
										if($_REQUEST['del'] == $dir.$file)
											echo "<tr><td><p class='error'>Are you sure you want to delete ".$_REQUEST['del']."?</p></td><td><a href='index.php?pg=03&teach_id=".$_REQUEST['teach_id'].$fi_man."&del_fil=".$dir.$file."'>Yes<a/></br></br><a href='index.php?pg=03&teach_id=".$_REQUEST['teach_id'].$fi_man."'>Cancel<a/></td></tr>";
									}											
								}
							}
							closedir($dh);
						}
					}

					?>
						</table>
					</div>
					
					<?php
					if(isset($_REQUEST['del_fil'])){
						unlink($_REQUEST['del_fil']);
						
						echo "<script type='text/javascript'>";
						echo 'alert("File has been deleted.");';
						echo 'document.location = "index.php?pg=03&teach_id='.$_REQUEST['teach_id'].$fi_man.'";';
						echo "</script>";
					}
				}

			}
			else{
				$select_query = "SELECT * FROM users WHERE user_id= ".$_REQUEST['teach_id'];
				$result = mysql_query($select_query);
				
				while($row = (mysql_fetch_array($result))){
					echo "<h1>".$row['first_name']." ".$row['last_name']."</h1>";

				if(isset($_REQUEST['month'])){
					echo "<span class='error'>You are not viewing the current month.</br></span><a href='index.php?pg=03&teach_id=".$_REQUEST['teach_id']."'>View Current Month?</a>";
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
				<div class="table">
					<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
					<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
					<table class="listing" cellpadding="0" cellspacing="0">
						<tr>
							<th class="first" width="20%">Month of <?php echo $mon_dis?></th>
							<th width="30%">ACTUAL Daily Wage</th>
							<th width="20%">Month of <?php echo $mon_dis?></th>
							<th class="last" width="30%">ACTUAL Daily Wage</th>
						</tr>
				<?php //print from database

						$tot1 = 0;
						$tot2 = 0;
						$user_name = $row['first_name']." ".$row['last_name'];
						$name = $row['first_name'];
						for($c=0;$c<16;$c++){
							
							if(($c+1)<10)
								$co1 = $mon ."0".($c+1) . date('y');
							else
								$co1 = $mon . ($c+1) . date('y');
								
							$co2 = $mon . ($c+17) . date('y');
							$row = 1;
							
							$dw1 = '--';
							$dw2 = '--';

							if(file_exists("DPR/" . $co1 ."_".strtolower($name).".csv")){
								$file = $co1 ."_".strtolower($name).".csv";
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

							if(file_exists("DPR/" . $co2 ."_".strtolower($name).".csv")){
								$file2 = $co2 ."_".strtolower($name).".csv";
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
				}	
				?>
					</table>
					<div class="select">
						<strong>Month of </strong>
						<form method='' action=''>
							<select name="month" action="" ONCHANGE="location = this.options[this.selectedIndex].value;">
								<option value="">..</option>
								<option value="index.php?pg=03&teach_id=<?php echo $_REQUEST['teach_id']?>&month=01">Jan</option>
								<option value="index.php?pg=03&teach_id=<?php echo $_REQUEST['teach_id']?>&month=02">Feb</option>
								<option value="index.php?pg=03&teach_id=<?php echo $_REQUEST['teach_id']?>&month=03">Mar</option>
								<option value="index.php?pg=03&teach_id=<?php echo $_REQUEST['teach_id']?>&month=04">Apr</option>
								<option value="index.php?pg=03&teach_id=<?php echo $_REQUEST['teach_id']?>&month=05">May</option>
								<option value="index.php?pg=03&teach_id=<?php echo $_REQUEST['teach_id']?>&month=06">Jun</option>
								<option value="index.php?pg=03&teach_id=<?php echo $_REQUEST['teach_id']?>&month=07">Jul</option>
								<option value="index.php?pg=03&teach_id=<?php echo $_REQUEST['teach_id']?>&month=08">Aug</option>
								<option value="index.php?pg=03&teach_id=<?php echo $_REQUEST['teach_id']?>&month=09">Sep</option>
								<option value="index.php?pg=03&teach_id=<?php echo $_REQUEST['teach_id']?>&month=10">Oct</option>
								<option value="index.php?pg=03&teach_id=<?php echo $_REQUEST['teach_id']?>&month=11">Nov</option>
								<option value="index.php?pg=03&teach_id=<?php echo $_REQUEST['teach_id']?>&month=12">Dec</option>
							</select>
						</form>
					</div>
				</div>
				<?php
				
				$select_query = "SELECT * FROM users WHERE user_id= ".$_REQUEST['teach_id'];
				$result = mysql_query($select_query);
				
				while($row = (mysql_fetch_array($result))){
					$file = $row['first_name']."_".$row['last_name'];
					
					if (file_exists("biodata/" . $file.".xls") || file_exists("biodata/" . $file.".xlsx")){
						if(file_exists("biodata/" . $file.".xls"))
							$file .= ".xls";
						else
							$file .= ".xlsx";
						
						$bd_stat = "<a href='biodata/". $file . "'>Download Bio Data</a>";
					}
					else
						$bd_stat = "Has not yet submitted Bio Data.";
				?>		
				<div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
						<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
						<table class="listing form" cellpadding="0" cellspacing="0">
							<tr>
								<th class="full" colspan="2">BIO data of <?php echo $row['first_name']." ".$row['last_name']?></th>
							</tr>
							<tr>
								<td class="full" width="172"><?php echo $bd_stat ?></td>
							</tr>
						</table>	
				</div>
				
				<div class="table">

					<form action="index.php?pg=03&teach_id=<?php echo $row['user_id']; ?>" method="post">
						<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
						<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
						<table class="listing form" cellpadding="0" cellspacing="0">
							<tr>
								<th class="full" colspan="2">message <?php echo $row['first_name']." ".$row['last_name']?></th>
							</tr>
							<tr>
								<td class="full" width="172"><textarea name="mess_teach" rows="8" cols="100%" ></textarea></br><input type='submit' value='send' name='not_teach' /></td>
							</tr>
						</table>
					</form>
				<p>&nbsp;</p>
				<?php
					if(isset($_REQUEST['not_teach'])){
						$mess_teach = $_REQUEST['mess_teach'];
						$us_le = $row['user_id'];
						$insert = "INSERT INTO messages (ID, name, email, message, user_level, app_date) VALUES ('', 'ADMIN', '$user_name', '$mess_teach','$us_le', NOW())";
						mysql_query($insert);
						if(mysql_affected_rows()==1){
							echo "<script type='text/javascript'>";
							echo 'alert("Your message has been sent.\nThank You.");';
							echo 'document.location = "index.php?pg=03&teach_id='.$_REQUEST['teach_id'].'";';
							echo "</script>";
							}
						else{
							echo "<script type='text/javascript'>";
							echo 'document.location = "index.php?pg=03&teach_id='.$_REQUEST['teach_id'].'";';
							echo "</script>";
						}
					}
				}
				?>
				</div>
				
		<?php
		
			}
		}
		else{
			if(isset($_REQUEST['teach'])){
				if($_REQUEST['teach']==0){
					echo "<h2>You did not select a teacher</h2>";
					echo "<a href='index.php?pg=03'>Cancel</a>";
				}
			}
		}
		?>
	
</div>