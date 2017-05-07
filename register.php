<?php

	require_once("buildPage.php");

	$topPart = <<<EOBODY
	<form action="register.php" method="post">
		<div class="outer-div" id="registerSlide">
		   <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
		      <div class="panel panel-info panel-primary panel-transparent" >
		         <div class="panel-heading">
		            <div class="panel-title">Sign Up</div>
		         </div>
		         <div style="padding-top:30px" class="panel-body" >
		            <form id="loginform" class="form-horizontal" role="form">
		               <div style="margin-bottom: 25px" class="input-group">
		                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		                  <input id="email" type="text" class="form-control" name="email" placeholder="johnsmith@gmail.com" required="required">                                        
		               </div>
		               <div style="margin-bottom: 1em" class="input-group">
		                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
		                  <input id="password" type="password" class="form-control" name="password" placeholder="password" required="required">
		               </div>
		               <div>
		               		<input type="submit" name="continue" id="continue" value="Continue to Preferences">
		               </div>
		            </form>
		         </div>
		      </div>
		   </div>
		</div>
	</form>	

EOBODY;
	$body = $topPart;
	$title = "SignUp1";
	$page = generatePage($body,$title);

	echo $page;

?>