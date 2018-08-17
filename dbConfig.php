<?php

/**database connection */
$databasehost     = "localhost"; 
$databasename     = "gac"; 
$databaseusername = "root"; 
$databasepassword = ""; 

    try {
        $pdo = new PDO("mysql:host=$databasehost;dbname=$databasename", $databaseusername, $databasepassword,
            array(
                PDO::MYSQL_ATTR_LOCAL_INFILE => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            )
        );
    } catch (PDOException $e) {
        die ("database connection failed: ".$e->getMessage());
    }
?>
