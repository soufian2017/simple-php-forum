<?php
    require_once ("init.php");
    $nbr = "";
    $nbra = "";
    $error = "";

    if(isset($_COOKIE["connected"]) && $_COOKIE["connected"] != "false"){

        $sql = "SELECT count(*) as nbr FROM pm WHERE id=:id AND receiver=:receiver AND read_=FALSE ";
        $res = $con->prepare($sql);
        $res->bindParam(":receiver", $_SESSION["username"]);
        $res->bindParam(":id", $_SESSION["id"]);
        $res->execute();

        $array = $res->fetch(PDO::FETCH_BOTH);

        if(!$res){
            $error = "An error occurred.";
        }
        else if($res->rowCount() == 0) $nbr = "0";
        else $nbr = $array["nbr"];
    }
    else{
        $error = "Please login to see your messages.";
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="description" content="espace utilisateur du forum de l'USTO Oran">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo $design; ?>/main.css" rel="stylesheet" title="Style">
    <link rel="shortcut icon" href="<?php echo $design; ?>/images/edit.png">
    <title>Espace Utilisateur</title>

</head>
<body>
    <div class="header">
        <img src="default/images/logo3.png" alt="Forum" />
    </div>
    <div class="content">
        <div class="box">
            <div class="box_left">
                <a href="message.php">Vos Messages<?php if($nbr != "") echo "(".$nbr.")";?></a>
            </div>
            <div class="box_right">
                <?php

                if(isset($_COOKIE["connected"]) && $_COOKIE["connected"] != "false") {
                    //echo "<div class='box_right' >";
                    echo "<a href = 'logout.php' > Se deconnecter </a >";
                    //echo "</div >";
                }
                ?>
            </div>
            <div class="center">
                <a href="articles.php">Vos articles<?php if($nrba != "") echo "(".$nbra.")"; ?></a> |
                <a href="newmessage.php">Envoyer un message</a>
            </div>
        </div>
        <div class="center">
            <p>
                <a href="login.php" style="color: red; font-size: 18px;"><?php echo $error; ?></a>
            </p>
        </div>
    </div>
    <div class="foot">
        <?php require_once ("footer.php"); ?>
    </div>
</body>
</html>