<?php
session_start(); // loads session
session_unset(); // removes session variables
session_destroy(); // destroys session
header("Location: index.php"); // redirects to index.php
?>