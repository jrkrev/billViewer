<?php

$connection = "mysql:host=localhost;dbname=bdDB_";
$user = "root";
$pwd = "mysql";
$db = new PDO($connection, $user, $pwd);

$bill = (object) NULL;

if(!isset($_POST["id"]))
    $billID = 1;
else    
    $billID = $_POST["id"];

$info = $db->query("SELECT billID, accountNumber, companyName, billAmount, "
                        . "billDate, billNote, recipientFirstName, "
                        . "recipientLastName FROM bill b JOIN account a ON "
                        . "b.accountID = a.accountID JOIN company c ON "
                        . "a.companyID = c.companyID JOIN recipient r ON "
                        . "a.recipientID = r.recipientID WHERE billID = "
                        . "$billID");

$bill->info = $info->fetch();

$earliestDate = $db->query("SELECT MIN(billDate) AS earliest "
                    . "FROM bill b "
                    . "JOIN account a "
                    . "ON b.accountID = a.accountID "
                    . "JOIN company c "
                    . "ON a.companyID = c.companyID "
                    . "WHERE a.accountID = "
                        . "(SELECT accountID "
                        . "FROM bill "
                        . "WHERE billID = $billID)");

$bill->date = $earliestDate->fetch();
$now = new DateTime();
$bill->now = $now->format("Y-m-d");

echo json_encode($bill);