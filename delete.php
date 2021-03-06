<!DOCTYPE html>
<!-- billViewer - Delete record page -->
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
            require_once("script/dbConnection.php");
            CreateTitleBar();
            CreateNavigationBar();
        ?>
        
        <div class ="mainDiv">
            
        <h3>Select Delete Type</h3>
        <select id="deleteType">
            <option disabled selected>Select Delete Type</option>
            <option value="recipient">Delete Recipient</option>
            <option value="company">Delete Company</option>
            <option value="account">Delete Account</option>
            <option value="bill">Delete Bill</option>
        </select>    
        
        <p id="deleteError"></p>
        
        <!-- Delete Bill Div -->
        
        <div id ="deleteBillDiv" style="display:none">
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
        
        <!-- Delete Account Div -->
        
        <div id ="deleteAccountDiv" style="display:none">
        <h3>Select Account for Deletion</h3>
        <select id="accountDeleteID">
        <option disabled selected>Select Account for Deletion</option>
        
        <?php
        $query = $db->query("SELECT accountID, accountNumber, companyName, "
                        .   "recipientFirstName, recipientLastName "
                        .   "FROM account a JOIN company c ON "
                        .   "a.companyID = c.companyID JOIN recipient r ON "
                        .   "a.recipientID = r.recipientID");
        while($row = $query->fetch())
        {
            echo "<option value=" . $row["accountID"] . ">" 
                    . $row["companyName"] . " - " . $row["accountNumber"]
                    . " (" . $row["recipientFirstName"] . " " 
                    . $row["recipientLastName"] . ")</option>";
        }
        ?>
        </select>
        
        <button type="button" id="deleteAccountButton">Delete Account</button>
        </div>
        
        <!-- Delete Company Div -->
        
        <div id ="deleteCompanyDiv" style="display:none">
        <h3>Select Company for Deletion</h3>
        <select id="companyDeleteID">
        <option disabled selected>Select Company for Deletion</option>
        
        <?php
        $query = $db->query("SELECT companyID, companyName, "
                        . "companyDescription, "
                        .   "companyContactInfo FROM company");
        while($row = $query->fetch())
        {
            echo "<option value=" . $row["companyID"] . ">" 
                    . $row["companyName"] . "</option>";
        }
        ?>
        </select>
        
        <button type="button" id="deleteCompanyButton">Delete Company</button>
        </div>
        
        <!-- Delete Recipient Div -->
        
        <div id ="deleteRecipientDiv" style="display:none">
        <h3>Select Recipient for Deletion</h3>
        <select id="recipientDeleteID">
        <option disabled selected>Select Recipient for Deletion</option>
        
        <?php
        $query = $db->query("SELECT recipientID, recipientFirstName, "
                        . "recipientLastName FROM recipient");
        while($row = $query->fetch())
        {
            echo "<option value =" . $row["recipientID"]. ">" 
                    . $row["recipientFirstName"] . " " 
                    . $row["recipientLastName"] . "</option>";
        }
        ?>
        </select>
        
        <button type="button" id="deleteRecipientButton">
            Delete Recipient</button>
        </div>
        
        <div id ="deletedMessage" style="display:none">
        <p>Deleted.</p>
        <a href="delete.php"><button type="button">Okay</button></a>
        </div>
        </div>
    </body>
</html>
