<?php

	require_once("buildPage.php");

	session_start();

	
	if(isset($_POST["yesPet"])) {
		$pets = 1;
	} else {
		$pets = 0;
	}

	$_SESSION['pets']=$pets;


	$topPart = <<<EOBODY
	<form action="updated.php" method="post">
        <div class="outer-div" id="sixthSlide">
           	<div class="inner-div">
                <p>Do you care about having an in-unit gym?</p>
                <input type="submit" name="yesGym" value="Yes">
                <input type="submit" name="noGym" value="No">
            </div>
        </div>
	</form>	

EOBODY;
	$body = $topPart;
	$title = "SignUp6";
	$page = generatePage($body,$title);

	echo $page;

?>