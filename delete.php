<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/style.css" rel="stylesheet"/> 
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
    </head>
    <body>
        <?php
            require_once("script/structure.php");
            CreateNavigationBar();
            
            $connection = "mysql:host=localhost;dbname=bdDB_";
            $user = "root";
            $pwd = "mysql";
           
            $db = new PDO($connection, $user, $pwd);
        ?>
        
        <div class ="mainDiv">
        <div id ="deleteMenu">
        <h3>Select Bill for Deletion</h3>
        <select id="billDeleteID">
        <option disabled selected>Select Bill for Deletion</option>
        
        <?php
        $query = $db->query("SELECT billID, companyName, billAmount, "
                        .   "billDate FROM bill b JOIN account a ON "
                        .   "b.accountID = a.accountID JOIN company c ON "
                        .   "a.companyID = c.companyID");
        while($row = $query->fetch())
        {
            echo "<option value=" . $row["billID"] . ">" 
                    . $row["companyName"] . " - " . $row["billAmount"]
                    . " - " . $row["billDate"] . "</option>";
        }
        ?>
        </select>
        
        <button type="button" id="deleteBillButton">Delete Bill</button>
        </div>
        <div id ="deletedMessage" style="display:none">
        <p>Bill deleted.</p>
        </div>
        </div>
    </body>
</html>
