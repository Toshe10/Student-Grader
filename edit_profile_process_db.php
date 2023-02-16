<?php
session_start();

require 'config.php';
require 'includes/header.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location:login.php");
    exit;
}


$user_id = $_SESSION['id'];


$fname_err = $lname_err = $email_err = "";
$fname = $lname = $email = "";

// procesiranje na podatoci
if ($_SERVER['REQUEST_METHOD'] == "POST") {

  // validacija za fname i lname

  // trim();
  // empty();



  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  


  // fname
  if (empty(trim($fname))) {
    $fname_err = "Please enter your first name";
  } else {
    $fname = trim($_POST['fname']);
  }
  // lname
  if (empty(trim($lname))) {
    $lname_err = "Please enter your last name";
  } else {
    $lname = trim($_POST['lname']);
  }
   // email
   if (empty(trim($email))) {
    $email_err = "Please enter your email";
  } else {
    $email = trim($_POST['email']);
  }


echo $fname.'<br>';
echo $lname.'<br>';
echo $email.'<br>';

  if (empty($fname_err) && empty($lname_err) && empty($email_err)) {


    // $sql = "INSERT INTO users (fname, lname, email, username, password, created_at) 
    //  VALUES (:fname, :lname, :email, :username, :password, :created_at)";

    $sql = 'UPDATE users SET fname=:fname, lname=:lname, email=:email WHERE user_id=:id';

    if ($stmt = $pdo->prepare($sql)) {

      // bind na varijabli

      $stmt->bindParam("fname", $param_fname);
      $stmt->bindParam("lname", $param_lname);
      $stmt->bindParam("email", $param_email);
      $stmt->bindParam("id", $param_id);



      // setiranje na parametri

      $param_fname = $fname;
      $param_lname = $lname;
      $param_email = $email;
      $param_id = $user_id;





      // ke izvrsime stmt

      if ($stmt->execute()) {
        echo "Uspesno updejtirani podatoci vo baza";
      } else {
        echo "nesto ne e vo red";
      }
    }
  }
}



?>
<p><a href="profile.php">Prikazi go mojot profil</a></p>