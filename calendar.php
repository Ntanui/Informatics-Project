<html>
    <head>
        <title>Calendar</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap/min.js"></script>
        
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.theme.min.css">
    </head>
    <style>
    input[type=text], select {
        width: 100%;
        padding: 12px 10px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    
    input[type=submit] {
        width: 100%;
        background-color: #2E9AFE;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    
    input[type=reset] {
        width: 100%;
        background-color: #2E9AFE;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    
    input[type=submit]:hover {
        background-color: #2E9AFE;
    }
    input[type=reset]:hover {
        background-color: #2E9AFE;
    }
    
    div {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 2px;
    }
    </style>
    
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
                    <h1>Calendar</h1>
                    <a href="index.php">View site</a>
                </div>
            </div>  
        </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="navbar navbar-inverse">
                        <div class="container-fluid">
                        <ul class="nav nav-pills">
                            <li><a href="about.php"><span class="glyphicon glyphicon-home"></span> &nbsp; Organization</a></li>
                            <li><a href="input.php"><span class="glyphicon glyphicon-flag"></span> &nbsp; Edit Page</a></li>
                            <li><a href="people.php"><span class="glyphicon glyphicon-user"></span> &nbsp; People</a></li>
                            <li><a href="news.php"><span class="glyphicon glyphicon-list-alt"></span> &nbsp; News</a></li>
                            <li class="active"><a href="calendar.php"><span class="glyphicon glyphicon-calendar"></span> &nbsp; Calendar</a></li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-9 col-xs-12">
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-9 col-xs-12">
                    
                    <p>
                        Calendar
                    </p>
                    <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=norman-tanui%40uiowa.edu&amp;color=%231B887A&amp;ctz=America%2FChicago" style="border-width:0" width="750" height="600" frameborder="0" scrolling="no"></iframe>    
                </div>
                
                <div class="col-sm-3 col-xs-12">                             
                    <div class="palen panel-default">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                        <body>
                        
                        <div class="w3-container">
                          <h1>Stay Simple!</h1>
                        
                          <div class="w3-panel w3-card-4 w3-light-grey" style="width:100%">
                            <p class=" w3-large w3-serif">
                            <i class="fa fa-quote-right w3-xxlarge w3-text-red"></i><br>
                            You are able to create your own organization website by simply entering the name and website. This is a great way to modify or delete the information instantly</p>
                          </div>
                        </div>
                        
                        </body>
                    </div>
                </div>
                 
            </div>   
            
            
        </div> 
        
    
    </body>

</html>
<?php
include_once("footer.php");
?>