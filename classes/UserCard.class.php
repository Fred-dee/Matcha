<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/Matcha/init.php';
if (!isset($_SESSION))
    session_start();


class UserCard extends Element {

    protected
            $_body,
            $_body_secodary,
            $_image_carousel,
            $_images = array(),
            $_card_title,
            $_card_text;

    public function __construct($user_name) {
        parent::__construct("div", false, array("class" => "card", "data-for" => base64_encode($user_name)));
        $this->_body = new Element("div", false, array("class" => "card-body"));

        $this->_card_title = new Element("h4", false, array("class" => "card-title"));
        $this->_card_text = new Element("p", false, array("class" => "card-text"));
        $this->_body_secondary = new Element("div", false, array("class" => "card-body card-body-secondary"));
        $this->_body->add_child($this->_card_title);
        $this->_body->add_child($this->_card_text);
        $this->_body_secondary->add_child(new Element("span", false));
        $this->_body_secondary->first_child()->add_child(new Element("i", false));
        $this->_body_secondary->first_child()->add_class("bio-close");
        $this->_body_secondary->first_child()->first_child()->add_class("fas fa-angle-up");
        $this->_image_carousel = new Element("div", false, array("class" => "view overlay"));

        $this->_image_carousel->add_child(new Element("div", false, array(
            "id" => "user_carousel",
            "class" => "carousel slide",
            "data-ride" => "carousel"
        )));
        $this->_image_carousel->first_child()->add_child(new Element("ol", false, array("class" => "carousel-indicators")));
        $this->_image_carousel->first_child()->add_child(
                new Element("div", false, array("class" => "carousel-inner"))
        );
        $this->_image_carousel->first_child()->add_child(
                new Element("a", false, array(
            "class" => "carousel-control-prev",
            "href" => "#user_carousel",
            "role" => "button",
            "data-slide" => "next"
                ))
        );
        $this->_image_carousel->first_child()->add_child(
                new Element("a", false, array(
            "class" => "carousel-control-next",
            "href" => "#user_carousel",
            "role" => "button",
            "data-slide" => "prev"
                ))
        );
        $this->_image_carousel->querySelector('.carousel-control-prev')->add_child
                (new Element(
                "span", false, array(
            "class" => "carousel-control-prev-icon",
            "aria-hidden" => "true"
                )
        ));
        $this->_image_carousel->querySelector('.carousel-control-next')->add_child
                (new Element(
                "span", false, array(
            "class" => "carousel-control-next-icon",
            "aria-hidden" => "true"
                )
        ));
    }

    public function __destruct()
    {
     /*   unset($this->_body);
        unset($this->_body_secondary);
        unset($this->_image_carousel);
        unset($this->_images);
        unset($this->_card_title);
        unset($this->_card_text);
        parent::__destruct();*/
    }
    public function assemble() {
        $img_count = 0;
        $this->add_child($this->_image_carousel);
        $this->add_child($this->_body_secondary);
        foreach ($this->_images as $value) {
            $over = new Element("div", false);
            $li = new Element("li", false, array(
                "data-target" => "#user_carousel",
                "data-slide-to" => $img_count
            ));
            $over->add_class("carousel-item");
            if ($img_count == 0) {
                $li->add_class("active");
                $over->add_class("active");
            }
            $over->add_child($value);

            $this->querySelector(".carousel-indicators")->add_child($li);
            $this->querySelector(".carousel-inner")->add_child($over);
            $img_count++;
        }

        $this->_body->add_child(new Element("div", false, array("class" => "d-flex justify-content-center", "id" => "btn_div")));
        $tmp = $this->_body->querySelector("#btn_div");
        $tmp->add_child(new Element("div", false, array("class" => "col")));
        $tmp->add_child(new Element("div", false, array("class" => "col")));
        $tmp->first_child()->add_child(new Element("button", false, array("class" => "btn purple-gradient btn-like")));
        $tmp->child_at(1)->add_child(new Element("button", false, array("class" => "btn blue-gradient btn-reject")));
        $this->add_child($this->_body);
    }

    public function add_images($src, $is_path = true, $attributes = array()) {
        $img_new = new Element("img", true);

        if ($is_path == true) {

            $img_new->add_attribute("src", $src);
            $img_new->add_attributes($attributes);
        } else {
            if (isset($attributes["type"])) {
                $img_new->add_attribute("src", "data:image/" . $attributes["type"] . ";base64," . ($src));
            }
            $img_new->add_attributes($attributes);
        }
        array_push($this->_images, $img_new);
    }

    public function set_bioText($text) {
        $this->_body_secondary->add_text($text);
    }

    public function set_Title($text) {
        $this->_card_title->add_text(trim($text));
    }

    public function set_cardtext($text) {
        $this->_card_text->add_text(trim($text));
    }

}

?>
