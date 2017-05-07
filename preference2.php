<?php

	require_once("buildPage.php");

	$topPart = <<<EOBODY
	<form action="preference3.php" method="post">
		<div class="outer-div" id="secondSlide">
            <div class="inner-div">
                <span id="range">$600</span>
                    <input type="range" name="price" id="points" value="700" min="700" max="1800" onchange="showValue(this.value)" />
                         <script type="text/javascript">
                            function showValue(newValue) {
                            	document.getElementById("range").innerHTML="$"+newValue;
                            }
                        </script>
                    <input type="submit" name="next" value="Next" >
            </div>
        </div>
	</form>	

EOBODY;
	$body = $topPart;
	$title = "SignUp2";
	$page = generatePage($body,$title);

	echo $page;

?>