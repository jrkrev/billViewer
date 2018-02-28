<?php

require_once("dbConnection.php");

$billID = $_POST["billID"];

$query = $db->query("DELETE FROM bill WHERE billID = $billID");
