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
          <h4>Welcome <b>Monica</b> </h4>

        </div>
      </div> <!-- End Row --> 

      <div class ="row">
        <div class = "col-md-12">

          <h6>Your Properties</h6>
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
                  <input id="searchinput" name="searchinput" type="search" placeholder="Search Properties" class="form-control input-md">
                </div>

                <!-- Submit Button -->
                <div class="col-md-2">
                 <input class="btn btn-primary style-bkg" type="submit" value="Search Properties">
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

                <th scope="col">Manage</th>
                <th scope="col">Name &#9660</th>
                <th scope="col">Address</th>
                <th scope="col">City &#9660</th>
                <th scope="col">Zip</th>
                <th scope="col">Size</th>
                <th scope="col">Type &#9660</th>
                <th scope="col">Public</th>
                <th scope="col">Commercial</th>
                <th scope="col">&nbsp ID</th>
                <th scope="col">isValid</th>
                <th scope="col">Visits &#9660</th>
                <th scope="col">Rating &#9650</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row"><a href="manageProperty.php">Edit &#x270E</a></th>
                <td data-toggle="modal" data-target="#propertyDetails" class="link-color">Atwood Street Garden</td>
                <td>Atwood Street SW</td>
                <td>Atlanta</td>
                <td>30308</td>
                <td>1</td>
                <td>Garden</td>
                <td>True</td>
                <td>False</td>
                <td>00400</td>
                <td>True</td>
                <td>3</td>
                <td>4.7</td>
              </tr>
              <tr>
                <th scope="row"><a href="manageProperty.php">Edit &#x270E</a></th>
                <td data-toggle="modal" data-target="#propertyDetails" class="link-color">East Lake Urban Farm</td>
                <td>2nd Avenue</td>
                <td>Atlanta</td>
                <td>30317</td>
                <td>20</td>
                <td>Farm</td>
                <td>False</td>
                <td>True</td>
                <td>12345</td>
                <td>False</td>
                <td>0</td>
                <td>N/A</td>
              </tr>
              <tr>
                <th scope="row"><a href="manageProperty.php">Edit &#x270E</a></th>
                <td data-toggle="modal" data-target="#propertyDetails" class="link-color">Atwood Street Garden</td>
                <td>Atwood Street SW</td>
                <td>Atlanta</td>
                <td>30308</td>
                <td>1</td>
                <td>Garden</td>
                <td>True</td>
                <td>False</td>
                <td>00400</td>
                <td>True</td>
                <td>3</td>
                <td>4.7</td>
              </tr>
              <tr>
                <th scope="row"><a href="manageProperty.php">Edit &#x270E</a></th>
                <td data-toggle="modal" data-target="#propertyDetails" class="link-color">East Lake Urban Farm</td>
                <td>2nd Avenue</td>
                <td>Atlanta</td>
                <td>30317</td>
                <td>20</td>
                <td>Farm</td>
                <td>False</td>
                <td>True</td>
                <td>12345</td>
                <td>False</td>
                <td>0</td>
                <td>N/A</td>
              </tr>
              <tr>
                <th scope="row"><a href="manageProperty.php">Edit &#x270E</a></th>
                <td data-toggle="modal" data-target="#propertyDetails" class="link-color">Atwood Street Garden</td>
                <td>Atwood Street SW</td>
                <td>Atlanta</td>
                <td>30308</td>
                <td>1</td>
                <td>Garden</td>
                <td>True</td>
                <td>False</td>
                <td>00400</td>
                <td>True</td>
                <td>3</td>
                <td>4.7</td>
              </tr>
              <tr>
                <th scope="row"><a href="manageProperty.php">Edit &#x270E</a></th>
                <td data-toggle="modal" data-target="#propertyDetails" class="link-color">East Lake Urban Farm</td>
                <td>2nd Avenue</td>
                <td>Atlanta</td>
                <td>30317</td>
                <td>20</td>
                <td>Farm</td>
                <td>False</td>
                <td>True</td>
                <td>12345</td>
                <td>False</td>
                <td>0</td>
                <td>N/A</td>
              </tr>
              <tr>
                <th scope="row"><a href="manageProperty.php">Edit &#x270E</a></th>
                <td data-toggle="modal" data-target="#propertyDetails" class="link-color">Atwood Street Garden</td>
                <td>Atwood Street SW</td>
                <td>Atlanta</td>
                <td>30308</td>
                <td>1</td>
                <td>Garden</td>
                <td>True</td>
                <td>False</td>
                <td>00400</td>
                <td>True</td>
                <td>3</td>
                <td>4.7</td>
              </tr>
              <tr>
                <th scope="row"><a href="manageProperty.php">Edit &#x270E</a></th>
                <td data-toggle="modal" data-target="#propertyDetails" class="link-color">East Lake Urban Farm</td>
                <td>2nd Avenue</td>
                <td>Atlanta</td>
                <td>30317</td>
                <td>20</td>
                <td>Farm</td>
                <td>False</td>
                <td>True</td>
                <td>12345</td>
                <td>False</td>
                <td>0</td>
                <td>N/A</td>
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


