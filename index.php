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
        <div class="container-fluid page" id="main" >
			
            <div class="card-wrapper align-middle">
                <?php
				//echo $_SERVER["DOCUMENT_ROOT"];
                include './private/loaddata.php';
                ?>
            </div>
            <?php require './includes/footer.inc.php' ?>
        </div>
        <div class="container-fluid page" id="main2" style="display:none">
            <div class="row">
                <div class="col matches">
                    <div class="match">
                        <img class="avatar " src="./imgs/avatar.png" alt="" data-username="Tester"/>
                        <span data-toggle="chat-content">Tester</span>
                    </div>
                </div>
                <div class="col chat-section">

                    <div class="chat-content">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus malesuada consectetur bibendum. Cras laoreet sapien diam, sit amet congue metus dapibus sed. Sed pretium volutpat orci ut sagittis. Cras sit amet sapien gravida, vehicula nunc ac, porta ipsum. Morbi sed gravida ante. Nam urna purus, mollis at quam gravida, dictum laoreet mi. Fusce sodales in elit sed faucibus.

                        Fusce et lacus nec nunc ultricies aliquet a nec erat. Vivamus lobortis libero sed massa rhoncus, ac tincidunt purus dignissim. Pellentesque mattis odio a malesuada malesuada. Ut dictum, enim vehicula tristique euismod, odio risus condimentum elit, eu volutpat tortor lectus id risus. Suspendisse ultricies libero velit, eu semper est maximus a. Sed nec lacinia sapien, at tristique arcu. Nullam purus justo, venenatis sit amet mi eget, ultricies varius lacus. Sed id sem quis dui semper varius. Cras quis vehicula turpis. Maecenas non maximus orci, ac viverra mauris. Nam velit libero, faucibus a pharetra sit amet, laoreet at odio. Integer bibendum fermentum arcu vel malesuada. Ut maximus tincidunt odio quis ultricies.

                        Curabitur pulvinar eu ipsum ut volutpat. Nam ac purus id urna posuere consequat at vel mauris. In hac habitasse platea dictumst. Mauris dignissim suscipit magna, eget ullamcorper augue pulvinar et. Mauris leo velit, tincidunt in erat ac, aliquam tempus leo. Mauris lacinia orci eu ipsum egestas scelerisque. Suspendisse finibus, ex id condimentum egestas, felis lorem blandit sem, at interdum nibh lorem nec velit. Etiam mollis, lectus accumsan accumsan consequat, magna odio faucibus risus, ac congue odio erat sit amet mauris. Vestibulum sed dui nec mi laoreet facilisis. Nunc rutrum dapibus dictum. Vivamus ut condimentum felis, at dictum risus. Sed et euismod tortor, nec rutrum dolor.

                        Aliquam bibendum ut arcu in porta. Nulla vestibulum velit quis lacus posuere, venenatis ullamcorper neque elementum. Donec facilisis, diam et faucibus volutpat, leo augue congue ligula, sed cursus lectus tortor sit amet eros. Sed pretium egestas dui, at interdum lacus. Suspendisse viverra fermentum vulputate. Maecenas ut elementum eros, nec mollis arcu. Praesent tincidunt, magna non hendrerit dapibus, ipsum libero pellentesque neque, a tempus felis nisi eget libero. Aliquam molestie urna sed commodo ornare. Mauris condimentum nisi vel tellus hendrerit congue luctus et est. Integer egestas est in nunc consectetur malesuada. Integer vulputate pretium pretium. Proin sodales leo vitae neque rutrum, a luctus velit varius. Pellentesque a risus et libero suscipit egestas nec rhoncus turpis.

                        Vestibulum dapibus nec leo ac feugiat. Nullam malesuada tristique lacus, in blandit nulla tempus a. Sed sed vehicula metus. Nulla mattis neque sit amet justo pellentesque, in rhoncus eros suscipit. Vivamus hendrerit condimentum tortor, id eleifend velit fermentum et. Sed ante risus, sagittis vel elit ac, dictum porta lacus. Sed efficitur tortor mi, tincidunt pharetra ipsum accumsan ut. Sed fringilla venenatis efficitur. Integer blandit rutrum arcu vitae malesuada. Donec pharetra enim ac tortor pellentesque dictum. Nunc eu posuere arcu. Nulla et hendrerit purus. Ut consectetur lacus et nibh laoreet, eget finibus ex sollicitudin. Maecenas in turpis tellus. Donec scelerisque, neque vitae scelerisque interdum, lectus dui faucibus nisi, eu tincidunt purus nunc et ex. 
                    </div>
                    <div class="card-wrapper align-middle profile-browse">
                    </div>
                </div>
            </div>
            <?php require './includes/footer.inc.php' ?>
        </div>

    </body>
</html>