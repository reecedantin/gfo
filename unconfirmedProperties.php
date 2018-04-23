<?php include('session.php'); ?>
<?php
    if($_SESSION['user_type'] != "ADMIN") {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<?php include("config.php"); ?>

<?php include("head.php"); ?>

<body>

  <?php include("navbar.php"); ?>

  <section>
    <div class="container">

      <div class="row text-center title-space">
        <div class="col-md-12">
          <h4>Welcome <b><?php echo($_SESSION['login_user']); ?></b> </h4>

        </div>
      </div> <!-- End Row -->

      <div class ="row">
        <div class = "col-md-12">

          <h6>Unconfirmed Properties</h6>
         <div class ="row">
        <div class = "col-md-12">


          <div class="text-center">

           <button class="btn btn-primary style-bkg" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            &#x1f50d Search Table
          </button>

        </div> 

        <div class="collapse" id="collapseExample">
          <form class="form-horizontal" action="UnconfirmedProperties.php" method = "GET">
            <fieldset>

              <br>
              <input id="SEARCH" name="SEARCH" value="true" type = "hidden">
              <div class="row rowspace">
                <!-- Select Basic -->
                <div class="col-md-2 offset-md-3">
                  <p>Search Name</p>
                </div>

                <!-- Search input-->
                <div class="col-md-4">
                  <input id="inputName" name="inputName" type="search" placeholder="Search Name" class="form-control input-md">
                </div>

              </div> <!-- End Row -->

              <div class="row rowspace">
                <!-- Select Basic -->
                <div class="col-md-2 offset-md-3">
                  <p>Search Street</p>
                </div>

                <!-- Search input-->
                <div class="col-md-4">
                  <input id="inputStreet" name="inputStreet" type="search" placeholder="Search Street" class="form-control input-md">
                </div>

              </div> <!-- End Row -->

              <div class="row rowspace">
                <!-- Select Basic -->
                <div class="col-md-2 offset-md-3">
                  <p>Search City</p>
                </div>

                <!-- Search input-->
                <div class="col-md-4">
                  <input id="inputCity" name="inputCity" type="search" placeholder="Search City" class="form-control input-md">
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
                  <p>Search Owner</p>
                </div>

                <!-- Search input-->
                <div class="col-md-4">
                  <input id="searchOwner" name="searchOwner" type="search" placeholder="Search Owner" class="form-control input-md">
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
                    <option value="1">True</option>
                    <option value="0">False</option>
                  </select>
                </div>

                <div class="col-md-2">
                  <select id="isCommercial" name="isCommercial" class="form-control">
                    <option value="2">Commercial?</option>
                    <option value="1">True</option>
                    <option value="0">False</option>
                  </select>
                </div>

                <div class="col-md-2">
                  <select id="PropertyType" name="PropertyType" class="form-control">
                    <option value="0">Type?</option>
                    <option value="GARDEN">Garden</option>
                    <option value="ORCHARD">Orchard</option>
                    <option value="FARM">Farm</option>
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

        <div class="property-table table-scroll">
          <table class="table table-striped table-sm sortable">
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
                <th scope="col">Owner</th>
              </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM Property WHERE ApprovedBy IS NULL";
                if (isset($_GET['SEARCH'])) {
                if (isset($_GET['inputName']) && $_GET['inputName'] != NULL) {
                  $query .= " AND Name LIKE '%" . mysqli_real_escape_string($db, $_GET['inputName']) . "%'";
                }
                if (isset($_GET['inputCity']) && $_GET['inputCity'] != NULL) {
                  $query .= " AND City LIKE '%" . mysqli_real_escape_string($db, $_GET['inputCity']) . "%'";
                }
                if (isset($_GET['inputStreet']) && $_GET['inputStreet'] != NULL) {
                  $query .= " AND Street LIKE '%" . mysqli_real_escape_string($db, $_GET['inputStreet']) . "%'";
                }
                if (isset($_GET['searchOwner']) && $_GET['searchOwner'] != NULL) {
                  $query .= " AND Owner LIKE '%" . mysqli_real_escape_string($db, $_GET['searchOwner']) . "%'";
                }
                if ($_GET['isCommercial'] != 2) {
                   $query .= " AND isCommercial = " . $_GET['isCommercial'];
                }
                if ($_GET['isPublic'] != 2) {
                   $query .= " AND isPublic = " . $_GET['isPublic'];
                }
                if ($_GET['PropertyType'] != '0') {
                   $query .= " AND PropertyType = '" . $_GET['PropertyType'] . "'";
                }
                if (isset($_GET['searchZip']) && $_GET['searchZip'] != NULL) {
                    $query .= " AND Zip = " . mysqli_real_escape_string($db, $_GET['searchZip']);
                }
                if (isset($_GET['searchSizeFrom']) && $_GET['searchSizeFrom'] != NULL) {
                    $sizeto = mysqli_real_escape_string($db, (isset($_GET['searchSizeTo']) && $_GET['searchSizeTo'] != NULL) ? $_GET['searchSizeTo'] : $_GET['searchSizeFrom']);
                    $query .= " AND Size >= " . mysqli_real_escape_string($db, $_GET['searchSizeFrom']) . " AND Size <= " . $sizeto;
                }
                if (isset($_GET['searchIdFrom']) && $_GET['searchIdFrom'] != NULL) {
                    $idto = mysqli_real_escape_string($db, (isset($_GET['searchIdTo']) && $_GET['searchIdTo'] != NULL) ? $_GET['searchIdTo'] : $_GET['searchIdFrom']);
                    $query .= " AND ID >= " . mysqli_real_escape_string($db, $_GET['searchIdFrom']) . " AND ID <= " . $idto;
                }
                
            }
            $query .= " ORDER BY Name";
            //echo "<br>" . $query . "<br>";
            $result = mysqli_query($db, $query);
                 while ($row = mysqli_fetch_array($result)) {?>
                     <tr>
                         <th scope="row"><a href=<?php echo "manageProperty.php?id=" . $row['ID'];?>>Edit</a></th>
                         <td class="link-color"><a href=<?php echo "propertyDetails.php?id=" . $row['ID'];?>><?php echo $row['Name'];?></a></td>
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
                         <td><?php echo $row['Owner']; ?>
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
