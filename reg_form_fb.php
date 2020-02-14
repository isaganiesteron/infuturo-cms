<>
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
			var valid = true;
			var nam_pat = /^([A-Z]{1})([a-z]+)$/; //regexps
			var age_pat = /^([0-9]{1,2})$/;
			var mob_pat = /^([0-9]{1,11})$/;
			var bday_pat = /^([1]{1}[0-2]{1})|^([0]{1}[1-9]{1})-([0-2]{1}[0-9]{1})|([3]{1}[0-1]{1})-([6-9]{1}[0-9]{1})$/;
			var add_pat = /^[ .,A-Za-z0-9]+$/;
			var email_pat = /^([_a-zA-Z0-9-]+)@([a-zA-Z0-9-]+)[.]([a-z]{2,3}$)/;
			var land_pat = /^([0-9]{1,11})$/;


			if (!nam_pat.test(frm.element_1.value)){
				document.getElementById('element_1').innerHTML = "Last Name Invalid"
				valid = false;
			}
			else{
				document.getElementById('element_1').innerHTML = ""
				valid = true;
			}
			if (!nam_pat.test(frm.element_2.value)){
				document.getElementById('element_2').innerHTML = "First Name Invalid"
				valid = false;
			}
			else{
				document.getElementById('element_2').innerHTML = ""
				valid = true;
			}
			if (!nam_pat.test(frm.element_3.value)){
				document.getElementById('element_3').innerHTML = "Middle Name Invalid"
				valid = false;
			}
			else{
				document.getElementById('element_3').innerHTML = ""
				valid = true;
			}
				
			if (!age_pat.test(frm.element_4.value)){
				document.getElementById('element_4').innerHTML = "Age Invalid"
				valid = false;
			}
			else{
				document.getElementById('element_4').innerHTML = ""
				valid = true;
			}
			if (!bday_pat.test(frm.element_6.value)){
				document.getElementById('element_6').innerHTML = "Birthday Invalid."
				valid = false;
			}
			else{
				document.getElementById('element_6').innerHTML = ""
				valid = true;
			}
			if (!mob_pat.test(frm.element_5.value)){
				document.getElementById('element_5').innerHTML = "Mobile Number Invalid."
				valid = false;
			}
			else{
				document.getElementById('element_5').innerHTML = ""
				valid = true;
			}
			if (!land_pat.test(frm.element_9.value)){
				document.getElementById('element_9').innerHTML = "Land Line Invalid."
				valid = false;
			}
			else{
				document.getElementById('element_9').innerHTML = ""
				valid = true;
			}
			if (!email_pat.test(frm.element_8.value)){
				document.getElementById('element_8').innerHTML = "Email address Invalid."
				valid = false;
			}
			else{
				document.getElementById('element_8').innerHTML = ""
				valid = true;
			}
			if (!add_pat.test(frm.element_7.value)){
				document.getElementById('element_7').innerHTML = "Home Address Invalid"
				valid = false;
			}
			else{
				document.getElementById('element_7').innerHTML = ""
				valid = true;
			}
			
			if(valid)
				document.reg.submit()
		}
		//-->
	</SCRIPT>
</head>

<body>

	<div id="container_fb">
		<div id="headerPan">
			<img src="images/slogan.jpg" alt="" name="logo" width="381" height="30" id="slogan" />
		</div>
		<div id="contentPan">
			<h1>InFuturo Inc. Registration Form</h1>
			<p align="center"><span>All fields marked with * are required.</span></p>
				<table cellpadding="5">
					<form name="reg" method="post" action="reg.php">
						<tr>
							<td align="right"><label class="description" for="element_1">Last Name* </label></td>
							<td><input name="element_1" class="element text small" type="text" maxlength="255" /><span id="element_1"></span></td>
						</tr>

						<tr>
							<td align="right"><label class="description" for="element_2">First Name* </label></td>
							<td><input name="element_2" class="element text small" type="text" maxlength="255" /><span id="element_2"></span></td>
						</tr>
					 
						<tr>
							<td align="right"><label class="description" for="element_3">Middle Name* </label></br>
							<td><input name="element_3" class="element text medium" type="text" maxlength="255" /><span id="element_3"></span></br>
						</tr>
						<tr>
						<td align="right"><label class="description" for="element_12">Gender* </label></td>
						<td>
							<select class="element select small" id="element_12" name="element_12"> 
								<option value="1">Male</option>
								<option value="2">Female</option>
							</select></td>
						<tr>
							
						<tr>
							<td align="right"><label class="description" for="element_14">Civil Status* </label></td>
							<td>
							<select class="element select small" id="element_14" name="element_14"> 
								<option value="1">Single</option>
								<option value="2">Married</option>
								<option value="3">Widowed</option>
								<option value="4">Separated</option>
							</select></td>
						</tr> 
							
						<tr>
							<td align="right"><label class="description" for="element_4">Age* </label>
							<p class="guidelines" id="guide_4"><small>(years)</small></p></td>
							<td><input name="element_4" class="element text small" type="text" maxlength="255" ><span id="element_4"></span></td>
						</tr>
							
						</tr>
							<td align="right"><label class="description" for="element_6">Birthday* </label>
							<p class="guidelines" id="guide_6"><small>(mm-dd-yy)</small></p>
							<td><input name="element_6" class="element text small" type="text" maxlength="255" /> <span id="element_6"></span></td>
						</tr>
						<tr>
							<td align="right"><label class="description" for="element_5">Mobile Number* </label>
							<p class="guidelines" id="guide_5"><small>Format :(0xxxxxxxxxx) / Example: (09171234567)</small></p></td>
							<td><input name="element_5" class="element text small" type="text" maxlength="255" /> <span id="element_5"></span></td>	
						</tr>
						<tr>
							<td align="right"><label class="description" for="element_9">Land Line* </label>
							<p class="guidelines" id="guide_9"><small>Format : (Area Code + Telephone Number) / Example: (4441234)</small></p></td>	
							<td><input name="element_9" class="element text small" type="text" maxlength="255" /> 	<span id="element_9"></span></td>			
						</tr>
						<tr>
							<td align="right"><label class="description" for="element_8">Email Address* </label>
							<p class="guidelines" id="guide_8"><small>Example: (someone@website.com)</small></p></td>
							<td><input name="element_8" class="element text small" type="text" maxlength="255" /> <span id="element_8"></span></td>		
						</tr>
						<tr>
							<td align="right"><label class="description" for="element_7">Your Home Address* </label></td>
							<td><textarea name="element_7" class="element text large" type="text" maxlength="255" rows="10" cols="25"></textarea> <span id="element_7"></span></td>
						</tr>
						<tr>
							<td align="right"><label class="description" for="element_10">Name of school attended </label></td>
							<td><input id="element_10" name="element_10" class="element text medium" type="text" maxlength="255" "/> </td>
						</tr>
						<tr>
							<td align="right"><label class="description" for="element_15">Please state your educational attainment </label></td>
							<td>
								<select class="element select medium" id="element_15" name="element_15"> 
									<option value="1" selected >College Graduate</option>
									<option value="2" >Vocational or Diploma Degree holder</option>
									<option value="3" >Undergraduate (incoming 3rd year and up)</option>
									<option value="4" >Undergraduate (less than 2 years)</option>
									<option value="5" >Post Graduate or Master's Degree student</option>
									<option value="6" >Post Graduate or Master's Degree holder</option>
									<option value="7" >Doctorate Degree student</option>
									<option value="8" >Doctorate Degree holder</option>
									<option value="9" >High School Graduate</option>
								</select></td>
						</tr>
						<tr>
							<td align="right"><label class="description" for="element_17">Have you been employed by Infuturo Inc or Blue and Beyond before? </label></td>
							<td><select class="element select small" id="element_17" name="element_17"> 
								<option value="1" selected >Yes</option>
								<option value="2">No</option>
								</select></td>
						</tr>
						<tr>
							<td align="right"><label class="description" for="element_18">Do you have call center / BPO work experience? </label></td>
							<td>
								<select class="element select small" id="element_18" name="element_18"> 
									<option value="1" selected>Yes</option>
									<option value="2">No</option>
								</select></td>
						</tr>
						<tr>
							<td align="right"><label class="description" for="element_16">Please state your professional work experience </label></td>
							<td>
								<select class="element select medium" id="element_16" name="element_16"> 
									<option value="1" selected>Fresh Graduate / no prior work experience</option>
									<option value="2" >less than 1 year work experience</option>
									<option value="3" >1-2 years work experience</option>
									<option value="4" >2-4 years work experience</option>
									<option value="5" >6-10 years work experience</option>
									<option value="6" >10+ years work experience</option>
								</select></td>
						</tr>
						<tr>
							<td align="right"><label class="description" for="element_19">Have You Ever Been Convicted of any Crime, Felony, or Misdemeanor? </label></td>
							<td>
								<select class="element select small" id="element_19" name="element_19"> 
									<option value="1" >Yes</option>
									<option value="2" >No</option>
								</select></td>
						</tr>
						<tr>
							<td align="right"><label class="description" for="element_20">Are you available for immediate employment? </label></td>
							<td>
								<select class="element select small" id="element_20" name="element_20"> 
									<option >Yes</option>
									<option >No</option>
								</select></td>
						</tr>
						<tr>
							<td align="right"><label class="description" for="element_21">Position you would like to apply for </label></td>
							<td>
								<input id="element_21_1" name="element_21" class="element radio" type="radio" value="1" checked />Online Teacher</br>
								<input id="element_21_2" name="element_21" class="element radio" type="radio" value="2" />IT</br>
								<input id="element_21_3" name="element_21" class="element radio" type="radio" value="3" />Admin</br>
								<input id="element_21_4" name="element_21" class="element radio" type="radio" value="4" />other</br>
								</td>
						</tr>
						<tr>
							<td align="right"><label class="description" for="element_22">If you answered "no" to the previous question, how soon can you start work if hired? 	</label></td>
							<td>
								<input id="element_22_1" name="element_22" class="element radio" type="radio" value="1" checked />within 1 month</br>
								<input id="element_22_2" name="element_22" class="element radio" type="radio" value="2" />after 1 or 2 months</br>
								<input id="element_22_3" name="element_22" class="element radio" type="radio" value="3" />after 2-6 months</br>
								<input id="element_22_4" name="element_22" class="element radio" type="radio" value="4" />other</br>
							</td>
						</tr>
						<tr>
							<td align="right"><label class="description" for="element_11">Please enter your comments or suggestions </label>
								<p class="guidelines" id="guide_11"><small>(optional)</small></p> </br></td>
							<td><textarea id="element_11" name="element_11" class="element text large" maxlength="255" rows="10" cols="25" value=""	></textarea></br></td>
						</tr>
						<tr>	
							<td></td>
							<td>
								<input type="button" onclick="checkValid(this.form)" value="Apply" />
							</td>
					</form>
				</table>
			<div class="clear" style="height:15px"></div>
		</div>
		
		<div id="footerPan">
			<p><span>Copyright &copy; InFuturo Inc. Designed by Isagani Esteron</span></p>
		</div>

	</div>

</body>
</html>
