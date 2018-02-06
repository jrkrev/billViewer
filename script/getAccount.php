<?php

$connection = "mysql:host=localhost;dbname=bdDB_";
$user = "root";
$pwd = "mysql";
$db = new PDO($connection, $user, $pwd);

$account = (object) NULL;


if(!isset($_POST["id"]))
    $accountID = 1;
else    
    $accountID = $_POST["id"];

$info = $db->query("SELECT accountID, accountNumber, accountNote, "
                        . "companyName, recipientFirstName, recipientLastName "
                        . "FROM account a JOIN company c ON "
                        . "a.companyID = c.companyID JOIN recipient r ON "
                        . "a.recipientID = r.recipientID WHERE accountID = "
                        . "$accountID");

$account->info = $info->fetch();
echo json_encode($account);