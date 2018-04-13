<!DOCTYPE html>
<html lang="en">

<?php include("head.php"); ?>
<?php include("propertyDetailsModal.php"); ?>

<body>

  <?php include("ownerNavbar.php"); ?>

  <section>
    <div class="container">

      <div class="row text-center title-space">
        <div class="col-md-12">
          <h4>Manage <b>Atwood Street Garden</b></h4>
          <br>
        </div> <!-- End Column --> 
      </div> <!-- End Row --> 

      <div class="row manage-card text-center">
        <div class="col-md-12">

          <form class="form-horizontal">
            <fieldset>



              <label class="col-md-12 control-label" for="propertyName">Name</label>
              <div class="col-md-12">
                <input id="propertyName" name="propertyName" type="text" placeholder="Property Name" class="form-control input-md" required="">
              </div>

              <label class="col-md-12 control-label" for="address">Address</label>  
              <div class="col-md-12">
                <input id="address" name="address" type="text" placeholder="Address" class="form-control input-md" required="">
              </div>

              <label class="col-md-12 control-label" for="city">City</label>  
              <div class="col-md-12">
                <input id="city" name="city" type="text" placeholder="City" class="form-control input-md" required="">
              </div>


              <label class="col-md-12 control-label" for="zip">Zip</label>  
              <div class="col-md-12">
                <input id="zip" name="zip" type="text" placeholder="Zip" class="form-control input-md" required="">
              </div>


              <label class="col-md-12 control-label" for="size">Size (acres)</label>  
              <div class="col-md-12">
                <input id="size" name="size" type="text" placeholder="Size" class="form-control input-md" required="">
              </div>

              <label class="col-md-12 control-label" for="public">Public</label>
              <div class="col-md-12">
                <select id="public" name="public" class="form-control">
                  <option value="1">True</option>
                  <option value="2">Flase</option>
                </select>
              </div>

              <label class="col-md-12 control-label" for="type">Type</label>  
              <div class="col-md-12">
                <input id="type" name="type" type="text" placeholder="Type" class="form-control input-md" required="">
              </div>


              <!-- Multiple Checkboxes -->
              <div class="form-group">
                <label class="col-md-12 control-label" for="currentCrops">Current Crops</label>
                <div class="col-md-12">
                  <div class="checkbox">
                    <label for="currentCrops-0">
                      <input type="checkbox" name="currentCrops" id="currentCrops-0" value="1">
                      Wheat
                    </label>
                  </div>
                  <div class="checkbox">
                    <label for="currentCrops-1">
                      <input type="checkbox" name="currentCrops" id="currentCrops-1" value="2">
                      Corn
                    </label>
                  </div>
                </div>
              </div>

              <label class="col-md-12 control-label" for="addCrop">Add New Crop</label>
              <div class="col-md-12">
                <button id="addCrop" name="addCrop" class="btn btn-primary">Add Crop to Property</button>
              </div>


            </fieldset>
          </form>

        </div> <!-- End Column -->
      </div> <!-- End Row -->

    </div> <!-- End Container -->
  </section>

</body>
</html>
