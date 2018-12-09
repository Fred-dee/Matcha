<?php
header('Content-type: text/html');
if (!isset($_SESSION))
    session_start();
if (!isset($_SESSION["login"]))
    $_SESSION["login"] = "guest";
require_once './classes/UserCard.class.php';
require_once './classes/User.class.php';
require_once './config/database.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Index</title>
        <?php require_once './includes/main.inc.php' ?>
        <script type="text/javascript" src="./js/cards.js"></script>
    </head>
    <body>
        <?php require_once './includes/navbar.inc.php' ?>
        <div class="container-fluid" id="main">

            <div class="card-wrapper">
                <?php
                $pdo = DB::getConnection();
                $stmt =$pdo->query("SELECT * FROM `users` WHERE username='Fred_Dee'");
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                $user = new User($res);
                echo $user;
                ?>
            </div>
            <?php require_once './includes/footer.inc.php' ?>
        </div>

    </body>
</html>