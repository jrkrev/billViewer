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
        <h3>billViewer</h3>
        <p>Navigate using the top menu to view, add, or delete
            recipients, companies, accounts, and bills.</p>
        <p>This project uses HTML, PHP, CSS, JavaScript, jQuery, Ajax, 
            and MySQL. </p>
        <h3>How to Use</h3>
        <p>A MySQL server must be running on the local host. Execute the script
           "RUN_ONLY_ONCE.sql" found in the "SQL script" folder as root before 
           using. This will create the billViewerDB and a billViewerUser that 
           accesses the database. From there, the database can be populated 
           using the forms found in this application.</p>
        </div>
    </body>
</html>
