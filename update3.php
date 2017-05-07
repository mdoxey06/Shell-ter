<?php

	require_once("buildPage.php");

	session_start();

	if(isset($_POST["price"])) {
		$price = $_POST["price"];
	}

	$_SESSION['price']=$price;


	$topPart = <<<EOBODY
	<form action="update4.php" method="post">
        <div class="outer-div" id="thirdSlide">
            <div class="inner-div">
            	<p>Where do you want to live?</p>
                    <input type="submit" name="xfinity" value="Xfinity Side">
                    <input type="submit" name="south" value="South Campus Side">
            </div>
        </div>
	</form>	

EOBODY;
	$body = $topPart;
	$title = "SignUp3";
	$page = generatePage($body,$title);

	echo $page;

?>