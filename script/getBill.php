<?php

require_once("dbConnection.php");

$bill = (object) NULL;
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

$latestDate = $db->query("SELECT MAX(billDate) AS latest "
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
$bill->latest = $latestDate->fetch();
$now = new DateTime();
$bill->now = $now->format("Y-m-d");

echo json_encode($bill);