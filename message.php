<?php
    require_once ("init.php");

    $error = "";
    $done = "";

    if(isset($_COOKIE["connected"]) && $_COOKIE["connected"] != "false"){
        $sql = "SELECT count(*) as cmp, sender, receiver, message FROM pm WHERE receiver=:usr AND read_=FALSE";
        $res = $con->prepare($sql);
        $res->bindParam(":usr", $_SESSION["username"]);
        $res->execute();

        $array = $res->fetch(PDO::FETCH_ASSOC);

        if(! $res) $error = "Unable to fetch the messages";
        else $done = "To see all the received messages";
    }
    else{
        $error = "Veillez vous connecter.";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="description" content="Visioner les messages que vous avez recue.">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo $design; ?>/main.css" rel="stylesheet" title="Style">
    <link rel="shortcut icon" href="<?php echo $design; ?>/images/edit.png">
    <title>Messages</title>
    <style>
        th{
            text-decoration: underline;
        }
        a#1:hover{
            color: blue;
            background-color: white;
        }
    </style>

</head>
<body>
    <div class="header">
        <img src="<?php echo $design; ?>/images/logo3.png" alt="Forum" />
    </div>
    <div class="content">
        <div class="box">
            <table width="100%">
                <tr>
                    <th width="30%">Received From</th>
                    <th>Message</th>
                    <th width="20%">Status</th>
                </tr>
                <?php
                    for($i=0; $i < $res->rowCount()+1; $i++){
                    // sender => 1; receiver => 2; message => 3;
                        echo "<tr>";
                        echo "<td width='30%'><a id='1' style='color: black;'
                        href='readmessage.php?id=".intval($_SESSION['id'])."&sender=".$array['sender']."&message=".$array['message']."'>".$array['sender']."</a>";
                        echo "</td>";
                        echo "<td>". $array['message'] ."</td>";
                        echo "<td width='20%'>Unread</td></tr>";
                    }
                ?>
            </table>
        </div>
        <div class="box">
            <p style="color: red; font-size: 18px;"><?php echo $error; ?></p>
            <p style="color: black; font-size: 18px;"><?php echo $done; ?><a href="all_messages.php"> Click here</a></p>
        </div>
    </div>

    <div class="foot">
        <?php require_once ("footer.php"); ?>
    </div>
</body>
