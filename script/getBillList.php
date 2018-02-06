<?php

$connection = "mysql:host=localhost;dbname=bdDB_";
$user = "root";
$pwd = "mysql";
$db = new PDO($connection, $user, $pwd);

  
$billID = $_POST["id"];
$dateFrom = $_POST["earliest"];
$dateTo = $_POST["latest"];

$billListQuery = $db->query("SELECT companyName, accountNumber, "
                    . "recipientFirstName, recipientLastName, billAmount, "
                    . "billDate, billNote "
                    . "FROM bill b "
                    . "JOIN account a "
                    . "ON b.accountID = a.accountID "
                    . "JOIN company c "
                    . "ON a.companyID = c.companyID "
                    . "JOIN recipient r "
                    . "ON a.recipientID = r.recipientID "
                    . "WHERE a.accountID = "
                        . "(SELECT accountID "
                        . "FROM bill "
                        . "WHERE billID = $billID) "
                    . "AND billDate >= '$dateFrom' "
                    . "AND billDate <= '$dateTo'");

$billList = $billListQuery->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($billList);