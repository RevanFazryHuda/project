<?php
session_start(); 
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'default'; // Gunakan default jika kosong
include('leftmenu_' . $role . '.php');
?>
