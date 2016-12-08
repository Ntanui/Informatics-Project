
<html>
    <head>
        <title>Calendar</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap/min.js"></script>
        
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.theme.min.css">
    </head>
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
                    <h1>Choose Calendar</h1>
                    <a href="index.php">View site</a>
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="site.php">Back to creating site</a>
                        </div>
                    </div>
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
                            <li><a href="news.php"><span class="glyphicon glyphicon-list-alt"></span> &nbsp; News</a></li>
                            <li class="active"><a href="calendar.php"><span class="glyphicon glyphicon-calendar"></span> &nbsp; Calendar</a></li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-9 col-xs-12">

                
<?php
//
// Code to handle input from the form
//
if (isset($_POST['submit'])) {
    //Run only if the form was submitted
    
    //Get data from the form
    $orgName = $_POST['orgName'];
    $caLink = $_POST['caLink'];
    
    if (!$db){
        // Connect to database
        $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
    }
    
    
    //Checking  for input into required fields    
    $isComplete = true;
    $errorMessage = "";
    
    if (!$email) {
        $errorMessage .= "Please enter your organization name.";
        $isComplete = false ;   
    }   else {
            $email = makeStringsafe($db, $email);
    }
        
    if (!$password) {
        $errorMessage .= "Please enter your calendar link.";
        $isComplete = false ;   
    }  
              
             
    if (!isComplete) {
        punt ($errorMessage);
    }
    
      
    //check if there's a user with the same email
    $query= " SELECT * FROM news WHERE orgName = '" . $orgName . "';";
    $result=  queryDB($query, $db);
    if (nTuples ($result) > 0 ) {
        // This means a director with the same email.
        punt ("Sorry we have already have a calendar link for an organization named " . $orgName );
   
    }
    
    
    // Sql code to insert tuple or record
    $insert = "INSERT INTO organization(orgName,caLink) VALUES ('" . $orgName . "' , '" . $caLink . "');";
    
    
    //run the insert statement
    $result = queryDB($insert, $db);
    
    //If no errors, record has been succesfully Inserted.
    
    echo ("Succesfully entered a calendar " . $orgName."'s link in the Database");
    
        }
           
?>
<!-- visible title-->
        <div class="row">
            <div class="col-xs-12">
                <h1>Insert Calendar</h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-12">
                <form action= "calendar.php" method ="post">
                
                    
                <!-- title -->
                    <div class="form-group">
                        <label for="email"> Name </label>
                        <input type="text" class="form-control" name ="newstitle"/>
                    </div>
                    
                <!-- news -->
                    <div class="form-group">
                        <label for=""> Personal Calendar address </label>
                        <input type="text" class="form-control" name ="newstitle"/>
                    </div>
                
                        
                    <button type="submit" class="btn btn-default col-xs-12" name ="submit">Post</button>
                    
                </form>
            </div>

        </div>
                    <p>
                        Calendar
                    </p>
                </div>
                
                <div class="col-sm-3 col-xs-12">
                    
                    <div class="palen panel-default">
                        <div class="panel-heading">
                        Upcoming events
                        </div>
                        <div class="panel-body">
                            Please contact administrator for more information
                        </div>
                    </div>
                </div>
                 
            </div>   
            
            
            
            <div class="row">
                <div class="col-xs-12">
                    
                    <div class="panel panel-default">
                        <div class="panel panel-body">
                            Administrator contact information: something@uiowa.edu
                        </div>
                    </div>
                </div>
            </div>
            
        </div> 

<div class = "row">
    <div class ="col-xs-12">
<table class = "table table-hover">
    
    <!-- Headers for table -->

    
    <tbody>
<?php
    if (!$db){
        // Connect to database
        $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
    }
    // Set up query to get all records from users table.
    $query = "SELECT * FROM organization ORDER BY orgName;";
    
    //Run the query
    $result = queryDB($query, $db);
    
    while($row = nextTuple($result)){
        //Each time the while loop runs,we create one row in the table.
        echo "\n <tr>";
        echo "<td>" . $row['orgName'] ."</td>" ;
        echo "<td>" . $row['caLink'] . "</td>" ;
        echo "</tr>";
    }
?>
    </tbody>   
</table>
        
    </div>
    
</div>
    
    </body>

</html>