<?php
    require_once ("creds.inc.php");
    $bonJour = "";
    if(isset($_COOKIE["username"]))
        $bonJour = "Bien venue".$_COOKIE["username"];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="description" content="bien venue a l universiter de l'USTO Oran">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $design; ?>/main.css" rel="stylesheet" title="Style">
        <link rel="shortcut icon" href="<?php echo $design; ?>/images/edit.png">
        <title>Bien Venue a vous</title>
        <style type="text/css">
            th:hover{
                color: grey;
                font-size: 24px;
            }
        </style>
    </head>
    <body>
        <div align="center">
            <p style="font-size: 18px; color: white;"><?php echo $bonJour; ?></p>
        </div>
        <div class="header">
            <table width="100%">
                <tr>
                    <th>
                        Categories
                    </th>
                    <th>Specialités</th>
                    <th>Types</th>
                </tr>
            </table>
        </div>
        <div class="content">
        <div class="box_right">
            <div class="box" style="font-size: 18px;">
                <div>
                    <table width="100%" style="background-color: black;border: 2px solid white;">
                        <tr>
                            <td>
                                <a href="login.php" style="text-decoration: underline">Se connecter.</a>
                                <p style="color: white;">ou</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="signup.php"  style="text-decoration: underline">S'inscrire.</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
            <div class="center">Hello World !!</div>
        </div>
    <div class="foot">
        <?php require_once ("footer.php"); ?>
    </div>
    </body>
</html>