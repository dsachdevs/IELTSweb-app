<?php
/**
 *
 */
require_once 'DBconnect.php';

function registerUser() {
	try {
		global $registererr;
		session_start();

		if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
			//Already logged in
			// header("location: index.php");
			// exit;
		}
		$username = $email = $password = "";
		if (empty(trim($_POST["username"]))) {
			$registererr = "Please enter username.";
		} else if (empty(trim($_POST["email"]))) {
			$registererr = "Please enter your email.";
		} else if (empty(trim($_POST["password"]))) {
			$registererr = "Please enter password.";
		} else if (empty(trim($_POST["repeat"]))) {
			$registererr = "Please re-enter your password.";
		} else if (trim($_POST["password"]) !== trim($_POST["repeat"])) {
			$registererr = "Passwords don't match! Please verify.";
		} else {
			$username = trim($_POST["username"]);
			$email = trim($_POST["email"]);
			$password = trim($_POST["password"]);
			// $repeat = trim($_POST["repeat"]);
		}

		if (empty($registererr)) {
			$instance = DBconnect::getInstance();
			$conn = $instance->getConnection();
			$sql = "SELECT name FROM users WHERE name = :username";

			if ($stmt = $conn->prepare($sql)) {
				$stmt->bindParam(":username", $username, PDO::PARAM_STR);

				if ($stmt->execute()) {
					if ($stmt->rowCount() == 1) {
						$registererr = "This username is already taken.";
					}
				} else {
					echo "Oops! Something went wrong. Please try again later.";
				}
			}
		}

		if (empty($registererr)) {
			$instance = DBconnect::getInstance();
			$conn = $instance->getConnection();
			$sql = "SELECT email FROM users WHERE email = :email";

			if ($stmt = $conn->prepare($sql)) {
				$stmt->bindParam(":email", $email, PDO::PARAM_STR);

				if ($stmt->execute()) {
					if ($stmt->rowCount() == 1) {
						$registererr = "This email is already taken.";
					}
				} else {
					echo "Oops! Something went wrong. Please try again later.";
				}
			}
		}

		if (empty($registererr)) {
			$instance = DBconnect::getInstance();
			$conn = $instance->getConnection();
			$role = '101';
			$sql = "INSERT INTO users (name, email, password, role) VALUES (:username, :email, :password, :role)";

			if ($stmt = $conn->prepare($sql)) {
				$stmt->bindParam(":username", $username, PDO::PARAM_STR);
				$stmt->bindParam(":email", $email, PDO::PARAM_STR);
				$stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
				$stmt->bindParam(":role", $role, PDO::PARAM_STR);

				$param_password = password_hash($password, PASSWORD_DEFAULT);

				// $param_password = $password;

				if ($stmt->execute()) {
					// Redirect to login page
					header("location: login.php");
				} else {
					echo "Something is wrong. Please try again.";
				}
			}
		}

	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}

$registererr = "";
if (isset($_POST['submit']) && $_POST['submit'] == "register") {
	registerUser();
}
