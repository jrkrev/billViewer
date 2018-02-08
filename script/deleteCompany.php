<?php

$connection = "mysql:host=localhost;dbname=bdDB_";
$user = "root";
$pwd = "mysql";
$db = new PDO($connection, $user, $pwd);

$companyID = $_POST["companyID"];


$query = $db->query("DELETE FROM company WHERE companyID = $companyID");

if($query)
    echo 1;
else
    echo 0;