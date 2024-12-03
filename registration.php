<?php
include_once('head.php');

// checks if the user is already in database 
function username_exists($username){
	global $conn;
	$username = mysqli_real_escape_string($conn, $username);
	$query = "SELECT * FROM users WHERE username='$username'";
	$res = $conn->query($query);
	return mysqli_num_rows($res) > 0;
}

// user creation
function register_user($username, $password){
	global $conn;
	$username = mysqli_real_escape_string($conn, $username);
	$pass = password_hash($password, PASSWORD_BCRYPT);
	
	$query = "INSERT INTO users (username, password) VALUES ('$username', '$pass');";
	if($conn->query($query)){
		return true;
	}
	else{
		echo mysqli_error($conn);
		return false;
	}
}

$error = "";
if(isset($_POST["register"])){
    // username length validation
    if (empty($_POST['username']) ||
        empty($_POST['password']) ||
        empty($_POST['repeat_password'])){
        $error = "Please fill all required fields!";
    }
	// password match validation
	else if($_POST["password"] != $_POST["repeat_password"]){
		$error = "Passwords do not match.";
	}
	// checks if username already exists in database
	else if(username_exists($_POST["username"])){
		$error = "Username already taken.";
	}
	// if data is validated, creates user
	else if(register_user($_POST["username"], $_POST["password"])){
		header("Location: login.php");
		die();
	}
	// registration error
	else{
		$error = "Unsuccessful registration.";
	}
}

?>
	<h2>Registration</h2>
	<form action="registration.php" method="POST">
		<label>Username</label><input type="text" name="username" /> <br/>
		<label>Password</label><input type="password" name="password" /> <br/>
		<label>Repeat password</label><input type="password" name="repeat_password" /> <br/>
        <input type="submit" name="register" value="Register" /> <br/>
		<label><?php echo $error; ?></label>
	</form>
    </body>
    </html>