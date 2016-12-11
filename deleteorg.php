<?php
    include_once("dbutils.php");
    include_once("config.php");

    // get data from fields
    $id = $_POST['id'];

    // check that we have an id
    if (!$id) {
        echo "No id received";
	exit;
    }
    
    // get a handle to the database
    $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
    
    $deleteQuery = "DELETE FROM organization WHERE id = " . $id . ";";
    
    $result = queryDB($deleteQuery, $db);
    
    if ($result) {
        echo "Page deleted";
        //header("Location: " . $baseURL . "input.php");
    } else {
        echo "something bad happened with the query. " . $db->error . " This was the query: " . $deleteQuery;    
    }
    
?>