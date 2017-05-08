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
        <div class="outer-div" id="updateSlide">
           	<div class="inner-div">
				<p>Do you want to live on or off campus?</p>
		        <input type="radio" name="location" value="On Campus" onclick="location.href = 'http://reslife.umd.edu/';"> On Campus<br>
		        <input type="radio" name="location" value="Off Campus"> Off Campus 
				<br>
				<hr noshade>
				<br>
				<p>What are your price preferences?</p>
				<span id="range">$600</span>
                    <input type="range" name="price" id="points" value="700" min="700" max="1800" onchange="showValue(this.value)" />
                         <script type="text/javascript">
                            function showValue(newValue) {
                            	document.getElementById("range").innerHTML="$"+newValue;
                            }
                        </script>
				<br>
				<hr noshade>
				<p>Where do you want to live?</p>
                    <input type="radio" name="spec" value="xfinity Side">Xfinity<br>
                    <input type="radio" name="spec" value="southCampus">South Campus
				<br>
				<hr noshade>
				 <p>Do you want a pool?</p>
                <input type="radio" name="pool" value="1">Yes<br>
                <input type="radio" name="pool" value="0">No
				<br>
				<hr noshade>
				 <p>Do you own a pet?</p>
                <input type="radio" name="pet" value="1">Yes<br>
                <input type="radio" name="pet" value="0">No
				<br>
				<hr noshade>
				<p>Do you care about having an in-unit gym?</p>
                <input type="radio" name="gym" value="1"> Yes<br>
                <input type="radio" name="gym" value="0"> No
				<br>
				<hr noshade>
				<input type="submit" name="Update" value="Update">
            </div>
        </div>
	</form>	

EOBODY;
	$body = $topPart;
	$title = "Update Preferences";
	$page = generatePage($body,$title);

	echo $page;

?>