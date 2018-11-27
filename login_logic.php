<?php
/**
 * 
 */
require_once 'DBconnect.php';

function logMeIn(){
	try{
		global $loginerr;
		session_start();
		 
		if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
			//Already logged in
		    // header("location: index.php");
		    // exit;
		}
		$username = $password = "";
		if(empty(trim($_POST["username"]))){
			$loginerr = "Please enter username.";
		}
		else if(empty(trim($_POST["password"]))){
			$loginerr = "Please enter your password.";
		} 
		else{
			$username = trim($_POST["username"]);
			$password = trim($_POST["password"]);
		}

    	if(empty($loginerr)){
    		$instance = DBconnect::getInstance();
			$conn = $instance->getConnection();
	    	$sql = "select name, email, password, role from users where name = :username";

	    	if($stmt = $conn->prepare($sql)){
	    		$stmt->bindParam(":username", $username, PDO::PARAM_STR);

		    	if($stmt->execute()){
		    		if($stmt->rowCount() == 1){
	                    if($row = $stmt->fetch()){
	                        $username = $row["name"];
	                        $hashed_password = $row["password"];
	                        $email = $row["email"];
	                        $role = $row["role"];

	                        if(password_verify($password, $hashed_password)){
	                        // if($password === $hashed_password){
	                            // session_start();
	                            $_SESSION["loggedin"] = true;
	                            $_SESSION["email"] = $email;
	                            $_SESSION["username"] = $username;
	                            $_SESSION["role"] = $role;
	                            $loginerr = "Login success";

	                            // Redirect user to home page
	                            // header("location: index.php");
	                        } else{
	                            $loginerr = "Invssalid username/password.";
	                        }
	                    }
	                } else{
	                    $loginerr = "Invalid username/password.";
	                }
	            } else{
	            	echo "Something is wrong. Please try again.";
	            }
        	}
    	}

	}catch(PDOException $e){
	    echo $e->getMessage();
	}
}

$loginerr = "";
if (isset($_POST['submit']) && $_POST['submit'] == "login" ) {
	logMeIn();
}

