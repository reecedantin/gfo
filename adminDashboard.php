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
          <h4>Welcome <b><?php echo($_SESSION['login_user']); ?></b> </h4>

        </div>
      </div> <!-- End Row -->

      <div class ="row">
        <div class = "col-md-12">

          <h6>Confirmed Properties</h6>
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
                $result = mysqli_query($db, "SELECT * FROM Property WHERE Owner = '" . $_SESSION['login_user'] . "'");
                 while ($row = mysqli_fetch_array($result)) {?>
                     <tr>
                         <th scope="row"><a href="manageProperty.php">Edit</a></th>
                         <td class="link-color"><a href="propertyDetails.php"><?php echo $row['Name'];?></a></td>
                         <td><?php echo $row['Street'];?></td>
                         <td><?php echo $row['City'];?></td>
                         <td><?php echo $row['Zip'];?></td>
                         <td><?php echo $row['Size'];?></td>
                         <td><?php echo $row['PropertyType'];?></td>
                         <td><?php if ($row['IsPublic'] == "0") {
                                    echo "No";
                                } else {
                                    echo "Yes";
                                } ?>
                         </td>
                         <td><?php if ($row['IsCommercial'] == "0") {
                                    echo "No";
                                } else {
                                    echo "Yes";
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
    </div> <!-- End Row -->

  </div> <!-- End Container -->
</section>

</body>
</html>
