<?php

require_once("dbConnection.php");

$bill = (object) NULL;

if(!isset($_POST["id"]) && !isset($_POST["earliest"]) && !isset($_POST["latest"]))
{
    $billID = 2;
    $dateFrom = '1991-01-01';
    $dateTo = '2018-01-16';
}
else
{
    $billID = $_POST["id"];
    $dateFrom = $_POST["earliest"];
    $dateTo = $_POST["latest"];
}

$avg = $db->query("SELECT ROUND(AVG(billAmount),2) AS _average "
                    . "FROM bill "
                    . "WHERE accountID = (SELECT accountID "
                            . "FROM bill "
                            . "WHERE billID = $billID) "
                    . "AND billDate >= '$dateFrom' "
                    . "AND billDate <= '$dateTo'");

$sum = $db->query("SELECT SUM(billAmount) AS _sum "
                    . "FROM bill "
                    . "WHERE accountID = (SELECT accountID "
                            . "FROM bill "
                            . "WHERE billID = $billID) "
                    . "AND billDate >= '$dateFrom' "
                    . "AND billDate <= '$dateTo'");

$count = $db->query("SELECT COUNT(billAmount) AS _count "
                    . "FROM bill "
                    . "WHERE accountID = (SELECT accountID "
                            . "FROM bill "
                            . "WHERE billID = $billID) "
                    . "AND billDate >= '$dateFrom' "
                    . "AND billDate <= '$dateTo'");

$min = $db->query("SELECT MIN(billAmount) AS _min "
                    . "FROM bill "
                    . "WHERE accountID = (SELECT accountID "
                            . "FROM bill "
                            . "WHERE billID = $billID) "
                    . "AND billDate >= '$dateFrom' "
                    . "AND billDate <= '$dateTo'");

$max = $db->query("SELECT MAX(billAmount) AS _max "
                    . "FROM bill "
                    . "WHERE accountID = (SELECT accountID "
                            . "FROM bill "
                            . "WHERE billID = $billID) "
                    . "AND billDate >= '$dateFrom' "
                    . "AND billDate <= '$dateTo'");



$bill->avg = $avg->fetch();
$bill->sum = $sum->fetch();
$bill->count = $count->fetch();
$bill->min = $min->fetch();
$bill->max = $max->fetch();



echo json_encode($bill);