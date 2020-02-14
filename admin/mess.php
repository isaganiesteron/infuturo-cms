<div id="left-column">
<h3>Order By</h3>
	<ul class="nav">
		<li><a href="index.php?pg=02&y=01">Incoming Messages</a></li>
		<li class="last"><a href="index.php?pg=02&y=02">Messages for Teachers / Request Forms</a></li>
	</ul>
</div>
<?php
	if(!isset($_REQUEST['y'])){
		$filter = "WHERE user_level=''";
		$area = "&y=01";
	}
	else{
		if($_REQUEST['y']==1){
			$filter = "WHERE user_level=''";
			$area = "&y=01";
		}
		else{
			$filter = "WHERE user_level!='' AND email!='Teacher'";
			$area = "&y=02";
		}
	}
?>
<div id="center-column">
	<div class="top-bar">
		<!--a href="#" class="button">ADD NEW </a-->	
		<h1>Messages</h1>
	</div>
	
	<div class="table">
		<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
		<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
		<table class="listing" cellpadding="0" cellspacing="0">
			<tr>
				<?php
				if($area == "&y=02"){
					echo "<th class='first' width='100'>Sender</th>";
					echo "<th width='200'>Message</th>";
					echo "<th>Recipient</th>";
					echo "<th>Date and Time</th>";
					echo "<th class='last' width='20'>Delete</th>";
				}
				else{
				echo "<th class='first' width='100'>Name</th>";
				echo "<th width='200'>Message</th>";
				echo "<th>E-mail</th>";
				echo "<th>Date and Time</th>";
				echo "<th width='20'>Reply</th>";
				echo "<th class='last' width='20'>Delete</th>";
				}				
				?>
			</tr>
			
			<?php
				$select_query = "SELECT * FROM messages ".$filter." ORDER by app_date DESC";
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
					echo "<td class='first style1'>".$row['name']."</td>";
					echo "<td>".$row['message']."</td>";
					echo "<td>".$row['email']."</td>";
					echo "<td>".$row['app_date']."</td>";
					if($area != "&y=02"){
						echo "<td>";
							echo "<a href='index.php?pg=02".$area."&rep=".$row['ID']."'><img src='img/add-icon.gif' width='16' height='16' alt='edit' /></a>";
						echo "</td>";
					}
					echo "<td  class='last'><a href='index.php?pg=02".$area."&de=".$row['ID']."'><img src='img/hr.gif' width='16' height='16' alt='edit' /></a></td>";
					echo "</tr>";
					
					if(isset($_REQUEST['de'])){ //delete users
						if($_REQUEST['de']==$row['ID']){
							echo "<form method='post' action=''>";
								echo "<tr>";
								if($area != "&y=02"){
									echo "<td colspan='4'><span class='error'>Are you sure you want to delete this message?</span></td>";
									echo "<td colspan='2'class='last'><input type='submit' value='Delete' name='delete'><a href='index.php?pg=02".$area."'>Cancel</a></td>";
								}
								else{
									echo "<td colspan='3'><span class='error'>Are you sure you want to delete this message?</span></td>";
									echo "<td colspan='2'class='last'><input type='submit' value='Delete' name='delete'></br><a href='index.php?pg=02".$area."'>Cancel</a></td>";
								}
								
								echo "</tr>";
							echo "</form>";
							
							if(isset($_REQUEST['delete'])){
								$del = "DELETE from messages where ID='".$row['ID']."'";
								mysql_query($del);
								
								if(mysql_affected_rows($dbc) == 1){
									echo "<script type='text/javascript'>";
									echo 'alert("Message deleted");';
									echo 'document.location = "index.php?pg=02'.$area.'";';
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
					
					if(isset($_REQUEST['rep'])){ //reply to users
						if($_REQUEST['rep']==$row['ID']){
							echo "<form method='post' action=''>";
								echo "<tr>";
								echo "<td colspan='4'><span id='temp'><textarea name='reply_mess' rows='6' cols='90%' ></textarea></span></td>";
								echo "<td colspan='2'class='last'><input type='submit' value='Send' name='Send'><a align='left' href='index.php?pg=02".$area."'>Cancel</a></td>";
								echo "</tr>";
							echo "</form>";
							
							if(isset($_REQUEST['Send'])){
								$body = "Thank you for replying.\n\n".$_REQUEST['reply_mess'];
								$body .= "\n\n--------------------------------\n\n"; 
								$body .= "From: ".$row['name']."(".$row['email'].")\n\nMessage:\n".$row['message'];

								$e_add = $row['email'];
								
								//echo $body." ".$e_add;
								mail($e_add, 'Reply to your Message', $body, 'From: InFuturo Inc.');

								echo "<script type='text/javascript'>";
								echo 'alert("An email has been sent to '.$e_add.'");';
								echo 'document.location = "index.php?pg=02'.$area.'";';
								echo "</script>";
							}
						}
					}
				}
			?>
		</table>
	</div><br />
</div>