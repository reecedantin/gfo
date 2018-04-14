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
          <form class="form-horizontal" action='createOwner.php' method='post'>
            <fieldset>

              <!-- Form Name -->
              <legend>New Owner Registration</legend>
              <br>

              <div class="row rowspace">
                <!-- Text input-->
                <div class="col-md-4">
                  <input id="emailid" name="emailid" type="text" placeholder="Email" class="form-control input-md" required="">
                </div>

                <div class="col-md-4">
                  <input id="passwordinput" name="passwordinput" type="password" placeholder="Password" class="form-control input-md" required="">
                </div>

                <div class="col-md-4">
                  <input id="confirmpasswordinput" name="confirmpasswordinput" type="password" placeholder="Confirm Password" class="form-control input-md" required="">
                </div>

              </div> <!-- End Row -->





              <div class="row rowspace">

                <!-- Text input-->
                <div class="col-md-4">
                  <input id="usernameID" name="usernameID" type="text" placeholder="Username" class="form-control input-md" required="">
                </div>

                <div class="col-md-4">
                  <input id="propertyNameId" name="propertyName" type="text" placeholder="Property Name" class="form-control input-md" required="">
                </div>

                <div class="col-md-4">
                  <input id="streetAddressId" name="streetAddress" type="text" placeholder="Street Address" class="form-control input-md" required="">
                </div>
              </div> <!-- End Row-->


              <div class="row rowspace">
                <div class="col-md-4">
                  <input id="cityId" name="city" type="text" placeholder="City" class="form-control input-md" required="">
                </div>
                <div class="col-md-4">
                  <input id="zipId" name="zip" type="text" placeholder="Zip" class="form-control input-md" required="">
                </div>
                <div class="col-md-4">
                  <input id="AcresId" name="Acres" type="text" placeholder="Acres" class="form-control input-md" required="">
                </div>
              </div> <!-- End Row -->

              <div class="row rowspace">
                <div class="col-md-4">
                  <select id="propertyType" name="propertyType" class="form-control">
                    <option value="1">Property Type</option>
                    <option value="2">Farm</option>
                    <option value="3">Garden</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <select id="animalType" name="animalType" class="form-control">
                    <option value="1">Animal</option>
                    <option value="2">Monkey</option>
                    <option value="3">Lion</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <select id="cropType" name="cropType" class="form-control">
                    <option value="1">Crop</option>
                    <option value="2">Corn</option>
                    <option value="3">Wheat</option>
                  </select>
                </div>
              </div>

              <div class="row rowspace">

                <div class="col-md-4">
                  <select id="propertyType" name="propertyType" class="form-control">
                    <option value="1">Public?</option>
                    <option value="2">Yes</option>
                    <option value="3">No</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <select id="commercialType" name="commercialType" class="form-control">
                    <option value="1">Commercial?</option>
                    <option value="2">Yes</option>
                    <option value="3">No</option>
                  </select>
                </div>

              </div>

              <br>
              <div class="row">

               <!-- Registration Links -->
               <div class="col-md-3">
                <a class="btn btn-success style-bkg" href="index.php">Back</a> <br>
              </div>


              <!-- Submit Button -->
              <div class="col-md-6">
               <input class="btn-get-started2" type="submit" value="Create Account">
             </div>


           </div> <!-- End Row -->


         </fieldset> <!-- End Fieldset -->
       </form> <!-- End Form -->


     </div> <!-- End Card Body -->
   </div> <!-- End Card -->


 </div>
</section>

  </body>
  </html>
