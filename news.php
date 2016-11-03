
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
        <div class="container">
            
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-header">
                    <h1>News</h1>
                    </div>
                </div> 
            </div>
            
            <div class="row">
                <div class="col-xs-12">
                    <div class="navbar navbar-inverse">
                        <div class="container-fluid">
                        <ul class="nav nav-pills">
                            <li><a href="calendar.php"><span class="glyphicon glyphicon-calendar"></span> &nbsp; Calendar</a></li>
                            <li><a href="people.php"><span class="glyphicon glyphicon-user"></span> &nbsp; People</a></li>
                            <li class="active"><a href="news.php"><span class="glyphicon glyphicon-list-alt"></span> &nbsp; News</a></li>
                            <li><a href="about.php"><span class="glyphicon glyphicon-flag"></span> &nbsp; About</a></li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-9 col-xs-12">
                    
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
                <label for="artice">Article</label>
                <input type="text" class="form-control" name="article"/>
            </div>
           
        <!-- link -->
            <div class="form-group">
                <label for="link">Link</label>
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