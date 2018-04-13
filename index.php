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
          <form class="form-horizontal">
            <fieldset>

              <!-- Form Name -->
              <legend>Login</legend>
              <br>

              <!-- Text input-->
              <div class="form-group">  
                <div class="col-md-12">
                  <input id="emailid" name="emailid" type="text" placeholder="Email" class="form-control input-md" required="">
                </div>
              </div>

              <!-- Password input-->
              <div class="form-group">
                <div class="col-md-12">
                  <input id="passwordinput" name="passwordinput" type="password" placeholder="Password" class="form-control input-md" required="">
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
