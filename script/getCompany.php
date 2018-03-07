<?php
require_once("dbConnection.php");

$company = (object) NULL;
$companyID = $_POST["id"];

$info = $db->query("SELECT companyID, companyName, companyDescription, "
                        . "companyContactInfo from company WHERE companyID = "
                        . "$companyID");

$company->info = $info->fetch();
echo json_encode($company);