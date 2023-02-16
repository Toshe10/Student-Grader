<?php

session_start();

// Unset na site sesiski promenlivi

$_SESSION = array();

// da ja ponistime sesijata

session_destroy();

// redirektirame na login

header('location:login.php');
exit;
?>