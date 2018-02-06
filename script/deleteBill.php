<?php

$connection = "mysql:host=localhost;dbname=bdDB_";
$user = "root";
$pwd = "mysql";
$db = new PDO($connection, $user, $pwd);

$billID = $_POST["billID"];

$query = $db->query("DELETE FROM bill WHERE billID = $billID");
