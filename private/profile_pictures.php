<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/Matcha/init.php';
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
if (!isset($_SESSION))
   session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //var_dump($_POST);
    //print_r($_FILES);
    $array_response = array("status" => "", "message" => "");
    if ($_POST["submit"] == "insert") {
        if (isset($_SESSION["user_obj"]) && isset($_FILES)) {

            $imageFileType = strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));
            if ($_FILES["image"]["size"] > 1000000) {
                $array_response["status"] = "failure";
                $array_response["message"] = "File too large";
                echo json_encode($array_response);
                exit();
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $array_response["status"] = "failure";
                $array_response["message"] = "File type not supported";
                echo json_encode($array_response);
                exit();
            }
            $img_src = base64_encode(file_get_contents($_FILES["image"]["tmp_name"]));
			
            if (!$_SESSION["user_obj"]->insert_image($imageFileType, $img_src, (int) $_POST["position"])) {
                $array_response["status"] = "failure";
                $array_response["message"] = "File type not supported";
                echo json_encode($array_response);
                exit();
            } else {
                $array_response["status"] = "success";
                $array_response["message"] = "Image succesfully uploaded";
                $array_response["img_Src"] = $img_src;
                $array_response["filetype"] = $imageFileType;
				$array_response["position"] = $_POST["position"];
                echo json_encode($array_response);
                exit();
            }
			echo json_encode($array_response);
        }
    }
}
?>
