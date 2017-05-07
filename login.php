<?php
	require_once("support.php");
	require_once("dbLogin.php");

	$bottomPart = "";
	if (isset($_POST["login"])) {
		$emailValue = trim($_POST["email"]);
		$passwordValue = trim($_POST["password"]);
		$db_connection = new mysqli($host, $user, $password, $database);

			//Making sure database successfully connected
		if ($db_connection->connect_error) {
			die($db_connection->connect_error);
		}

		$query = sprintf("select * from user where email= '%s'", $emailValue);
		$result = $db_connection->query($query);

		if (!$result) {
				die("Retrieval failed: ". $db_connection->error);
		}
		else {
			$num_rows = $result->num_rows;
				if ($num_rows === 0) {
					$bottomPart .= "<script>document.getElementById(\"modalText\").innerHTML= \"Email doesn't exist in database.\";";
					$bottomPart .= "$('#myModal').modal('show'); </script>";
				}
			else {
				$result->data_seek(0);
				$row = $result->fetch_array(MYSQLI_ASSOC);
				session_start();

				$passwordDatabase= $row["password"];

				//If password is correctly 
				if (password_verify($passwordValue, $passwordDatabase)) {
					$_SESSION["currUser"]= $row["email"];
					header("Location: recommendations.php");
				}
				else {
					$bottomPart .= "<script>document.getElementById(\"modalText\").innerHTML= \"Wrong Password.\";";
					$bottomPart .= "$('#myModal').modal('show'); </script>";
				}
			}
		}

		/* Freeing memory */
		$result->close();

		/* Closing connection */
		$db_connection->close();
	}

		$topPart = <<<EOBODY
		  <div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <div class="modal-content">
		      <div class="modal-header" style= "background-color: #CD5C5C">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Warning</h4>
		      </div>
		      <div class="modal-body" style= "background-color: #F0F8FF">
		        <p id= "modalText">Some text in the modal.</p>
		      </div>
		      <div class="modal-footer" style= "background-color: #F0F8FF">
		        <button type="button" class="btn btn-primary" data-dismiss="modal" >OK</button>
		      </div>
		    </div>

		  </div>
		</div>
	    
		<div class="container">
		   <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
		      <div class="panel panel-info panel-primary panel-transparent" >
		         <div class="panel-heading">
		            <div class="panel-title">Sign In</div>
		         </div>
		         <div style="padding-top:30px" class="panel-body" >
		            <form id="loginform" action= "login.php" method= "post" class="form-horizontal" role="form">
		               <div style="margin-bottom: 25px" class="input-group">
		                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		                  <input id="email" type="text" class="form-control" name="email" placeholder="johnsmith@gmail.com">
		               </div>

		               <div style="margin-bottom: 1em" class="input-group">
		                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
		                  <input id="password" type="password" class="form-control" name="password" placeholder="Password">
		               </div>
		               <br>
		               <div style="margin-top:.1px" class="form-group">
		                  <div class="col-sm-12 controls">
		                     <input type= "submit" id= "login" name= "login" value= "Login" class="btn btn-success">
		                  </div>
		               </div>

		               <div class="form-group">
		                  <div class="col-md-12 control">
		                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
		                        Don't have an account?
		                        <a href="signup.html">
		                        Register
		                        </a>
		                     </div>
		                  </div>
		               </div>
		            </form>
		         </div>
		      </div>
		   </div>
		</div>
EOBODY;
	
	$body = $topPart.$bottomPart;	
	$page = generatePage($body);
	echo $page;
?>