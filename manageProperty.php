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
        </div> <!-- End Column --> 
      </div> <!-- End Row --> 


      <div class="row">
        <div class="col-md-12">


          <div class="row">
            <div class="col-md-4 offset-md-2">

              <form class="form-horizontal">
                <fieldset>

                  <label class="col-md-12 control-label" for="propertyName">Property Name*</label>
                  <div class="col-md-12">
                    <input id="propertyName" name="propertyName" type="text" placeholder="Property Name" class="form-control input-md" required="">
                  </div> <br> 

                  <label class="col-md-12 control-label" for="address">Address*</label>  
                  <div class="col-md-12">
                    <input id="address" name="address" type="text" placeholder="Address" class="form-control input-md" required="">
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

                  <label class="col-md-12 control-label" for="type">Type*</label>  
                  <div class="col-md-12">
                    <input id="type" name="type" type="text" placeholder="Type" class="form-control input-md" value="Garden" disabled>
                  </div> <br> 

                </div> <!-- End Column -->
                <div class="col-md-4">


                  <label class="col-md-12 control-label" for="public">Public*</label>
                  <div class="col-md-12">
                    <select id="public" name="public" class="form-control">
                      <option value="1">True</option>
                      <option value="2">Flase</option>
                    </select>
                  </div> <br> 

                  <label class="col-md-12 control-label" for="public">Commercial*</label>
                  <div class="col-md-12">
                    <select id="public" name="public" class="form-control">
                      <option value="1">True</option>
                      <option value="2">Flase</option>
                    </select>
                  </div> <br> 

                  <label class="col-md-12 control-label" for="type">ID</label>  
                  <div class="col-md-12">
                    <input id="type" name="type" type="text" placeholder="Type" class="form-control input-md" value="00122" disabled>
                  </div> <br> 

                  <!-- Multiple Checkboxes -->
                  <div class="form-group">
                    <label class="col-md-12 control-label" for="currentCrops">Current Crops*</label>
                    <div class="col-md-12">
                      <div class="checkbox">
                        <label for="currentCrops-0">
                          <input type="checkbox" name="currentCrops" id="currentCrops-0" value="1" checked="checked">
                          Wheat
                        </label>
                      </div>
                      <div class="checkbox">
                        <label for="currentCrops-1">
                          <input type="checkbox" name="currentCrops" id="currentCrops-1" value="2" checked="checked">
                          Corn
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-12 control-label" for="addCrop">Add New Crop</label>

                    <div class="col-md-12 rowspace">
                      <select id="public" name="public" class="form-control">
                        <option value="1">Coffee</option>
                        <option value="2">Spinach</option>
                      </select>
                    </div> 
                    <div class="col-md-12">
                      <button id="addCrop" name="addCrop" class="btn btn-primary style-bkg" style="width: 100%;">Add Crop to Property</button>
                    </div>
                  </div> <!-- End form group --> <br>

                  <div class="form-group">
                    <label class="col-md-12 control-label" for="addCrop">Request Crop Approval</label>

                    <div class="col-md-12 rowspace">
                      <input id="cropRequest" name="cropRequest" type="text" placeholder="Enter New Crop Name" class="form-control input-md">
                    </div>

                    <div class="col-md-12">
                      <button id="addCrop" name="addCrop" class="btn btn-primary style-bkg" style="width: 100%;">Submit Request</button>
                    </div>
                  </div> <!-- End form group -->
                  <br>


                </div> <!-- End Column -->
              </div> <!-- End Row -->


              <div class="row">
                <div class="col-md-2 offset-md-3">
                  <button id="addCrop" name="addCrop" class="btn btn-success style-bkg" style="width: 100%;">&#x1f4be Save</button>
                </div>

                <div class="col-md-2">
                  <button  name="addCrop" class="btn btn-danger" style="width: 100%;">&#x2718 Delete Property</button>
                </div>

                <div class="col-md-2">
                  <a href="ownerDashboard.php"><button name="addCrop" class="btn btn-secondary" style="width: 100%;">&#x2190 Cancel</button></a>
                </div>
              </div> <!-- End Row -->

            </fieldset>
          </form>
          <br> <br>

        </div> <!-- End Outer Column -->
      </div> <!-- End Outer Row --> 

    </div> <!-- End Container -->
  </section>

</body>
</html>
