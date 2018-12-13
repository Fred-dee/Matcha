<?php
header('Content-type: text/html');
require_once 'init.php';
if (!isset($_SESSION))
    session_start();
if (!isset($_SESSION["login"]))
    $_SESSION["login"] = "guest";

//spl_autolaod_register("./classes/UserCard.class.php");
//spl_autolaod_register("./classes/User.class.php");
//require_once './classes/UserCard.class.php';
//require_once './classes/User.class.php';
//require_once './config/database.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Index</title>
        <?php
        require_once './includes/main.inc.php';
        ?>
        <script type="text/javascript" src="./js/cards.js"></script>
    </head>
    <body>
        <?php require_once './includes/navbar.inc.php' ?>
        <?php
        if ($_SESSION["login"] == "guest")
            include_once './includes/signuplogin.inc.php';
        ?>
        <div class="container-fluid" id="main">

            <div class="card-wrapper">
                <?php
                 /*$pdo = DB::getConnection();
                  $stmt = $pdo->query("SELECT * FROM `users` WHERE username='Fred-Dee'");
                  $res = $stmt->fetch(PDO::FETCH_ASSOC);
                  if ($res != NULL) {
                  $user = new User($res);
                  echo $user;
                  $_SESSION["user_obj"] = $user;
                  $_SESSION["user_obj"]->set_bio("Blah Blah Blah");
                  } */
                if (isset($_SESSION["user_obj"])) {
                    echo $_SESSION["user_obj"];
                } else {
                    echo "Could not make a user persist in the session";
                }
                ?>
            </div>
            <?php require_once './includes/footer.inc.php' ?>
        </div>

    </body>
</html>