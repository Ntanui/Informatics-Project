<?php
    include_once("dbutils.php");
    include_once("config.php");
    // get the page we are in
    if (isset($_GET['page'])) {
        $urlTitle = $_GET['page'];
    } else {
        $urlTitle = 'home';
    }
    
    // get all the information about the page based on urlTitle
    // get a handle to the database
    $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
    $query = "select id, pageTitle, menuTitle, parent, bodyTitle, body, pageType from pages where urlTitle='" . $urlTitle . "'";
    
    $result = queryDB($query, $db);
    if ($result) {
        $numberofrows = nTuples($result);
        
        if ($numberofrows > 0) {
            $row = nextTuple($result);
            $id = $row['id'];
            $pageTitle = $row['pageTitle'];
            $menuTitle = $row['menuTitle'];
            $parent = $row['parent'];
            $bodyTitle = $row['bodyTitle'];
            $body = $row['body'];
            $pageType = $row['pageType'];
        } else {
        punt("Something went wrong when retrieving pages from the database.<p>" .
                          "This was the error: " . $db->error . "<p>", $query);
        }
    } else {
        punt("Something went wrong when retrieving pages from the database.<p>" .
                          "This was the error: " . $db->error . "<p>", $query);
    }   
?>

<!-- get basic html for starting the page here -->
<html>

<head>
    <title><?php echo $pageTitle ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="http://code.jquery.com/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>    
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
      
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />
    
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
        <a href="input.php">Edit site</a>
    </div>
</div>
    
<div class="row">
    <div class="col-xs-12">
        <div class="page-header">
            <!-- Header -->
            <h1><a href="index.php"><?php echo $siteName; ?></a></h1>
        </div>
    </div>
</div>

<!-- generate top menu bar -->
<div class="row">
    <div class="col-xs-12">
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="container-fluid">
                <ul class="nav navbar-nav lead">
<?php   
    // query to get all child pages to the parent
    // here we assume that the home page has an id=1
    $query = "select urlTitle, menuTitle from pages where parent=1";
    
    $result = queryDB($query, $db);
    if ($result) {
        $numberofrows = nTuples($result);
        
        for($i=0; $i < $numberofrows; $i++) {
            $row = nextTuple($result);
            
            if ($row['urlTitle']==$urlTitle) {
                echo "<li class='active'>";
            } else {
                echo "<li>";
            }
            echo "<a href='index.php?page=" . $row['urlTitle'] . "'>" . $row['menuTitle'] . "</a></li>\n";
        }
    } else {
        punt("Something went wrong when retrieving pages from the database.<p>" .
                          "This was the error: " . $db->error . "<p>", $query);
    }
?>
                </ul>
            </div>
        </nav>
    </div>
</div>

<!-- Generate left-side menu if necessary -->
<?php
    // use this boolean to check whether we are having this menu or not
    $leftSideMenuOn = false;
    // check if this page needs to display a left-side menu
    if ($parent > 0) {
        
        if ($parent == 1) {
            // if it's a second level page, show its children on the left side menu
            $query = "select urlTitle, menuTitle from pages where parent=" . $id . " order by menuTitle";
        } else {
            // if it's a third or lower level page, show its siblings on the left side menu
            $query = "select urlTitle, menuTitle from pages where parent=" . $parent . " order by menuTitle";
        }
        
        $result = queryDB($query, $db);
        if ($result) {
            $numberofrows = nTuples($result);
            
            if ($numberofrows > 0) {
                // if this is the case, then we show it
                $leftSideMenuOn = true;
                
                $leftSideMenu = "\t<div class='col-xs-2'>\n";
                $leftSideMenu .= "\t\t<table class='table table-hover text-left'>\n";
            
                for($i=0; $i < $numberofrows; $i++) {
                    $row = nextTuple($result);
                    
                    $leftSideMenu .= "\t\t\t<tr><td><a href='index.php?page=" . $row['urlTitle'] . "'>". $row['menuTitle'] ."</a></td></tr>\n";
                }
                
                $leftSideMenu .= "\t\t</table>\n";
                $leftSideMenu .= "\t</div>\n";
                $leftSideMenu .= "\t<div class='col-xs-10'>\n";
            } 
        }
    }
    if (!$leftSideMenuOn) {
        $leftSideMenu = "\t<div class='col-xs-12'>\n";
    }
?>

<!-- Generate breadcrumbs if necessary -->
<?php
    $breadcrumbs = "";
    
    // if this is at least a third-level page (assuming home has parent -1 and is of id 1)
    if ($parent > 1) {
        // setup the breadcrumbs
        $breadcrumbs = "<ol class='breadcrumb'>\n";
        
        $currParent = $parent;
        $innerLinks = "";
        
        // we will iterate all the way to the home page and stop when the parent = -1, meaning we got to the home page
        while ($currParent != -1) {
            // get the parent
            $query = "select urlTitle, menuTitle, parent from pages where id=" . $currParent;
            
            $result = queryDB($query, $db);
            if ($result) {
                $numberofrows = nTuples($result);
                if ($numberofrows > 0) {
                    $row = nextTuple($result);
                    
                    // add <li> item to breadcrumbs before the previous items, because we are moving up the hierarchy
                    $innerLinks = "\t\t\t<li><a href='index.php?page=" . $row['urlTitle'] . "'>" . $row['menuTitle'] . "</a></li>\n" . $innerLinks;
                    
                    $currParent = $row['parent'];
                } else {
                    $currParent = -1;
                }
            } else {
                $currParent = -1;
            }               
        }
        
        $breadcrumbs .= $innerLinks;
        $breadcrumbs .= "\t\t\t<li class='active'>" . $menuTitle . "</li>\n";
        $breadcrumbs .= "\t\t</ol>\n    ";
    }
?>

<!-- Middle area of site -->
<div class="row">
<!-- Add left-side menu if necessary -->
<?php echo $leftSideMenu; ?>
        
        <!-- This is the spot for the main content -->
        <?php echo $breadcrumbs; ?>
    <h2><?php echo $bodyTitle; ?></h2>
        <p>
           <?php echo $body; ?>
        </p>
        <?php
// render something different depending on pageType
if ($pageType=='People') {
    echo '<p>People</p>';
    // write php code to show a list of people that you entered in the database
    echo '<table class="table table-hover">
    
    <!-- headers for table -->
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Position</th>
        </tr>
    </thead>
    
    <tbody>';
    
if (!$db) {
        // connect to the database
        $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
    }
    
    //set up query to records from the table
    // ******** I was not sure about this ********
    $query="SELECT * FROM person ORDER BY lastName;";
    
    //run the query
    $result = queryDB($query, $db);
    while($row = nextTuple($result)) {
        // in the lecture, each time the while loop runs we create one row in the table
        echo "\n <tr>";
        echo "<td>" . $row['firstName'] . " " . $row['lastName'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['personType'] . "</td>";
        echo "</tr>";
    }
    
    echo '    </tbody>
</table>';
    
} elseif ($pageType=='News') {
    echo '<p>News</p>';
    // php code to show all the news (headline + text)
    echo '<table class="table table-hover">
    
    <!-- headers for table -->
    <thead>
        <tr>
            <th>News Title</th>
            <th>Article</th>
        </tr>
    </thead>
    
    <tbody>';
    
    // query database to get all news
    
        $query="SELECT * FROM news ORDER BY newsTitle;";
    
    // use a  loop to echo each headline and text
        //run the query
    $result = queryDB($query, $db);
    while($row = nextTuple($result)) {
        // in the lecture, each time the while loop runs we create one row in the table
        echo "\n <tr>";
        echo "<td>" . $row['newsTitle'] . " ";
        echo "<td>" . $row['timePost'] . "</td>";
        echo "</tr>";
    }
    
    echo '    </tbody>
</table>';
    
} elseif ($pageType=='Calendar') {
    echo $caLendar;
}   
        ?>

    </div> <!-- close content area of page-->
</div>



<!-- close container div -->


</body>
</html>

<?php
    $db->close();
?>
<?php
include_once('footer.php');
?>
</div>