<?php
session_start();


require 'config.php';
require 'includes/header.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location:login.php");
    exit;
}



$get_user_id_test = $_GET['get_user_id'];
$get_user_id_test = $_SESSION['id'];
echo '<hr><strong>'. $get_user_id_test . '</strong><hr>';

// "DELETE FROM `users` WHERE `users`.`user_id` = 9"?
$sql = "DELETE FROM users WHERE user_id = :user_id";
if ($stmt = $pdo->prepare($sql)) {
    $stmt->bindParam(":user_id", $param_user_id);
    $param_user_id = $get_user_id_test;
    // echo $param_user_id ;
    if ($stmt->execute()) {
        // akauntot e izbrisan
        header( 'location:register.php');
        exit;
    } else {
        echo "Greska ne moze da se izbrise";

    }
}