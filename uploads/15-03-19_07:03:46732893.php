<?php 
// Database definition for MySQL server
define("DB_HOST", "whatever.com");
define("DB_USER", "user");
define("DB_PASS", "pass");
?>


<?php 

// index.php

// Log In Script
// Main Page that allow users to log in and create new accounts

require_once('login.class.php');


$login = new Login();
$login->startSession();
$login->connectToDB();
$session_id = session_id();


// If the user has a cookie set, redirect him to secure page
if($login->isAuthorized()) {
    header("Location: securePage.php"); 
}

if($_POST['login']){

    // get the data, trim the blank spacesß
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    //if checked, the value will be 'on'
    //otherwise, it will be blank
    $rememberme = $_POST['rememberme'];

    // verify if the username and password are correct
    // and if rememberme is set to 'on', create a cookie

    if($username && $password){

        // Check the login details and redirect to securePage.php
        // if the password is not correct, notify the user
        $login->checkLogin($username, $password, $rememberme, $session_id);

    } else {

        echo("Please enter a username and password");

    }
}
if($_POST['create']){

    // create an account
    // and notify the user the account has been created
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $login->addUser($username, $password, $first_name, $last_name, $email);


}

?>
<html>
<head>
<style type="text/css">
#table {
    width: 340px;
    height: 450px;
    margin: 0 auto;
    border: 3px solid;
    padding: 20px;
}
</style>
</head>
<br/>
<br/>
<div id="table">
<form action="index.php" method="POST">
Existing Users<hr/>
Username:
<input type="text" name="username"></input>
<br/>
<br/>
Password:
<input type="password" name="password"></input>
<br/>
<br/>
<input type="checkbox" name="rememberme"> Keep Me Logged In</input>
<br/>
<br/>
<input type="submit" name="login" value="Log In"></input>
</form>

<form action="index.php" method="POST">
New Users - Sign Up Below<hr/>
Username:
<input type="text" name="username"></input>
<br/>
<br/>
Password:
<input type="password" name="password"></input>
<br/>
<br/>
First Name:
<input type="text" name="first_name"></input>
<br/>
<br/>
Last Name:
<input type="text" name="last_name"></input>
<br/>
<br/>
E-Mail: &nbsp;&nbsp;&nbsp;&nbsp;    
<input type="text" name="email"></input>
<br/>
<br/>
<input type="submit" name="create" value="Create A New Account"></input>
</form>


</div>
</html>

<?php 



// login.class.php
// This class contains most of the user's functionality 
/*
 *  MySQL Database Information Below
 *  the reason for password being 82 chars is because of the way the salt will be generated and added


// user table  
CREATE TABLE `users` (
    `id` INT NOT NULL AUTO_INCREMENT ,
    `username` VARCHAR( 64 ) NOT NULL,
    `password` VARCHAR( 82 ) NOT NULL,
    `first_name` VARCHAR( 64 ) NOT NULL,
    `last_name` VARCHAR( 64 ) NOT NULL,
    `email` VARCHAR ( 64 ) NOT NULL,
    PRIMARY KEY ( `id` ) ,
    UNIQUE KEY ( `username`), 
    UNIQUE KEY ( `email` )
)

// table for storing cookie sessions
 * 
 You save the session_id in a cookie 
 and once the person visits the website again, 
 the page pulls up a cookie and gets session_id. 
 You then compare current ip and user agent to the ones stored in Session table. 
 After that, you pull up user's data based on user_id from users table.

CREATE TABLE `sessions` (
`id` INT NOT NULL AUTO_INCREMENT,
`session_id` VARCHAR(64) NOT NULL, 
`user_ip` VARCHAR(64) NOT NULL ,
`user_agent` VARCHAR(100) NOT NULL,
`user_id` VARCHAR(64) NOT NULL,
PRIMARY KEY ( `id` )
) 

*/

// db defines
require_once('db_config.php');



// Salt Length for generateHash function
define('SALT_LENGTH', 9);

class Login {

    private $username;
    private $password;
    private $first_name; 
    private $last_name;
    private $email;
    private $session_id;

    public function __construct(){
    }

    // starts a session
    public function startSession(){
        session_start();
    }

    // Creates a new account based on a new user name and password
    // username must be unique
    // password gets md5 (hashed)
    // It also checks if username already exists
    public function addUser($username, $password, $first_name, $last_name, $email){
        $username = $this->clean($username);
        $password = $this->generateHash($this->clean($password));
        $first_name = $this->clean($first_name);
        $last_name = $this->clean($last_name);
        $email = $this->clean($email);

        // Check if username already exists
        $query = ("SELECT * FROM users WHERE username = '$username' LIMIT 0,5");    

        $result = mysql_query($query) OR die("Cannot perform query!");

        // Check if user name already exists and if it does not exist, create a new account

        if (mysql_num_rows($result) >= 1) {
            echo "User's name already exists. Please pick another one!";        
        } else {

            // otherwise create an account
            $query = "INSERT INTO users VALUES('', '" . $username . "', '" . $password . "', '" . $first_name . "'
                        , '" . $last_name . "', '" . $email . "')";       
            $result = mysql_query($query) OR die('Cannot perform query! Make sure you have filled out all the fields!');    
            echo "Your account has been created. You can now log in.";
        }
    }

    public function deleteUser($username){
        $username = $this->clean($username);
         // Check if username already exists
        $query = "DELETE FROM users WHERE username = '$username'";      

        $result = mysql_query($query) OR die("Cannot perform query!");
        $this->destroyCookieAndSession();
        header("Location: index.php");

    }

    // updates user's information
    public function updateUser($username, $password){

        $username = $this->clean($username);
        $password =  $this->generateHash($this->clean($password));

        $query = "UPDATE users SET password ='$password' WHERE username = '$username'";     

        //die();    
        $result = mysql_query($query) OR die("Cannot perform query!");
        echo "Your changes have been saved.<br/>";

    }

    // Check if the user account and password match the one in the database
    public function checkLogin($username, $password, $rememberme, $session_id) {

        $this->username = $this->clean($username);
        $this->password = $this->clean($password);
        $this->$session_id = $session_id;

        //extract the salt/hash from db and check if the hash/password is correct
        $query = "SELECT * FROM users WHERE username = '" . $this->username . "' LIMIT 0,1"; 

        $result = @mysql_query($query) OR die('Cannot perform query!'); 
        $row = mysql_fetch_array($result, MYSQL_ASSOC);
        $dbHash = $row['password'];


        // generates hash based on the submitted password and stored salt
        $this->password = $this->generateHash($this->password, $dbHash);


        $query = "SELECT * FROM users WHERE username = '" . $this->username . "' AND 
                password ='" . $this->password . "' LIMIT 0,1";                                             

        $result = mysql_query($query) OR die('Cannot perform query!');  


        if (mysql_num_rows($result) == 1) {     

            //set a cookie if rememberme is set to 'on' 

            if($rememberme == "on"){
                $this->setRememberMe($session_id);

        }

        // user has logged in successfuly, store all his information in this object 
        // before redirecting to securePage.php
        $this->setFirstName($row['first_name']);
        $this->setLastName($row['last_name']);
        $this->setEmail($row['email']);


        $this->createSession();
        header("Location: securePage.php");
        exit();

        } else {

            echo "Incorrect username or/and password.";
        }

        // frees the memory used by query   
        mysql_free_result($result);         
    }

    private function createSession(){


        // save state of this object before passing
        // php automatically serializes the object
        // and will automatically unserialize it

        $_SESSION['usrData'] = $this;

    }

    // sets the cookie
    // which allows the user to be logged into automatically
    private function setRememberMe($session_id){

        // check if the user id exists in the session db, if it does, delete that row

        $query = "SELECT * FROM sessions WHERE user_id = '" . $this->getUsername() . "' LIMIT 0,5"; 
        $result = mysql_query($query) OR die("Cannot perform query!");

        if (mysql_num_rows($result) >= 1) {
            $query = "DELETE FROM sessions WHERE user_id = '" . $this->getUsername() . "'"; 
            $result = mysql_query($query) OR die("Cannot perform query!");
        }

        // insert the user's information into a session table
        $query = "INSERT INTO sessions (session_id, user_ip, user_agent, user_id) 
                  VALUES('" . $session_id . "', '" . $_SERVER['REMOTE_ADDR'] . "', '" . 
                  $_SERVER['HTTP_USER_AGENT'] . "', '" . $this->getUsername() . "')";
        $result = mysql_query($query) OR die('Cannot perform query!!'); 

        // create a cookie with session_id         
        setcookie("autologin", $session_id, time() + 60*60*24*365, "/");

    }

    // check if the user has access to the page
    public function isAuthorized() {

        // check the session access
        if(isset($_COOKIE['autologin']) ) {

            // check if user information matches up
            // we do that by checking user agent and user ip information
            $session_id = $_COOKIE['autologin'];
            $user_ip = $_SERVER['REMOTE_ADDR'];
            $user_agent =  $_SERVER['HTTP_USER_AGENT'];

            $query = "SELECT * FROM sessions WHERE session_id = '" . $session_id . "'";                                         

            $result = mysql_query($query) OR die('Cannot perform query!');  

            // query the results only once since there's supposed to be only
            // one record for each session_id
            $row = mysql_fetch_assoc($result); 

            if ( $row["user_ip"] == $user_ip && $row["user_agent"] == $user_agent)
            {
                // if everything matches, create a new Login object based on user ID

                // Check if username already exists
                $query2 = "SELECT * FROM users WHERE username = '" . $row["user_id"] . "' LIMIT 0,5";   
                $result2 = mysql_query($query2) OR die("Cannot perform query!");
                while ( $row2 = mysql_fetch_assoc($result2) ){
                    $this->username = $row2['username'];
                    $this->first_name = $row2['first_name'];
                    $this->last_name = $row2['last_name'];
                    $this->password = $row2['password'];
                    $this->email = $row2['email'];
                    $this->session_id = $session_id;
                } 

                $_SESSION['usrData'] = $this;
                return true;

            } else {
                // Information does not match
                return false;
            }

        } else {
            // if cookie is not set.
            return false;
        }

    }

    // private function that allows connection to the database 
    public function connectToDB() { 
        @mysql_connect(DB_HOST, DB_USER, DB_PASS) OR die("Cannot connect to MySQL server!");    
        mysql_select_db("dig_login") OR die("Cannot select database!");
    }


    // Returns the username of a user
    public function getUsername() {
        return $this->username;
    }

    // Returns the plain text password of a user
    public function getPassword() {
        return $this->password;
    }
    // Returns first name
    public function getFirstName() {
        return $this->first_name;
    }
    // Returns last name
    public function getLastName() {
        return $this->last_name;
    }
    public function getEmail() {
        return $this->email;
    }
    //gets session
    public function getSessionID(){
        return $this->session;
    }


    // sets first name
    public function setFirstName($firstName) {
        $this->first_name = $firstName;
    }
    // sets last name
    public function setLastName($lastName) {
        $this->last_name = $lastName;
    }
    // sets email
    public function setEmail($email) {
        $this->email = $email;
    }


    // Escape bad input, sql injections, etc 
    private function clean($input) {
        return mysql_real_escape_string($input);
    }   

    // Kill the cookie
    public function destroyCookieAndSession(){
        setcookie('autologin', '', time()-42000, '/');
        session_unset();
        session_destroy();

    }
    // This is a function that does the hashing
    // we are going to use sha256 as hashing algorithm 
    // If $salt is not passed, it creates a new salt
    // otherwise it extracts the salt from db 
    public function generateHash($password, $salt = null){

        if ($salt === null)
        {
            $salt = substr(md5(uniqid(rand(), true)), 0, SALT_LENGTH);
        }
        else
        {
            $salt = substr($salt, 0, SALT_LENGTH);

        }


        return $salt . hash('sha256', $salt . $password);

    }

}
?>

<?php 
// securePage.php
// if the user has successfully logged in, this page will be shown.

// The form is generated by SESSION variables

require_once('login.class.php');
session_start();

// if session usr data does not exist, redirect to login page
if(!$_SESSION['usrData']){
    header("Location: index.php");
}

$login = $_SESSION['usrData'];

// re-establish DB connection since Object's DB connection is not persistent
// once the object is passed through the session
$login->connectToDB();

echo "<br/>";
echo "Hello " . $login->getFirstName() . " " . $login->getLastName();
echo "<br/><br/>";



if( $_POST['save'] ){

    $login->updateUser(trim($_POST['username']), trim($_POST['password']));


}
if($_POST['delete']){

        $login->deleteUser(trim($_POST['username']));

}

// Logs out the user
if(isset($_GET['logout']) == "true"){
    $login->destroyCookieAndSession();
    header("Location: index.php");
}

?>
<br/><br/>
<form action="securePage.php" method="post">
<hr/>
Username: <?php echo $login->getUserName(); ?>
<input type="hidden" name="username" value="<?php echo $login->getUserName(); ?>"></input>
<br/>
<br/>
Password:
<input type="password" name="password"></input>
<br/>
<br/>
<br/>
<input type="submit" name="save" value="Save Changes"></input>
<input type="submit" name="delete" value="Delete Account"></input>
</form>
<hr/>
<br/>
<br/>
<a href="./securePage.php?logout=true">Log Out</a>
