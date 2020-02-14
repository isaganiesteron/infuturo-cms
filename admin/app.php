<div id="left-column">
	<h3>Order By</h3>
	<ul class="nav">
		<li><a href="index.php?pg=01">All</a></li>
		<?php
		echo "<li class='last'><a href=''>Date of </a>
				<select name='forma' ONCHANGE='location = this.options[this.selectedIndex].value;'>
					<option value=''>..</option>
					<option value='index.php?pg=01&y=01'>Jan</option>
					<option value='index.php?pg=01&y=02'>Feb</option>
					<option value='index.php?pg=01&y=03'>Mar</option>
					<option value='index.php?pg=01&y=04'>Apr</option>
					<option value='index.php?pg=01&y=05'>May</option>
					<option value='index.php?pg=01&y=06'>Jun</option>
					<option value='index.php?pg=01&y=07'>Jul</option>
					<option value='index.php?pg=01&y=08'>Aug</option>
					<option value='index.php?pg=01&y=09'>Sep</option>
					<option value='index.php?pg=01&y=10'>Oct</option>
					<option value='index.php?pg=01&y=11'>Nov</option>
					<option value='index.php?pg=01&y=12'>Dec</option>
				</select></li>";
		?>
	</ul>
</div>
<?php
	if(!isset($_REQUEST['y'])){
		$nav = "";
		$order = "ORDER BY app_date DESC";
		$mon_dis = "All Applicants";
	}	
	else{
		$order = "WHERE app_date LIKE '%-".$_REQUEST['y']."-%' ORDER BY app_date DESC ";
		switch($_REQUEST['y']){
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
?>
<div id="center-column">
	<div class="top-bar">
		<!--a href="#" class="button">ADD NEW </a-->	
		<h1><?php if(isset($_REQUEST['y'])) echo "Applicants of ".$mon_dis; else echo "All Applications";?></h1>
	</div>

	<div class="table">
		<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
		<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
		<table class="listing" cellpadding="0" cellspacing="0">
			<tr>
				<th class="first" width="100">Name</th>
				<th width="60">Date</th>
				<th>Age/Sex</th>
				<th>Contact</th>
				<th>E-mail</th>
				<th>Exam Score</th>
				<th class="last">Del</th>
			</tr>
			
			<?php
				$select_query = "SELECT * FROM applicants ".$order;
				$result = mysql_query($select_query);
				$bg = true;
				if(mysql_affected_rows()>0){
					while($row = (mysql_fetch_array($result))){
						if($bg){
							$bg = false;
							echo "<tr class='bg'>";
						}
						else{
							$bg = true;
							echo "<tr>";
						}
						
						echo "<td class='first style1'><a href='app_info.php?x=".$row['ID']."' target='_blank'>".$row['fname']." ".$row['lname']."</a><a NAME=".$row['ID']."></a></td>";
						
							switch(substr($row['app_date'],5,2)){
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

						echo "<td>".$mon_dis." ".substr($row['app_date'],8,2)."</br>Time: ".substr($row['app_date'],11,5)."</td>";
							//echo substr("2012-04-10 07:12:51",6,5);
						echo "<td>".$row['age'];
						if($row['gen']==1)
							echo " / M</td>";
						else
							echo " / F</td>";
						echo "<td>Mobile: ".$row['mobi']."</br>LandLine: ".$row['land']."</td>";
						echo "<td>".$row['e_add']."</td>";
						
						$ans_I = "ABCACBABBCBDCDBACBCCCCBDCCCACBAACBCAACCABABBABAABB";	//Answer key
						$ans_II = "DEABCBABBCCCCBDCAAEFHJIEBAACCB";
						$sc_I=0;
						$sc_II=0;
						
						if($row['exam_key']==NULL){
							for($a=0; $a<50; $a++){
								if($row['A']{$a}==$ans_I{$a})
									$sc_I++;
							}
							for($a=0; $a<30; $a++){
								if($row['B']{$a}==$ans_II{$a})
									$sc_II++;
							}
							echo "<td><a href='exam_result.php?x=".$row['ID']."' target='_blank'>".$sc_I."/50 ".$sc_II."/30</a></td>";
						}
						else{
							echo "<td><a href='resend.php?x=".$row['ID']."' target='_blank'>Didn't take exam yet.</a></td>";
						}
						echo "<td  class='last'><a href='index.php?pg=01&de=".$row['ID']."#".$row['ID']."'><img src='img/hr.gif' width='16' height='16' alt='edit' /></a></td>";
						echo "</tr>";
						
						if(isset($_REQUEST['de'])){  //delete users
							if($_REQUEST['de']==$row['ID']){
								echo "<form method='post' action=''>";
									echo "<tr>";
									echo "<td colspan='5'><span class='error'><strong>Are you sure you want to delete the application of ".$row['fname']." ".$row['lname']."?</strong></span></td>";
									echo "<td colspan='2' class='last'><input type='submit' value='Delete' name='delete'><a href='index.php?pg=01$nav'>Cancel</a></td>";
									echo "</tr>";
								echo "</form>";
								
								if(isset($_REQUEST['delete'])){
									$del = "DELETE from applicants where ID='".$row['ID']."'";
									mysql_query($del);
									
									if(mysql_affected_rows($dbc) == 1){
										echo "<script type='text/javascript'>";
										echo 'alert("Application Delete");';
										echo 'document.location = "index.php?pg=01";';
										echo "</script>";
									}
									else{
										echo "<script type='text/javascript'>";
										echo 'alert("Application not deleted");';
										echo "</script>";
									} 
								}
							}
						}
					}
				}
				else
					echo "<tr><td class='last' colspan='7'>No Records Found</td></tr>";
					
			?>
		</table>
	</div><br />
</div>