<?php include("session.php") ?>
<!DOCTYPE html>
<html lang="en">

<?php include("head.php"); ?>

<body>

  <?php include("navbar.php"); ?>

  <section>
    <div class="container">

      <div class="row text-center title-space">
        <div class="col-md-12">
          <h4>Add New Property</h4>
        </div> <!-- End Column -->
      </div> <!-- End Row -->

      <div class="row">
        <div class="col-md-12">

          <form class="form-horizontal">
            <fieldset>

              <div class="row ">
                <div class="col-md-4 offset-md-2">

                  <label class="col-md-12 control-label" for="propertyName">Property Name*</label>
                  <div class="col-md-12">
                    <input id="propertyName" name="propertyName" type="text" placeholder="Property Name" class="form-control input-md" required="">
                  </div> <br>

                  <label class="col-md-12 control-label" for="address">Street Address*</label>
                  <div class="col-md-12">
                    <input id="streetAddress" name="streetAddress" type="text" placeholder="Street Address" class="form-control input-md" required="">
                  </div> <br>

                  <label class="col-md-12 control-label" for="city">City*</label>
                  <div class="col-md-12">
                    <input id="city" name="city" type="text" placeholder="City" class="form-control input-md" required="">
                  </div> <br>


                  <label class="col-md-12 control-label" for="zip">Zip*</label>
                  <div class="col-md-12">
                    <input id="zip" name="zip" type="text" placeholder="Zip" class="form-control input-md" required="">
                  </div> <br>

                  <label class="col-md-12 control-label" for="size">Size* (acres)</label>
                  <div class="col-md-12">
                    <input id="size" name="size" type="text" placeholder="Size" class="form-control input-md" required="">
                  </div> <br>


                </div> <!-- End Column -->
                <div class="col-md-4">

                  <label class="col-md-12 control-label" for="type">Type*</label>
                  <div class="col-md-12">
                    <select id="type" name="type" class="form-control">
                      <option value="1">Farm</option>
                      <option value="2">Garden</option>
                    </select>
                  </div> <br>


                  <label class="col-md-12 control-label" for="animal">Animal*</label>
                  <div class="col-md-12">
                    <select id="animal" name="animal" class="form-control">
                      <option value="1">Snake</option>
                      <option value="2">Lizard</option>
                    </select>
                  </div> <br>

                  <label class="col-md-12 control-label" for="crop">Crop*</label>
                  <div class="col-md-12">
                    <select id="crop" name="crop" class="form-control">
                      <option value="1">Wheat</option>
                      <option value="2">Corn</option>
                    </select>
                  </div> <br>


                  <label class="col-md-12 control-label" for="public">Public?*</label>
                  <div class="col-md-12">
                    <select id="public" name="public" class="form-control">
                      <option value="1">True</option>
                      <option value="2">Flase</option>
                    </select>
                  </div> <br>

                  <label class="col-md-12 control-label" for="commercial">Commercial*</label>
                  <div class="col-md-12">
                    <select id="commercial" name="commercial" class="form-control">
                      <option value="1">True</option>
                      <option value="2">Flase</option>
                    </select>
                  </div> <br>

                </div> <!-- End Column -->
              </div> <!-- End Row -->


              <!-- Button Bar -->
              <div class="row button-adjust">
                <div class="col-md-6">
                  <button i="addCrop" name="addCrop" class="btn btn-success style-bkg" style="width: 100%;">&#x2b Add Property</button>
                </div>

                <div class="col-md-6">
                  <button id="addCrop" name="addCrop" class="btn btn-secondary" style="width: 100%;">&#x2190 Cancel</button>
                </div>
              </div> <!-- End Row -->
              <br> <br>


            </fieldset>
          </form>

        </div> <!-- End Outer Column -->
      </div> <!-- End Outer Row -->



    </div> <!-- End Container -->
  </section>

</body>
</html>
