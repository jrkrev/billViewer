<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/style.css" rel="stylesheet"/> 
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
    </head>
    <body background="background-1.jpeg">
        
        
        <?php
            require_once("script/structure.php");
            CreateTitleBar();
            CreateNavigationBar();
             
        ?>
        <div class ="mainDiv">
        <h3>Bill Tracker</h3>
        <p>Navigate using the top menu to view bills or add recipients,
            companies, accounts, and bills. Bills can also be deleted.</p>
        </div>
    </body>
</html>
