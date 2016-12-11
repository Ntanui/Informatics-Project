<?php
    include_once("dbutils.php");
    include_once("config.php");

     // get data from fields
    $id = $_POST['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $personType = $_POST['personType'];
    
    
    // check that we have the data we need
    if (!$id) {
        echo "Hey, you didn't add an id. Please <a href='people.php'>try again</a>";
        exit;
    }

    if (!$firstName) {
        echo "Hey, you didn't a Firstname. Please <a href='people.php'>try again</a>";
        exit;
    }
    
    if (!$lastName) {
        echo "Hey, you didn't add a Lastname. Please <a href='people.php'>try again</a>";
        exit;
    }
    
    if (!$email) {
        echo "Hey, you didn't add an email address. Please <a href='people.php'>try again</a>";
        exit;
    }
    
    if (!$personType) {
        echo "Hey, you didn't add a page title. Please <a href='people.php'>try again</a>";
        exit;
    }
    

    
    // get a handle to the database
    $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);

    // add escape characters to text    
    $firstName = $db->real_escape_string($firstName);
    $lastName = $db->real_escape_string($lastName);
    $email = $db->real_escape_string($email);
    $personType = $db->real_escape_string($personType);

    
    // check if url title is already in the table
    $urlCheckQuery = "select * from people where firtName='" . $firstName . "' AND lastName =". $lastName . "' AND id!=". $id;
    $result = queryDB($urlCheckQuery, $db);
    if ($result) {
        $numberofrows = nTuples($result);
        if ($numberofrows > 0) {
            punt("The url person named '" . $firstName . "' AND ". $lastName . "' already exists in the database." .
                              "<p>Please <a href='people.php'>try again</a>");
        }
    } else {
        punt("Could not check if This Person was already in table.<p>" . $db->error, $firstName,$lastNameCheckQuery);
    }
    
    $updateQuery = "UPDATE peope SET firstName='" . $firstName
	. "', lastName='" . $lastName
        . "', email='" . $email 
	. "', personType='" . $personType 
	. " WHERE id = " . $id . ";";
    
    $result = queryDB($updateQuery, $db);
    
    if ($result) {
        echo "Page edited";
    } else {
        echo "something bad happened with the query. " . $db->error . " This was the query: " . $updateQuery;    
    }
    
?>