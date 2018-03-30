<?php
    $_SESSION["username"] = "";
    $_SESSION["id"] = "";
    setcookie("connected", "false");
    header("Location: index.php");
?>