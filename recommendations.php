<!doctype html>
<html>
    <head> 
        <meta content="text/html" charset=UTF-8" />
        <title>View Recommendations</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <div class="collapse navbar-collapse">
                  <ul class="nav navbar-nav">
                    <li class="active"><a class="navbar-brand" href="Options.html">Shell-ter</a></li>
                    <li><a href="Options.html">Home</a></li>
                    <li><a href="updatePreferences.php">Update Preferences</a></li>
                  </ul>
                </div>
            </div>
        </nav>
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
        
        if ($col == "price")
            $query = sprintf("select aptName from offCampus, user where user.email = '%s' and offCampus.price >= (user.price - 100) and offCampus.price <= (user.price + 100);", $currUser);
        else
            $query = sprintf("select aptName from offCampus, user where user.email = '%s' and offCampus.%s = user.%s;", $currUser, $col, $col);
            
        $result = $db_connection->query($query);
        
        if ($result) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                $result ->data_seek($i);
                $row = $result->fetch_array(MYSQLI_ASSOC);
                incApartment($row["aptName"]);
            }
        }
    }
    
    foreach ($colNames as $currCol) {
        queryCol($currCol, $currUser);
    }
    
    $aptScores = ["Terrapin Row" => $trow, "Landmark" => $landmark, "View" => $view, "Commons" => $commons, "Courtyards" => $courtyards];
    $aptLinks = ["Terrapin Row" => "http://www.terrapinrow.com/", "Landmark" => "http://www.landmarkcollegepark.com/",
                    "View" => "http://uviewapts.com/", "Commons" => "http://southcampuscommons.com/", "Courtyards" => "http://umdcourtyards.com/"];
    arsort($aptScores);

    
    $table = "<table class='table table-striped table-bordered'><thead><tr><th><strong>Image</strong></th><th><strong>Apartment</strong></th><th><strong>Match Percentage</strong></th></tr></thead><tbody>";
    foreach (array_keys($aptScores) as $apt) {
        $matchPct = (100*$aptScores[$apt])/5;
        $query = sprintf("select image from offCampus where aptName = '%s'", $apt);
        $result = $db_connection->query($query);
        $result -> data_seek(0);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $image = "<img src='data:image/jpeg;base64,".base64_encode( $row['image'] )."'/>";
        $table.= "<tr><td>".$image."</td><td><a href='".$aptLinks[$apt]."'>".$apt."</a></td><td>".$matchPct."%</td></tr>";
    }
    $table .= "</tbody></table>";
        
    echo $table;
?>
    </body>
</html>