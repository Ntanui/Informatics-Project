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
								<div class="row">
									<div class="col-xs-12">
										<div class="navbar navbar-inverse">
											<div class="container-fluid">
											<ul class="nav nav-pills">
												<li><a href="about.php"><span class="glyphicon glyphicon-home"></span> &nbsp; Organization</a></li>
												<li class="active"><a href="input.php"><span class="glyphicon glyphicon-flag"></span> &nbsp; Create Site</a></li>
												<li><a href="people.php"><span class="glyphicon glyphicon-user"></span> &nbsp; People</a></li>
												<li><a href="news.php"><span class="glyphicon glyphicon-list-alt"></span> &nbsp; News</a></li>
												<li><a href="calendar.php"><span class="glyphicon glyphicon-calendar"></span> &nbsp; Calendar</a></li>
											</ul>
											</div>
										</div>
									</div>
								</div>                     
							</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>