<?php include('session.php'); ?>
<?php
if($_SESSION['user_type'] != "OWNER") {
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include("config.php"); ?>

<?php include("head.php"); ?>

<body>

  <?php include("adminNavbar.php"); ?>

  <section>
    <div class="container">

      <div class="row text-center title-space">
        <div class="col-md-12">
          <h4>Approved Animals/Crops</h4>
          <br>
        </div>
      </div> <!-- End Row -->


      <div class="row">
        <div class="col-md-6 offset-md-3">

          <form class="form-horizontal">
            <fieldset>

              <div class="form-group">
                <label class="col-md-12 control-label" for="addCrop">Request Crop Approval</label>

                <div class="col-md-12 rowspace">
                  <input id="cropRequest" name="cropRequest" type="text" placeholder="Enter New Crop Name" class="form-control input-md">
                </div>

                <div class="col-md-12">
                  <button id="addCrop" name="addCrop" class="btn btn-primary style-bkg" style="width: 100%;">Submit Request</button>
                </div>
              </div> <!-- End form group -->

            </fieldset> 
          </form>

        </div> <!-- End Column --> 
      </div> <!-- End Row -->  <br>



      <div class ="row">
        <div class = "col-md-12">

          <form class="form-horizontal">
            <fieldset>

              <div class="row">

                <!-- Select Basic -->
                <div class="col-md-3">
                  <select id="selectbasic" name="selectbasic" class="form-control">
                    <option value="1">Search by...</option>
                    <option value="2">Option two</option>
                  </select>
                </div>

                <!-- Search input-->
                <div class="col-md-7">
                  <input id="searchinput" name="searchinput" type="search" placeholder="Search Animals/Crops" class="form-control input-md">
                </div>

                <!-- Submit Button -->
                <div class="col-md-2">
                  <input class="btn btn-primary style-bkg" type="submit" value="Search Animals/Crops">
                </div>

              </div> <!-- End Row -->

            </fieldset>
          </form>

        </div> <!-- End Column -->
      </div> <!-- End Row -->

      <br>

      <div class ="row">
        <div class = "col-md-12">

          <div class="property-table table-scroll">
            <table class="table table-striped table-sm">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Delete</th>
                  <th scope="col">Name</th>
                  <th scope="col">Type</th>
                </tr>
              </thead>
              <tbody>
               <tr>
                <td class="link-color"><a>Delete</a></td>
                <td>Apple</td>
                <td>Fruit</td>                   
              </tr>
              <tr>
                <td class="link-color"><a>Delete</a></td>
                <td>Antelope</td>
                <td>Animal</td>                   
              </tr>
              <tr>
                <td class="link-color"><a>Delete</a></td>
                <td>Apple</td>
                <td>Fruit</td>                   
              </tr>
              <tr>
                <td class="link-color"><a>Delete</a></td>
                <td>Antelope</td>
                <td>Animal</td>                   
              </tr>
              <tr>
                <td class="link-color"><a>Delete</a></td>
                <td>Apple</td>
                <td>Fruit</td>                   
              </tr>
              <tr>
                <td class="link-color"><a>Delete</a></td>
                <td>Antelope</td>
                <td>Animal</td>                   
              </tr>
              <tr>
                <td class="link-color"><a>Delete</a></td>
                <td>Apple</td>
                <td>Fruit</td>                   
              </tr>
              <tr>
                <td class="link-color"><a>Delete</a></td>
                <td>Antelope</td>
                <td>Animal</td>                   
              </tr>
              <tr>
                <td class="link-color"><a>Delete</a></td>
                <td>Apple</td>
                <td>Fruit</td>                   
              </tr>
              <tr>
                <td class="link-color"><a>Delete</a></td>
                <td>Antelope</td>
                <td>Animal</td>                   
              </tr>
              <tr>
                <td class="link-color"><a>Delete</a></td>
                <td>Apple</td>
                <td>Fruit</td>                   
              </tr>
              <tr>
                <td class="link-color"><a>Delete</a></td>
                <td>Antelope</td>
                <td>Animal</td>                   
              </tr>
            </tbody>
          </table>
        </div> <!-- End Property Table Wrapper -->


      </div> <!-- End Column -->
    </div> <!-- End Row -->


  </div> <!-- End Container -->
</section>

</body>
</html>
