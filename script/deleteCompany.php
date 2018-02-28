<?php

require_once("dbConnection.php");

$companyID = $_POST["companyID"];


$query = $db->query("DELETE FROM company WHERE companyID = $companyID");

if($query)
    echo 1;
else
    echo 0;