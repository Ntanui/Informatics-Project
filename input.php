<?php
    include_once("dbutils.php");
    include_once("config.php");
    
    //
    // We use this bit of code to generate a list of possible parents for the data entry portion
    //
    
    // get a handle to the database
    $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
    
    // prepare sql statement
    $query = "select id, urlTitle from pages order by parent;";
    
    // execute sql statement
    $result = queryDB($query, $db);
        
    // check if it worked
    if ($result) {
        $numberofrows = nTuples($result);
        
        // this one is for input
        $selectStatement = "<select class='form-control' name='parent'>\n";
    
        // this one is for editing    
        $editselectStatement = "<select class='form-control' name='editparent' id='editparent'>\n";
        
        for ($i=0; $i<$numberofrows; $i++) {
            $row = nextTuple($result);
            $selectStatement = $selectStatement . "\t<option value='" . $row['id'] . "'>" . $row['urlTitle'] . "</option>\n";
            $editselectStatement = $editselectStatement . "\t<option value='" . $row['id'] . "'>" . $row['urlTitle'] . "</option>\n";
        }
        
        $selectStatement = $selectStatement . "</select>\n";
        $editselectStatement = $editselectStatement . "</select>\n";
    } else {
        punt("Something went wrong when retrieving pages from the database.<p>" .
                          "This was the error: " . $db->error . "<p>", $query);
    }
?>

<html>

<head>
    <title>Create Site</title>

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
        background-color: #5b87ff;
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
        background-color: #5b87ff;
    }
    input[type=reset]:hover {
        background-color: #2E9AFE;
    }
    
    div {
        border-radius: 5px;
        background-color: #eaf3ff;
        padding: 2px;
    }
    </style>


<style>
body {
    background-color: #eaf3ff;
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
            <h1>Create Website</h1>
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
                        <li class="active"><a href="input.php"><span class="glyphicon glyphicon-flag"></span> &nbsp; Create Site</a></li>
                        <li><a href="people.php"><span class="glyphicon glyphicon-user"></span> &nbsp; People</a></li>
                        <li><a href="news.php"><span class="glyphicon glyphicon-list-alt"></span> &nbsp; News</a></li>
                        <li><a href="calendar.php"><span class="glyphicon glyphicon-calendar"></span> &nbsp; Calendar</a></li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>

<div class="row">
<div class="col-xs-12">
<form action="insertpage.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="urlTitle">URL Title</label>
        <input type="text" class="form-control" name="urlTitle"/>
    </div>
    
    <div class="form-group">
        <label for="parent">Parent Page</label>
        <?php echo $selectStatement ?>
    </div>
    
    <div class="form-group">
        <label for="pageTitle">Page Title</label>
        <input type="text" class="form-control" name="pageTitle"/>
    </div>
    
    <div class="form-group">
        <label for="menuTitle">Menu Title</label>
        <input type="text" class="form-control" name="menuTitle"/>
    </div>
    
    <div class="form-group">
        <label for="bodyTitle">Body Title</label>
        <input type="text" class="form-control" name="bodyTitle"/>
    </div>
    
    <div class="form-group">
        <label for="body">Body</label>
        <textarea type="text" class="form-control" name="body" rows="5"></textarea>
    </div>
    

    <div class="form-group">
        <input type="radio" name="pageType" value="None" checked> None<br>
        <input type="radio" name="pageType" value="People"> People<br>
        <input type="radio" name="pageType" value="News"> News<br>
        <input type="radio" name="pageType" value="Calendar"> Calendar
    </div>
    
    <button type="submit" class="btn btn-default">Add</button>
    <p>
        <br/>
    </p>

    
</form>
</div> <!-- close column -->
</div> <!-- close row -->

<!---------------->
<!-- List data  -->
<!---------------->
<p>
    <br/>
    <br/>
    <h2>Pages in the database</h2>
</p>

<table class="table table-striped">
    
    <!-- Titles for table -->
    <tr>
        <td>urlTitle</td>
        <td> </td>
        <td> </td>
    </tr>
    
<?php
    // prepare sql statement
    $query = "select id, urlTitle, pageTitle, menuTitle, parent, bodyTitle, body from pages order by parent;";
    
    // execute sql statement
    $result = queryDB($query, $db);
    
    // check if it worked
    if ($result) {
        $numberofrows = nTuples($result);
        
        for($i=0; $i < $numberofrows; $i++) {
            $row = nextTuple($result);
            echo "\n <tr>";
            echo "\n <td>" . $row['urlTitle'] . "</td>";
            echo "\n <td>";
            if ($row['parent'] >= 0) {
                echo "<button type='button' onclick='deleteRecord(" . $row['id'] . ', "' .
                $row['urlTitle'] . '"' . ");'>Delete</button>";
            } else {
                echo " ";
            }
            echo "</td>";
            echo "\n <td><button type='button' onclick='" . "editRecord(" . $row['id'] . ', "' .
                $row['urlTitle'] . '", "' . $row['pageTitle'] . '", "' . $row['menuTitle'] .
                '", "' . $row['bodyTitle'] . '", ' . str_replace('\'', '&#39;', json_encode($row['body'])) . ', "' . $row['parent'] . '"' . ");'>Edit</button></td>";
            echo "\n </tr>";
        }
        
    } else {
        punt("Something went wrong when retrieving pages from the database.<p>" .
                          "This was the error: " . $db->error . "<p>", $query);
    }
    
    $db->close();
    
?>    
    
</table>

</div> <!-- Closing container div -->

<!-- Code for editing form -->
<div id="dialog-form" title="Edit page" style="display: none">
<form>
    <fieldset>
    <div class="form-group">
        <label for="editurlTitle">URL Title</label>
        <input type="text" class="form-control" name="editurlTitle" id="editurlTitle"/>
    </div>
    
    <div class="form-group">
        <label for="editparent">Parent Page</label>
        <?php echo $editselectStatement ?>
    </div>
    
    <div class="form-group">
        <label for="editpageTitle">Page Title</label>
        <input type="text" class="form-control" name="editpageTitle" id="editpageTitle"/>
    </div>
    
    <div class="form-group">
        <label for="editmenuTitle">Menu Title</label>
        <input type="text" class="form-control" name="editmenuTitle" id="editmenuTitle"/>
    </div>
    
    <div class="form-group">
        <label for="editbodyTitle">Body Title</label>
        <input type="text" class="form-control" name="editbodyTitle" id="editbodyTitle"/>
    </div>
    
    <div class="form-group">
        <label for="editbody">Body</label>
        <textarea class="form-control" name="editbody" id="editbody" rows="5"></textarea>
    </div>
    
    <input type="hidden" name="editid" id="editid"/>
    </fieldset>
</form>    
    


</body>



<script>
    
    // confirm that a user wants to delete, then call php script to do deletion
    function deleteRecord(id, name) {
        // delete record from pages table identified by id, if user agrees
        var decision = confirm("Would you like to delete " + name + "?");
        if (decision === true) {
            var xmlhttp = new XMLHttpRequest();
            
            // this part of code receives a response from deleteperson.php 
            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    if(xmlhttp.responseText == "Page deleted") {
                        location.reload();
                    } else {
                        alert("Unsuccessful delete: " + xmlhttp.responseText);
                    }
                }
            };
            
            // this sends the data request to deleteperson.php
            xmlhttp.open("POST", "deletepage.php", true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send("id=" + id);
        }
    }
    
    // pop up a form to edit a record that provides option to cancel or save changes
    function editRecord(id, urlTitle, pageTitle, menuTitle, bodyTitle, body, parent) {
        document.getElementById("editurlTitle").value = urlTitle;
        document.getElementById("editpageTitle").value = pageTitle;
        document.getElementById("editbodyTitle").value = bodyTitle;
        document.getElementById("editmenuTitle").value = menuTitle;
        document.getElementById("editbody").value = body;
        
        if (parent == -1) {
            $("#editparent").hide();
        } else {
            $("#editparent").show();
        }
        document.getElementById("editparent").value = parent;
        
        document.getElementById("editid").value = id;
        
        $("#dialog-form").dialog("open");        
    }
    
    $("#dialog-form").dialog(
        {
            autoOpen: false,
            height: 700,
            width: 600,
            modal: true,
            buttons: {
                "Save": function() {
                    var xmlhttp = new XMLHttpRequest();
            
                    // this part of code receives a response from editpage.php 
                    xmlhttp.onreadystatechange=function() {
                        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                            if(xmlhttp.responseText == "Page edited") {
                                location.reload();
                            } else {
                                alert("Unsuccessful save: " + xmlhttp.responseText);
                                location.reload();
                            }
                        }
                    };
                                      
                    // this sends the data request to deleteperson.php
                    xmlhttp.open("POST", "editpage.php", true);
                    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    
                    // get variables
                    var editurlTitle = document.getElementById("editurlTitle").value;
                    var editpageTitle = document.getElementById("editpageTitle").value;
                    var editbodyTitle = document.getElementById("editbodyTitle").value;
                    var editmenuTitle = document.getElementById("editmenuTitle").value;
                    var editbody = document.getElementById("editbody").value;
                    var editparent = document.getElementById("editparent").value;
                    var editid = document.getElementById("editid").value;
                    
                    // send data to editpage.php
                    xmlhttp.send("id=" + editid + "&urlTitle=" + editurlTitle + "&pageTitle=" + editpageTitle + "&bodyTitle=" +
                                 editbodyTitle + "&menuTitle=" + editmenuTitle + "&body=" + editbody + "&parent=" + editparent);
                },
                "Cancel": function() {
                    $(this).dialog("close");       
                }
            }
        }
                             
                             );
    
    
</script>

</html>