<?php

function generatePage($body, $title) {
    $page = <<<PAGE
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>$title</title>
        <script src="validate.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
            $(function(){
              $('#myCarousel').carousel();
            });
        </script>
        <script type="text/javascript">
            function redirect() {
                let url = "signedup.php";
                window.location.href = url;
            }
        </script>
        <link rel="stylesheet" href="mainstyle.css" />
    </head>
    <body>
        $body
    </body>
</html>
PAGE;
    return $page;
}
?>