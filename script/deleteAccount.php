<?php

$connection = "mysql:host=localhost;dbname=bdDB_";
$user = "root";
$pwd = "mysql";
$db = new PDO($connection, $user, $pwd);

$accountID = $_POST["accountID"];


$query = $db->query("DELETE FROM account WHERE accountID = $accountID");

if($query)
    echo 1;
else
    echo 0;
