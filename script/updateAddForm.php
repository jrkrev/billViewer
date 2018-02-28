<?php

require_once("dbConnection.php");

$addType = $_POST["addType"];
$selectString = (object) NULL;

if($addType == "account")
{
    $selectString->recipient = "<option disabled selected>Select Recipient</option>";
    
    $query = $db->query("SELECT recipientID, recipientFirstName, "
                            .   "recipientLastName FROM recipient"); 
    while($row = $query->fetch())
    {
        $selectString->recipient = $selectString->recipient 
            . "<option value=" 
            . $row["recipientID"] . ">" 
            . $row["recipientFirstName"] . " " 
            . $row["recipientLastName"] . "</option>";     
    }
            
    $selectString->company = "<option disabled selected>Select Company</option>";
    $query = $db->query("SELECT companyID, companyName "
                            .   "FROM company"); 
    while($row = $query->fetch())
    {
        $selectString->company = $selectString->company .  
            "<option value=" . $row["companyID"] . ">" 
            . $row["companyName"] . "</option>";
    }
}
else
    if ($addType == "bill")
    {
        $selectString->bill = "<option disabled selected>Select Account</option>";
        
        $query = $db->query("SELECT companyName, a.accountID, accountNumber, "
                            .   "recipientFirstName, recipientLastName "
                            .   "FROM recipient r "
                            .   "JOIN account a ON r.recipientID = "
                            .   "a.recipientID JOIN company c ON "
                            .   "a.companyID = c.companyID"); 
        while($row = $query->fetch())
        {
            $selectString->bill = $selectString->bill 
                . "<option value=" . $row["accountID"] . ">" 
                . $row["companyName"] . " - "
                . $row["accountNumber"] . " (" 
                . $row["recipientFirstName"] . " " 
                . $row["recipientLastName"] . ")</option>";
            }
    }

echo json_encode($selectString);