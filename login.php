<!-- This file enables users to login into the system -->
<!--It also lists the contents of the table -->
<!-- Ir uses Bootsrap for formatting-->
<!--Norman K. Tanui-->


<?php
    include_once('config.php');
    include_once('dbutils.php');

?>

<html>
    <head>
        
<title> Login Users. </title>

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
                <h1> Login.</h1>
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
    
    if (!$db){
        // Connect to database
        $db = connectDB($DBHost, $DBUser ,$DBPasswd, $DBName );
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
            
             
    if (!isComplete) {
        punt ($errorMessage);
    }
    
      
    //Get the hashed password from the user whose email was entered.
    $query= " SELECT * FROM account WHERE email = '" . $email . "';";
    $result=  queryDB($query, $db);
    if (nTuples ($result) > 0 ) {
        // There is an account that corresponds with the email entered by the user
        //Get the hashed password for that account.
        $row = nextTuple($result);
        $hashedpass = $row['hashedpass'];
        
        //Compare entered password to the password on the database.
        if ($hashedpass == crypt($password, $hashedpass)) {
            //If we are here, we know the password was entered correcty.
            
            //Start a session
            if (session_start()) {
                $_SESSION['email'] = $email;
                header('location:sitebuild.php');
                exit;
            } else  {
                // If we cannot start a session
                punt ("Unable to Sart session while logging in.");
                
            }
        } else {
            punt ("Wrong Password. <a href = 'login.php'> Try again. </a>.");
        }
   
    } else{
        // Email entered is not in the account table.
        punt("Sorry,this email address is not in our database. <a href = 'login.php'>Try again</a>.");
    }   
}
           
?>
      
            </div>
        </div>
        
     
        <div class ="row">
             <div class = "col-xs-12">
                                 
<form action= "login.php" method ="post">
    
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
        
    <button type="submit" class="btn btn-default" name ="submit">Login</button>
</form>
                
            </div>
        </div>
               
</div>

<!-- Footer Bar -->
<?php include_once ("footer.php"); ?>
        
    </body>
    
</html>
