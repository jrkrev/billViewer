<?php

$connection = "mysql:host=localhost;dbname=bdDB_";
$user = "root";
$pwd = "mysql";
$db = new PDO($connection, $user, $pwd);

$recipientID = $_POST["recipientID"];

$query = $db->query("DELETE FROM recipient WHERE recipientID = $recipientID");

if($query)
    echo 1;
else
    echo 0;