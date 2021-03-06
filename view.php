<!DOCTYPE html>
<!-- billViewer - View record page -->
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
        <div class="mainDiv">
            
        <h3>Select View Type</h3>
        <select id="viewType">
            <option disabled selected>Select View Type</option>
            <option value="recipient">View Recipient</option>
            <option value="company">View Company</option>
            <option value="account">View Account</option>
            <option value="bill">View Bill</option>
        </select>    
        
        <!-- View Bill Div -->
        
        <div id="viewBillDiv" style="display:none">
        <h3>Select Bill</h3>
        <select id="billSelect">
        <option disabled selected>Select Bill</option>
        
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
        <table border =1 id="viewBillInfo">
            <tr>
                <th>Company</th>
                <th>Recipient</th> 
                <th>Amount</th>
                <th>Due</th>
                <th>Notes</th></tr>
        </table>
        </div>
        
        <!-- View Account Div -->
        
        <div id="viewAccountDiv" style="display:none">
        <h3>Select Account</h3>
        <select id="accountSelect">
        <option disabled selected>Select Account</option>
        
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
        <table border =1 id="viewAccountInfo">
            <tr>
                <th>Company</th>
                <th>Account Number</th> 
                <th>Recipient</th>
                <th>Notes</th></tr>
        </table>
        </div>
        
        
        <!-- View Company Div -->
        
        <div id="viewCompanyDiv" style="display:none">
        <h3>Select Company</h3>
        <select id="companySelect">
        <option disabled selected>Select Company</option>
        
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
        <table border =1 id="viewCompanyInfo">
            <tr>
                <th>Company Name</th>
                <th>Description</th> 
                <th>Contact Info</th>
            </tr>
        </table>
        </div>
        
        <!-- View Recipient Div -->
        
        <div id="viewRecipientDiv" style="display:none">
        <h3>View Recipients</h3>
        <select id="recipientSelect">
        <option disabled selected>List of Recipients</option>
        
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
        </div>
        
        
        </div>
        
        
        
        <div id="additionalInfo" style="display:none">
            <h3>Account Statistics</h3>
            <p>
            <label>From : </label>
            <input type="date" id="earliestDate"/> 
            </p>
            <p>
            <label>To : </label>
            <input type="date" id="latestDate"/> 
            </p>
            <p>Number of bills: <input type="text" id="billCount"/></p>
            <p>Total paid: <input type="text" id="billSum"/></p>
            <p>Minimum: <input type="text" id="billMin"/></p>
            <p>Maximum: <input type="text" id="billMax"/></p>
            <p>Average: <input type="text" id="billAverage"/></p>
            <button type="button" id="listBillsButton">
                List Bills from Account
            </button>
         </div>
        
        <div id="billListDiv" style="display:none">
            <table border="1" id="billList"></table>
        </div>
        
    </body>
</html>
