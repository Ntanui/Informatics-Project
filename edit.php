<?php
    include_once("config.php");
    include_once("dbutils.php");
    
    //
    //
    
    if (isset($_POST['submit'])) {
        

        //get data from form
        $id = $_POST['id'];
        $orgName = $_POST['orgName'];
        $lastname = $_POST['lastname'];
        $country = $_POST['country'];


        //connect to database
        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
        
        //check for required fields
        $isComplete = true;
        $errorMessage = "";
        
        
        if(!$orgName) {
            $errorMessage .= "Please enter a organization name";
            $isComplete = false;
        } else {
            $orgName = makeStringSafe($db, $orgName);
        }
        
        
        if (!$lastname) {
            $errorMessage .= " Please enter a last name";
            $isComplete = false;
        } else {
            $title = makeStringSafe($db, $lastname);
        }


        if (!$country) {
            $errorMessage .= " Please enter a country";
            $isComplete = false;
        } else {
            $title = makeStringSafe($db, $country);
        }
        


        if (!$isComplete) {
            //if there is a problem with the data sned it back with error message
            header('Location: update.php?id=' . $id . '&errorMessage=' . $errorMessage);
        }
        
        //check that there are no other records in the database with the same scorer and year
        

        
        //check
        $query = "SELECT * FROM organization WHERE orgName='" .  $orgName . "' ADD lastname=" . $lastname .  " AND id!=". $id . ";";
        punt($query);
        $result = queryDB($query, $db);
        if (nTuples($result) >  0) {
            header('Location: update.php?id=' . $id . '&errorMessage=' . "Sorry. We already have a name by " . $orgName . " " . $lastname);
        }
        
        //
        //
        
        //according to lecture, put together sql code to insert tuple or record
        $update = "UPDATE organization SET orgName='" . $orgName . "', lastname='" . $lastname . "', country='" . $country . "' WHERE id=" . $id . ";";
        
    
        
        //run the update statement
        $result = queryDB($update, $db);
        
        header('Location: input.php');
    }
    
    
    
    
    // check if there is a GET variable
    
    if(!$_GET['id']) {
        punt('test');
        header('Location: input.php');
    }
    
    //connect to database
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    // set up a query
    $id = $_GET['id'];
    $query = "SELECT * FROM organization WHERE id=" . $id . ";";
    
    $result = queryDB($query, $db);
    
    if (nTuples($result) == 0) {
        //if no record, we can get back to input.php
        //punt("error here " . $query);
        header('Location: input.php');
        exit;
    }
    
    
    //
    //
    //
    
    $row = nextTuple($result);
    $orgName = $row['orgName'];
    $lastname = $row['lastname'];
    $country = $row['country'];
    
?>

<html>
    <head>

<title>Edit Organization</title>

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
                <h1>Edit Organization</h1>
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

<form action="update.php" method="post">
<!-- name -->
    <div class="form-group">
        <label for="orgName">First Name</label>
        <input type="text" class="form-control" name="organization name" value="<?php echo $orgName; ?>"/>
    </div>

<!-- name -->
    <div class="form-group">
        <label for="lastname">Last Name</label>
        <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>"/>
    </div>

<!-- country -->    
    <div class="form-group">
        <label for="country">Country</label>
        <input type="text" class="form-control" name="title" value="<?php echo $country; ?>"/>
    </div>
    

    
    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
    
    <button type="submit" class="btn btn-default" name="submit">Add</button>
</form>

    </body>
</html>