<?php
	$title = "Build Your Site";
	$menuHighlight = 0;
	include_once("header.php");

?>

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


            
<div class="container" style="width: 1024px">
        
        <div class="row">
            <div class="col-sm-9 col-xs-12">   
        <div class="center-block">
        
			<div class="panel-body">
				<a href="input.php">
				<input type="button" value="Create A Site" class="btn btn-primary btn-lg btn-block col-lg-1">
				</a>
				<a href="people.php">
				<input type="button" value="Create New User" class="btn btn-default btn-lg btn-block center-block col-lg-1">
				</a>
				<a href="index.php">
				<input type="button" value="View your Site" class="btn btn-default btn-lg btn-block center-block col-lg-1">
				</a>

        </div>

<?php
	include_once("footer.php");
?>