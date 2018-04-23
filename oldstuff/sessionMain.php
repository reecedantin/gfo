<?php
   session_start();

   if(isset($_SESSION['login_user'])){
      if($_SESSION['user_type'] == "ADMIN") {
          header("Location: adminDashboard.php");
      } else if($_SESSION['user_type'] == "OWNER") {
          header("Location: ownerDashboard.php");
      } else if($_SESSION['user_type'] == "VISITOR") {
          header("Location: visitorDashboard.php");
      }
   }
?>
