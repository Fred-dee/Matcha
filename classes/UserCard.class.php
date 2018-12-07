<?php
    require_once $_SERVER["DOCUMENT_ROOT"].'/Matcha/classes/Element.php';
    class UserCard extends Element
    {
        protected
                $_body,
                $_body_secodary,
                $_image_carousel,
                $_images = array();
        public function __construct()
        {
            parent::__construct("div", false);
            $this->add_class("card");
            $this->_body = new Element("div", false);
            $this->_body->add_class("card-body");
            $this->_body_secondary = new Element("div", false);
            $this->_body_secondary->add_class("card-body card-body-secondary");
//            <span class="bio-close"><i class="fas fa-angle-up"></i></span>
            
            $this->_body_secondary->add_child(new Element("span", false));
            $this->_body_secondary->first_child()->add_child(new Element("i", false));
            $this->_body_secondary->first_child()->add_class("bio-close");
            $this->_body_secondary->first_child()->first_child()->add_class("fas fa-angle-up");
            $this->_image_carousel = new Element("div", false);
            $this->_image_carousel->add_class("view overlay");
        }
        
        public function assemble()
        {
            $img_count = 0;
            foreach($this->_images as $value)
            {
                $over = new Element("div", false);
                $over->add_class("carousel-item");
                if($img_count == 0)
                    $over->add_class("active");
                $over->add_child($value);
                $this->_image_carousel->add_child( $over);
                $img_count++;
            }
            $this->add_child($this->_image_carousel);
            $this->add_child($this->_body_secondary);
            $this->add_child($this->_body);            
        }
        
        public function add_images($src, $is_path = true, $attributes = array())
        {
            $img_new = new Element("img", true);
            
            if ($is_path == true)
            {
                
                $img_new->add_attribute("src", $src);
                $img_new->add_attributes($attributes);
 
            }
            else
            {
                if (isset($attributes["type"]))
                {
                     $img->add_attribute("src", "data:image/".$attributes["type"].";base64," . ($src));
                }
                $img_new->add_attributes($attributes);
            }   
            array_push($this->_images, $img_new);
        }
        
        public function add_bioText($text)
        {
            $this->_body_secondary->add_text($text);
        }
        
    }
?>
