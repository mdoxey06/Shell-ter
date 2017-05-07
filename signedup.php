<?php
	require_once("buildPage.php");

    session_start();

	$host = "localhost";
	$user = "dbuser";
	$password = "hi";
	$database = "shellterp";

	$db_connection = new mysqli($host, $user, $password, $database);
	if ($db_connection->connect_error) {
		die($db_connection->connect_error);
	}

    $price = $_SESSION['price'];
    $location = $_SESSION['location'];
    $pool = $_SESSION['pool'];
    $pets = $_SESSION['pets'];
    
    if(isset($_POST["yesGym"])) {
        $gym = 1;
    } else {
        $gym = 0;
    }

    $email = $_SESSION['email'];
    $password = $_SESSION['password'];

	$query = sprintf("insert into user(email, password, location, price, pool, pets, gym) values ('%s', '%s', '%s', '%s', %s, %s, %s)", 
	$email, $password, $location, $price, $pool, $pets, $gym);

	$result = $db_connection->query($query);
	if (!$result) {
		die("Insertion failed: ".$db_connection->error);
	} 
				
	$db_connection->close();
	
	$topPart = <<<EOBODY
        <div class="outer-div" id="calculatingSlide">
            <div class="inner-div">
                <h2>Calulating Results...</h2>
            </div>
        </div>
EOBODY;
	$body = $topPart;
	$title = "SignUp";
	$page = generatePage($body,$title);

	echo $page;
?>