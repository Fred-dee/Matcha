<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/Matcha/init.php';
if (!isset($_SESSION))
    session_start();

class UserProGal extends Element {

    public function __construct($srcs = array()) {
        parent::__construct("div", false, array("class" => "profile-images-wrapper container-fluid"));
        $this->add_child(new Element("div", false, array("class" => "row")));
        $this->add_child(new Element("div", false, array("class" => "row")));
        $curr = $this->first_child();
        $loop = 0;
        for ($i = 0; $i < 6; $i++)
        {
            if ($i == 3)
            {
                $curr = $this->child_at(1);
                $loop = 0;
            }
            $curr->add_child(new Element("div", false, array("class" => "col-4")));
            //type="file" accept="image/*" style="display:none"
            $curr->child_at($loop)->add_child(new Element("input", true, array(
                "type" => "file",
                "accept" => "image/*",
                "style" => "display:none",
                "name" => "p_img".($i + 1)
                )));
            $src = "";
            if (isset($srcs[$i]))
            {
                $src = "data:image/".$srcs[$i]["type"].";base64,".$srcs[$i]["src"];
            }
            else {
                $src="./imgs/avatar.png";
            }
            $curr->child_at($loop)->add_child(new Element("img", true, array(
                "class" => "img-fluid rounded",
                "alt" => "",
                "data-for" => "p_img".($i + 1),
                "src" => $src
            )));
            $loop++;
        }
    }

}

?>
