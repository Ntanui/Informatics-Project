<html>
    <head>
        <title>Calendar</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap/min.js"></script>
        
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.theme.min.css">
    </head>
    <body>
        <div class="container">
            
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-header">
                    <h1>Calendar</h1>
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
            
            <div class="row">
                <div class="col-sm-9 col-xs-12">
                    
                    <p>
                        Calendar
                    </p>
                    <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=norman-tanui%40uiowa.edu&amp;color=%231B887A&amp;ctz=America%2FChicago" style="border-width:0" width="800" height="600" frameborder="0" scrolling="no"></iframe>    
                </div>
                
                <div class="col-sm-4 col-xs-12">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        Upcoming events
                        </div>
                        <div class="panel-body">
                            Please contact our administrator for further information
                        </div>
                    </div>
                </div>
                 
            </div>   
            
            
            
            <div class="row">
                <div class="col-xs-12">
                    
                    <div class="panel panel-default">
                        <div class="panel panel-body">
                            Administrator contact information: Admin@uiowa.edu
                        </div>
                    </div>
                </div>
            </div>
            
        </div> 
        
    
    </body>

</html>
<?php
include_once("footer.php");
?>