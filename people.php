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
    <style>
    input[type=text], select {
        width: 100%;
        padding: 12px 10px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    
    input[type=submit] {
        width: 100%;
        background-color: #5b87ff;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    
    input[type=reset] {
        width: 100%;
        background-color: #2E9AFE;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    
    input[type=submit]:hover {
        background-color: #5b87ff;
    }
    input[type=reset]:hover {
        background-color: #2E9AFE;
    }
    
    div {
        border-radius: 5px;
        background-color: #eaf3ff;
        padding: 2px;
    }
    </style>


<style>
body {
    background-color: #eaf3ff;
}
</style>
    
    <body>

<div class="container" style="width: 1024px">

<!-- if you have a site table, you'd get this from there -->
<div class="row">
    <div class="col-xs-10">
        
    </div>
    <div class="col-xs-2">
        <a href="login.php">Log In</a>
        <a>or</a>
        <a href="login.php">Log Out</a>
    </div>
</div>

    <div class="container" style="width: 1024px">
    
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <!-- Header -->
                <h1>Edit People</h1>
                <a href="index.php">View site</a>
            </div>
        </div>  
    </div>
        

            
        <div class="row">
            <div class="col-xs-12">
                <div class="navbar navbar-inverse">
                    <div class="container-fluid">
                    <ul class="nav nav-pills">
                        <li><a href="about.php"><span class="glyphicon glyphicon-home"></span> &nbsp; Organization</a></li>
                        <li><a href="input.php"><span class="glyphicon glyphicon-flag"></span> &nbsp; Create Site</a></li>
                        <li class="active"><a href="people.php"><span class="glyphicon glyphicon-user"></span> &nbsp; People</a></li>
                        <li><a href="news.php"><span class="glyphicon glyphicon-list-alt"></span> &nbsp; News</a></li>
                        <li><a href="calendar.php"><span class="glyphicon glyphicon-calendar"></span> &nbsp; Calendar</a></li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
            
        
        <div class="row">
            <div class="col-sm-9 col-xs-12">
                
<?php
//
//code to handle input from form
//
if (isset($_POST['submit'])) {
    //only run if the form was submitted
    
    //get data from form
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $personType= $_POST['personType'];
    
    //connect to database
    $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
    //check for required fields
    $isComplete = true;
    $errorMessage = "";
    
    if(!$firstName) {
        $errorMessage .= "Please enter a First Name";
        $isComplete = false;
    } else {
        $firstName = makeStringSafe($db, $firstName);
    }
    
    if (!$lastName) {
        $errorMessage .= " Please enter a Last Name";
        $isComplete = false;
    } else {
        $lastName = makeStringSafe($db, $lastName);
    }
    if (!$email) {
        $errorMessage .= " Please enter your email address";
        $isComplete = false;
    } else {
        $email = makeStringSafe($db, $email);
    }
    
    /*if (!$phone) {
        $errorMessage .= " Please enter your phone number  (If you don't want to put your phone number it is fine)";
        $isComplete = false;
    } else {
        $phone = makeStringSafe($db, $phone);
    }*/
    
    if (!$personType) {
        $errorMessage .= " Please enter your position in organization";
        $isComplete = false;
    } else {
        $personType = makeStringSafe($db, $personType);
    }
    
    
    if (!$isComplete) {
        punt($errorMessage);
    }
    
    
    //check
    $query = "SELECT * FROM person WHERE firstName='" .  $firstName . "' AND lastName='" . $lastName . "' AND email='" . $email . "'AND personType='" . $personType . "';";
    $result = queryDB($query, $db);
    if (nTuples($result) >  0) {
        punt("Sorry. We already have a person called " . $firstName . " " . $lastname);
    }
    
    //according to lecture, put together sql code to insert tuple or record
    $insert = "INSERT INTO person (firstName, lastName,email, personType) VALUES ('" . $firstName . "', '" . $lastName . "', '" . $email . "', '" . $personType . "');";
    
    
    //run the insert statement
    $result = queryDB($insert, $db);
    
    //we have successfully inserted the record
    echo ("Successfully entered " . $firstName . " " . $lastName . " into the database.");
    
    //maybe delete this line
    //echo $insert;
    
    //echo ("Name: " . $name . ". Location: " . $location . ". URL: " . $url);
    //until here maybe delete
}
?>
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-sm-9 col-xs-12">

                
<!-- change the name of the file -->
<form action="people.php" method="post">
<!-- first name -->
    <div class="form-group">
        <label for="firstName">First Name</label>
        <input type="text" class="form-control" name="firstName"/>
    </div>

<!-- last name -->
    <div class="form-group">
        <label for="lastName">Last Name</label>
        <input type="text" class="form-control" name="lastName"/>
    </div>
    
<!-- email -->    
    <div class="form-group">
        <label for="contact information">Email</label>
        <input type="text" class="form-control" name="email"/>
    </div>
 

<!-- role -->    
    <div class="form-group">
        <label for="contact information">Position</label>
        <input type="text" class="form-control" name="personType"/>
    </div>
    
    <div class="form-group">
        <input type="submit" name="submit"></input>
    </div>
</form>            
                
                
            </div>
            
            <div class="col-sm-3 col-xs-12">                             
                <div class="palen panel-default">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                    <body>
                    
                    <div class="w3-container">
                      <h1>Stay Simple!</h1>
                    
                      <div class="w3-panel w3-card-4 w3-light-grey" style="width:100%">
                        <p class=" w3-large w3-serif">
                        <i class="fa fa-quote-right w3-xxlarge w3-text-red"></i><br>
                        You are able to create your own organization website by simply entering the name and website. This is a great way to modify or delete the information instantly</p>
                      </div>
                    </div>
                    
                    </body>
                </div>
            </div>
        </div>
        
        
   
<!-- table to show contents-->     
<div class="row">
    <div class="col-xs-12">
<table class="table table-hover">
    
    <!-- headers gor table -->
    <thead>
        <tr class="w3-green">
            <th>Name</th>
            <th>Email</th>
            <th>Position</th>
            <th> </th>
        </tr>
    </thead>
    
    <tbody>
<!-- php datacode and creat the html table where you can ge the mysql table -->
<?php
    if (!$db) {
        // connect to the database
        $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
    }
    
    //set up query to records from the table
    // ******** I was not sure about this ********
    $query="SELECT * FROM person ORDER BY lastName;";
    
    //run the query
    $result = queryDB($query, $db);
    while($row = nextTuple($result)) {
        // in the lecture, each time the while loop runs we create one row in the table
        echo "\n <tr>";
        echo "<td>" . $row['firstName'] . " " . $row['lastName'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['personType'] . "</td>";
        echo "<td><a href='deletepeople.php?id=" . $row['id'] . "'>delete</a></td>";
        echo "</tr>";
    }
?>
             
    </tbody>
</table>
        
    </div>
</div> 
        
        
        
    </body>
</html>
<?php
include_once("footer.php");
?>