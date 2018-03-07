<?php
/*  This function connects to the database using the DB and user generated
    by RUN_ONLY_ONCE.sql  */
$connection = "mysql:host=localhost;dbname=billViewerDB";
$user = "billViewerUser";
$pwd = "bvPass";
$db = new PDO($connection, $user, $pwd);

