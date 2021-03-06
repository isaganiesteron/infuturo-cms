<?php
	require_once ('../includes/sql_connect.php');
	
	$q = "SELECT * FROM applicants WHERE ID='".$_REQUEST['x']."';";
	$result = mysql_query($q);
		
	while($row = (mysql_fetch_array($result))){
		$lname = $row['lname'];
		$fname = $row['fname'];
		$mname = $row['mname'];
		
		$age = $row['age'];
		$mobi = $row['mobi'];
		$bday = $row['bday'];
		
		$h_add = $row['h_add'];
		$e_add = $row['e_add'];
		$land = $row['land'];
		
		$school = $row['school'];
		
		$comment = $row['comment'];
		
		$gen = $row['gen'];
		
		$stat = $row['stat'];
		
		$avail = $row['avail'];
		switch($row['educ']){
			case '1';
				$educ = 'College Graduate';
				break;
			case '2';
				$educ = 'Vocational or Diploma Degree holder';
				break;
			case '3';
				$educ = 'Undergraduate (incoming 3rd year and up)';
				break;
			case '4';
				$educ = 'Undergraduate (less than 2 years)';
				break;
			case '5';
				$educ = 'Post Graduate or Masters Degree student';
				break;
			case '6';
				$educ = 'Post Graduate or Masters Degree holder';
				break;
			case '7';
				$educ = 'Doctorate Degree student';
				break;
			case '8';
				$educ = 'Doctorate Degree holder';
				break;
			case '9';
				$educ = 'High School Graduate';
				break;
		}
		
		switch($row['pas_exp']){
			case '1';
				$pas_exp = 'Yes';
				break;
			case '2';
				$pas_exp = 'No';
				break;
		}
		
		switch($row['exp']){
			case '1';
				$exp = 'Fresh Graduate / no prior work experience';
				break;
			case '2';
				$exp = 'less than 1 year work experience';
				break;
			case '3';
				$exp = '1-2 years work experience';
				break;
			case '4';
				$exp = '2-4 years work experience';
				break;
			case '5';
				$exp = '6-10 years work experience';
				break;
			case '6';
				$exp = '10+ years work experience';
				break;
		}

		switch($row['prev_emp']){
			case '1';
				$prev_emp = 'Yes';
				break;
			case '2';
				$prev_emp = 'No';
				break;
		}

		switch($row['crime']){
			case '1';
				$crime = 'Yes';
				break;
			case '2';
				$crime = 'No';
				break;
		}
		
		switch($row['gen']){
			case '1';
				$ged = 'Male';
				break;
			case '2';
				$gen = 'Female';
				break;
		}

		switch($row['stat']){
			case '1';
				$stat = 'Single';
				break;
			case '2';
				$stat = 'Married';
				break;
			case '3';
				$stat = 'Widowed';
				break;
			case '4';
				$stat = 'Separated';
				break;
		}

		switch($row['pos']){
			case '1';
				$pos = 'Online Teacher';
				break;
			case '2';
				$pos = 'IT';
				break;
			case '3';
				$pos = 'Administration';
				break;
			case '4';
				$pos = 'Other';
				break;
		}
		
		if($avail == 'No'){
			switch($row['soon']){
				case '1';
					$soon = 'within 1 month';
					break;
				case '2';
					$soon = 'after 1 or 2 months';
					break;
				case '3';
					$soon = 'after 2-6 months';
					break;
				case '4';
					$soon = 'other';
					break;
			}
		}
		else
			$soon = 'N/A';

		$res_I = $row['A'];
		$res_II = $row['B'];
		$G1 =$row['C'];
		$G2 =$row['D'];
		
		if($row['exam_key']!=NULL)
			$vis = "hidden";
		else
			$vis = "";
	}
	$sc_I = 0;
	$sc_II = 0;
	$ans_I = "ABCACBABBCBDCDBACBCCCCBDCCCACBAACBCAACCABABBABAABB";	//Answer key
	$ans_II = "DEABCBABBCCCCBDCAAEFHJIEBAACCB";
	

	header("Content-type: application/x-msdownload"); 
	header("Content-Disposition: attachment; filename=".$lname."_".$fname."_ExamResult.xls"); 
	header("Pragma: no-cache"); 
	header("Expires: 0"); 
	//print "$header\n$data";


?>
<html>
	<body>
		<table text align="top" style="visibility:<?php echo $vis;?>";>
			<tr>
				<td align="top">
					<table border="1px solid">
						<tr>
							<th>
								Part I
							</th>
							<th>
								Answered
							</th>
							<th>
								Result
							</th>
						</tr>
						<?php
							for($a=0; $a<50; $a++){
								echo "<tr>";
									echo "<td>";
									echo $a+1;
									echo "</td>";
									echo "<td>";
									echo $res_I{$a};
									echo "</td>";
									echo "<td>";
										if($res_I{$a}!=$ans_I{$a}){
											$sc_I++;
											echo "wrong";
										}
										else
											echo "correct";
									echo "</td>";
								echo "</tr>";
							}
						?>
						<tr>
							<td>
							</td>
							<td>
								<b>Score</b>
							</td>
							<td>
							<?php
								echo $sc_I = (50-$sc_I)."/50";
							?>
							</td>
						</tr>
					</table>
				</td>
				<td align="right">
					<table border="1px solid">
						<tr>
							<th>
								Part II
							</th>
							<th>
								Answered
							</th>
							<th>
								Result
							</th>
						</tr>
						<?php
							for($a=0; $a<30; $a++){
								echo "<tr>";
									echo "<td>";
									echo $a+1;
									echo "</td>";
									echo "<td>";
									echo $res_II{$a};
									echo "</td>";
									echo "<td>";
										if($res_II{$a}!=$ans_II{$a}){
											$sc_II++;
											echo "wrong";
										}
										else
											echo "correct";
									echo "</td>";
								echo "</tr>";
							}
						?>
						<tr>
							<td>
							</td>
							<td>
								<b>Score</b>
							</td>
							<td>
							<?php
								echo $sc_II = (30 - $sc_II)."/30";
							?>
							</td>
						</tr>
					</table>
				</td>
				<td>
					<fieldset>
					<legend>Part 1</legend>
						<?php
							echo $G1;
						?>
					</fieldset>
				</td>
				<td>
					<fieldset>
					<legend>Part 2</legend>
						<?php
							echo $G2;
						?>
					</fieldset>
				</td>
			</tr>
		</table>
	</body>
</html>