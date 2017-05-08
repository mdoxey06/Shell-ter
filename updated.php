<?php
	require_once("buildPage.php");

    session_start();
	
	

	$host = "localhost";
	$user = "shell";
	$password = "terps";
	$database = "shellterp";
    $table = "user";
	$db_connection = new mysqli($host, $user, $password, $database);
	if ($db_connection->connect_error) {
		die($db_connection->connect_error);
	}

	$location = $_POST['spec'];
	$price = $_POST['price'];
	$pool = $_POST['pool'];
	$pets = $_POST['pet'];
	$gym = $_POST['gym'];
    $email = $_SESSION['currUser'];
	$query = sprintf("UPDATE $table SET location='%s',price='%s',pool=%s,pets=%s,gym=%s WHERE email='%s'", $location,$price,$pool,$pets,$gym,$email); 


	$result = $db_connection->query($query);
	if (!$result) {
		die("Updating failed: ".$db_connection->error);
	} else {
		$db_connection->close();
		header( "refresh:5;url=recommendations.php" );
	}
				
	$topPart = <<<EOBODY
        <div class="outer-div" id="calculatingSlide">
            <div class="inner-div">
                <h2>Updating...</h2>
            </div>
        </div>
EOBODY;
	$body = $topPart;
	$title = "Update Preferences";
	$page = generatePage($body,$title);

	echo $page;
?>