<?php
    include_once('config.php');
    include_once('dbutils.php');
    
?>

<html>
    <head>
        <title>Organization</title>
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
                    <h1>Edit Organization</h1>
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
                            <li class="active"><a href="about.php"><span class="glyphicon glyphicon-home"></span> &nbsp; Organization</a></li>
                            <li><a href="input.php"><span class="glyphicon glyphicon-flag"></span> &nbsp; Edit Page</a></li>
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
        $errorMessage .= "Please enter a Organization Name";
        $isComplete = false;
    } else {
        $orgName = makeStringSafe($db, $orgName);
    }
    
    if (!$contactInfo) {
        $errorMessage .= " Please enter a Contact Information";
        $isComplete = false;
    } else {
        $contactInfo = makeStringSafe($db, $contactInfo);
    }
    if (!$adMininfo) {
        $errorMessage .= " Please enter Administrator Name";
        $isComplete = false;
    } else {
        $adMininfo = makeStringSafe($db, $adMininfo);
    }
     
    if (!$isComplete) {
        punt($errorMessage);
    }
    
    
    //check
    $query = "SELECT * FROM organization WHERE orgName='" .  $orgName . "' AND contactInfo='" . $contactInfo . "' AND adMininfo='" . $adMininfo . "';";
    $result = queryDB($query, $db);
    if (nTuples($result) >  0) {
        punt("Sorry. We already have a organization name called " . $orgName . " " . $contactInfo);
    }
    
    //according to lecture, put together sql code to insert tuple or record
    $insert = "INSERT INTO organization (orgName, contactInfo ,adMininfo) VALUES ('" . $orgName . "', '" . $contactInfo . "', '" . $adMininfo . "');";
    
    
    //run the insert statement
    $result = queryDB($insert, $db);
    
    //we have successfully inserted the record
    echo ("Successfully entered " . $orgName . " " . $contactInfo . " into the database.");
    
    //maybe delete this line
    //echo $insert;
    
    //echo ("Name: " . $name . ". Location: " . $location . ". URL: " . $url);
    //until here maybe delete
}
?>

                    <p>Edit Organization</p>
                    
                    <form action="people.php" method="post">
                        
                        <div class="form-group">
                            <label for="title">Organization Name</label>
                            <input type="text" class="form-control" name="title"/>
                        </div>
            
                        <div class="form-group">
                            <label for="artice">Contact Information</label>
                            <input type="text" class="form-control" name="article"/>
                        </div>
                       
                        <div class="form-group">
                            <label for="link">Administrator Name</label>
                            <input type="text" class="form-control" name="link"/>
                        </div>
                        
                        <button type="submit" class="btn btn-default" name="submit">Add</button>
                    </form>
                </div>
                                    
                <div class="col-sm-3 col-xs-12">
                    
                    <div class="palen panel-default">
                        <div class="panel-heading">
                        Welcome
                        </div>
                        <div class="panel-body">
                            Please edit the organization information
                        </div>
                    </div>
                </div>
                 
            </div>
            
            
            <!-- table to show contents-->     
<div class="row">
    <div class="col-xs-12">
<table class="table table-hover">
    
    <!-- headers gor table -->
    <thead>
        <tr>
            <th>Organization Name</th>
            <th>Contact Information</th>
            <th>Admnistrator Information</th>
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
        echo "<td>" . $row['adMininfo'] . "</td>";
        echo "<td><a href='edit.php?id=" . $row['id'] . "'>edit</a></td>";
        echo "<td><a href='delete.php?id=" . $row['id'] . "'>delete</a></td>";
        echo "</tr>";
    }
?>
             
    </tbody>
</table>
        
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
        
    
    </body>

</html>