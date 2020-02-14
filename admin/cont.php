<div id="left-column">
	<h3>Menu</h3>
	<ul class="nav">
		<li><a href="index.php?pg=05&y=01">Front Carousel</a></li>
		<li><a href="index.php?pg=05&y=02">Online Exam</a></li>
		<li><a href="index.php?pg=05&y=03">Email Message</a></li>
	</ul>
</div>
<div id="center-column">
	<?php
	if(isset($_REQUEST['y'])){
		switch($_REQUEST['y']){
			case '01'://carousel
				echo "<div class='top-bar'>";
				echo "	<h1>Front Image Carousel</h1>";
				echo "</div>";
				echo "<h5>Instructions:</br>1.To add a new picture click choose file, choose a file(only .jpg files) then click upload.</br>2.To delete a picture/s, check the checkbox beside the file name and click delete3.The carousel on the front of the page is shuffled each time the page is refreshed, the order seen here does not affect the order in the carousel.</h5>";
				
				if(isset($_REQUEST['new_photo'])){
					if ($_FILES["file"]["type"] == "image/jpeg"){
						if ($_FILES["file"]["error"] > 0)
							echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
						else{
							if(move_uploaded_file($_FILES["file"]["tmp_name"], "../teachers/" .$_FILES["file"]["name"])){
								echo "<h4>Successfully Uploaded</br>Saved as: " . $_FILES["file"]["name"] . "</h4>";
							}
							else
								echo "<h4>Not Uploaded</h4>";
						}
					}
					else
						echo "<p class='error'>Wrong format</br>Please choose only .jpg file formats.</p>";
				}
				
				if(isset($_REQUEST['del'])){
					if(isset($_REQUEST['delete'])){
						$lim = count($_REQUEST['delete']);
						$items = "";
						for($a=0; $a<$lim; $a++){
							if($a==($lim-1))
								$items .= $_REQUEST['delete'][$a];
							else
								$items .= $_REQUEST['delete'][$a] .",";
						}
						echo "<h4>Are you sure you want to delete these items?</h4>";
						for($a=0; $a<count($_REQUEST['delete']); $a++)
							echo $_REQUEST['delete'][$a]."</br>";
						echo "</br><a href='index.php?pg=05&y=01&items=$lim&todel=$items')'>Delete</a>";
						echo "</br><a href='index.php?pg=05&y=01')'>Cancel</a></br>";
					}
					else
						echo "<p class='error'>You did not select anything to delete.</p>";
				}
				if(isset($_REQUEST['items']) && isset($_REQUEST['todel'])){
					$pic = array();
					$lim = $_REQUEST['items'];
					$str = $_REQUEST['todel'];
					$cut_start = 0;
					$cut_stop = 0;
					for($a=0;$a<$lim;$a++){
						for($b=$cut_start;$b<strlen($str);$b++){
							if($a==$lim-1){
								array_push($pic, substr($str, $cut_start, strlen($str)));
								$b=strlen($str);
							}
							else{
								if($str{$b}==','){
									$cut_stop = $b;
									array_push($pic, substr($str, $cut_start, ($cut_stop-$cut_start)));
									$b=strlen($str);
								}
							}
						}
						$cut_start = $cut_stop+1;
					}
					//print_r($pic);
					for($a=0;$a<count($pic);$a++){
						unlink("../teachers/".$pic{$a});
						echo "<script type='text/javascript'>";
						echo 'alert("File/s Deleted");';
						echo 'document.location = "index.php?pg=05&y=01";';
						echo "</script>";
					}
				}
				
				echo "<div class='table'>";
					echo "<img src='img/bg-th-left.gif' width='8' height='7' alt='' class='left' />";
					echo "<img src='img/bg-th-right.gif' width='7' height='7' alt='' class='right' />";
					echo "<table class='listing' cellpadding='0' cellspacing='0'>";
						echo "<form method='post' action='' enctype='multipart/form-data'>";
						echo "<tr>";
							echo "<th class='full' colspan='2'>Add New Photo</th>";
						echo "</tr>";
							echo "<td class='full'><fieldset><input type='file' name='file' id='file' /></fieldset><input type='submit' name='new_photo' value='Upload' /><input type='submit' name='del' value='Delete' /><a href='index.php?pg=05&y=01'><input type=button value='Cancel'></a></td>";
						echo "<tr><td class='full'>";
							$dir = "../teachers";
							$ind = 0;
							echo "<table>";
							if (is_dir($dir)) {
								if ($dh = opendir($dir)) {
									while (($file = readdir($dh)) !== false) {
										if($ind==0)
											echo "<tr>";
										if(filetype("../teachers/$file")=="file" && $file!='Thumbs.db' && $file!='blank.jpg'){
											echo "<td style='border: 1px solid; margin: 5px; padding: 5px;'><input name='delete[]' value='$file' type='checkbox' />$file</br>";
											echo "<a href='../teachers/".$file."' target='_blank'><img src='../teachers/".$file."' width='100' height='100'/></a></td>";
											$ind++;
										}
										if($ind==5){
											echo "</tr>";
											$ind = 0;
										}
									}
									closedir($dh);
								}
							}
							echo "</table>";
							echo "</td></tr>";
						echo "</form>";
					echo "</table>";
				echo "</div>";
								
				break;
			case '02'://online exam
				echo "<div class='top-bar'>";
				echo "	<h1>Online Examination</h1>";
				echo "</div>";
				echo "<h5>Edit, Add and Delete questions and answers to the online examination</h5>";
				break;
			case '03'://email message
				echo "<div class='top-bar'>";
				echo "	<h1>Email Message</h1>";
				echo "</div>";
				echo "<h5>Customize the message that the applicants will recieve</h5>";
				break;
		}
	}
	else{
		echo "<div class='top-bar'>";
		echo "	<h1>Welcome to the Website Customization Area</h1>";
		echo "</div>";
		echo "<h4>Please use the menu on the left to navigate through this section.</h4>";
	}
	?>
</div>