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
                <!-- Card -->
                <div class="card">

                    <!-- Card image -->
                    <div class="view overlay">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100 card-picture" src="./imgs/13524498_1355525024475110_341246408285628536_n.jpg" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100 card-picture" src="./imgs/14138715_10210283076183583_2563936512643780707_o.jpg" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100 card-picture" src="./imgs/14224805_1287416131271200_1849041609591974141_n.jpg" alt="Third slide">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>

                    <!-- Card content -->
                    <div class="card-body card-body-secondary">
                        <span class="bio-close"><i class="fas fa-angle-up"></i></span>


                        This is the secondary vibes the vibes with the bio;
                    </div>
                    <div class="card-body">

                        <!-- Title -->
                        <h4 class="card-title">Fred Dilapisho, 22</h4>
                        <!-- Text -->
                        <p class="card-text">WeThinkCode_</p>
                        <!-- Button -->

                        <div class="d-flex justify-content-center">
                            <div class="col "><button class="btn purple-gradient btn-like"></button></div>
                            <div class="col"><button class="btn blue-gradient btn-reject"></button></div>
                        </div>



                    </div>

                </div>
                <!-- Card -->
            </div>
            <div class="card-wrapper">
                <?php
                    $card = new UserCard();
           
                    $imgattrs = array(
                        "class" => "d-block w-100 card-picture",
                        "alt" => "",
                        "type" => "jpg"
                    );
                   // $img = base64_encode(file_get_contents("./imgs/13524498_1355525024475110_341246408285628536_n.jpg"));
                    //$card->add_images($img, false, $imgattrs);
                    $card->assemble();
                    echo $card;
                ?>
            </div>
            <?php require_once './includes/footer.inc.php' ?>
        </div>

    </body>
</html>