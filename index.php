<?php 
session_start();
require "config.php";
require "includes/header.php";
 
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header ("location:login.php");
    exit;
}
 
// $_SESSION['loggedin']=true;
// $_SESSION['username']=$username;

?>
 
 <div id="container">
     <h2 style="padding-bottom: 2%; font-size:30px"> This is homepage </h2>
 <div style="padding-bottom: 5%;"><?php echo "Hello " .$_SESSION['username'];?></div>

<a href="profile.php" style=" background-color: blue;
    border-radius: 5px;
    text-decoration: none;
    padding: 5px;
    color:white;
    font-size: 20px;
    width:60px;">Profile</a> </br>
<a href="logout.php" style=" background-color: white;
    border-radius: 5px;
    text-decoration: none;
    padding: 5px;
    color:blue;
    font-size: 20px;
    width:70px;
    ">Log Out</a>

</div>

 
<?php 
 
include "includes/footer.php";
?>