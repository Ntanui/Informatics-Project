<html lang="en">
<head>

	<title>
		<?php echo($title); ?>
	</title>

	 <meta name="viewport" content="width=device-width,initial-scale=1.0">
     
     <script src="//code.jquery.com/jquery.min.js"></script>
     <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     
     <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
     <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" rel="stylesheet">
     <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
     <link href="bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
</head>
<body>

	<div class="container">
    	
        <div class="row">
            <div class="col-xs-12">
            	<div class="page-header">
                <h1>
					<?php echo($title); ?>
				</h1>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-12">
                <div class="navbar navbar-inverse">
                	<div class="container-fluid">
                        <ul class="nav nav-pills">
                            <li <?php
								if($menuHighlight == 0)
								{
									echo('class="active"');
								}
								?>
							><a href="index.php"><span class="glyphicon glyphicon-home"></span>&nbsp; Home</a></li>
                          	<li <?php
								if($menuHighlight == 1)
								{
									echo('class="active"');
								}
								?>
							><a href="dogepic.php"><span class="glyphicon glyphicon-user"></span>&nbsp; Administrator</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>