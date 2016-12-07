<!-- This file provides input capabilities into a table of Users -->
<!--It also lists the contents of the table -->
<!-- It uses Bootsrap for formatting-->
<!--Norman K. Tanui-->


<?php
    include_once('config.php');
    include_once('dbutils.php');

?>

<html>
    <head>
        
<?php
	include_once("header.php");
?>
        
<title> Enter News. </title>

<!-- Code from Bootsrap -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    </head>
           
    <body>
        
<h2>Welcome to your news post page!</h2>

<!-- Processing form input -->        
        <div class="row">
            <div class= "col-xs-12">
                
<?php

//
// Code to handle input from the form
//
if (isset($_POST['submit'])) {
    //Run only if the form was submitted
    
    //Get data from the form
    $newsTitle = $_POST['newsTitle'];
    $timePost = $_POST['timePost'];
    $preview = $_POST['preview'];

    
    if (!$db){
        // Connect to database
        $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
    }
    
    
    //Checking  for input into required fields    
    $isComplete = true;
    $errorMessage = "";
    
    if (!$email) {
        $errorMessage .= "Please enter a news item Headline.";
        $isComplete = false ;   
    }   else {
            $email = makeStringsafe($db, $email);
    }
        
    if (!$password) {
        $errorMessage .= "Please enter your news post .";
        $isComplete = false ;   
    }  
              
             
    if (!isComplete) {
        punt ($errorMessage);
    }
    
      
    //check if there's a user with the same email
    $query= " SELECT * FROM news WHERE newsTitle = '" . $newsTitle . "';";
    $result=  queryDB($query, $db);
    if (nTuples ($result) > 0 ) {
        // This means a director with the same email.
        punt ("Sorry we have already have a news item titled  " . $newsTitle );
   
    }
    
    
    // Sql code to insert tuple or record
    $insert = "INSERT INTO news(newsTitle,news) VALUES ('" . $newsTitle . "' , '" . $timePost . "');";
    
    
    //run the insert statement
    $result = queryDB($insert, $db);
    
    //If no errors, record has been succesfully Inserted.
    
    echo ("Succesfully entered a news item titled" . $newsTitle." in the Database");
    
        }
           
?>
      
            </div>
        </div>
        
     
        <div class ="row">
             <div class = "col-xs-12">
                                 
<form action= "inputuseers.php" method ="post">
    
<!-- title -->
    <div class="form-group">
        <label for="email"> Newstitle </label>
        <input type="text" class="form-control" name ="newsTitle" />
    </div>
    
<!-- news -->
    <div class="form-group">
        <label for=""> TimePost </label>
        <input type="text" class="form-control" name ="timePost"/>

    </div
         
    <div class="form-group">
        <label for="preview"> Preview </label>
        <input type="text" class="form-control" name ="preview"/>
    </div>
        
    <button type="submit" class="btn btn-default" name ="submit">Post</button>
	

<!-- Table to show contents of database -->

<div class = "row">
    <div class ="col-xs-12">
<table class = "table table-hover">
    
    <!-- Headers for table -->
    <thead>
        <tr>
            <th> Article Name</th>
        </tr>
    </thead>
    
    <tbody>
<?php

    if (!$db){
        // Connect to database
        $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
    }

    // Set up query to get all records from users table.
    $query = "SELECT * FROM news ORDER BY newsTitle;";
    
    //Run the query
    $result = queryDB($query, $db);
    
    while($row = nextTuple($result)){
        //Each time the while loop runs,we create one row in the table.
        echo "\n <tr>";
        echo "<td>" . $row['newsTitle'] ."</td>" ;
        echo "<td>" . $row['timePost'] . "</td>" ;
        echo "<td>" . $row['preview'] . "</td>" ;
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