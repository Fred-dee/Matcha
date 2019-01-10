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
					<?php
						$source = ChatServer::getConversations();
						
						foreach($source as $value)
						{
							echo new ChatItem($value);
						}
						//echo new ChatItem($source[0]);
					?>
                </div>
                <div class="col chat-section">

                    <div class="chat-content">
   						<?php
							//first chat here perhaps?
						?>

						<form id="message_send" action="" method ="POST">
							<div class="md-form">
								<input type="text" id="message_tosend" class ="form-control" name="message_tosend" />
								<label for="message_tosend" >Type Message Here</label>
							</div>
						</form>
                    </div>
                    <div class="card-wrapper align-middle profile-browse">
                    </div>
                </div>
            </div>
            <?php require './includes/footer.inc.php' ?>
        </div>

    </body>
</html>