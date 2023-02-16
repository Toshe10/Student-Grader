<?php
session_start();


require 'config.php';
require 'includes/header.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location:login.php");
    exit;
}

//$_SESSION['loggedin'] = true;|
//$_SESSION['username'] = $username;
// echo "Zdravo ".$_SESSION['username'] . '</br>';
// echo 'User Id: ' . $_SESSION['id'];

$user_id = $_SESSION['id'];

$sql = "SELECT * FROM users WHERE user_id = :user_id";

if ($stmt = $pdo->prepare($sql)) {
    $stmt->bindParam(":user_id", $param_user_id);
    $param_user_id = $user_id;

    if ($stmt->execute()) {
        if ($row = $stmt->fetch()) {
            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];

            // echo '<br>' . $fname;
            // echo '<br>' . $lname;
            // echo '<br>' . $email;
        }
    }
}

?>

<div id="container">
<h2 style="padding-bottom: 2%; font-size:30px"> Edit Profile </h2>
<p>My profile info:</p>

<form action="edit_profile_process_db.php" method="POST">

<label for="fname">First name:</label><br>
  <input type="text" style="height:40px; font-size:30px;" id="fname" name="fname" value="<?php
  echo $fname; $lname; $email; ?>"><br>
  <label for="lname">Last name:</label><br>
  <input type="text" style="height:40px; font-size:30px;" id="lname" name="lname" value="<?php
  echo  $lname;  ?>"><br><br>
  <label for="email">Email:</label><br>
  <input type="text" style="height:40px; font-size:30px;" id="email" name="email" value="<?php
  echo  $email; ?>"><br><br>
  
  <input type="submit" value="Update My Profile" style="   background-color: blue;
    color:white;
    border-radius: 5px;
    width:200px;
    height:40px;
    font-size: 20px;">
  <input type="reset" value="Reset" style="    background-color: white;
    color: blue;
    border-radius: 5px;
    height:40px;
    width:60px;
    font-size: 20px;">
</form>
</br>
<a href="logout.php" style="    text-decoration: none;
    padding: 5px;
    color:white;
    font-size: 30px;">Logout</a>

</div>

<?php

// echo '<br>' . $fname;
// echo '<br>' . $lname;
// echo '<br>' . $email;
echo "</br>";

?>



<?php
require 'includes/footer.php';
?>