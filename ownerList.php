<?php include('session.php'); ?>
<?php include("config.php"); ?>
<?php
    if($_SESSION['user_type'] != "ADMIN") {
      header("Location: index.php");
    }
?>

<?php
    if($_SERVER["REQUEST_METHOD"] == "GET") {
       // username and password sent from form
       if(isset($_GET['username'])) {
           $propertiessql = "SELECT ID FROM Property WHERE Owner = '" . $_GET['username'] . "'";
           $propertiesresult = mysqli_query($db,$propertiessql);

           $deleteresult = true;

           while ($row = mysqli_fetch_array($propertiesresult)) {
               $deletesql = "DELETE FROM Has WHERE PropertyID = '" . $row['ID'] . "'";
               $deleteresult = ($deleteresult && mysqli_query($db, $deletesql));
           }

           $deletepropertiessql = "DELETE FROM Property WHERE Owner = '" . $_GET['username'] . "'";
           $deletepropertiesresult = mysqli_query($db, $deletepropertiessql);

           $sql = "DELETE FROM User WHERE Username = '" . $_GET['username'] . "'";
           $result = mysqli_query($db, $sql);

           if($result && $deleteresult && $deletepropertiesresult) {
               echo "<script type='text/javascript'>if(!alert(\"Successfully deleted user: " . $_GET['username'] . "\")) document.location = 'ownerList.php';</script>";
           } else {
               echo "<script type='text/javascript'>if(!alert(\"Error: Could not delete user: " . $_GET['username'] . " Deleted properties: " . $deleteresult . " Deleted user: " . $result . "\")) document.location = 'ownerList.php';</script>";
           }
       }
   }
 ?>

<!DOCTYPE html>
<html lang="en">

<?php include("head.php"); ?>

<body>

  <?php include("navbar.php"); ?>

  <section>
    <div class="container">

      <div class="row text-center title-space">
        <div class="col-md-12">
          <h4>All Owners In System</h4>
          <br>
        </div>
      </div> <!-- End Row -->

            <div class ="row">
        <div class = "col-md-12">

          <div class="text-center">

           <button class="btn btn-primary style-bkg" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            &#x1f50d Search Table
          </button>

        </div> 

        <div class="collapse" id="collapseExample">
          <form class="form-horizontal" action="ownerList.php" method = "GET">
            <fieldset>

              <br>
              <input id="SEARCH" name="SEARCH" value="true" type = "hidden">
              <div class="row rowspace">
                <!-- Select Basic -->
                <div class="col-md-2 offset-md-3">
                  <p>Search Username</p>
                </div>

                <!-- Search input-->
                <div class="col-md-4">
                  <input id="inputUsername" name="inputUsername" type="search" placeholder="Search Username" class="form-control input-md">
                </div>

              </div> <!-- End Row -->

              <div class="row rowspace">
                <!-- Select Basic -->
                <div class="col-md-2 offset-md-3">
                  <p>Search Email</p>
                </div>

                <!-- Search input-->
                <div class="col-md-4">
                  <input id="searchEmail" name="searchEmail" type="search" placeholder="Search Email" class="form-control input-md">
                </div>

              </div> <!-- End Row -->

              <div class="row rowspace">
                <!-- Select Basic -->
                <div class="col-md-2 offset-md-3">
                  <p>Search Number of Properties</p>
                </div>

                <!-- Search input-->
                <div class="col-md-2">
                  <input id="searchPropertiesFrom" name="searchPropertiesFrom" type="search" placeholder="Start Value" class="form-control input-md">
                </div>

                <!-- Search input-->
                <div class="col-md-2">
                  <input id="searchPropertiesTo" name="searchPropertiesTo" type="search" placeholder="End Value" class="form-control input-md">
                </div>

              </div> <!-- End Row -->

              
            <br>

              <div class="row">

                <!-- Submit Button -->
                <div class="col-md-6 offset-md-5">
                 <input class="btn btn-primary style-bkg btn-md" type="submit"  width="100%" value="Search Owners">
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
                  <th scope="col">Delete Owner</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">Number of properties</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $query = "SELECT * FROM User WHERE UserType = 'OWNER'";
              if (isset($_GET['SEARCH'])) {
                if (isset($_GET['inputUsername']) && $_GET['inputUsername'] != NULL) {
                  $query .= " AND Username LIKE '%" . mysqli_real_escape_string($db, $_GET['inputUsername']) . "%'";
                }
                if (isset($_GET['searchEmail']) && $_GET['searchEmail'] != NULL) {
                  $query .= " AND Email LIKE '%" . mysqli_real_escape_string($db, $_GET['searchEmail']) . "%'";
                }
                if (isset($_GET['searchPropertiesFrom']) && $_GET['searchPropertiesFrom'] != NULL) {
                    $visitto = mysqli_real_escape_string($db, (isset($_GET['searchPropertiesTo']) && $_GET['searchPropertiesTo'] != NULL) ? $_GET['searchPropertiesTo'] : $_GET['searchPropertiesFrom']);
                    if ($_GET['searchPropertiesFrom'] <= 0 && $visitto >= 0) {
                      $query .= " AND Username NOT IN (SELECT Owner as Username FROM Property GROUP BY Owner HAVING COUNT(Owner) < " . mysqli_real_escape_string($db, $_GET['searchPropertiesFrom']) . " OR COUNT(Owner) > " . $visitto . ")";
                    } else {
                      $query .= " AND Username IN (SELECT Owner as Username FROM Property GROUP BY Owner HAVING COUNT(Owner) >= " . mysqli_real_escape_string($db, $_GET['searchPropertiesFrom']) . " AND COUNT(Owner) <= " . $visitto . ")";
                    }
                    
                }
            }
            $query .= " ORDER BY Username";
            //echo "<br>" . $query . "<br>";
                  $result = mysqli_query($db, $query);
               while ($row = mysqli_fetch_array($result)) {?>
                   <tr>
                       <td class="link-color"><a href=<?php echo "ownerList.php?username=" . $row['Username'];?>>Delete</a></td>
                       <td><?php echo $row['Username'];?></td>
                       <td><?php echo $row['Email'];?></td>
                       <td><?php
                                  $visitsql = "SELECT COUNT(*) FROM Property WHERE Owner = '" . $row['Username'] . "'";
                                  $visitresult = mysqli_query($db, $visitsql);
                                  $visitrow = mysqli_fetch_array($visitresult);
                                  echo $visitrow['COUNT(*)'];?></td>
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
