<?php

/*
  <div class="match">
  <img class="avatar " src="./imgs/avatar.png" alt="" data-username="Tester"/>
  <span data-toggle="chat-content">Tester</span>
  </div>
 */
require_once $_SERVER["DOCUMENT_ROOT"] . '/Matcha/init.php';
if (!isset($_SESSION))
    session_start();

class ChatItem extends Element {

    public function __construct($username) {
        parent::__construct("div", false, array("class" => "match"));
        $pdo = DB::getConnection();
        try {
            $stmt = $pdo->prepare(
                    "SELECT images.src, images.type
				FROM images
				INNER JOIN users ON images.user_id = users.id
				WHERE users.username = :uname AND images.position = 1"
            );
            $stmt->bindParam(":uname", $username, PDO::PARAM_STR);
            $stmt->execute();
            $src = "";
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() == 0)
                $src = "./imgs/avatar.png";
            else
                $src = "data:image/" . $results["type"] . ";base64," . $results["src"];

            $img = new Element("img", true, array(
                "class" => "avatar",
                "alt" => "",
                "data-username" => $username,
                "src" => $src
            ));
            $this->add_child($img);
            $this->add_child(new Element("span", false, array("data-toggle" => "chat-content",
                "data-username" => $username,
                "class" => "message-tag"
            )));
            $this->child_at(1)->add_text($username);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
    }

}

?>