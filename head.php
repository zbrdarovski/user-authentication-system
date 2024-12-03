<?php
	session_start();
	
	// session expires in 30 minutes
	if(isset($_SESSION['LAST_ACTIVITY']) && time() - $_SESSION['LAST_ACTIVITY'] < 1800){
		session_regenerate_id(true);
	}
	$_SESSION['LAST_ACTIVITY'] = time();
	
	// connect to database
	$conn = new mysqli('localhost', 'root', '', 'database', 3306);

	// character encoding, used for communication with the database
	$conn->set_charset("UTF8");
?>
<html>
<head>
	<title>User Authentication System</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>
	<h1>Menu</h1>
	<nav>
		<ul>
			<li><a href="index.php">Home</a></li>
			
            <?php
			if(isset($_SESSION["USER_ID"])){
				?>
				<li><a href="logout.php">Logout</a></li>
				<?php
			} else{
				?>
				<li><a href="login.php">Login</a></li>
				<li><a href="registration.php">Registration</a></li>
				<?php
			}
			?>
		</ul>
	</nav>
	<hr/>
    
    <?php
			if(isset($_SESSION["USER_ID"])){
                ?>
				<h3>Hi, <?php echo $_SESSION["USERNAME"]?>!</h3>
			<?php
            } 
            ?>
