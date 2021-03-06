<?php
error_reporting(E_ALL ^ E_DEPRECATED);
class DB_Functions {

    private $db;

    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $this->db = new DB_Connect();
	$this->db->connect();
    }

    // destructor
    function __destruct() {

    }

    /**
     * Store user details
     */
    public function storeUser($name, $email, $password) {
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
        $result = mysqli_query($this->db->con,"INSERT INTO users(user_name, user_email, user_password, salt) VALUES('$name', '$email', '$encrypted_password', '$salt')") or die(mysqli_error($this->db));
        // check for result
        if ($result) {
            // gettig the details
            $uid = mysqli_insert_id($this->db->con); // last inserted id
            $result = mysqli_query($this->db->con,"SELECT * FROM users WHERE user_id = $uid");
            // return details
            return mysqli_fetch_array($result);
        } else {
            return false;
        }
    }

    /*
     *create news,insert records to news table
     */
    //public function createNews($title,$content,$writer) {
    public function createNews($title,$content,$image,$pubDate) {
        //$result = mysqli_query($this->db->con,"insert into news(title,writer,content) values('$title','$content','$writer')")
        $result = mysqli_query($this->db->con,"insert into news(title,content,image,pubDate)
            values('$title','$content','$image','$pubDate')")
            or die(mysqli_error($this->db));
        //check for result
        if($result) {
            //getting the detatils
            $newsId = mysqli_insert_id($this->db->con);
            $imageName = $newsId.".jpg";
            $imageFilePath = "image/".$imageName;
            if(file_exists($imageFilePath)){
                unlink($imageFilePath);
            }
            //create a new empty file
            $myfile = fopen($imageFilePath,"w") or die ("unable to open file");
            //add data to that file
            file_put_contents($imageFilePath,base64_decode($image));
            $result = mysqli_query($this->db->con,"select *from news where newsId = $newsId");
            //return details
            return mysqli_fetch_array($result);
        }else {
            return false;
        }
    }

    /**
     * Get user by email and password
     */
    public function getUserByEmailAndPassword($email, $password) {
        $result = mysqli_query($this->db->con,"SELECT * FROM users WHERE user_email = '$email'") or die(mysqli_connect_errno());
        // check for result
        $no_of_rows = mysqli_num_rows($result);
        if ($no_of_rows > 0) {
            $result = mysqli_fetch_array($result);
            $salt = $result['salt'];
            $encrypted_password = $result['user_password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password
            if ($encrypted_password == $hash) {
                return $result;
            }
        } else {
            return false;
        }
    }

    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $result = mysqli_query($this->db->con,"SELECT user_email from users WHERE user_email = '$email'");
        $no_of_rows = mysqli_num_rows($result);
        if ($no_of_rows > 0) {
            // user exist
            return true;
        } else {
            // user not exist
            return false;
        }
    }

    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {

        $hash = base64_encode(sha1($password . $salt, true) . $salt);

        return $hash;
    }

}

?>
