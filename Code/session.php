<?php
if(!isset($_SESSION['activeUser'])){
    die("PLease Login First. <a href='index.php'>Click to Login</a>");
}
else {
  header("reservation.php");
}
?>
