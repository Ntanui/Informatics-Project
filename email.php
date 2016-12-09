
<html>
<head>
    <title>Email</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap/min.js"></script>
        
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.theme.min.css">
</head>
<body>

<h2>Send e-mail to Administrator</h2>

<form action="mailto:administrator@gmail.com" method="post" enctype="text/plain">
Your Name:<br>
<input type="text" name="name"><br>
Your E-mail:<br>
<input type="text" name="mail"><br>
Comment:<br>
<textarea class="form-control" name="comment" id="comment" rows="5"></textarea>
<input type="submit" value="Send">
<input type="reset" value="Reset">
</form>

</body>
</html>
