<?php
    include_once("config.php");
    include_once("dbutils.php");
    
    //
    //
    
    if (isset($_POST['submit'])) {
        
        
        //get data from form
        $id = $_POST['id'];
        $delete = $_POST['delete'];

        if ($delete == 'yes') {
            //connect to database
            $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
    
            // If we get here, we can go ahead and delete the record
            //
            
            //according to lecture, put together sql code to insert tuple or record
            $delete = "DELETE FROM organization WHERE id=" . $id . ";";
        
            
            //run the update statement
            $result = queryDB($delete, $db);
        }
        
        header('Location: about.php');
        exit;
    }

    //connect to database
    $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);  
    // check if there is a GET variable
    

    // set up a query
    $id = $_GET['id'];
    $query = "SELECT * FROM organization WHERE id=" . $id;
    
    // run query
    $result = queryDB($query, $db);
    
    if (nTuples($result) == 0) {
        //if no record, we can get back to input.php
        //punt("error here " . $query);
        header('Location: about.php');
        exit;
        
    }

    
    $row = nextTuple($result);
    $orgName = $row['orgName'];
    $contactInfo = $row['contactInfo'];

?>

<html>
    <head>

<title>Delete Organization Information</title>

<!-- this is the code from bootstrap -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
    </head>
    
    <body>
        
        
<!-- visible title-->
        <div class="row">
            <div class="col-xs-12">
                <h1>Delete Organization Information</h1>
            </div>
        </div>
        
        
<!-- spot for errors if any -->
        <div class="row">
            <div class="col-xs-12">
                <p>
                    <?php
                        if($_GET['errorMessage']) {
                            echo $_GET['errorMessage'];
                        }
                    ?>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <p>
                    Do you want to delete organization information <?php echo $orgName . " " . $contactInfo; ?>?
                </p>
            </div>
        </div>

<form action="deleteorg.php" method="post">

    <div class="radio">
        <label>
            <input type="radio" name="delete" id="optionsRadios1" value="yes" checked>
            Yes
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="delete" id="optionsRadios1" value="no" checked>
            No
        </label>
    </div>
    
    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
    
    <button type="submit" class="btn btn-default" name="submit">Submit</button>
</form>

    </body>
</html>