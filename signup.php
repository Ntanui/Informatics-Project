<!-- This file provides input capabilities into a table of Users -->
<!--It also lists the contents of the table -->
<!-- It uses Bootsrap for formatting-->
<!--Norman K. Tanui-->


<?php
    include_once('config.php');
    include_once('dbutils.php');
	include_once('header.php');
?>

<html>
    <head>
        
<title> Enter Users. </title>

<!-- Code from Bootsrap -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    </head>
           
    <body>
<!-- Visible Title -->
        <div class = "row">
            <div class = "col-xs-12">
                <h1> Enter Users.</h1>
            </div>  
        </div>
        
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
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    
    if (!$db){
        // Connect to database
    $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
    }
    
    
    //Checking  for input into required fields    
    $isComplete = true;
    $errorMessage = "";
    
    if (!$email) {
        $errorMessage .= "Please enter an email.";
        $isComplete = false ;   
    }   else {
            $email = makeStringsafe($db, $email);
    }
        
    if (!$password) {
        $errorMessage .= "Please enter a password.";
        $isComplete = false ;   
    }  
            
    if (!$password2)  {
        $errorMessage .= "Please Re-enter your password.";
        $isComplete = false ;   
    }
    
    if ($password !=$password2) {
        $errorMessage.= "Sorry, your passwords do not match.";
        $isComplete =false;
        
    }   
             
    if (!isComplete) {
        punt ($errorMessage);
    }
    
      
    //check if there's a user with the same email
    $query= " SELECT * FROM account WHERE email = '" . $email . "';";
    $result=  queryDB($query, $db);
    if (nTuples ($result) > 0 ) {
        // This means a director with the same email.
        punt ("Sorry we have already have user with the email " . $email );
   
    }
    
    //Generate the hashed version of the password
    $hashedpass = crypt($password, getSalt());
    
    // Sql code to insert tuple or record
    $insert = "INSERT INTO account(email,hashedpass) VALUES ('" . $email . "' , '" . $hashedpass . "');";
    
    
    //run the insert statement
    $result = queryDB($insert, $db);
    
    //If no errors, record has been succesfully Inserted.
    
    echo ("Succesfully entered" . $email." in the User's Database");
    
        }
           
?>
      
            </div>
        </div>
        
     
        <div class ="row">
             <div class = "col-xs-12">
                                 
<form action= "inputusers.php" method ="post">
    
<!-- Email -->
    <div class="form-group">
        <label for="email"> Email </label>
        <input type="email" class="form-control" name ="email" />
    </div>
    
<!-- Password 1 -->
    <div class="form-group">
        <label for="password"> Password </label>
        <input type="password" class="form-control" name ="password"/>

    </div
         
<!-- Password 2 -->
    <div class="form-group">
        <label for="password2"> Re-enter Password </label>
        <input type="password" class="form-control" name ="password2"/>
    </div>
        
    <button type="submit" class="btn btn-default" name ="submit">Add</button>
</form>
                
            </div>
        </div>
<!-- Table to show contents of database -->

<div class = "row">
    <div class ="col-xs-12">
<table class = "table table-hover">
    
    <!-- Headers for table -->
    <thead>
        <tr>
            <th>Name</th>
        </tr>
    </thead>
    
    <tbody>
<?php
    if (!$db){
        // Connect to database
    $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
    }
    // Set up query to get all records from users table.
    $query = "SELECT * FROM account ORDER BY email;";
    
    //Run the query
    $result = queryDB($query, $db);
    
    while($row = nextTuple($result)){
        //Each time the while loop runs,we create one row in the table.
        echo "\n <tr>";
        echo "<td>" . $row['email'] ."</td>" ;
        echo "<td>" . $row['password'] . "</td>" ;
        echo "<td>" . $row['password2'] . "</td>" ;
        echo "</tr>";
    }
?>
    </tbody>   
</table>
        
    </div>
    
</div>
        
    </body>
    
</html>