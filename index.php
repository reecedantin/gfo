<?php include("sessionMain.php"); ?>
<?php
   include("config.php");

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);

      $sql = "SELECT * FROM User WHERE Username = '$myusername' and Password = '" . md5($mypassword) . "'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $usertype = $row['UserType'];

      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {
         //session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         $_SESSION['user_type'] = $usertype;
         if($usertype == "ADMIN") {
             header("Location: adminDashboard.php");
         } else if($usertype == "OWNER") {
             header("Location: ownerDashboard.php");
         } else if($usertype == "VISITOR") {
             header("Location: visitorDashboard.php");
         } else {
             header("Location: index.php");
         }
      }else {
         echo "<script type='text/javascript'>alert('Incorrect username or password');</script>";
      }
   }
?>


<!DOCTYPE html>
<html lang="en">

<?php include("head.php"); ?>

<body>

  <?php include("loginNavbar.php"); ?>

  <!--==========================
    Main Section
    ============================-->
    <section id="hero">
      <div class="hero-container">
       <!--  <h1>Welcome</h1> -->
       <h2>Atlanta Gardens, Farms, and Orchards</h2>

       <div class="card">
        <div class="card-body">
          <form class="form-horizontal" action='index.php' method='post'>
            <fieldset>

              <!-- Form Name -->
              <legend>Login</legend>
              <br>

              <!-- Text input-->
              <div class="form-group">
                <div class="col-md-12">
                  <input id="username" name="username" type="text" placeholder="Username" class="form-control input-md" required="">
                </div>
              </div>

              <!-- Password input-->
              <div class="form-group">
                <div class="col-md-12">
                  <input id="password" name="password" type="password" placeholder="Password" class="form-control input-md" required="">
                </div>
              </div>


              <!-- Submit Button -->
              <div class="col-md-12">
               <input class="btn-get-started" type="submit" value="Login">
             </div>
             <br>

             <div class="col-md-12">
               <div class="row">
                <!-- Registration Links -->
                <div class="col-md-6">
                  <a class="btn btn-success style-bkg" href="newOwnerReg.php">New Owner Registration</a> <br>
                </div>

                <!-- Registration Links -->
                <div class="col-md-6">
                  <a class="btn btn-success style-bkg" href="newVisitorReg.php">New Visitor Registration</a> <br>
                </div>
              </div> <!-- End Row -->
            </div> <!-- End Column -->

          </fieldset> <!-- End Fieldset -->
        </form> <!-- End Form -->


      </div> <!-- End Card Body -->
    </div> <!-- End Card -->


  </div>
</section>

</body>
</html>
