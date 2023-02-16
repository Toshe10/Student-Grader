<?php
session_start();


require 'config.php';
require 'includes/header.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location:login.php");
    exit;
}



// $get_user_id_test = $_GET['get_user_id'];
// echo '<hr><strong>'. $get_user_id_test . '</strong><hr>';



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
    <h2 style="padding-bottom: 2%; font-size:30px">Profile</h2>

    <?php echo "Zdravo " . $_SESSION['username'] . '</br>';
    echo 'User Id: ' . $_SESSION['id']; ?>

    <p>My profile info:</p>

    <div style="padding-bottom: 5%;">
        <?php

        echo 'First name: ' . $fname;
        echo '<br>last name: ' . $lname;
        echo '<br>Email: ' . $email;
        echo "</br>";

        ?>
    </div>
    <p style="padding-top:10px;"><a href="delete_profile.php?get_user_id=<?php echo $user_id; ?>
" style=" background-color: red;
    border-radius: 5px;
    text-decoration: none;
    padding: 5px;
    color:white;
    font-size: 20px;
    ">Delete my profile</a></p>
    <p><a href="edit_profile.php" style="    background-color: blue;
    border-radius: 5px;
    text-decoration: none;
    padding: 5px;
    color:white;
    font-size: 20px;">Edit Profile</a></p>
    <p><a href="logout.php" style="   
    
    text-decoration: none;
    padding: 5px;
    color: white;
    font-size: 20px;">Logout</a></p>
</div>
<?php
require 'includes/footer.php';
?>