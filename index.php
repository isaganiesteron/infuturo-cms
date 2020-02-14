<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="shortcut icon" href="favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Infuturo Inc</title>
	<link href="css/styles.css" rel="stylesheet" type="text/css" />
	

	<SCRIPT Language="JavaScript">
		<!--//
		function checkValid(frm){
			var nam_pat = /^([A-Z]{1})([a-z]+)([ ]{1})([A-Z]{1})([a-z]+)$/;
			var add_pat = /^([._a-zA-Z0-9-]+)@([a-zA-Z0-9-]+)[.]([a-z]{2,3}$)/;

			if (nam_pat.test(frm.nam.value) && add_pat.test(frm.add.value) && frm.mess.value!="")
				document.send.submit()
			else{
				if (!nam_pat.test(frm.nam.value))
					document.getElementById('na').innerHTML = "First and last name are required. example(John Doe)"
				else
					document.getElementById('na').innerHTML = ""
				if (!add_pat.test(frm.add.value))
					document.getElementById('ad').innerHTML = "Invalid email. example(yourname@email.com)"
				else
					document.getElementById('ad').innerHTML = ""
				if(frm.mess.value=="")
					document.getElementById('me').innerHTML = "You don't have a message."
				else
					document.getElementById('me').innerHTML = ""
			}
		}
		
		function LogIn(frm){
			var add_pat = /^([._a-zA-Z0-9-]+)@([a-zA-Z0-9-]+)[.]([a-z]{2,3}$)/;
			
			if (add_pat.test(frm.user.value) && (frm.pwd.value) )
				document.login.submit()
			else{
				if (!add_pat.test(frm.user.value))
					document.getElementById('us').innerHTML = "Invalid Username"
				else
					document.getElementById('us').innerHTML = ""
				if (frm.pwd.value=="")
					document.getElementById('pw').innerHTML = "Password empty"
				else
					document.getElementById('pw').innerHTML = ""
			}
		}
		//-->
	</SCRIPT>	
	<script language="javascript">
		/*
		function checkValid(frm){
			if('/^([A-Z]{1})([a-z]+)([ ]{1})([A-Z]{1})([a-z]+)$/'.test(frm.nam.value))
				alert("valid name");
			if('/^([._a-zA-Z0-9-]+)@([a-zA-Z0-9-]+)[.]([a-z]{2,3}$)/'.test(frm.add.value))
				alert("valid name");
			if(REGEXP.test(frm.mess.value))!="")
			else{
				document.send.submit();
			alert(frm.name.value);
			}			
		}*/
	</script>
	
	<!--
	  jQuery library
	-->
	<script type="text/javascript" src="carousel/jquery-1.4.2.min.js"></script>
	<!--
	  jCarousel library
	-->
	<script type="text/javascript" src="carousel/jquery.jcarousel.min.js"></script>
	<!--
	  jCarousel skin stylesheet
	-->
	<link rel="stylesheet" type="text/css" href="carousel/skin.css" />
	
	<script type="text/javascript">

	function mycarousel_initCallback(carousel)
	{
		// Disable autoscrolling if the user clicks the prev or next button.
		carousel.buttonNext.bind('click', function() {
			carousel.startAuto(0);
		});

		carousel.buttonPrev.bind('click', function() {
			carousel.startAuto(0);
		});

		// Pause autoscrolling if the user moves with the cursor over the clip.
		carousel.clip.hover(function() {
			carousel.stopAuto();
		}, function() {
			carousel.startAuto();
		});
	};

	jQuery(document).ready(function() {
		jQuery('#mycarousel').jcarousel({
			auto: 2,
			wrap: 'last',
			initCallback: mycarousel_initCallback
		});
	});
	</script>


</head>

<body>

	<div id="container">

	<div id="topPan">
		
		<p><a href="index.php">HOME</a> | <a href="reg_form.php">APPLY</a> | <a href="admin/login.php" target="_blank">ADMIN</a></p>
		
	</div>
	
	<div id="headerPan">

		<img src="images/slogan.jpg" alt="" name="logo" width="381" height="30" id="slogan" />

	</div>
	<div id="gallery">	
	  <ul id="mycarousel" class="jcarousel-skin-tango">
		  <?php
			$counter = 0;
			if (is_dir("teachers")) {
				if ($dh = opendir("teachers")) {
					$pic = array();
					while (($file = readdir($dh)) !== false) {				
						if(filetype("teachers/$file")=="file" && $file!='Thumbs.db' && $file!='blank.jpg'){
							array_push($pic, "$file");
						}
					}
					closedir($dh);
				}
			}
			shuffle($pic);
			for($a=0;$a<(count($pic));$a++)
				echo "<li><a href='teachers/$pic[$a]'><img src='teachers/$pic[$a]' width='150' height='150'  target='_blank' /></a></li>";
		  ?>
		  
	  </ul>
	</div>
	<div id="contentPan">
		<div id="c1">
		
		<div id="welcome">
		<h2></h2>
		<p>
			<ol>
				<li>To provide top quality online English education to second language learners of all ages, professions, nationalities, and walks of life in the Southeast Asian region.</li>
				<li>To provide an alternative, more convenient, and more affordable mode of English proficiency instruction while maintaining the highest levels of excellence.</li>
				<li>To provide the Asian and international job markets with excellent English speaking professionals from the Southeast Asian region.</li>
			</ol>
		</p>

		</div>

		<div id="featured">
		<h2></h2>

		<!--<img src="images/img_featured.jpg" width="183" height="72" alt="" />-->

		<p>
			To be among the most dominant, professional, and proficient ONLINE ENGLISH CONSULTANCY COMPANY in the country catering to South Korean nationals and other second language learners in Southeast Asia.
		</p>
		</div>

		<div class="clear" style="height:10px"></div>

		<div id="solutions">
		<a href="reg_form.php" ><h1><img src="images/apply.gif" width="150px"></h1></a>
		
		<p>You are just one click away from being the next InFuturo online teacher.</p>

		</div>

		</div>
		<div id="c2">
			<div id="news">
				<h2></h2>
				<form name="login" method="post" action="login2.php">
					<p>Username:</p><span id="us"></span>
					<input type="text" name="user">
					<p>Password:</p><span id="pw"></span>
					<input type="password" name="pwd">
					<input type="hidden" name="submitted" value="submitted">
					<input type="button" value="Login" onclick="LogIn(this.form)">
				</form>
			</div>

			<div id="energy">
				<h2></h2>
				<form name="send" method="post" action="contact.php">
					<p>Name:</p><span id="na"></span>
					<input id="nam" type="text" name="nam" value="">
					<p>E-mail Address:</p><span id="ad"></span>
					<input id="add" type="text" name="add" value="">
					<p>Message:</p><span id="me"></span>
					<textarea id="mess" name="mess" rows="8" cols="20" ></textarea>
					<input type="button" value="Send" onclick="checkValid(this.form)">
				</form>				

			</div>

		</div>
		<div class="clear" style="height:15px"></div>

	</div>
	<div id="footerPan">
	  <p><span>Copyright &copy; InFuturo Inc. Designed by Isagani Esteron</span></p>
	</div>

	</div>

</body>
</html>
