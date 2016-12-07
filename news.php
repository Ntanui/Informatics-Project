
<html>
    <head>
        <title>News</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap/min.js"></script>
        
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.theme.min.css">
    </head>
    <body>
    <div class="container" style="width: 1024px">
    
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <!-- Header -->
                <h1>Add News</h1>
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
                            <li><a href="input.php"><span class="glyphicon glyphicon-home"></span> &nbsp; Edit Page</a></li>
                            <li><a href="people.php"><span class="glyphicon glyphicon-user"></span> &nbsp; People</a></li>
                            <li class="active"><a href="news.php"><span class="glyphicon glyphicon-list-alt"></span> &nbsp; News</a></li>
                            <li><a href="calendar.php"><span class="glyphicon glyphicon-calendar"></span> &nbsp; Calendar</a></li>
                            <li><a href="about.php"><span class="glyphicon glyphicon-flag"></span> &nbsp; Administrator</a></li>
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
    $newsTitle = $_POST['newsTitle'];
    $contactInfo = $_POST['timePost'];
    $preview = $_POST['preview'];
    
    //connect to database
    $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
    //check for required fields
    $isComplete = true;
    $errorMessage = "";
    
    if(!$newsTitle) {
        $errorMessage .= "Please enter a News Title";
        $isComplete = false;
    } else {
        $newsTitle = makeStringSafe($db, $newsTitle);
    }
    
    if (!$timePost) {
        $errorMessage .= " Please enter a URL Post";
        $isComplete = false;
    } else {
        $timePost = makeStringSafe($db, $timePost);
    }
    if (!$preview) {
        $errorMessage .= " Please enter a short preview";
        $isComplete = false;
    } else {
        $preview = makeStringSafe($db, $preview);
    }
     
    if (!$isComplete) {
        punt($errorMessage);
    }
    
    
    //check
    $query = "SELECT * FROM person WHERE newsTitle='" .  $newsTitle . "' AND timePost='" . $timePost . "' AND preview='" . $preview . "';";
    $result = queryDB($query, $db);
    if (nTuples($result) >  0) {
        punt("Sorry. We already have a news name called " . $newsTitle . " " . $timePost);
    }
    
    //according to lecture, put together sql code to insert tuple or record
    $insert = "INSERT INTO person (newsTitle, timePost ,preview) VALUES ('" . $newsTitle . "', '" . $timePost . "', '" . $preview . "');";
    
    
    //run the insert statement
    $result = queryDB($insert, $db);
    
    //we have successfully inserted the record
    echo ("Successfully entered " . $newsTitle . " " . $timePost . " into the database.");
    
    //maybe delete this line
    //echo $insert;
    
    //echo ("Name: " . $name . ". Location: " . $location . ". URL: " . $url);
    //until here maybe delete
}
?>
                    
                    <p>
                        News
                    </p>
                    
        <form action="people.php" method="post">
            
        <!-- Title -->
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title"/>
            </div>

        <!-- article -->
            <div class="form-group">
                <label for="artice">Link</label>
                <input type="text" class="form-control" name="article"/>
            </div>
           
        <!-- link -->
            <div class="form-group">
                <label for="link">Preview</label>
                <input type="text" class="form-control" name="link"/>
            </div>
            
            <button type="submit" class="btn btn-default" name="submit">Add</button>
        </form>            
                        
                    
                </div>
                
                <div class="col-sm-3 col-xs-12">
                    
                    <div class="palen panel-default">
                        <div class="panel-heading">
                        Most recent News
                        </div>
                        <div class="panel-body">
                            News are related to the organization
                        </div>
                    </div>
                </div>
                 
            </div>   

<div class="row">
    <div class="col-xs-12">
<table class="table table-hover">
    
    <!-- headers gor table -->
    <thead>
        <tr>
            <th>Title</th>
            <th>Link</th>
            <th>Preview</th>
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
    $query="SELECT * FROM person ORDER BY orgName;";
    
    //run the query
    $result = queryDB($query, $db);
    while($row = nextTuple($result)) {
        // in the lecture, each time the while loop runs we create one row in the table
        echo "\n <tr>";
        echo "<td>" . $row['newsTitle'] . "</td>";
        echo "<td>" . $row['timePost'] . "</td>";
        echo "<td>" . $row['preiew'] . "</td>";
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