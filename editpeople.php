<html>
    <head>

<title>Enter Member</title>
<!-- this is the code from bootstrap -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
    </head>
    
    <body>

<div class="container" style="width: 1024px">
          
        <div class="row">
            <div class="col-xs-12">
                <div class="navbar navbar-inverse">
                    <div class="container-fluid">
                    <ul class="nav nav-pills">
                        <li class="active"><a href="people.php"><span class="glyphicon glyphicon-user"></span> &nbsp; Edit People</a></li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
            
        
        <div class="row">
            <div class="col-sm-9 col-xs-12">
<?php
    include_once("config.php");
    include_once("dbutils.php");
    
    //
    //
    
    if (isset($_POST['submit'])) {
        
        //get data from form
        $id = $_POST['id'];
        $firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $personType = $_POST['personType'];
        //connect to database
    $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
        
        //check for required fields
        $isComplete = true;
        $errorMessage = "";
        
        
        if(!$firstName) {
            $errorMessage .= "Please enter a Firstname";
            $isComplete = false;
        } else {
            $firstName = makeStringSafe($db, $firstName);
        }
        
		if(!$lastName) {
            $errorMessage .= "Please enter a Lastname";
            $isComplete = false;
        } else {
            $lastName = makeStringSafe($db, $lastName);
        }
        
        if (!$email) {
            $errorMessage .= " Please enter an email address";
            $isComplete = false;
        } else {
            $email = makeStringSafe($db, $email);
        }
        if (!$personType) {
            $errorMessage .= " Please enter the Member Type(Either Admin or Member)";
            $isComplete = false;
        } else {
            $personType = makeStringSafe($db, $personType);
        }
        
        if (!$isComplete) {
            //if there is a problem with the data send it back with error message
            header('Location: people.php?id=' . $id . '&errorMessage=' . $errorMessage);
        }
        
        //check that there are no other records in the database with the same organization and contact info
        
        
        //check
        $query = "SELECT * FROM person WHERE firstName='" .  $firstName . "' ADD lastName=" . $lastName .  " AND id!=". $id . ";";
        punt($query);
        $result = queryDB($query, $db);
        if (nTuples($result) >  0) {
            header('Location: editpeople.php?id=' . $id . '&errorMessage=' . "Sorry. We already have an person named  " . $firstName . " , " . $lastName);
        }
        
        //
        //
        
        //according to lecture, put together sql code to insert tuple or record
        $update = "UPDATE person SET firstName='" . $firstNameName . "', lastName='" . $lastName . "', email='" . $email . "' WHERE id=" . $id . ";";
        
    
        
        //run the update statement
        $result = queryDB($update, $db);
        
        header('Location: people.php');
    }
    
    
    
    
    // check if there is a GET variable
    
    if(!$_GET['id']) {
        punt('test');
        header('Location: people.php');
    }
    
    //connect to database
    $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
    
    // set up a query
    $id = $_GET['id'];
    $query = "SELECT * FROM person WHERE id=" . $id . ";";
    
    $result = queryDB($query, $db);
    
    if (nTuples($result) == 0) {
        //if no record, we can get back to about.php
        //punt("error here " . $query);
        header('Location: people.php');
        exit;
    }
    
    
    //
    //
    //
    
    $row = nextTuple($result);
				$row['firstName'] . " " . $row['lastName'] . "</td>";
				$row['email'] . "</td>";
				$row['personType'] . "</td>";
    
?>

<html>
    <head>

<title>Update People</title>

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
                <h1>Edit People</h1>
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

<form action="editpeople.php" method="post">
<!-- name -->
    <div class="form-group">
        <label for="firstName">First Name</label>
        <input type="text" class="form-control" name="First name" value="<?php echo $firstName; ?>"/>
    </div>
	
<!-- name -->
    <div class="form-group">
        <label for="lastName">Last Name</label>
        <input type="text" class="form-control" name="Last name" value="<?php echo $lastName; ?>"/>
    </div>

<!-- contact -->
    <div class="form-group">
        <label for="Contact info">Email</label>
        <input type="email" class="form-control" name="email" value="<?php echo $email; ?>"/>
    </div>

<!-- Admin -->    
    <div class="form-group">
        <label for="personType">Member Type</label>
        <input type="text" class="form-control" name="personType" value="<?php echo $personType; ?>"/>
    </div>
    

    
    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
    
    <button type="submit" class="btn btn-default" name="submit">Update</button>
</form>

    </body>
</html>