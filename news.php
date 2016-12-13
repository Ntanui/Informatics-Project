<?php
    include_once('config.php');
    include_once('dbutils.php');
    
?>

<html>
    <head>

<title>Enter News</title>
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
        background-color: #2E9AFE;
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
        background-color: #2E9AFE;
    }
    input[type=reset]:hover {
        background-color: #2E9AFE;
    }
    
    div {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 2px;
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
                <h1>Edit News</h1>
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
                        <li><a href="input.php"><span class="glyphicon glyphicon-flag"></span> &nbsp; Edit Page</a></li>
                        <li><a href="people.php"><span class="glyphicon glyphicon-user"></span> &nbsp; People</a></li>
                        <li class="active"><a href="news.php"><span class="glyphicon glyphicon-list-alt"></span> &nbsp; News</a></li>
                        <li><a href="calendar.php"><span class="glyphicon glyphicon-calendar"></span> &nbsp; Calendar</a></li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
            
        
        <div class="row">
            <div class="col-sm-9 col-xs-12">

<h2>Welcome to your news post page!</h2>

<!-- Processing form input -->        
        <div class="row">
            <div class= "col-xs-12">
                
<?php
//
//code to handle input from form
//
if (isset($_POST['submit'])) {
    //only run if the form was submitted
    
    //get data from form
    $newsTitle = $_POST['newsTitle'];
    $timePost = $_POST['timePost'];
    
    //connect to database
    $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
    //check for required fields
    $isComplete = true;
    $errorMessage = "";
    
    if(!$newsTitle) {
        $errorMessage .= "Please enter a First Name";
        $isComplete = false;
    } else {
        $newsTitle = makeStringSafe($db, $newsTitle);
    }
    
    if (!$timePost) {
        $errorMessage .= " Please enter a Last Name";
        $isComplete = false;
    } else {
        $timePost = makeStringSafe($db, $timePost);
    }

    
    /*if (!$phone) {
        $errorMessage .= " Please enter your phone number  (If you don't want to put your phone number it is fine)";
        $isComplete = false;
    } else {
        $phone = makeStringSafe($db, $phone);
    }*/
    
    
    if (!$isComplete) {
        punt($errorMessage);
    }
    
    
    //check
    $query= " SELECT * FROM news WHERE newsTitle = '" . $newsTitle . "' AND '" . $timePost . "';";
    $result=  queryDB($query, $db);
    if (nTuples ($result) > 0 ) {
        // This means a director with the same email.
        punt ("Sorry we have already have a news item titled  " . $newsTitle );
   
    }
    
    
    // Sql code to insert tuple or record
    $insert = "INSERT INTO news(newsTitle,timePost) VALUES ('" . $newsTitle . "' , '" . $timePost . "');";
    
    
    //run the insert statement
    $result = queryDB($insert, $db);
    
    //If no errors, record has been succesfully Inserted.
    
    echo ("Succesfully entered a news item titled" . $newsTitle." in the Database");
    
        }
           
?>
        <div class="row">
            <div class="col-xs-12">
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-12">

                
<!-- change the name of the file -->
<form action="news.php" method="post">
<!-- first name -->
    <div class="form-group">
        <label for="newsTitle">News Title</label>
        <input type="text" class="form-control" name="newsTitle"/>
    </div>

<!-- role -->    
    <div class="form-group">
        <label for="timePost">Time Post</label>
        <!-- <input type="text" class="form-control" name="timePost" rows="10"/> -->
        <textarea class="form-control" name="timePost" id="editbody" rows="10"></textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" name="submit"></input>
    </div>
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
            <th>News Title</th>
            <th>Article</th>
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
    $query="SELECT * FROM news ORDER BY newsTitle;";
    
    //run the query
    $result = queryDB($query, $db);
    while($row = nextTuple($result)) {
        // in the lecture, each time the while loop runs we create one row in the table
        echo "\n <tr>";
        echo "<td>" . $row['newsTitle'] . "</td>";
        echo "<td>" . $row['timePost'] . "</td>";
        echo "<td><a href='deletenews.php?id=" . $row['id'] . "'>delete</a></td>";
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