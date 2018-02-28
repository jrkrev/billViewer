<?php

require_once("dbConnection.php");

$account = (object) NULL;
$accountID = $_POST["id"];

$info = $db->query("SELECT accountID, accountNumber, accountNote, "
                        . "companyName, recipientFirstName, recipientLastName "
                        . "FROM account a JOIN company c ON "
                        . "a.companyID = c.companyID JOIN recipient r ON "
                        . "a.recipientID = r.recipientID WHERE accountID = "
                        . "$accountID");

$account->info = $info->fetch();
echo json_encode($account);