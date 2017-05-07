<!doctype html>
<html>
    <head> 
        <meta content="text/html" charset=UTF-8" />
        <title>View Recommendations</title>	
    </head>
            
    <body>
        
    <h1>Recommendations</h1>
<?php
    session_start();
    
    $db_connection = new mysqli("localhost", "user", "terps", "shellterp");
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
        if ($col != price)
            $query = "select aptName, offCampus.".$col." from offCampus, user where user.email = ".$currUser." and offCampus.".$col." = user.".$col;
        else 
            $query = "select aptName, offCampus.price from offCampus, user where user.email = ".$currUser." and offCampus.price >= (user.price - 100) and offCampus.price <= (user.price + 100)";
            
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
    
    $query = "select aptName, image from offCampus";
    $result = $db_connection->query($query);
    
    // TODO: INSERTING IMAGES!!!!!!
    
    $table = "<table class='table'><thead><tr><th><strong>Apartment</strong></th><th><strong>Match Percentage</strong></th></tr></thead><tbody>";
    foreach ($aptScores as $apt) {
        $matchPct = (100*$aptScores[$apt])/5;
        $table.= "<tr><td><a href='".$aptLinks[$apt]."'>".$apt."</a></td><td>".$aptScores[$apt]."%</td></tr>";
    }
    $table .= "</tbody></table>";
        
    echo $table;
?>
    </body>
</html>