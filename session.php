<?php include 'inc/header.php' ?>

<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    $_SESSION["redirectURL"] = $_SERVER["REQUEST_URI"];
    echo $_SERVER['REQUEST_URI'];
    // header('location:dashboard.php');
}
?>