<?php

$connection = "mysql:host=localhost;dbname=bdDB_";
$user = "root";
$pwd = "mysql";
$db = new PDO($connection, $user, $pwd);

$addType = $_POST["addType"];


if($addType == "recipient")
{
        
        $recipientFirstName = $_POST["recipientFirstName"];
        $recipientLastName = $_POST["recipientLastName"];
        
        $addQuery = $db->query("INSERT INTO recipient VALUES "
                . "(NULL, '$recipientFirstName', '$recipientLastName')");
        
        echo "INSERT INTO recipient VALUES "
                . "(NULL, '$recipientFirstName', '$recipientLastName')";
        
}
    
else if($addType == "company")
{
        
        $companyName = $_POST["companyName"];
        $companyDescription = $_POST["companyDescription"];
        $companyContactInfo = $_POST["companyContactInfo"];
        
        $addQuery = $db->query("INSERT INTO company VALUES "
                . "(NULL, '$companyName', '$companyDescription', "
                . "'$companyContactInfo')");
        
}
    
else if($addType == "account")
{
        
        
        $accountNumber = $_POST["accountNumber"];
        $accountNote = $_POST["accountNote"];
        $accountCompanyID = $_POST["accountCompanyID"];
        $accountRecipientID = $_POST["accountRecipientID"];
        
        $addQuery = $db->query("INSERT INTO account VALUES (NULL, "
                . "'$accountNumber', '$accountNote', CURDATE(), "
                . "'$accountCompanyID', '$accountRecipientID')");
        
}
    
else if($addType == "bill")
{
        
        $billAmount = $_POST["billAmount"];
        $billDate = $_POST["billDate"];
        $billNote = $_POST["billNote"];
        $billAccountID = $_POST["billAccountID"];
        
        $addQuery = $db->query("INSERT INTO bill VALUES "
                . "(NULL, $billAmount, '$billDate', '$billNote', "
                . "'$billAccountID')");         
        
}

