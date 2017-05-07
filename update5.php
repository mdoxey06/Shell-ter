<?php

	require_once("buildPage.php");

	session_start();

	
	if(isset($_POST["yesPool"])) {
		$pool = 1;
	} else {
		$pool = 0;
	}

	$_SESSION['pool']=$pool;


	$topPart = <<<EOBODY
	<form action="update6.php" method="post">
        <div class="outer-div" id="fifthSlide">
            <div class="inner-div">
                <p>Do you own a pet?</p>
                <input type="submit" name="pet" value="Yes">
                <input type="submit" name="noPet" value="No">
            </div>
        </div>
	</form>	

EOBODY;
	$body = $topPart;
	$title = "SignUp5";
	$page = generatePage($body,$title);

	echo $page;

?>