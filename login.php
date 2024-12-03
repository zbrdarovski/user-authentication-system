<?php
include_once('head.php');

function validate_login($username, $password){
    global $conn;
    $username = mysqli_real_escape_string($conn, $username);
    $query = "SELECT * FROM users WHERE username='$username'";
    $res = $conn->query($query);
    if($user_obj = $res->fetch_object()){
           $hash = $user_obj->password;
        if(password_verify($password, $hash)){
            return $user_obj->id;
        }
    }
	return -1;
}

$error="";
if(isset($_POST["login"])){
	// checks login data
	if(($user_id = validate_login($_POST["username"], $_POST["password"])) >= 0){
		// saves logged user in session and redirects to index.php
		$_SESSION["USER_ID"] = $user_id;
        $_SESSION["USERNAME"] = $_POST["username"];
		header("Location: index.php");
		die();
	} else{
		$error = "Unsuccessful login.";
	}
}
?>
	<h2>Login</h2>
	<form action="login.php" method="POST">
		<label>Username</label><input type="text" name="username" /> <br/>
		<label>Password</label><input type="password" name="password" /> <br/>
		<input type="submit" name="login" value="Login" /> <br/>
		<label><?php echo $error; ?></label>
	</form>
    </body>
    </html>