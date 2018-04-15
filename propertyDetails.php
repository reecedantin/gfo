<?php include('session.php'); ?>
<?php include("config.php"); ?>

<?php
if($_SESSION['user_type'] != "OWNER") {
  header("Location: index.php");
}
?>

<?php
    $findpropertywithID = mysqli_query($db, "SELECT * FROM Property WHERE ID = '" . $_GET['id'] . "'");
    $foundproperty = mysqli_fetch_array($findpropertywithID);

    $count = mysqli_num_rows($findpropertywithID);

    if($count == 1) {
        $ownerresult = mysqli_query($db, "SELECT * FROM User WHERE Username = '" . $foundproperty['Owner'] . "'");
        $foundOwner = mysqli_fetch_array($ownerresult);
        $visitresult = mysqli_query($db, "SELECT COUNT(*),  AVG(Rating) FROM Visit WHERE PropertyID = '" . $foundproperty['ID'] . "'");
        $visitrow = mysqli_fetch_array($visitresult);

        $cropsresult = mysqli_query($db, "SELECT * FROM Has WHERE PropertyID = '" . $foundproperty['ID'] . "' AND ItemName NOT IN (SELECT Name FROM FarmItem WHERE Type = 'ANIMAL')");
        $animalresult = mysqli_query($db, "SELECT * FROM Has WHERE PropertyID = '" . $foundproperty['ID'] . "' AND ItemName IN (SELECT Name FROM FarmItem WHERE Type = 'ANIMAL')");

    } else {
       echo "<script type='text/javascript'>if(!alert(\"Could not find property\")) document.location = 'index.php';</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">


<?php include("head.php"); ?>

<body>

  <?php include("ownerNavbar.php"); ?>

  <section>
    <div class="container">

      <div class="row text-center title-space">
        <div class="col-md-12">
          <h4>Property Details</h4>
          <br>
        </div>
      </div> <!-- End Row -->

      <div class ="row">
        <div class = "col-md-4 offset-md-4">

         <table class="table table-condensed table-sm table-striped">
          <thead>

          </thead>
          <tbody>
            <tr>
              <th>Name</th>
              <td><?php echo $foundproperty['Name']; ?></td>
            </tr>
            <tr>
              <th>Owner</th>
              <td><?php echo $foundproperty['Owner']; ?></td>
            </tr>
            <tr>
              <th>Owner Email</th>
              <td><?php echo $foundOwner['Email']; ?></td>
            </tr>
            <tr>
              <th>Visits</th>
              <td><?php echo $visitrow['COUNT(*)']; ?></td>
            </tr>
            <tr>
              <th>Street</th>
              <td><?php echo $foundproperty['Street']; ?></td>
            </tr>
            <tr>
              <th>City</th>
              <td><?php echo $foundproperty['City']; ?></td>
            </tr>
            <tr>
              <th>Zip</th>
              <td><?php echo $foundproperty['Zip']; ?></td>
            </tr>
            <tr>
              <th>Size (acres)</th>
              <td><?php echo $foundproperty['Size']; ?></td>
            </tr>
            <tr>
              <th>Avg Rating</th>
              <td><?php echo $visitrow['AVG(Rating)']; ?></td>
            </tr>
            <tr>
              <th>Type</th>
              <td><?php echo $foundproperty['PropertyType']; ?></td>
            </tr>
            <tr>
              <th>Public</th>
              <td><?php if ($foundproperty['IsPublic'] == "0") {
                         echo "No";
                     } else {
                         echo "Yes";
                     } ?>
              </td>
            </tr>
            <tr>
              <th>Commercial</th>
              <td><?php if ($foundproperty['IsCommercial'] == "0") {
                         echo "No";
                     } else {
                         echo "Yes";
                     } ?>
              </td>
            </tr>
            <tr>
              <th>ID</th>
              <td><?php echo $foundproperty['ID']; ?></td>
            </tr>
            <tr>
              <th>Crops</th>
              <td><?php while ($row = mysqli_fetch_array($cropsresult))
                        echo $row["ItemName"] . " ";
                   ?></td>
            </tr>
            <tr>
              <th>Animals</th>
              <td><?php while ($row = mysqli_fetch_array($animalresult))
                        echo $row["ItemName"] . " ";
                   ?></td>
            </tr>
          </tbody>
        </table>

      </div> <!-- End Column -->
    </div> <!-- End Row -->


    <div class ="row">
      <div class="col-md-12">

        <form class="form-horizontal">
          <fieldset>

            <div class ="row">
              <div class = "col-md-4 offset-md-4">


                <table class="table table-condensed table-sm">
                  <thead>

                  </thead>
                  <tbody>
                    <tr>
                      <th>Rate Visit</th>
                      <td>

                        <div class="col-md-12">
                          <select id="selectbasic" name="selectbasic" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                          </select>
                        </div>

                      </td>
                    </tr>
                  </tbody>
                </table>

                <br> <br>

              </div> <!-- End Column -->
            </div> <!-- End Row -->


            <div class="row">
             <div class="col-md-3 offset-md-3">
              <a href="ownerDashboard.php"><button class="btn btn-success style-bkg" style="width: 100%;">&#x2605 Log Visit</button></a>
            </div>

  <!--   Uncomment and use this for the unlogging case
             <div class="col-md-3 offset-md-3">
                  <a href="ownerDashboard.php"><button class="btn btn-success style-bkg" style="width: 100%;">&#x2718 Un-Log Visit</button></a>
                </div>
              -->
              <div class="col-md-3">
                <a href="ownerDashboard.php"><div class="btn btn-secondary" style="width: 100%;">&#x2190 Back</div></a>
              </div>
            </div>

          </fieldset>
        </form>
      </div> <!-- End Column -->
    </div> <!-- End Row -->

    <br> <br>

  </div> <!-- End Container -->
</section>

</body>
</html>
