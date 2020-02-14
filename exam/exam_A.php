<?php

	session_start();
	require_once ('../includes/sql_connect.php');
	
	if(isset($_SESSION['exam_start']) && isset($_SESSION['exam_start'])){
		$q = "SELECT * FROM applicants WHERE (e_add='" . mysql_real_escape_string($_SESSION['exam_start']) . "' AND exam_key='" . mysql_real_escape_string($_SESSION['exam_start2']) . "')";
		mysql_query($q);
		
		if (mysql_affected_rows() != 1) {
			header("Location: ../index.html");
		}
	}
	else{
		session_destroy(); 
		header("Location: ../index.html");
	}
	
	if (!isset($_SESSION['endOfTimer'])){ 	//if the session variable is not set then it sets it here, 
		$endOfTimer = time() + 75*60; 		//uses the time() function plus the time limit
		$_SESSION['endOfTimer'] = $endOfTimer; 	//puts it in a php variable
	} 

	if(($_SESSION['endOfTimer'] - time()) < 0) { 	//introdudes time till end timer
		  $timeTilEnd = 0; 
	} 
	else { 
		  $timeTilEnd = $_SESSION['endOfTimer'] - time(); 	//
	} 

	if($timeTilEnd <= 0) {
		session_destroy(); 
	} 
	
?>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=7" />
	<title>Infuturo EXAM A</title>
	<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
	<div class="timer">
	<h1>
	<u>Time</u></br>
	<span id="hour"></span>:<span id="minutes"></span>.<span id="seconds"></span>
	<script type="text/javascript"> 
		var TimeLeft = <?php echo $timeTilEnd; ?>; 
		var seconds = 0;
		var minutes = 0;
		var hour = 0;
			function countdown(){
			if(TimeLeft > 0){
				TimeLeft -= 1;
				seconds = TimeLeft % 60;
				minutes = Math.floor(TimeLeft / 60) % 60;
				hour = Math.floor(Math.floor(TimeLeft / 60) / 60);
				
				if(seconds<10)
					seconds = "0" + seconds;
				if(minutes<10)
					minutes = "0" + minutes;
				if(hour<10)
					hour = "0" + hour;
				
				document.getElementById('hour').innerHTML = hour;
				document.getElementById('minutes').innerHTML = minutes;
				document.getElementById('seconds').innerHTML = seconds;


			} 
				if(TimeLeft < 1){
					document.myform.submit()	//if the user doesn't press submit, the answers will still be recorded.
				} 
			} 
				CountFunc = setInterval(countdown,1000); 
	</script>
	</h1>
	</div>
	<div class="main">
		<div class="header">
			<table width="100%" height="100%">
				<tr>
					<td width="70%"><h1>Infuturo, Inc.</h1></td>
					<td width="30%"><h2>EXAM A</h2></td>
				</tr>
			</table>
		</div>
		<div class="admin">
			<form name="myform" action="process.php" method="post">
				<h3>PART I. GRAMMAR (Choose the best answer from the choices below.)</h3>
				
				<h4><u>PHRASAL VERBS</u></h4>
				
				<label>1. The river's current is very strong. It will be hard to ________. </label></br>
				<input type="radio" name="A#1" value="A" /><label>get across</label></br>
				<input type="radio" name="A#1" value="B"/><label>get in</label></br>
				<input type="radio" name="A#1" value="C" /><label>get around</label></br>

				</br>
				<label>2. You really need a car in this city to ________. </label></br>
				<input type="radio" name="A#2" value="A" /><label>get by</label></br>
				<input type="radio" name="A#2" value="B"/><label>get around</label></br>
				<input type="radio" name="A#2" value="C" /><label>get in</label></br>

				</br>				
				<label>3. She had a hard time after the break-up, but then she decided to ________ with her life. </label></br>
				<input type="radio" name="A#3" value="A" /><label>get along</label></br>
				<input type="radio" name="A#3" value="B"/><label>get in</label></br>
				<input type="radio" name="A#3" value="C" /><label>get on</label></br>

				</br>				
				<label>4. My girlfriend's mother and I don't ________ at all. </label></br>
				<input type="radio" name="A#4" value="A" /><label>get along</label></br>
				<input type="radio" name="A#4" value="B"/><label>get on</label></br>
				<input type="radio" name="A#4" value="C" /><label>get in</label></br>

				</br>				
				<label>5. Its Okay. Don't worry. You'll ________ this. </label></br>
				<input type="radio" name="A#5" value="A" /><label>get along</label></br>
				<input type="radio" name="A#5" value="B"/><label>get on</label></br>
				<input type="radio" name="A#5" value="C" /><label>get through</label></br>

				</br>
				<label>6. The museum? You should ________ at the third stop. </label></br>
				<input type="radio" name="A#6" value="A" /><label>get through</label></br>
				<input type="radio" name="A#6" value="B"/><label>get off</label></br>
				<input type="radio" name="A#6" value="C" /><label>get on</label></br>

				</br>
				<label>7. As soon as he ________ the horse, I knew that he had never been on one before. </label></br>
				<input type="radio" name="A#7" value="A" /><label>got on</label></br>
				<input type="radio" name="A#7" value="B"/><label>got around</label></br>
				<input type="radio" name="A#7" value="C" /><label>got in</label></br>

				</br>				
				<label>8. I ________ my old couch and need to buy a new one. </label></br>
				<input type="radio" name="A#8" value="A" /><label>got rid</label></br>
				<input type="radio" name="A#8" value="B"/><label>got rid of</label></br>
				<input type="radio" name="A#8" value="C" /><label>got off </label></br>

				</br>				
				<label>9. I'm really tired because I ________ at 5 AM this morning.  </label></br>
				<input type="radio" name="A#9" value="A" /><label>got around</label></br>
				<input type="radio" name="A#9" value="B"/><label>got up</label></br>
				<input type="radio" name="A#9" value="C" /><label>got on</label></br>

				</br>				
				<label>10. Friends can help you to ________ a difficult time in your life.  </label></br>
				<input type="radio" name="A#10" value="A" /><label>get around</label></br>
				<input type="radio" name="A#10" value="B"/><label>get by</label></br>
				<input type="radio" name="A#10" value="C" /><label>get through</label></br>

				</br>	
				<h4><u>VOCABULARY/EXPRESSIONS</u></h4>

				<label>1.	“We should all start going in on lottery tickets and agree to split the winnings.  If we win, we will be __________ for life and will never have to go to work again,” Phil told his three friends at work. </label></br>
				<input type="radio" name="B#1" value="A" /><label>vacation</label></br>
				<input type="radio" name="B#1" value="B"/><label>set</label></br>
				<input type="radio" name="B#1" value="C" /><label>rented</label></br>
				<input type="radio" name="B#1" value="D" /><label>adjusted</label></br>

				</br>
				<label>2.	“Professor Jackson, am I going to pass this class?”  Jenny asked during office hours.  He replied, “What are you talking about?  You are __________.  You have an A in this class.”</label></br>
				<input type="radio" name="B#2" value="A" /><label>silver</label></br>
				<input type="radio" name="B#2" value="B"/><label>copper</label></br>
				<input type="radio" name="B#2" value="C" /><label>lead</label></br>
				<input type="radio" name="B#2" value="D" /><label>golden</label></br>

				</br>				
				<label>3.	“Well, you promised to give me 50 hours of hard work instead of paying me the money you owe me and you have been as __________ as your word.  Consider the debt paid,” Mr. Wilson said to Craig.</label></br>
				<input type="radio" name="B#3" value="A" /><label>burnt</label></br>
				<input type="radio" name="B#3" value="B"/><label>young</label></br>
				<input type="radio" name="B#3" value="C" /><label>good</label></br>
				<input type="radio" name="B#3" value="D" /><label>predictable</label></br>

				</br>				
				<label>4.	“I am very impressed with Louie Chang.  He has only been in the United States for two years and already, he has a good __________ of the English language.  I think he actually knows more words than me!”  Elliot said to his two friends. </label></br>
				<input type="radio" name="B#4" value="A" /><label>order</label></br>
				<input type="radio" name="B#4" value="B"/><label>box</label></br>
				<input type="radio" name="B#4" value="C" /><label>directions</label></br>
				<input type="radio" name="B#4" value="D" /><label>command</label></br>

				</br>				
				<label>5.	“I should be mad at Luke for selling me this car – considering that it broke down a week after I bought it.  But, I am not.  I know that he knows next to nothing about cars and he acted in __________ faith when he told me that he thought it was in good working condition.  I believe that he believed there was nothing wrong with it,” Tommy told his dad. </label></br>
				<input type="radio" name="B#5" value="A" /><label>bad</label></br>
				<input type="radio" name="B#5" value="B"/><label>good</label></br>
				<input type="radio" name="B#5" value="C" /><label>horrible</label></br>
				<input type="radio" name="B#5" value="D" /><label>positive</label></br>

				</br>
				<label>6.	He was very happy with the dog he had rescued from the pound.  She was easy to train and was very good __________.  She didn’t bark at people and was very nice to little kids. </label></br>
				<input type="radio" name="B#6" value="A" /><label>natured</label></br>
				<input type="radio" name="B#6" value="B"/><label>character</label></br>
				<input type="radio" name="B#6" value="C" /><label>soul</label></br>
				<input type="radio" name="B#6" value="D" /><label>smart</label></br>

				</br>
				<label>7.	“I like your new boyfriend.  He has a good __________ on his shoulders.  He thinks about the future, is smart, and believes in hard work,” Ronald told his daughter.</label></br>
				<input type="radio" name="B#7" value="A" /><label>hair</label></br>
				<input type="radio" name="B#7" value="B"/><label>weight</label></br>
				<input type="radio" name="B#7" value="C" /><label>head</label></br>
				<input type="radio" name="B#7" value="D" /><label>eye</label></br>

				</br>				
				<label>8.	"I am trying to decide how much to sell my bicycle for. I know that a good __________people will want it since gas prices have gone up so much," Jim said to his roommate.</label></br>
				<input type="radio" name="B#8" value="A" /><label>group</label></br>
				<input type="radio" name="B#8" value="B"/><label>many</label></br>
				<input type="radio" name="B#8" value="C" /><label>house</label></br>
				<input type="radio" name="B#8" value="D" /><label>sort</label></br>

				</br>				
				<label>9.	"I am kind of glad that our TV broke. It is good __________, if you ask me. It never worked right and it was quite ugly looking," Jane said to her husband.</label></br>
				<input type="radio" name="B#9" value="A" /><label>avoidance</label></br>
				<input type="radio" name="B#9" value="B"/><label>sample</label></br>
				<input type="radio" name="B#9" value="C" /><label>riddance</label></br>
				<input type="radio" name="B#9" value="D" /><label>dump</label></br>

				</br>				
				<label>10.	"That good-for-__________ neighbor of ours is outside. He wants to know if he can borrow your saw and drill," Lisa said to her husband.</label></br>
				<input type="radio" name="B#10" value="A" /><label>anything</label></br>
				<input type="radio" name="B#10" value="B"/><label>negative</label></br>
				<input type="radio" name="B#10" value="C" /><label>nothing</label></br>
				<input type="radio" name="B#10" value="D" /><label>noting</label></br>
				</br>	
				
				<h4><u>MULTIPLE CHOICE</u></h4>
				
				<label>1. Almost everyone fails _________ the road on the first try.</label></br>
				<input type="radio" name="C#1" value="A" /><label>passing</label></br>
				<input type="radio" name="C#1" value="B"/><label>to have passed</label></br>
				<input type="radio" name="C#1" value="C" /><label>to pass</label></br>
				<input type="radio" name="C#1" value="D" /><label>in passing</label></br>

				</br>
				<label>2. Abner had hoped _________ his letter.</label></br>
				<input type="radio" name="C#2" value="A" /><label>her to answer</label></br>
				<input type="radio" name="C#2" value="B"/><label>that she answer</label></br>
				<input type="radio" name="C#2" value="C" /><label>that she would answer</label></br>
				<input type="radio" name="C#2" value="D" /><label>her answering</label></br>

				</br>				
				<label>3. I think that you had better _________ earlier so that you can be on time.</label></br>
				<input type="radio" name="C#3" value="A" /><label>to start to get up</label></br>
				<input type="radio" name="C#3" value="B"/><label>start getting up</label></br>
				<input type="radio" name="C#3" value="C" /><label>started getting up</label></br>
				<input type="radio" name="C#3" value="D" /><label>to get up</label></br>

				</br>				
				<label>4. Today’s exercise isn't as difficult as the one we did yesterday,________?</label></br>
				<input type="radio" name="C#4" value="A" /><label>wasn't it?</label></br>
				<input type="radio" name="C#4" value="B"/><label>was it</label></br>
				<input type="radio" name="C#4" value="C" /><label>isn't it</label></br>
				<input type="radio" name="C#4" value="D" /><label>is it</label></br>

				</br>				
				<label>5. I’ve been in Calgary for a long time. I __________ 12 years ago.</label></br>
				<input type="radio" name="C#5" value="A" /><label>have come</label></br>
				<input type="radio" name="C#5" value="B"/><label>was coming</label></br>
				<input type="radio" name="C#5" value="C" /><label>came</label></br>
				<input type="radio" name="C#5" value="D" /><label>had come</label></br>

				</br>
				<label>6. The police ________ the robber.</label></br>
				<input type="radio" name="C#6" value="A" /><label>to catch</label></br>
				<input type="radio" name="C#6" value="B"/><label>catching</label></br>
				<input type="radio" name="C#6" value="C" /><label>caught</label></br>
				<input type="radio" name="C#6" value="D" /><label>were caught</label></br>

				</br>			
				<label>7. Roberto has been in Canada __________ 1989.</label></br>
				<input type="radio" name="C#7" value="A" /><label>after</label></br>
				<input type="radio" name="C#7" value="B"/><label>until</label></br>
				<input type="radio" name="C#7" value="C" /><label>since</label></br>
				<input type="radio" name="C#7" value="D" /><label>for</label></br>

				</br>				
				<label>8. When I arrived, there wasn't ____________ in the classroom.</label></br>
				<input type="radio" name="C#8" value="A" /><label>anybody</label></br>
				<input type="radio" name="C#8" value="B"/><label>somebody</label></br>
				<input type="radio" name="C#8" value="C" /><label>body</label></br>
				<input type="radio" name="C#8" value="D" /><label>nobody</label></br>

				</br>				
				<label>9. Ho can't drive a car because he __________ a license.</label></br>
				<input type="radio" name="C#9" value="A" /><label>don't have</label></br>
				<input type="radio" name="C#9" value="B"/><label>hasn't had</label></br>
				<input type="radio" name="C#9" value="C" /><label>doesn't have</label></br>
				<input type="radio" name="C#9" value="D" /><label>didn't have</label></br>

				</br>				
				<label>10. Sara can't talk on the phone now because she _________ dishes.</label></br>
				<input type="radio" name="C#10" value="A" /><label>wash</label></br>
				<input type="radio" name="C#10" value="B"/><label>is washing</label></br>
				<input type="radio" name="C#10" value="C" /><label>was washing</label></br>
				<input type="radio" name="C#10" value="D" /><label>washes</label></br>
				</br>

				<h4><u>COMPARATIVE ADJECTIVES</u></h4>
				
				<label>1. Things are ________ now than they used to be. </label></br>
				<input type="radio" name="D#1" value="A" /><label>BOTH ARE OK</label></br>
				<input type="radio" name="D#1" value="B"/><label>busier</label></br>
				<input type="radio" name="D#1" value="C" /><label>more busy</label></br>

				</br>
				<label>2. He is ________ about this than I am. </label></br>
				<input type="radio" name="D#2" value="A" /><label>more nervous</label></br>
				<input type="radio" name="D#2" value="B"/><label>nervouser</label></br>
				<input type="radio" name="D#2" value="C" /><label>BOTH ARE OK </label></br>

				</br>				
				<label>3. I liked this movie, although I found it a bit ________ than his last film. </label></br>
				<input type="radio" name="D#3" value="A" /><label>duller</label></br>
				<input type="radio" name="D#3" value="B"/><label>more dull</label></br>
				<input type="radio" name="D#3" value="C" /><label>BOTH ARE OK</label></br>

				</br>				
				<label>4. Mary wears her white skirt ________ than (she wears) her blue one. </label></br>
				<input type="radio" name="D#4" value="A" /><label>oftener</label></br>
				<input type="radio" name="D#4" value="B"/><label>more often</label></br>
				<input type="radio" name="D#4" value="C" /><label>BOTH ARE OK</label></br>

				</br>				
				<label>5. This test is ________ than the last one.</label></br>
				<input type="radio" name="D#5" value="A" /><label>simpler</label></br>
				<input type="radio" name="D#5" value="B"/><label>more simple</label></br>
				<input type="radio" name="D#5" value="C" /><label>BOTH ARE OK </label></br>

				</br>
				<label>6. Which one is ________ ? </label></br>
				<input type="radio" name="D#6" value="A" /><label>better</label></br>
				<input type="radio" name="D#6" value="B"/><label>more good</label></br>
				<input type="radio" name="D#6" value="C" /><label>BOTH ARE OK</label></br>

				</br>
				<label>7. This is much ________. </label></br>
				<input type="radio" name="D#7" value="A" /><label>more important</label></br>
				<input type="radio" name="D#7" value="B"/><label>importanter</label></br>
				<input type="radio" name="D#7" value="C" /><label>BOTH ARE OK</label></br>

				</br>				
				<label>8. My brother is ________ than I am. </label></br>
				<input type="radio" name="D#8" value="A" /><label>more wealthy</label></br>
				<input type="radio" name="D#8" value="B"/><label>wealthier</label></br>
				<input type="radio" name="D#8" value="C" /><label>BOTH ARE OK</label></br>

				</br>				
				<label>9. This sounds a bit ________. </label></br>
				<input type="radio" name="D#9" value="A" /><label>naturaler</label></br>
				<input type="radio" name="D#9" value="B"/><label> BOTH ARE OK</label></br>
				<input type="radio" name="D#9" value="C" /><label>more natural </label></br>

				</br>				
				<label>10. This trip was ________ than the last one. </label></br>
				<input type="radio" name="D#10" value="A" /><label>more fun</label></br>
				<input type="radio" name="D#10" value="B"/><label>funner </label></br>
				<input type="radio" name="D#10" value="C" /><label>BOTH ARE OK</label></br>
				</br>

				<h4><u>WORD ORDER</u></h4>
				
				<label>1. Q: Who knows about this? A: _______________ knows about this. It's a secret.</label></br>
				<input type="radio" name="E#1" value="A" /><label>Really no one </label></br>
				<input type="radio" name="E#1" value="B"/><label>No one really</label></br>

				</br>
				<label>2. Q: How many times did you tell him? A: _______________ told him once.</label></br>
				<input type="radio" name="E#2" value="A" /><label>I only</label></br>
				<input type="radio" name="E#2" value="B"/><label>Only I</label></br>

				</br>				
				<label>3. Q: How much do you eat? A: _______________.</label></br>
				<input type="radio" name="E#3" value="A" /><label>A lot I eat.</label></br>
				<input type="radio" name="E#3" value="B"/><label>I eat a lot</label></br>

				</br>				
				<label>4. Q: Are you going to try hard? A: I _______________ to do my best.</label></br>
				<input type="radio" name="E#4" value="A" /><label>try always</label></br>
				<input type="radio" name="E#4" value="B"/><label>always try</label></br>

				</br>				
				<label>5. Q: Did you call me?  A: Yes, I _______________.</label></br>
				<input type="radio" name="E#5" value="A" /><label>called you many times</label></br>
				<input type="radio" name="E#5" value="B"/><label>many times called you</label></br>

				</br>
				<label>6. Q: How many times have you been there? A: I have been _______________ .</label></br>
				<input type="radio" name="E#6" value="A" /><label>twice there  </label></br>
				<input type="radio" name="E#6" value="B"/><label>there twice</label></br>

				</br>
				<label>7. Q: What is your name? A: I'm not going to _______________.</label></br>
				<input type="radio" name="E#7" value="A" /><label>tell you again</label></br>
				<input type="radio" name="E#7" value="B"/><label>again tell you</label></br>

				</br>				
				<label>8. Q: What do you think of Tom? A: I think he's _______________.</label></br>
				<input type="radio" name="E#8" value="A" /><label>a little stupid  </label></br>
				<input type="radio" name="E#8" value="B"/><label>little a stupid</label></br>

				</br>				
				<label>9. Q: Have you ever prepared this dish before?  A: No, I've never tried _______________ before.</label></br>
				<input type="radio" name="E#9" value="A" /><label>this to make </label></br>
				<input type="radio" name="E#9" value="B"/><label>to make this</label></br>

				</br>				
				<label>10. Q: Why did you do that!!!???  A: I'm sorry. I was _______________ to help.</label></br>
				<input type="radio" name="E#10" value="A" /><label>trying only</label></br>
				<input type="radio" name="E#10" value="B"/><label>only trying</label></br>
				</br>
				
				<h3>PART II. READING</h3>
				
				<fieldset>
				<legend><h4>I.  Look at the following information and the list of characteristics below.</h4></legend>
				<h4>Geography</h4>
				
				<p>The northern third of Luxembourg is known as the 'Oesling', and forms part of the Ardennes. It is dominated by hills and low mountains, including the Kneiff, which is the highest point, at 560 metres (1,837 ft). The region is sparsely populated, with only one town (Wiltz) with a population of more than 2,000 people.</p>

				<p>The southern two-thirds of the country is called the 'Gutland', and is more densely populated than the Oesling. It is also more diverse, and can be divided into five geographic sub-regions. The Luxembourg plateau, in south-central Luxembourg, is a large, flat, sandstone formation, and the site of Luxembourg City. Little Switzerland, in the east of Luxembourg, has craggy terrain and thick forests. The Moselle valley is the lowest-lying region, running along the south-eastern border. The Red Lands, in the far south and southwest, are Luxembourg's industrial heartland and home to many of Luxembourg's largest towns.</p>

				<h4>Language</h4>

				<p>The linguistic situation in Luxembourg is characterised by the practice and the recognition of three official languages: French, German, and Luxembourgish, a Franconian language of the Moselle region similar to German. Apart from being one of the three official languages, Luxembourgish is also considered the national language of the Grand Duchy.</p>

				<p>None of the three languages predominates generally, and each is used as the primary language in certain spheres. Luxembourgish is generally preferred for spoken use, but is superseded by both French and German for written purposes. French is the language in which most government business is carried out. German is the language of most media and of the church.</p>

				<p>In addition to the three native languages, English is taught from a young age (mostly 2nd grade, i.e. at the age of 13 to 14 years), and most of the population of Luxembourg is proficient in English. Portuguese and Italian, the languages of the two largest immigrant communities, are also spoken by large parts of the population, but by relatively few from outside their respective communities.</p>
				
				<label>List of Characteristics</label>
				<ul>
					<li>most media</li>
					<li>thick forests</li>
					<li>widely spoken</li>
					<li>northern third</li>
					<li>sandstone formation</li>
				</ul>
				</fieldset>
				
				<h5>Area or Language</h5>
				<label>1. Oesling</label></br></br>
				<input type="radio" name="F#1" value="A" /><label>most media</label></br>
				<input type="radio" name="F#1" value="B"/><label>thick forests</label></br>
				<input type="radio" name="F#1" value="C" /><label>widely spoken</label></br>
				<input type="radio" name="F#1" value="D"/><label>northern third</label></br>
				<input type="radio" name="F#1" value="E"/><label>sandstone formation</label></br></br>
				<label>2. Luxembourg Plateau</label></br></br>
				<input type="radio" name="F#2" value="A" /><label>most media</label></br>
				<input type="radio" name="F#2" value="B"/><label>thick forests</label></br>
				<input type="radio" name="F#2" value="C" /><label>widely spoken</label></br>
				<input type="radio" name="F#2" value="D"/><label>northern third</label></br>
				<input type="radio" name="F#2" value="E"/><label>sandstone formation</label></br></br>
				<label>3. German</label></br></br>
				<input type="radio" name="F#3" value="A" /><label>most media</label></br>
				<input type="radio" name="F#3" value="B"/><label>thick forests</label></br>
				<input type="radio" name="F#3" value="C" /><label>widely spoken</label></br>
				<input type="radio" name="F#3" value="D"/><label>northern third</label></br>
				<input type="radio" name="F#3" value="E"/><label>sandstone formation</label></br></br>
				<label>4. Little Switzerland</label></br></br>
				<input type="radio" name="F#4" value="A" /><label>most media</label></br>
				<input type="radio" name="F#4" value="B"/><label>thick forests</label></br>
				<input type="radio" name="F#4" value="C" /><label>widely spoken</label></br>
				<input type="radio" name="F#4" value="D"/><label>northern third</label></br>
				<input type="radio" name="F#4" value="E"/><label>sandstone formation</label></br></br>
				<label>5. Luxembourgish</label></br></br>
				<input type="radio" name="F#5" value="A" /><label>most media</label></br>
				<input type="radio" name="F#5" value="B"/><label>thick forests</label></br>
				<input type="radio" name="F#5" value="C" /><label>widely spoken</label></br>
				<input type="radio" name="F#5" value="D"/><label>northern third</label></br>
				<input type="radio" name="F#5" value="E"/><label>sandstone formation</label></br></br>
				
				<h4>II.</h4>
				
				<table align="center" width="80%" border="1px solid">
					<tr>
						<td ALIGN=Center>
							<b>A - Language International</b></br>
							Technology Institute</br>
							<i>“where technology meets morphology”</i></br>
							<b>Greek and German</br>
							Summer Courses - 2007</b></br>
							Also on offer:</br>
							Vietnamese Korean English</br>
							Indonesian Spanish Italian</br>
							German Russian Greek</br>
							For further details contact:</br>
							Admissions Office</br>
							10 Holt Street,</br>
							Perth, 23140</br>			
							<b>Tel: 423 5464</br>
							Fax: 423 2313</b></br>
						</td>
						<td ALIGN=Center>
							<b>B - Language Land</br>
							Learning Centres</br></br>
							NOW IN Christchurch!</b></br></br>
							The best is getting bigger!</br></br>
							LEARN A NEW LANGUAGE</br>
							<b>IN AS LITTLE AS 10 WEEKS</b>
							LATEST METHODS</br>
							GUARANTEED RESULTS</br>
							BUSINESS, TRAVEL, ACADEMIC</br>
							<b>Phone for Appointment</br>
							456 832</b></br>
						</td>
					</tr>
				</table>
				
				<h5>Choose the correct letter A -B for items 6-9</h5>
				<label>6. offers intensive courses</label></br>
				<input type="radio" name="F#6" value="A" /><label>A</label></br>
				<input type="radio" name="F#6" value="B"/><label>B</label></br></br>
				<label>7. is located In Perth</label></br>
				<input type="radio" name="F#7" value="A" /><label>A</label></br>
				<input type="radio" name="F#7" value="B"/><label>B</label></br></br>
				<label>8. offers a refund</label></br>
				<input type="radio" name="F#8" value="A" /><label>A</label></br>
				<input type="radio" name="F#8" value="B"/><label>B</label></br></br>
				<label>9. teaches business English</label></br>
				<input type="radio" name="F#9" value="A" /><label>A</label></br>
				<input type="radio" name="F#9" value="B"/><label>B</label></br></br>

				<fieldset>
				<legend><h4>III.	IMPORTANT NOTICE: PRODUCT RECALL</h4></legend>
				<p>General Motors (Vauxhall UK) wishes to inform the public that faulty tyres may have been found on some recent models of their vehicles. The models of the vehicles involved are the 2006 Orion four-door sedan, Orion two-door sport model xtz, and the Riviera two- door coupe. The vehicle numbers involved are 1269453821657 through 1269453821660.</p>
				<p>If you have recently purchased an above model with vehicle numbers in the posted range, please return your vehicle to the nearest dealer. Vauxhall UK will replace all four tyres at no cost to you.</p>
				<p>We are sorry for any inconvenience this may cause our loyal customers and once again we want to thank you for your purchase of our vehicles. We are always striving to win your loyalty and trust.</p>
				<p>Other models have not received the faulty tyres from our supplier and, therefore, have not been affected. Please do not return any models to our dealers other than the ones mentioned above. New tyres will be placed on affected models only.</p>
				<h4 align="center" >HOT LINE</h4>
				<p>General Motors has set-up a 24 hotline to handle inquiries concerning products purchased in the months of November and December 2005. Products purchased after December 2005 have not been affected. For products purchased before November 2005, call the 24 hour hotline for information.</p>
				</fieldset>
				
				</br>
				<label>10.	  How many models have been affected?   </label></br>
				<input type="radio" name="F#10" value="A" /><label>One</label></br>
				<input type="radio" name="F#10" value="B"/><label>Two</label></br>
				<input type="radio" name="F#10" value="C" /><label>Three</label></br></br>

				<label>11.	 Where should you take the vehicle if it qualifies?   </label></br>
				<input type="radio" name="F#11" value="A" /><label>Vauxhall UK</label></br>
				<input type="radio" name="F#11" value="B"/><label></label>Leave it home</br>
				<input type="radio" name="F#11" value="C" /><label>Nearest Dealer</label></br></br>

				<label>12.	 What will Vauxhall replace?   </label></br></br>
				<input type="radio" name="F#12" value="A" /><label>Only the affected tyre</label></br>
				<input type="radio" name="F#12" value="B"/><label></label>Two tyres</br>
				<input type="radio" name="F#12" value="C" /><label>All four tyres</label></br></br>

				<label>13.	 What is Vauxhall continually trying to gain?   </label></br>
				<input type="radio" name="F#13" value="A" /><label>Loyalty</label></br>
				<input type="radio" name="F#13" value="B"/><label>Money</label></br>
				<input type="radio" name="F#13" value="C"/><label>Loyalty and trust</label></br></br>

				<label>14.	 What has General Motors done for products purchased before November 2005?   </label></br></br>
				<input type="radio" name="F#14" value="A" /><label>Replacement of faulty tyres</label></br>
				<input type="radio" name="F#14" value="B"/><label>Established a hotline</label></br>
				<input type="radio" name="F#14" value="C" /><label>Nothing</label></br></br>
				
				<fieldset>
				<legend><h4>IV.</h4></legend>
				<h4>Task One</h4>
				<i>Choose</i> <b>NO MORE THAN TWO WORDS AND/OR NUMBERS</b> <i>from the text for each answer.</i>
				
				<h4 align="center">Australia's Northern Territory</h4>
				
				<p>The Northern Territory makes up nearly one-sixth of Australia and geographically most closely resembles the popular image of the Great Australian Outback. The north or Top End, centred on the capital, Darwin, is tropical with rich vegetation and a varied coastline. 251km east of Darwin is World Heritage-listed Kakadu National Park (the third largest National Park in the world and about half the size of Switzerland), an area of vast flood plains and rocky escarpments steeped in natural and cultural heritage and home to Aborigines for at least 40,000 years. Katherine is 314km south of Darwin and just beyond that is Nitmiluk (Katherine Gorge) National Park, a striking system of 13 gorges towering up to 60 metres high.</p>

				<p>The southern part of the Territory is centred on Alice Springs, which is virtually the centre of Australia and the starting point to explore many of the Red Centre's highlights including Uluru (Ayers Rock), which is located about 465kms to the south-west. Other of the Red Centre's natural and geological wonders include Kata Tjuta (the Olgas), King's Canyon, the Western MacDonnell Ranges and the Devil's Marbles. This part of the Northern Territory features desert-like conditions with cold nights and hot, dry days. Plant life is limited to small shrubs, gum trees and wild grasses.</p>

				<table align="center" width="90%" border="1px solid">
					<tr>
						<td></td>
						<td><b>North</b></td>
						<td><b>South</b></td>
					</tr>
					<tr>
						<td>Centered on</td>
						<td>(15.) <select name="F#15">
									<option value="A">Gum Trees</option>
									<option value="B">Australian Outback</option>
									<option value="C">Alice Springs</option>
									<option value="D">Darwin</option>
									<option value="E">varied coastline</option>
									<option value="F">tropical</option>
									<option value="G">desert-like</option>
									<option value="H">World Heritage</option>
									<option value="I">13 gorges</option>
									<option value="J">Devil's marbles</option>
								</select>
						</td>
						<td>(16.) <select name="F#16">
									<option value="A">Gum Trees</option>
									<option value="B">Australian Outback</option>
									<option value="C">Alice Springs</option>
									<option value="D">Darwin</option>
									<option value="E">varied coastline</option>
									<option value="F">tropical</option>
									<option value="G">desert-like</option>
									<option value="H">World Heritage</option>
									<option value="I">13 gorges</option>
									<option value="J">Devil's marbles</option>
								</select>
						</td>
					</tr>
					<tr>
						<td>Vegetation</td>
						<td>(17.) <select name="F#17">
									<option value="A">Gum Trees</option>
									<option value="B">Australian Outback</option>
									<option value="C">Alice Springs</option>
									<option value="D">Darwin</option>
									<option value="E">varied coastline</option>
									<option value="F">tropical</option>
									<option value="G">desert-like</option>
									<option value="H">World Heritage</option>
									<option value="I">13 gorges</option>
									<option value="J">Devil's marbles</option>
								</select>
						</td>
						<td>grasses, shrubs and (18.) <select name="F#18">
									<option value="A">Gum Trees</option>
									<option value="B">Australian Outback</option>
									<option value="C">Alice Springs</option>
									<option value="D">Darwin</option>
									<option value="E">varied coastline</option>
									<option value="F">tropical</option>
									<option value="G">desert-like</option>
									<option value="H">World Heritage</option>
									<option value="I">13 gorges</option>
									<option value="J">Devil's marbles</option>
								</select>
						</td>
					</tr>
					
					<tr>
						<td>Coastline</td>
						<td>(19.) <select name="F#19">
									<option value="A">Gum Trees</option>
									<option value="B">Australian Outback</option>
									<option value="C">Alice Springs</option>
									<option value="D">Darwin</option>
									<option value="E">varied coastline</option>
									<option value="F">tropical</option>
									<option value="G">desert-like</option>
									<option value="H">World Heritage</option>
									<option value="I">13 gorges</option>
									<option value="J">Devil's marbles</option>
								</select>
						</td>
						<td>N/A </td>
					</tr>
				</table>
				<h4>Task Two (use same text as above)</h4>
				<label>20. Darwin's climate is considered to be <select name="F#20">
									<option value="A">centre of Australia</option>
									<option value="B">Great Australian Outback</option>
									<option value="C">Alice Springs</option>
									<option value="D">vast</option>
									<option value="E">flood plain</option>
									<option value="F">tropical</option>
									<option value="G">desert-like</option>
									<option value="H">third largest</option>
									<option value="I">13 gorges</option>
									<option value="J">starting Point</option>
								</select> .</label></br>
				<label>21. Kakadu National Park is the <select name="F#21">
									<option value="A">centre of Australia</option>
									<option value="B">Great Australian Outback</option>
									<option value="C">Alice Springs</option>
									<option value="D">vast</option>
									<option value="E">flood plain</option>
									<option value="F">tropical</option>
									<option value="G">desert-like</option>
									<option value="H">third largest</option>
									<option value="I">13 gorges</option>
									<option value="J">starting Point</option>
								</select> national park.</label></br>
				<label>22. Alice Springs is the <select name="F#22">
									<option value="A">centre of Australia</option>
									<option value="B">Great Australian Outback</option>
									<option value="C">Alice Springs</option>
									<option value="D">vast</option>
									<option value="E">flood plain</option>
									<option value="F">tropical</option>
									<option value="G">desert-like</option>
									<option value="H">third largest</option>
									<option value="I">13 gorges</option>
									<option value="J">starting Point</option>
								</select> for exploring the Red Centre.</label></br>
				<label>23. Katherine gorge boasts <select name="F#23">
									<option value="A">centre of Australia</option>
									<option value="B">Great Australian Outback</option>
									<option value="C">Alice Springs</option>
									<option value="D">vast</option>
									<option value="E">flood plain</option>
									<option value="F">tropical</option>
									<option value="G">desert-like</option>
									<option value="H">third largest</option>
									<option value="I">13 gorges</option>
									<option value="J">starting Point</option>
								</select> reaching 60 meters in height.</label></br>
				<label>24. Aborigines lived for more than 40,000 years in a <select name="F#24">
									<option value="A">centre of Australia</option>
									<option value="B">Great Australian Outback</option>
									<option value="C">Alice Springs</option>
									<option value="D">vast</option>
									<option value="E">flood plain</option>
									<option value="F">tropical</option>
									<option value="G">desert-like</option>
									<option value="H">third largest</option>
									<option value="I">13 gorges</option>
									<option value="J">starting Point</option>
								</select> plain</label></br>
				</fieldset>	
				<h4>V.	History of Academic Journals</h4>

				<fieldset>
				<p>Among the earliest research journals were the Proceedings of meetings of the Royal Society in the 17th century. At that time, the act of publishing academic inquiry was controversial, and widely ridiculed. It was not at all unusual for a new discovery to be announced as an anagram, reserving priority for the discoverer, but indecipherable for anyone not in on the secret: both Isaac Newton and Leibniz used this approach. However, this method did not work well. Robert K. Merton, a sociologist, found that 92% of cases of simultaneous discovery in the 17th century ended in dispute. The number of disputes dropped to 72% in the 18th century, 59% by the latter half of the 19th century, and 33% by the first half of the 20th century. The decline in contested claims for priority in research discoveries can be credited to the increasing acceptance of the publication of papers in modern academic journals.</p>
				<p>The Royal Society was steadfast in its unpopular belief that science could only move forward through a transparent and open exchange of ideas backed by experimental evidence. Many of the experiments were ones that we would not recognize as scientific today — nor were the questions they answered. For example, when the Duke of Buckingham was admitted as a Fellow of the Royal Society on June 5, 1661, he presented the Society with a vial of powdered "unicorn horn". It was a well-accepted 'fact' that a circle of unicorn's horn would act as an invisible cage for any spider. Robert Hooke, the chief experimenter of the Royal Society, emptied the Duke's vial into a circle on a table and dropped a spider in the centre of the circle. The spider promptly walked out of the circle and off the table. In its day, this was cutting-edge research.</p>
				</fieldset>
				
				<h4><u>Task One:</u> Do the following statements agree with the views of the writer of the text?</h4>
				<label>25.	Publication of Academic Journals was popular in the 17th century</label></br>
				<input type="radio" name="F#25" value="A" /><label>YES</label></br>
				<input type="radio" name="F#25" value="B"/><label>NO</label></br>
				<input type="radio" name="F#25" value="C" /><label>NOT GIVEN</label></br></br>
				<label>26.	Unicorn horn acts as an invisible cage</label></br>
				<input type="radio" name="F#26" value="A" /><label>YES</label></br>
				<input type="radio" name="F#26" value="B"/><label>NO</label></br>
				<input type="radio" name="F#26" value="C" /><label>NOT GIVEN</label></br></br>
				<label>27.	Increased publication of Academic Journals has brought about a decline in simultaneous discovery disputes</label></br>
				<input type="radio" name="F#27" value="A" /><label>YES</label></br>
				<input type="radio" name="F#27" value="B"/><label>NO</label></br>
				<input type="radio" name="F#27" value="C" /><label>NOT GIVEN</label></br></br>
				
				<h4><u>Task Two:</u> Do the following statements agree with the information given in the text above?</h4>
				<label>28.	The Duke of Buckingham was asked to bring the Unicorn horn for the experiment.</label></br>
				<input type="radio" name="F#28" value="A" /><label>YES</label></br>
				<input type="radio" name="F#28" value="B"/><label>NO</label></br>
				<input type="radio" name="F#28" value="C" /><label>NOT GIVEN</label></br></br>
				<label>29.	Anagram announcements were thought of by Isaac Newton</label></br>
				<input type="radio" name="F#29" value="A" /><label>YES</label></br>
				<input type="radio" name="F#29" value="B"/><label>NO</label></br>
				<input type="radio" name="F#29" value="C" /><label>NOT GIVEN</label></br></br>
				<label>30.	Anagram announcements ensured everyone would know who discovered what</label></br>
				<input type="radio" name="F#30" value="A" /><label>YES</label></br>
				<input type="radio" name="F#30" value="B"/><label>NO</label></br>
				<input type="radio" name="F#30" value="C" /><label>NOT GIVEN</label></br></br>
								
				<h3>PART III: WRITING (Please answer the questions in the format being asked.)</h3>
				<h4>Criteria for scoring:</br>
				Content: 25%</br>
				Context: 25%</br>
				Choice of words: 20%</br>
				Grammar: 30%</h4></br>

				<label>1.) This is part of a letter you receive from your friend:</br></br>
				In your next letter, please tell me about the music you like. </br>
				What’s your favorite kind of music? Do you play an instrument?</br></br>

				Now write a short letter, answering your friend’s questions.</label></br></br>
				<textarea name="G#1" rows="10" cols="80"></textarea></br></br>
				<label>2.) Would you prefer to choose a job you enjoy with a low salary, or a job that you do not enjoy that pays you a lot of money? Give specific reasons and examples to support you answer. Answer in an essay format.</label></br></br>
				<textarea name="G#2"rows="10" cols="80"></textarea></br></br>
				</br>
				<label align="center"><input class="submit" type="submit" name="finish" /></label>
			</form>
		</div>
		<div class="footer">
			<label>2012-2013 Infuturo, Inc</label></br>
			<h2>EXAM A</h2>
		</div>
	</div>
</body>
</html>