<?php
    define(DBHOST, "localhost");
    define(DBUSER, "root");
    define(DBPASS, "");
    define(DB, "database");

    $drv = "mysql:dbname=".DB.";host=".DBHOST;
    try {
        $con = new PDO($drv, DBUSER, DBPASS);
    }catch (PDOException $e){
        $loginError = "Echec de la connexion %s\n". $e->getMessage();
        exit();
    }

    $admin = "admin";
    $design = "default";
?>
