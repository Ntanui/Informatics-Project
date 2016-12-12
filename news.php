<?php
    include_once('config.php');
    include_once('dbutils.php');
?>

<html>
    <head>
        

        
        <title>News</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap/min.js"></script>
        
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.theme.min.css">
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
                <h1>Add News</h1>
                <a href="index.php">View site</a>
                <div class="row">
                    <div class="col-xs-12">
                        <a href="news.php">Back to Add News</a>
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
// Code to handle input from the form
//
if (isset($_POST['submit'])) {
    //Run only if the form was submitted
    
    //Get data from the form
    $newsTitle = $_POST['newsTitle'];
    $timePost = $_POST['timePost'];
    
    if (!$db){
        // Connect to database
        $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
    }
    
    
    //Checking  for input into required fields    
    $isComplete = true;
    $errorMessage = "";
    
    if (!$newsTitle) {
        $errorMessage .= "Please enter a news item Headline.";
        $isComplete = false ;   
    }   else {
            $newsTitle = makeStringsafe($db, $newsTitle);
    }
        
    if (!$timePost) {
        $errorMessage .= "Please enter your news post .";
        $timePost = false ;   
    }   else {
            $timePost = makeStringsafe($db, $timePost);
    } 
              
             
    if (!isComplete) {
        punt ($errorMessage);
    }
    
      
    //check if there's a user with the same email
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
<!-- visible title-->
        <div class="row">
            <div class="col-xs-12">
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-12">
                <form action= "news.php" method ="post">
                
                    
                <!-- title -->
                    <div class="form-group">
                        <label for="email"> Newstitle </label>
                        <input type="text" class="form-control" name ="newstitle"/>
                    </div>
                    
                <!-- news -->
                    <div class="form-group">
                        <label for=""> Article </label>
                        <textarea class="form-control" name="editbody" id="editbody" rows="10"></textarea>
                    </div>
                
                        
                    <input type="submit" name="submit"></input>
                    
                </form>
            </div>

        </div>

<!-- Table to show contents of database -->

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
    $query = "SELECT * FROM news ORDER BY newsTitle;";
    
    //Run the query
    $result = queryDB($query, $db);
    
    while($row = nextTuple($result)){
        //Each time the while loop runs,we create one row in the table.
        echo "\n <tr>";
        echo "<td>" . $row['newsTitle'] ."</td>" ;
        echo "<td>" . $row['timePost'] . "</td>" ;
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