<?php

require "config.php";
include "includes/header.php";

$uname_err = $psw_err = '';
$uname = $psw = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $uname = $_POST['uname'];
  $psw = $_POST['psw'];

  // echo $psw;

  // username
  if (empty(trim($uname))) {
    $uname_err = 'Please enter your username';
  } else {
    $uname = trim($_POST['uname']);
  }

  //psw
  if (empty(trim($psw))) {
    $psw_err = 'Please enter your password';
  } else {
    $psw = trim($_POST['psw']);
  }

  $sql = "SELECT user_id, username, password FROM users WHERE username = :username";

  if ($stmt = $pdo->prepare($sql)) {

    //bindiranje
    $stmt->bindParam(":username", $param_uname);

    //setiranje
    $param_uname = $uname;

    if ($stmt->execute()) {
      if ($stmt->rowCount() == 1) {
        if ($row = $stmt->fetch()) {
          $username = $row['username'];
          $password = $row['password'];
          $id = $row['user_id'];
          if ($password == $psw);

          if ($password == $psw) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $id;
            header("location:index.php");
          } else {
            echo " your password is incorrect";
          }
        }
      } else {
        echo "username is wrong";
      }
    }
  }
}
?>
<div id="container">
  <h2 style="padding-bottom: 5%; font-size:30px;">Login</h2>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <label for="uname">Username:</label><br>
    <input type="text" style="height:40px; font-size:30px;" id="uname" name="uname" placeholder="Username"><br><br>
    <span><?php echo $uname_err; ?></span><br>
    <label for="psw">Password:</label><br>
    <input type="password" style="height:40px;  font-size:30px;" id="psw" name="psw" placeholder="Password"><br><br>
    <span><?php echo $psw_err; ?></span><br>
    <input type="submit" value="Submit" id="submit" class="buttonSubmit" >
    <input type="reset" value="Reset" id="submit" style="    background-color: white;
    color: blue;
    border-radius: 5px;
    height:40px;
    width:60px;
    font-size: 20px;" >
    
    <p>Forgot password?</p>
    <a class="buttonRegister" href="register.php">Create new account</a>
  </form>
</div>

<?php
require "includes/footer.php";
?>