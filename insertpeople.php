<html>

<head>
    <title>Insert people</title>
</head>

<body>

<h1>
    Insert people feedback
</h1>

<?php
    include_once("dbutils.php");
    include_once("config.php");

    // get data from fields
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $personType = $_POST['personType'];
    
    
    // check that we have the data we need
    if (!$firstName) {
        echo "Hey, you didn't add a firstname title. Please <a href='people.php'>try again</a>";
        exit;
    }
    
    if (!$lastName) {
        echo "Hey, you didn't add a lastname. Please <a href='people.php'>try again</a>";
        exit;
    }
    
    if (!$email) {
        echo "Hey, you didn't add an email. Please <a href='people.php'>try again</a>";
        exit;
    }
    
    if (!$personType) {
        echo "Hey, you didn't add a persontype. Please <a href='people.php'>try again</a>";
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
    $urlCheckQuery = "select * from people where firtName='" . $firstName . "' AND lastName !=". $lastName . "'";
    $result = queryDB($urlCheckQuery, $db);
    if ($result) {
        $numberofrows = nTuples($result);
        if ($numberofrows > 0) {
            punt("The person named  firtName='" . $firstName . "', ". $lastName . "' already exists in the database." .
                              "<p>Please <a href='people.php'>try again</a>");
        }
    } else {
        punt("Could not check if This Person was already in table.<p>" . $db->error, $firstName,$lastNameCheckQuery);
    }
    
    // prepare sql statement
    $query = "insert into people (firstName, lastName, email, personType,)
        values ('" . $firstName . "', '" . $lastName . "', '" . $email . "', " .
        $personType . "');";
    
    // execute sql statement
    $result = queryDB($query, $db);
    
    // check if it worked
    if ($result) {
        echo $firstName . "', ". $lastName . " was added to the database.";
        echo "<p>";
        echo "<a href='people.php'>Add more pages</a>";
    } else {
        echo "Something went horribly wrong when adding " . $u . ".";
        echo "<p>This was the error: " . $db->error;
        echo "<p>This was the sql statement: " . $query;
        echo "<p>Please <a href='people.php'>try again</a>";
    }
    
    $db->close();
?>

</body>

</html>