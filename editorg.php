<?php
    include_once("config.php");
    include_once("dbutils.php");
    
    //
    //
    
    if (isset($_POST['submit'])) {
        

        //get data from form
        $id = $_POST['id'];
        $orgName = $_POST['orgName'];
        $contactInfo = $_POST['contactInfo'];
        $adMininfo = $_POST['adMininfo'];


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
        
        
        if (!$contactInfo) {
            $errorMessage .= " Please enter contact info";
            $isComplete = false;
        } else {
            $title = makeStringSafe($db, $contactInfo);
        }


        if (!$adMininfo) {
            $errorMessage .= " Please enter Adminstrator's Name";
            $isComplete = false;
        } else {
            $title = makeStringSafe($db, $adMininfo);
        }
        


        if (!$isComplete) {
            //if there is a problem with the data send it back with error message
            header('Location: about.php?id=' . $id . '&errorMessage=' . $errorMessage);
        }
        
        //check that there are no other records in the database with the same organization and contact info
        

        
        //check
        $query = "SELECT * FROM organization WHERE orgName='" .  $orgName . "' ADD contactInfo=" . $contactInfo .  " AND id!=". $id . ";";
        punt($query);
        $result = queryDB($query, $db);
        if (nTuples($result) >  0) {
            header('Location: editorg.php?id=' . $id . '&errorMessage=' . "Sorry. We already have an organizaion named  " . $orgName . " with contact info " . $contactInfo);
        }
        
        //
        //
        
        //according to lecture, put together sql code to insert tuple or record
        $update = "UPDATE organization SET orgName='" . $orgName . "', contactInfo='" . $contactInfo . "', adMininfo='" . $adMininfo . "' WHERE id=" . $id . ";";
        
    
        
        //run the update statement
        $result = queryDB($update, $db);
        
        header('Location: about.php');
    }
    
    
    
    
    // check if there is a GET variable
    
    if(!$_GET['id']) {
        punt('test');
        header('Location: about.php');
    }
    
    //connect to database
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    // set up a query
    $id = $_GET['id'];
    $query = "SELECT * FROM organization WHERE id=" . $id . ";";
    
    $result = queryDB($query, $db);
    
    if (nTuples($result) == 0) {
        //if no record, we can get back to about.php
        //punt("error here " . $query);
        header('Location: about.php');
        exit;
    }
    
    
    //
    //
    //
    
    $row = nextTuple($result);
    $orgName = $row['orgName'];
    $contactInfo = $row['contactInfo'];
    $adMininfo = $row['adminInfo'];
    
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

<form action="editorg.php" method="post">
<!-- name -->
    <div class="form-group">
        <label for="orgName">First Name</label>
        <input type="text" class="form-control" name="organization name" value="<?php echo $orgName; ?>"/>
    </div>

<!-- contact -->
    <div class="form-group">
        <label for="Contact info">Contact Info</label>
        <input type="email" class="form-control" name="contactinfo" value="<?php echo $contactInfo; ?>"/>
    </div>

<!-- Admin -->    
    <div class="form-group">
        <label for="Adminstrator">Admin Info</label>
        <input type="text" class="form-control" name="title" value="<?php echo $adMininfo; ?>"/>
    </div>
    

    
    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
    
    <button type="submit" class="btn btn-default" name="submit">Add</button>
</form>

    </body>
</html>