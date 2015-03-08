<?php
// A simple web site in Cloud9 that runs through Apache
// Press the 'Run' button on the top to start the web server,
// then click the URL that is emitted to the Output tab of the console

    $q_input = $_POST["user_input"];
    $int_input = array_map('intval', $q_input);

    $dbhandle = new PDO("sqlite:bgg.sqlite") or die("Failed to open DB");
    //$db = 'api/bgg.sqlite';
    if (!$dbhandle) die ($error);
    $query = "SELECT * FROM games WHERE average > {$int_input['average']} 
    AND objectid > 0
    AND avgweight > 0
    AND rank > 0
    AND minplayers > 0
    AND maxplayers > 0
    AND playingtime > 0
    AND bggbestplayers > 0
    ";
    $statement = $dbhandle->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    header('HTTP/1.1 200 OK');
    header('Content-Type: application/json');
    echo json_encode($results);
    
?>