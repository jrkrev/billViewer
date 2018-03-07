<?php
require_once("dbConnection.php");

$dates = (object) NULL;

$query = $db->query("SELECT MIN(billDate) AS earliest FROM bill");
$dates->date = $query->fetch();
$now = new DateTime();
$dates->now = $now->format("Y-m-d");

echo json_encode($dates);