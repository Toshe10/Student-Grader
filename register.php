<?php

require 'config.php';
require 'includes/header.php';

$fname_err = $lname_err = $email_err = $uname_err = $psw_err = "";
$fname = $lname = $email = $uname = $psw = $created_at = "";

// procesiranje na podatoci
if ($_SERVER['REQUEST_METHOD'] == "POST") {

  // validacija za fname i lname

  // trim();
  // empty();



  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $uname = $_POST['uname'];
  $psw = $_POST['psw'];
  $created_at = time();

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
    // password
    // strlen()
    if (empty(trim($psw))) {
      $psw_err = "Please enter your password";
    } else if (strlen(trim($psw)) < 4) {
      $psw_err = 'Password must have altest 4 chars';
    } else {
      $psw = trim($_POST['psw']);
    }
  // username
  if (empty(trim($uname))) {
    $uname_err = "Please enter your username";
  } else {
    $uname = trim($_POST['uname']);



    // PREPARE select

    $sql = "SELECT user_id FROM users WHERE username = :username";

    if ($stmt = $pdo->prepare($sql)) {

      $stmt->bindParam(":username", $param_username);

      $param_username = trim($_POST['uname']);
    }

    if ($stmt->execute()) {
      if ($stmt->rowCount() >= 1) {
        $uname_err = "This username taken, please ....";
      } else {
        $uname = trim($_POST['uname']);
      }
    } else {
      echo "Stmt is wrong";
    }
    unset($stmt);
  }

  // ako nekoja od promenlivite za greski ima vrednost 

  // ako site promenlivi za greski se prazni (nema vrednost) => (znaci) deka e ok

  if (empty($fname_err) && empty($lname_err) && empty($uname_err) && empty($email_err) && empty($psw_err)) {


    $sql = "INSERT INTO users (fname, lname, email, username, password, created_at) 
     VALUES (:fname, :lname, :email, :username, :password, :created_at)";

    if ($stmt = $pdo->prepare($sql)) {

      // bind na varijabli

      $stmt->bindParam("fname", $param_fname);
      $stmt->bindParam("lname", $param_lname);
      $stmt->bindParam("email", $param_email);
      $stmt->bindParam("username", $param_username);
      $stmt->bindParam("password", $param_password);
      $stmt->bindParam("created_at", $param_created_at);


      // setiranje na parametri

      $param_fname = $fname;
      $param_lname = $lname;
      $param_email = $email;
      $param_username = $uname;
      $param_password = $psw;
      $param_created_at = $created_at;

      
      
      ?>
     <div style="text-align: center;">
<?php
      // ke izvrsime stmt

      if ($stmt->execute()) {
        echo "Successfully entered data";
      } else {
        echo "Something is wrong";
      }
    }
  }
}
?>
     </div>


<div id="container">
<h2 style="padding-bottom: 5%; font-size:30px;">Register</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>
" method="POST" >
  <label for="fname">First name:</label><br>
  <input type="text" style="height:40px; font-size:30px;" id="fname" name="fname"><br>
  <span><?php echo $fname_err; ?></span>
  <label for="lname">Last name:</label><br>
  <input type="text" style="height:40px; font-size:30px;" id="lname" name="lname"><br><br>
  <span><?php echo $lname_err; ?></span>
  <label for="uname">Username:</label><br>
  <input type="text" style="height:40px; font-size:30px;" id="uname" name="uname"><br><br>
  <span><?php echo $uname_err; ?></span>
  <label for="email">Email:</label><br>
  <input type="text" style="height:40px; font-size:30px;" id="email" name="email"><br><br>
  <span><?php echo $email_err; ?></span>
  <label for="psw">Password:</label><br>
  <span><?php echo $psw_err; ?></span>
  <input type="password" style="height:40px;  font-size:30px;" id="psw" name="psw" ><br><br>
  <input type="submit" value="Submit" class="buttonSubmit">
  <input type="reset" value="Reset" class="buttonReset">
  <p>Already have an account?<a href="login.php"> Click here to login</a></p>

</form>
</div>
<!-- pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required -->

<?php
require "includes/footer.php";
?>