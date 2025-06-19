<?php 
require_once '../includes/functions.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isLoggedIn()){
    header("location: dashboard.php");
}else{
    header("location: login-admin.php");

}
?>