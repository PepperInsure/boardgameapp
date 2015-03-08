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
    AND objectid > {$int_input['objectid']}
    AND avgweight > {$int_input['avgweight']}
    AND rank > {$int_input['rank']}
    AND minplayers > {$int_input['minplayers']}
    AND maxplayers > {$int_input['maxplayers']}
    AND playingtime > {$int_input['playingtime']}
    AND bggbestplayers > {$int_input['bggbestplayers']}
    ";
    $statement = $dbhandle->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    header('HTTP/1.1 200 OK');
    header('Content-Type: application/json');
    echo json_encode($results);
    
?>