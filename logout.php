<?php
session_start();
include("lib/functions.php");

unset($_SESSION['nama']);
unset($_SESSION['username']);

// Destroy the entire session
session_destroy();

// Redirect to a login page or wherever you want the user to go after logging out
header("Location: ".base_url()."login.php");
exit();
?>
