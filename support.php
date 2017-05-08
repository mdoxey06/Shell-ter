<!--Code taken from Nelson's support.php file -->

<?php

function generatePage($body, $title="Shell-ter") {
    $page = <<<EOPAGE
<!doctype html>
<html>
    <head> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="login.css">
        <script src="validate.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>$title</title>	
    </head>
            
    <body>
        <div id = "login">
            $body
        </div>
    </body>
</html>
EOPAGE;

    return $page;
}
?>