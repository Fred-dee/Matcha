<?php
header('Content-type: text/html');
if (!isset($_SESSION))
    session_start();
if (!isset($_SESSION["login"]))
    $_SESSION["login"] = "guest";
require_once './classes/UserCard.class.php';
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
                $card = new UserCard();

                $imgattrs = array(
                    "class" => "d-block w-100 card-picture",
                    "alt" => "",
                    "type" => "jpg"
                );
                $img = base64_encode(file_get_contents("./imgs/13524498_1355525024475110_341246408285628536_n.jpg"));
                $card->add_images($img, false, $imgattrs);
                $card->add_images("./imgs/14138715_10210283076183583_2563936512643780707_o.jpg", true, $imgattrs);
                $card->set_cardText("WeThinkCode_");
                $card->set_Title("Fred Dilapisho, 21");
                $card->assemble();
                echo $card;
                ?>
            </div>
            <?php require_once './includes/footer.inc.php' ?>
        </div>

    </body>
</html>