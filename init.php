<?php

    require_once ("creds.inc.php");

    session_start();
    header('Content-type: text/html;charset=UTF-8');

    if(!isset($_SESSION['username']) and isset($_COOKIE['username'], $_COOKIE['password'])){
        $sql = "SELECT password, id FROM users WHERE username=:user";
        $res = $con->prepare($sql);
        $res->bindParam(":user", $_COOKIE['username']);
        $res->execute();

        $array = $res->fetch(PDO::FETCH_BOTH);

        if($res->rowCount() > 0 && sha1($array["password"]) == $_COOKIE["password"]){
            $_SESSION["username"] = $_COOKIE["username"];
            $_SESSION["userid"] = $array["id"];
        }
    }
?>