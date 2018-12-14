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
                if (isset($_SESSION["user_obj"])) {
                    echo $_SESSION["user_obj"];
                } else {
                    echo "<img class='img-responsive' src='./imgs/landing_page.png' alt='' />";
                }
                ?>
            </div>
            <?php require_once './includes/footer.inc.php' ?>
        </div>

    </body>
</html>