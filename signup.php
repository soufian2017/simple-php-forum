<?php
    require_once ("creds.inc.php");
    $signError = "";
    $signedIn = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password2"]) && isset($_POST["email"])){

            $sql = "SELECT * FROM users WHERE email=:email";
            $check = $con->prepare($sql);
            $check->bindParam(":email", $_POST["email"]);
            $check->execute();

            $sql = "SELECT * FROM users WHERE username=:usr";
            $check2 = $con->prepare($sql);
            $check2->bindParam(":usr", $_POST["username"]);
            $check2->execute();

            if($check->rowCount() > 0){
                $signError = "E-mail already in use";
            }
            else if($check2->rowCount() > 0){
                $signError = "Username already in use";
            }
            else{

                if(isset($_POST["avatar"])){
                    $sql = "INSERT INTO users(username, password, email, signup_date, avatar) VALUES (:username, :password, :email, :time, :avatar)";
                }
                else $sql = "INSERT INTO users(username, password, email, signup_date) VALUES (:username, :password, :email, :time)";
                
                $res = $con->prepare($sql);
                $res->bindParam(":username", $_POST["username"]);
                $res->bindParam("password", $_POST["password"]);
                $res->bindParam("email", $_POST["email"]);
                if(isset($_POST["avatar"]))
                    $res->bindParam(":avatar", $_POST["avatar"]);
                $date = date("dd/hh/mm/ss");
                $res->bindParam(":time", $date);
                $res->execute();

                $arr = $res->fetch(PDO::FETCH_BOTH);

                if(isset($_SESSION["username"]))
                    header("Location: index.php");
                if (!$res){
                    $signError = "An error occured while signing in";
                }
                else if($res->rowCount() > 0){
                    $signedIn = "Signed in";
                    $_SESSION["username"] = $arr["username"];
                    $_SESSION["id"] = $arr["id"];
                    setcookie("connected", "user=".$arr['username']."; id=".$arr['id'], time()+ (86400 * 30));
                    header("Location: index.php");
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
    <title>Signup</title>
    <script type="text/javascript" src="default/verification.js"></script>
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
        <div class="clean"></div>
    </div>
    <div class="box_login">
        <div align='center' class='box'>
            <p style="color: red; font-size: 18px;" ><?php echo $signError; ?></p>
            <p style="color: green; font-size: 18px;"><?php echo $signedIn; ?></p>
            <p id="msg" style="color: red; font-size: 18px;"></p>
        </div>
        <form action="" method="POST" oninput="verification()" >
            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" id="username" required/><br />
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required/>
            <br />
            <label for="verifpass">Confirmer</label>
            <input type="password" name="password2" id="password2" required/><br />
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" required/><br />
            <label for="email">Avatar</label>
            <input type="text" name="avatar" id="avatar"/><br />
            <div class="center">
                <input type="submit" value="S'inscrire" id="sub"/>
            </div>
        </form>
    </div>
</div>
</body>
</html>