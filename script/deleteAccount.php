<?php
require_once("dbConnection.php");

$accountID = $_POST["accountID"];

$query = $db->query("DELETE FROM account WHERE accountID = $accountID");

if($query)
    echo 1;
else
    echo 0;
