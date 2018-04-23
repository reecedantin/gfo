<?php
   include("config.php");
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {

      $sql = "INSERT INTO User (Username, Email, Password, UserType) VALUES ('" . $_POST['username'] . "', '" . $_POST['email'] . "', '" . md5($_POST['password']) . "', 'VISITOR' )";
      $result = mysqli_query($db,$sql);

      if($result == true) {
         $_SESSION['login_user'] = $_POST['username'];
         $_SESSION['user_type'] = 'VISITOR';
         header("Location: visitorDashboard.php");
      } else {
         echo "<script type='text/javascript'>alert('There was an error creating the account');</script>";
      }
   }
?>

<!DOCTYPE html>
<html lang="en">

<?php include("head.php"); ?>

<script>
function validateForm() {
    var x = document.forms["visitReg"]["password"].value;
    var y = document.forms["visitReg"]["confirmpassword"].value;

    if (x != y) {
        alert("Passwords must match");
        return false;
    }

    if (x.length < 8) {
        alert("Passwords must have at least 8 characters");
        return false;
    }

    var email = document.forms["visitReg"]["email"].value;
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(!re.test(String(email).toLowerCase())) {
        alert("Email must be a valid email address");
        return false;
    }

    var username = document.forms["visitReg"]["username"].value;
    if(username = "") {
        alert("Username cannot be empty");
        return false;
    }


}
</script>


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
          <form name="visitReg" onsubmit="return validateForm()" class="form-horizontal" action='newVisitorReg.php' method='post'>
            <fieldset>

              <!-- Form Name -->
              <legend>New Visitor Registration</legend>
              <br>

              <!-- Text input-->
              <div class="form-group">
                <div class="col-md-12">
                  <input id="email" name="email" type="text" placeholder="Email" class="form-control input-md" required="">

                </div>
              </div>

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

              <!-- Password input-->
              <div class="form-group">
                <div class="col-md-12">
                  <input id="confirmpassword" name="confirmpassword" type="password" placeholder="Confirm Password" class="form-control input-md" required="">

                </div>
              </div>


              <!-- Submit Button -->
              <div class="col-md-12">
               <input class="btn-get-started" type="submit" value="Create Account">
             </div>
             <br>

             <div class="col-md-12">
               <div class="row">


                <!-- Registration Links -->
                <div class="col-md-3">
                  <a class="btn btn-success style-bkg" href="index.php">Back</a> <br>
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
