<?php

    require_once ("init.php");

    $loginError = "";
    $logedIn = "";

    if($_COOKIE["connected"] == "user=".$_SESSION['username']."; id=".$_SESSION['id']){
        $logedIn = "Dejas Connecter";
        header("Location: user_space.php");
    }

    else if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST["username"]) && isset($_POST["password"])){
            $sql = "SELECT * FROM users WHERE username=:user AND password=:pass";
            $res = $con->prepare($sql);
            $res->bindParam(":user",$_POST["username"]);
            $res->bindParam(":pass", $_POST["password"]);
            $res->execute();

            $arr = $res->fetch(PDO::FETCH_BOTH);

            if(! $res){
                $loginError = "Probleme d'acces";
                exit();
            }
            else{
                if($res->rowCount() == 0)
                    $loginError = "Nom d'utilisateur ou Mot de passe incorrect";
                else{
                    $_SESSION["username"] = $arr["username"];
                    $_SESSION["id"] = $arr["id"];
                    setcookie("connected", "user=".$arr['username']."; id=".$arr['id'], time()+ (86400 * 30));
                    $logedIn = "Connection etablis";
                    header("Location: user_space.php");
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="connexion ou inscription a l universiter de l USTO Oran">
        <link href="<?php echo $design; ?>/main.css" rel="stylesheet" title="Style" />
        <link rel="shortcut icon" href="<?php echo $design; ?>/images/edit.png">
        <title>Login</title>
    </head>
    <body>
        <div class="header">
            <img src="default/images/logo3.png" alt="Forum" />
        </div>
        <div class="content">
            <div class="box">
                <div class="box_left">
                    <a href="index.php">Index du Forum</a>
                </div>
                <?php

                if(isset($_COOKIE["connected"]) && $_COOKIE["connected"] != "false") {
                    echo "<div class='box_right' >";
                    echo "<a href = 'logout.php' > Se deconnecter </a >";
                    echo "</div >";
                }
                ?>
                <div class="clean"></div>
            </div>
            <div class="box_login">
                <div align='center' class='box'>
                    <p style='color: red; font-size: 18px;' ><?php echo $loginError; ?></p>
                    <p style="color: yellow; font-size: 18px;"><?php echo $logedIn; ?></p>
                </div>
                    <form action="" method="POST">
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" name="username" id="username" required/><br />
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password" required/><br />
                        <label for="memorize">Se souvenir de moi</label><input type="checkbox" name="memorize" id="memorize" value="yes" checked="true"/>
                        <div class="center">
                            <input type="submit" value="Se connecter" />
                            ou
                            <input type="button" onclick="javascript:document.location='signup.php';" value="S'inscrire" />
                        </div>
                    </form>
            </div>
        </div>
        <div class="foot">
            <?php require_once ("footer.php"); ?>
        </div>
    </body>
</html>
