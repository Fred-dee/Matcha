<?php

class Element {

    protected $_tagname;
    protected $_classes = array();
    protected $_attributes = array();
    protected $_children = array();
    protected $_inlineattr = array();
    protected $_isInline;
    protected $_text;
    protected $_parent = null;

    public function __construct($elem_name, $inline, $array = array()) {
        $this->_tagname = $elem_name;
        $this->_isInline = $inline;
        $this->_text = "";
        $this->add_attributes($array);
    }
    
    public function __destruct()
    {
        unset($this->_tagname);
        unset($this->_classes);
        unset($this->_attributes);
        unset($this->_children);
        unset($this->_inlineattr);
        unset($this->_isInline);
        unset($this->_text);
        unset($this->_parent);
    }

    public function add_class($class) {
        $class = trim($class);
        if (!(array_search($class, $this->_classes))) {

            if (strpos($class, ' ')) {
                $new_split = preg_split('/ /', $class);
                
                foreach ($new_split as $value) {

                    array_push($this->_classes, $value);
                }
            } else
                array_push($this->_classes, $class);
        }
    }

    public function prepend_child($child) {
        $child->_parent = $this;
        array_unshift($this->_children, $child);
    }

    private function searchTagName($query) {
        foreach ($this->_children as $key => $value) {
            if ($value->_tagname == $query)
                return ($value);
        }
        return null;
    }

    private function has_class($query)
    {
        foreach ($this->_classes as $class_value)
        {
            if ($class_value == $query)
                return true;
        }
        return false;
    }
    private function searchID($query) {

        foreach ($this->_children as $key => $value) {

            foreach ($value->_attributes as $att_name => $att_value) {


                if (isset($att_value["id"]) && $att_value["id"] == $query)
                    return $value;
            }
        }
        return null;
    }

    private function searchClassName($query) {

        if ($this->has_class($query))
            return $this;
        
        foreach ($this->_children as $key => $value){
            $ret = $value->querySelector(".".$query);
          if ($ret != null)
              return ($ret);
        }
        return null;
    }

    public function querySelector($query) {
        $query = trim($query);

        switch ($query[0]) {
            case "#":
                return $this->searchID(substr($query, 1, strlen($query)));
            case ".":
                return $this->searchClassName(substr($query, 1, strlen($query)));

            default :
                return $this->searchTagName($query);
        }
    }

    public function __toString() {
        $ret_string = "<" . $this->_tagname . " ";
        if (!empty($this->_classes)) {
            $ret_string .= " class='";
            $arrkeys = array_keys($this->_classes);
            $last_key = end($arrkeys);
            foreach ($this->_classes as $key => $value) {
                if (!($key == $last_key)) {
                    $ret_string .= $value . " ";
                } else {
                    $ret_string .= $value;
                }
            }
            $ret_string .= "' ";
        }
        foreach ($this->_attributes as $key => $value) {
            foreach ($value as $ind => $val) {
                $ret_string .= $ind . " = '" . $val . "'";
            }
        }
        foreach ($this->_inlineattr as $key => $value) {
            foreach ($value as $ind => $val) {
                $ret_string .= " " . $val . " ";
            }
        }
        if ($this->_isInline == true) {
            $ret_string .=" />";
        } else {
            $ret_string .= ">" . $this->_text;
            foreach ($this->_children as $value)
                $ret_string .= $value;
            $ret_string .= "</" . $this->_tagname . ">";
        }
        return $ret_string;
    }

    public function get_tagname() {
        return $this->_tagname;
    }

    public function add_attribute($att_name, $value) {
        if (!array_search(trim($att_name), $this->_attributes)) {
            if (trim($att_name) == "class") {

                $this->add_class($value);
            } else {
                array_push($this->_attributes, array(trim($att_name) => trim($value)));
            }
        }
    }

    public function add_attributes($attrs = array()) {
        //var_dump($attrs);
        foreach ($attrs as $key => $value) {
            //echo $key."    ".$value;

            if (trim($key) == "class") {
                $this->add_class(trim($value));
            } else
                array_push($this->_attributes, array(trim($key) => trim($value)));
        }
    }

    public function add_inlineattr($attr) {
        $attr = trim($attr);
        if (!array_search($attr, $this->_inlineattr)) {
            array_push($this->_inlineattr, array($attr => $attr));
        }
    }

    public function remove_inlineattr($attr) {
        $attr = trim($attr);
        $index;
        if (($index = array_search($attr, $this->_inlineattr))) {
            $this->_inlineattr[$index] = NULL;
            $this->_inlineattr[$index] = array_filter($thhis->_inlineattr);
        }
    }

    public function remove_class($class) {
        $class = trim($class);
        $index;
        if (($index = array_search($class, $this->_classes))) {
            $this->_classes[$index] = NULL;
            $this->_classes = array_filter($this->_classes);
        }
    }

    public function remove_attribute($att_name) {
        $att_name = trim($att_name);
        $index;
        if (($index = array_search($att_name, $this->_attributes))) {
            $this->_attributes[$index] = NULL;
            $this->_attributes = array_filter($this->_attributes);
        }
    }

    public function mod_attribute($att_name, $nvalue) {
        $att_name = trim($att_name);
        $nvalue = trim($nvalue);
        if (($index = array_search($att_name, $this->_attributes))) {
            $this->_attributes[$index] = $nvalue;
        } else {
            array_push($this->_attributes, array($att_name => $nvalue));
        }
    }

    public function add_text($string) {
        $this->_text = $string;
    }

    public function get_text() {
        return $this->_text;
    }

    public function add_child($elem) {
        $elem->_parent = $this;
        array_push($this->_children, $elem);
    }

    public function get_children() {
        return $this->_children;
    }

    public function first_child() {

        return (isset($this->_children[0]) ? $this->_children[0] : -1);
    }

    public function child_at($index) {
        return (isset($this->_children[$index]) ? $this->_children[$index] : -1);
    }

    public function insertBefore($index, $child) {
        if ($index > -1 && $child instanceof Element) {
            //$to_insert = array($child);
            $child->_parent = $this;
            $original = $this->_children;
            $this->_children = array_merge(
                    array_slice($original, 0, $index), array($child), array_slice($original, $index));
            return true;
        }
        return false;
    }

    public function parentNode() {
        return (isset($this->_parent) ? $this->_parent : null);
    }

}

?>