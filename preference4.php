<?php

	require_once("buildPage.php");

	session_start();

	
	if(isset($_POST["south"])) {
		$location = "southCampus";
	} else {
		$location = "xfinity";
	}

	$_SESSION['location']=$location;


	$topPart = <<<EOBODY
	<form action="preference5.php" method="post">
        <div class="outer-div" id="fourthSlide">
            <div class="inner-div">
                <p>Do you want a pool?</p>
                <input type="submit" name="yesPool" value="Yes">
                <input type="submit" name="noPool" value="No">
        	</div>
        </div>
	</form>	

EOBODY;
	$body = $topPart;
	$title = "SignUp4";
	$page = generatePage($body,$title);

	echo $page;

?>