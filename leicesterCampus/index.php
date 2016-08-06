<?php
error_reporting(E_ALL ^ E_DEPRECATED);
/**
 * File to handle all API requests
 * Accepts GET and POST
 *
 * Each request will be identified by TAG
 * Response will be JSON data
 /**
 * check for POST request
 */
if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // get tag
    $tag = $_POST['tag'];

    // include DB_function
    require_once 'DB_Functions.php';
    $db = new DB_Functions();

    // response Array
    $response = array("tag" => $tag, "error" => FALSE);

    // checking tag
    if ($tag == 'login') {
        // Request type is check Login
        $email = $_POST['email'];
        $password = $_POST['password'];

        // check for user
        $user = $db->getUserByEmailAndPassword($email, $password);
        if ($user != false) {
            // user found
            $response["error"] = FALSE;
            $response["user_id"] = $user["user_id"];
            $response["username"] = $user["user_name"];
            $response["user"]["name"] = $user["user_name"];
            $response["user"]["email"] = $user["user_email"];
            echo json_encode($response);
        } else {
            // user not found
            // echo json with error = 1
            $response["error"] = TRUE;
            $response["error_msg"] = "Incorrect email or password!";
            echo json_encode($response);
        }
    } else if ($tag == 'register') {
        // Request type is Register new user
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // check if user is already existed
        if ($db->isUserExisted($email)) {
            // user is already existed - error response
            $response["error"] = TRUE;
            $response["error_msg"] = "User already existed";
            echo json_encode($response);
        } else {
            // store user
            $user = $db->storeUser($name, $email, $password);
            if ($user) {
                // user stored successfully
                $response["error"] = FALSE;
                $response["uid"] = $user["user_id"];
                $response["user"]["name"] = $user["user_name"];
                $response["user"]["email"] = $user["user_email"];
                echo json_encode($response);
            } else {
                // user failed to store
                $response["error"] = TRUE;
                $response["error_msg"] = "Error occured in Registartion";
                echo json_encode($response);
            }
        }
    }elseif($tag == 'createNews') {
        // Request type is create news
        $title = $_POST['newsTitle'];
        $content = $_POST['newsContent'];
        $image = $_POST['image'];
       // $writer = $_POST['userName'];
       // $createNewsFinish = $db->createNews($title,$content,$writer);
        $createNewsFinish = $db->createNews($title,$content,$image);
        if($createNewsFinish) {
            //created news successfully
            $response["error"] = FALSE;
            echo json_encode($response);
        }else {
            //failed to create news
            $response["error"] = TRUE;
            $response["error_msg"] = "Error occured in creating news";
            echo json_encode($response);
        }
        }
    else {
        // user failed to store
        $response["error"] = TRUE;
        $response["error_msg"] = "Unknown 'tag' value. It should be either 'login' or 'register'";
        echo json_encode($response);
    }
}
?>
