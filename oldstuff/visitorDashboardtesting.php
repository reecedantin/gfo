<?php include('session.php'); ?>
<?php
if($_SESSION['user_type'] != "VISITOR") {
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include("head.php"); ?>
<?php include("config.php"); ?>

<body>

  <?php include("navbar.php"); ?>

  <section>
    <div class="container">

      <div class="row text-center title-space">
        <div class="col-md-12">
          <h4>Welcome <b><?php echo($_SESSION['login_user']); ?></b></h4>
        </div>
      </div> <!-- End Row -->

      <h6>All Public Validated Properties</h6>
      <div class ="row">
        <div class = "col-md-12">


          <div class="text-center">

           <button class="btn btn-primary style-bkg" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            &#x1f50d Search Table
          </button>

        </div> 

        <div class="collapse" id="collapseExample">
          <form class="form-horizontal">
            <fieldset>

              <br>

              <div class="row rowspace">
                <!-- Select Basic -->
                <div class="col-md-2 offset-md-3">
                  <p>Search Name</p>
                </div>

                <!-- Search input-->
                <div class="col-md-4">
                  <input id="nameInput" name="nameInput" type="search" placeholder="Search Name" class="form-control input-md">
                </div>

              </div> <!-- End Row -->

              <div class="row rowspace">
                <!-- Select Basic -->
                <div class="col-md-2 offset-md-3">
                  <p>Search Street</p>
                </div>

                <!-- Search input-->
                <div class="col-md-4">
                  <input id="searchinput" name="searchinput" type="search" placeholder="Search Street" class="form-control input-md">
                </div>

              </div> <!-- End Row -->

              <div class="row rowspace">
                <!-- Select Basic -->
                <div class="col-md-2 offset-md-3">
                  <p>Search Zip</p>
                </div>

                <!-- Search input-->
                <div class="col-md-4">
                  <input id="searchZip" name="searchZip" type="search" placeholder="Search Zip" class="form-control input-md">
                </div>

              </div> <!-- End Row -->  


              <div class="row rowspace">
                <!-- Select Basic -->
                <div class="col-md-2 offset-md-3">
                  <p>Search Approved By</p>
                </div>

                <!-- Search input-->
                <div class="col-md-4">
                  <input id="searchApprovedBy" name="searchApprovedBy" type="search" placeholder="Search Approved By" class="form-control input-md">
                </div>

              </div> <!-- End Row -->     

              <div class="row rowspace">
                <!-- Select Basic -->
                <div class="col-md-2 offset-md-3">
                  <p>Search ID</p>
                </div>

                <!-- Search input-->
                <div class="col-md-2">
                  <input id="searchIdFrom" name="searchIdFrom" type="search" placeholder="Start Value" class="form-control input-md">
                </div>

                <!-- Search input-->
                <div class="col-md-2">
                  <input id="searchIdTo" name="searchIdTo" type="search" placeholder="End Value" class="form-control input-md">
                </div>

              </div> <!-- End Row -->


              <div class="row rowspace">
                <!-- Select Basic -->
                <div class="col-md-2 offset-md-3">
                  <p>Search Visits</p>
                </div>

                <!-- Search input-->
                <div class="col-md-2">
                  <input id="searchVisitsFrom" name="searchVisitsFrom" type="search" placeholder="Start Value" class="form-control input-md">
                </div>

                <!-- Search input-->
                <div class="col-md-2">
                  <input id="searchVisitsTo" name="searchVisitsTo" type="search" placeholder="End Value" class="form-control input-md">
                </div>

              </div> <!-- End Row -->

              <div class="row rowspace">
                <!-- Select Basic -->
                <div class="col-md-2 offset-md-3">
                  <p>Search Rating</p>
                </div>

                <!-- Search input-->
                <div class="col-md-2">
                  <input id="searchRatsingFrom" name="searchRatingFrom" type="search" placeholder="Start Value" class="form-control input-md">
                </div>

                <!-- Search input-->
                <div class="col-md-2">
                  <input id="searchRatingTo" name="searchRatingTo" type="search" placeholder="End Value" class="form-control input-md">
                </div>

              </div> <!-- End Row --> 


              <div class="row rowspace">
                <!-- Select Basic -->
                <div class="col-md-2 offset-md-3">
                  <p>Search Size</p>
                </div>

                <!-- Search input-->
                <div class="col-md-2">
                  <input id="searchSizeFrom" name="searchSizeFrom" type="search" placeholder="Start Value" class="form-control input-md">
                </div>

                <!-- Search input-->
                <div class="col-md-2">
                  <input id="searchSizeTo" name="searchSizeTo" type="search" placeholder="End Value" class="form-control input-md">
                </div>

              </div> <!-- End Row --> 

              <div class="row rowspace">
                <div class="col-md-2 offset-md-3">
                  <select id="isPublic" name="isPublic" class="form-control">
                    <option value="2">Public?</option>
                    <option value="0">True</option>
                    <option value="1">False</option>
                  </select>
                </div>

                <div class="col-md-2">
                  <select id="IsCommercial" name="IsCommercial" class="form-control">
                    <option value="2">Commercial?</option>
                    <option value="0">True</option>
                    <option value="1">False</option>
                  </select>
                </div>

                <div class="col-md-2">
                  <select id="IsCommercial" name="IsCommercial" class="form-control">
                    <option value="0">Type?</option>
                    <option value="1">Garden</option>
                    <option value="2">Orchard</option>
                    <option value="3">Farm</option>
                  </select>
                </div>

              </div> <!-- End Row -->  <br>

              <div class="row">

                <!-- Submit Button -->
                <div class="col-md-6 offset-md-5">
                 <input class="btn btn-primary style-bkg btn-md" type="submit"  width="100%" value="Search Properties">
               </div>

             </div> 

           </fieldset>
         </form>

       </div> <!-- End Collapse Example -->

     </div> <!-- End Column -->
   </div> <!-- End Row -->

   <br>

   <div class ="row">
    <div class = "col-md-12">

      <div class="property-table">
        <table class="table table-striped table-sm sortable" id="dataTable" name="dataTable">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Street</th>
              <th scope="col">City</th>
              <th scope="col">Zip</th>
              <th scope="col">Size</th>
              <th scope="col">Type</th>
              <th scope="col">Public</th>
              <th scope="col">Commercial</th>
              <th scope="col">&nbsp ID</th>
              <th scope="col">Approved By</th>
              <th scope="col">Visits</th>
              <th scope="col">Rating</th>
            </tr>
          </thead>
          <tbody>




            <?php
            $result = mysqli_query($db, "SELECT * FROM Property WHERE ApprovedBy != 'NULL';");
            while ($row = mysqli_fetch_array($result)) {?>
            <tr>
             <td class="link-color"><a href=<?php echo "propertyDetails.php?id=" . $row['ID'];?>><?php echo $row['Name'];?></a></td>
             <td><?php echo $row['Street'];?></td>
             <td><?php echo $row['City'];?></td>
             <td><?php echo $row['Zip'];?></td>
             <td><?php echo $row['Size'];?></td>
             <td><?php echo $row['PropertyType'];?></td>
             <td><?php if ($row['IsPublic'] == "0") {
              echo "False";
            } else {
              echo "True";
            } ?>
          </td>
          <td><?php if ($row['IsCommercial'] == "0") {
            echo "False";
          } else {
            echo "True";
          } ?>
        </td>
        <td><?php echo $row['ID'];?></td>
        <td><?php if ($row['ApprovedBy'] == "NULL") {
          echo "Not Approved";
        } else {
          echo $row['ApprovedBy'];
        } ?>
      </td>
      <td><?php
      $visitsql = "SELECT COUNT(*),  AVG(Rating) FROM Visit WHERE PropertyID = '" . $row['ID'] . "'";
      $visitresult = mysqli_query($db, $visitsql);
      $visitrow = mysqli_fetch_array($visitresult);
      echo $visitrow['COUNT(*)'];?></td>
      <td><?php echo $visitrow["AVG(Rating)"];?></td>
    </tr>
    <?php  } ?>


  </tbody>
</table>
</div> <!-- End Property Table Wrapper -->


</div> <!-- End Column -->
</div> <!-- End Row --> <br> <br> <br> <br>


</div> <!-- End Container -->
</section>

</body>
</html>
