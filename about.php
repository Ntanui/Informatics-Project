<?php
    include_once('config.php');
    include_once('dbutils.php');
    
?>

<html>
    <head>

<title>Enter Organization</title>
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
                <h1>Welcome! Please add an Organization</h1>
                <a href="index.php">View site</a>
            </div>
        </div>  
    </div>
        

            
        <div class="row">
            <div class="col-xs-12">
                <div class="navbar navbar-inverse">
                    <div class="container-fluid">
                    <ul class="nav nav-pills">
                        <li class="active"><a href="about.php"><span class="glyphicon glyphicon-home"></span> &nbsp; Organization</a></li>
                        <li><a href="input.php"><span class="glyphicon glyphicon-flag"></span> &nbsp; Create Site</a></li>
                        <li><a href="people.php"><span class="glyphicon glyphicon-user"></span> &nbsp; People</a></li>
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
    $orgName = $_POST['orgName'];
    $contactInfo = $_POST['contactInfo'];
    $adMininfo = $_POST['adMininfo'];
    
    //connect to database
    $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
    //check for required fields
    $isComplete = true;
    $errorMessage = "";
    
    if(!$orgName) {
        $errorMessage .= "Please enter the Organization's Name";
        $isComplete = false;
    } else {
        $orgName = makeStringSafe($db, $orgName);
    }
    
    if (!$contactInfo) {
        $errorMessage .= " Please enter web address";
        $isComplete = false;
    } else {
        $contactInfo = makeStringSafe($db, $contactInfo);
    }
     
    if (!$isComplete) {
        punt($errorMessage);
    }
    
    
    $query = "SELECT * FROM organization WHERE orgName='" .  $orgName . "' AND contactInfo='" . $contactInfo . "';";
    $result = queryDB($query, $db);
    if (nTuples($result) >  0) {
        punt("Sorry. We already have a organization name called " . $orgName . " whose website is  " . $contactInfo);
    }
     
    //according to lecture, put together sql code to insert tuple or record
    $insert = "INSERT INTO organization (orgName, contactInfo) VALUES ('" . $orgName . "', '" . $contactInfo . "');";
    
    
    //run the insert statement
    $result = queryDB($insert, $db);
    
    //we have successfully inserted the record
    echo ("Successfully entered " . $orgName . " " . $contactInfo . " into the database.");
    
}
?>
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-sm-9 col-xs-12">

                
<!-- change the name of the file -->
<form action="about.php" method="post">
<!-- first name -->
    <div class="form-group">
        <label for="orgName">Organization Name</label>
        <input type="text" class="form-control" name="orgName"/>
    </div>

<!-- last name -->
    <div class="form-group">
        <label for="contactInfo">Web Address</label>
        <input type="text" class="form-control" name="contactInfo"/>
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
            <th>Organization Name</th>
            <th>Web Address</th>
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
    $query="SELECT * FROM organization ORDER BY orgName;";
    
    //run the query
    $result = queryDB($query, $db);
    while($row = nextTuple($result)) {
        // in the lecture, each time the while loop runs we create one row in the table
        echo "\n <tr>";
        echo "<td>" . $row['orgName'] . "</td>";
        echo "<td>" . $row['contactInfo'] . "</td>";
        echo "<td><a href='deleteorg.php?id=" . $row['id'] . "'>delete</a></td>";
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