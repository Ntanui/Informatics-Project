<?php
    include_once('config.php');
    include_once('dbutils.php');
    
?>

<html>
    <head>

<title>Enter Member</title>

<!-- this is the code from bootstrap -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
    </head>
    
    <body>
        
        
<!-- visible title-->
        <div class="row">
            <div class="col-xs-12">
                <h1>Enter Name</h1>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-xs-12">
                
<?php
//
//code to handle input from form
//

if (isset($_POST['submit'])) {
    //only run if the form was submitted
    
    //get data from form
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $contactinfo = $_POST['contact information'];
    $role = $_POST['role'];

    
    //connect to database
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    //check for required fields
    $isComplete = true;
    $errorMessage = "";
    
    if(!$firstname) {
        $errorMessage .= "Please enter a First Name";
        $isComplete = false;
    } else {
        $firstname = makeStringSafe($db, $firstname);
    }
    
    if (!$lastname) {
        $errorMessage .= " Please enter a Last Name";
        $isComplete = false;
    } else {
        $lastname = makeStringSafe($db, $lastname);
    }

    if (!$contactinfo) {
        $errorMessage .= " Please enter a contact information";
        $isComplete = false;
    } else {
        $contactinfo = makeStringSafe($db, $contactinfo);
    }

    if (!$role) {
        $errorMessage .= " Please enter a role in organization";
        $isComplete = false;
    } else {
        $role = makeStringSafe($db, $role);
    }
    
    
    if (!$isComplete) {
        punt($errorMessage);
    }
    

    
    //check
    $query = "SELECT * FROM directors WHERE firstname='" .  $firstname . "' AND lastname='" . $lastname . "' AND contact inforamtion='" . $contactinfo . "'AND role='" . $role . "';";
    $result = queryDB($query, $db);
    if (nTuples($result) >  0) {
        punt("Sorry. We already have a director called " . $firstname . " " . $lastname);
    }
    
    //according to lecture, put together sql code to insert tuple or record
    $insert = "INSERT INTO directors (firstname, lastname, contact information, role) VALUES ('" . $firstname . "', '" . $lastname . "', '" . $contactinfo . "', '" . $role . "');";
    

    
    //run the insert statement
    $result = queryDB($insert, $db);
    
    //we have successfully inserted the record
    echo ("Seccessfully entered " . $firstname . " " . $lastname . " into the database.");
    
    //maybe delete this line
    //echo $insert;
    
    //echo ("Name: " . $name . ". Location: " . $location . ". URL: " . $url);
    //until here maybe delete
}
?>
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-xs-12">
                
<!-- change the name of the file -->
<form action="people.php" method="post">
<!-- first name -->
    <div class="form-group">
        <label for="firstname">First Name</label>
        <input type="text" class="form-control" name="firstname"/>
    </div>

<!-- last name -->
    <div class="form-group">
        <label for="lastname">Last Name</label>
        <input type="text" class="form-control" name="lastname"/>
    </div>
    
<!-- year -->    
    <div class="form-group">
        <label for="contact information">Country</label>
        <input type="text" class="form-control" name="conctact information"/>
    </div>       

    
    <button type="submit" class="btn btn-default" name="submit">Add</button>
</form>            
                
                
            </div>
        </div>
   
<!-- table to show contents-->     
<div class="row">
    <div class="col-xs-12">
<table class="table table-hover">
    
    <!-- headers gor table -->
    <thead>
        <tr>
            <th>Name</th>
            <th>Organization</th>
            <th> </th>
            <th> </th>
        </tr>
    </thead>
    
    <tbody>
<!-- php datacode and creat the html table where you can ge the mysql table -->
<?php

    if (!$db) {
        // connect to the database
        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    }
    
    //set up query to records from the table
    // ******** I was not sure about this ********
    $query="SELECT * FROM directors ORDER BY lastname;";
    
    //run the query
    $result = queryDB($query, $db);

    while($row = nextTuple($result)) {
        // in the lecture, each time the while loop runs we create one row in the table
        echo "\n <tr>";
        echo "<td>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
        echo "<td>" . $row['contact inforamtion'] . "</td>";
        echo "<td>" . $row['role'] . "</td>";
        echo "<td><a href='update 1.php?id=" . $row['id'] . "'>edit</a></td>";
        echo "<td><a href='delete 1.php?id=" . $row['id'] . "'>delete</a></td>";
        echo "<\tr>";
    }


?>
             
    </tbody>
</table>
        
    </div>
</div> 
        
        
        
    </body>
</html>