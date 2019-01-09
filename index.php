<?php
header('Content-type: text/html');
require_once 'init.php';
if (!isset($_SESSION))
    session_start();
if (!isset($_SESSION["login"]))
    $_SESSION["login"] = "guest";
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
   						<?php
							$source = ChatServer::getConversations();
							$chat = ChatServer::getConversation($source[0]);
							$msg =  new Message("You", $chat[1]);
							echo $msg;
							//var_dump( $chat);
						//	echo $chat[1][0];
						//	echo $chat[1][1];
							//echo $chat[1][2];
						?>
						<div class="message alert-success">
							<span class="message-sender">
								You:
							</span>
							<span class="message-content">
								Hey there Tester
							</span>
							<span class="message-time">
								10:15
							</span>
							<span class="message-status">
								<i class="fas fa-check"></i>
							</span>
						</div>
                    </div>
                    <div class="card-wrapper align-middle profile-browse">
                    </div>
                </div>
            </div>
            <?php require './includes/footer.inc.php' ?>
        </div>

    </body>
</html>