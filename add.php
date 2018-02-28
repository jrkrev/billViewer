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
            require_once("script/dbConnection.php");
            CreateTitleBar();
            CreateNavigationBar();           
        ?>
        
        <div class="mainDiv">
        <h3>Select Add Type</h3>
        <select id="addType">
            <option disabled selected>Select Add Type</option>
            <option value="recipient">Add Recipient</option>
            <option value="company">Add Company</option>
            <option value="account">Add Account</option>
            <option value="bill">Add Bill</option>
        </select>
        
        <p id="inputError"></p>
        
        <div id="addRecipientDiv" style="display:none">
            <p>
            <label>Recipient First Name * </label>
            <input type="text" maxlength="20" id="recipientFirstName"/>
            </p>
            <p>
            <label>Recipient Last Name * </label>
            <input type="text" maxlength="20" id="recipientLastName"/>
            </p>
            <p>
            <button type="button" id="addRecipientButton">
                Add Recipient</button>
            </p>
        </div>
        
        <div id="addCompanyDiv" style="display:none">
            <p>
            <label>Company Name * </label>
            <input type="text" maxlength="40" id="companyName"/>
            </p>
            <p>
            <label>Description </label>
            </p>
            <p>
            <textarea rows ="7" cols="50" id="companyDescription" 
                maxlength="255"></textarea>    
            </p>
            <p>
            <label>Contact Info </label>
            <input type="text" maxlength="50" id="companyContactInfo"/>
            </p> 
             <p>
            <button type="button" id="addCompanyButton">
                Add Company</button>
            </p>
        </div>
        
        <div id ="addAccountDiv" style="display:none">
            
            <p><label>Select Company and Recipient * </label></p>
            <select id="account_companyID">
            </select>
            
            <select id="account_recipientID">
            </select>
            
            <p>
            <label>Account Number * </label>
            <input type="text" maxlength="30" id="accountNumber"/>
            </p>
            <p>
            <label>Notes </label>
            </p>
            <p>
            <textarea rows ="7" cols="50" id="accountNote" 
                maxlength="255"></textarea>    
            </p>
            <p>
            <button type="button" id="addAccountButton">
                Add Account</button>
            </p>
        </div>
        <div id="addBillDiv" style="display:none">
            
            <p>
            <label>Select Account * </label>
            <select id="bill_accountID">   
            </select>
            </p>
            <p>
            <label>Bill Amount * </label>
            <input type="text" maxlength="10" id="billAmount"/>
            </p>
            <p>
            <label>Due Date * </label>
            <input type="date" id="billDate"/>
            </p>
            <p>
            <label>Notes </label>
            </p>
            <p>
            <textarea rows ="7" cols="50" id="billNote" 
                maxlength="255"></textarea>    
            </p>
            <button type="button" id="addBillButton">
                Add Bill</button>
            </p>
        </div>
        
        <div id="added" style="display:none">
        <p>Record added</p>
        <button type="button" id="addDone">Done</button>
        </div>
        
        </div>
    </body>
</html>
