<?php

$connection = "mysql:host=localhost;dbname=bdDB_";
$user = "root";
$pwd = "mysql";
$db = new PDO($connection, $user, $pwd);

$company = (object) NULL;


if(!isset($_POST["id"]))
    $companyID = 1;
else    
    $companyID = $_POST["id"];

$info = $db->query("SELECT companyID, companyName, companyDescription, "
                        . "companyContactInfo from company WHERE companyID = "
                        . "$companyID");

$company->info = $info->fetch();
echo json_encode($company);