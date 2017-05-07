<?php

	require_once("buildPage.php");

	session_start();

	if(isset($_POST["email"])) {
		$email = $_POST["email"];
	}

	if(isset($_POST["password"])) {
		$password = $_POST["password"];
	}

	$_SESSION['currUser']=$email;
	$_SESSION['password']=$password;

	$topPart = <<<EOBODY
	<form action="preference2.php" method="post">
		<div class="outer-div" id="firstSlide">
		    <div class="inner-div">
		    	<p>Do you want to live on or off campus?</p>
		        <input type="button" name="onCampus" value="On Campus" onclick="location.href = 'http://reslife.umd.edu/';">
		        <input type="submit" name="offCampus" value="Off Campus">
		    </div>
		</div>
	</form>	

EOBODY;
	$body = $topPart;
	$title = "SignUp1";
	$page = generatePage($body,$title);

	echo $page;

?>