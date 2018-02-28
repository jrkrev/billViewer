<?php

require_once("dbConnection.php");

$recipientID = $_POST["recipientID"];

$query = $db->query("DELETE FROM recipient WHERE recipientID = $recipientID");

if($query)
    echo 1;
else
    echo 0;