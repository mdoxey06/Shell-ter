<!doctype html>
<html>
    <head> 
        <meta content="text/html" charset=UTF-8" />
        <title>View Recommendations</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">            
    <body>
        
    <h1>Recommendations</h1>
<?php
    session_start();
    
    $db_connection = new mysqli("localhost", "shell", "terps", "shellterp");
    if ($db_connection->connect_error) {
        die($db_connection->connect_error);
    }
    
    $currUser = $_SESSION["currUser"];
    $trow = 0;
    $landmark = 0;
    $view = 0;
    $commons = 0;
    $courtyards = 0; 
    $colNames = ["location", "price", "pool", "pets", "gym"];
    
    function incApartment($aptName) {
        global $trow, $landmark, $view, $commons, $courtyards;
        
        switch ($aptName) {
            case "Terrapin Row":
                $trow++;
                break;
            case "Landmark":
                $landmark++;
                break;
            case "View":
                $view++;
                break;
            case "Commons":
                $commons++;
                break;
            case "Courtyards":
                $courtyards++;
                break;
        }
    }
    
    function queryCol($col, $currUser) {
        global $db_connection;
        
        if ($col != "price")
            $query = sprintf("select aptName, offCampus.%s from offCampus, user where user.email = %s and offCampus.%s = user.%s", $col, $currUser, $col, $col);
        else 
            $query = sprintf("select aptName, offCampus.price from offCampus, user where user.email = %s and offCampus.price >= (user.price - 100) and offCampus.price <= (user.price + 100)", $currUser);
            
        $result = $db_connection->query($query);
        
        for ($i = 0; $i < $result->num_rows; $i++) {
            $result ->data_seek($i);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            incApartment($row["aptName"]);
        }
    }
    
    foreach ($colNames as $currCol) {
        queryCol($currCol, $currUser);
    }
    
    $aptScores = ["Terrapin Row" => $trow, "Landmark" => $landmark, "View" => $view, "Commons" => $commons, "Courtyards" => $courtyards];
    $aptLinks = ["Terrapin Row" => "http://www.terrapinrow.com/", "Landmark" => "http://www.landmarkcollegepark.com/",
                    "View" => "http://uviewapts.com/", "Commons" => "http://southcampuscommons.com/", "Courtyards" => "http://umdcourtyards.com/"];
    asort($aptScores);

    // TODO: INSERTING IMAGES!!!!!!
    
    $table = "<table class='table'><thead><tr><th><strong>Image</strong></th><th><strong>Apartment</strong></th><th><strong>Match Percentage</strong></th></tr></thead><tbody>";
    foreach ($aptScores as $apt) {
        $matchPct = (100*$aptScores[$apt])/5;
        $query = sprintf("select image from offCampus where aptName = %s", $apt);
        $result = $db_connection->query($query);
        $result -> data_seek(0);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $image = "<img src='data:image/jpeg;base64,".base64_encode( $row['image'] )."'/>";
        $table.= "<tr><td>".$image."</td><td><a href='".$aptLinks[$apt]."'>".$apt."</a></td><td>".$aptScores[$apt]."%</td></tr>";
    }
    $table .= "</tbody></table>";
        
    echo $table;
?>
    </body>
</html>