<?php
session_start();
    $hostname   = "localhost";
    $username   = "candrain_salma";
    $password   = "salmaskripsi";
    $dbname     = "candrain_app_salma";
    $db = new PDO('mysql:dbname='.$dbname.';host='.$hostname, $username, $password);
    
    $con =  new PDO( "mysql:host=".$hostname.";"."dbname=".$dbname, $username, $password); 
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    define( "DB_DSN", "mysql:host=localhost;dbname=candrain_app_salma" );
    define( "DB_USERNAME", "candrain_salma" );
    define( "DB_PASSWORD", "salmaskripsi" );
?>