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
       if(isset($_GET['deleteUser'])) {
           $sql = "DELETE FROM User WHERE Username = '" . $_GET['deleteUser'] . "'";
           $result = mysqli_query($db,$sql);

           $logssql = "DELETE FROM Visit WHERE Username = '" . $_GET['deleteUser'] . "'";
           $logsresult = mysqli_query($db,$logssql);

           if($result && $logsresult) {
               echo "<script type='text/javascript'>if(!alert(\"Successfully deleted user: " . $_GET['deleteUser'] . "\")) document.location = 'visitorList.php';</script>";
           } else {
               echo "<script type='text/javascript'>if(!alert(\"Error deleting user: " . $_GET['deleteUser'] . "\")) document.location = 'visitorList.php';</script>";
           }

       } else if(isset($_GET['deleteLogs'])) {
           $sql = "DELETE FROM Visit WHERE Username = '" . $_GET['deleteLogs'] . "'";
           $result = mysqli_query($db,$sql);

           if($result == true) {
               echo "<script type='text/javascript'>if(!alert(\"Successfully deleted logs for user: " . $_GET['deleteLogs'] . "\")) document.location = 'visitorList.php';</script>";
           } else {
               echo "<script type='text/javascript'>if(!alert(\"Error: Could not delete logs for user: " . $_GET['deleteLogs'] . "\")) document.location = 'visitorList.php';</script>";
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
          <h4>All Visitors In System</h4>
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
          <form class="form-horizontal" action="visitorList.php" method = "GET">
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

              
            <br>

              <div class="row">

                <!-- Submit Button -->
                <div class="col-md-6 offset-md-5">
                 <input class="btn btn-primary style-bkg btn-md" type="submit"  width="100%" value="Search Visitors">
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

          <div class="property-table-scroll">
            <table class="table table-striped table-sm sortable">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Delete Visitor</th>
                  <th scope="col">Delete Log History</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">Logged Visits</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $query = "SELECT * FROM User WHERE UserType = 'VISITOR'";
                if (isset($_GET['SEARCH'])) {
                if (isset($_GET['inputUsername']) && $_GET['inputUsername'] != NULL) {
                  $query .= " AND Username LIKE '%" . mysqli_real_escape_string($db, $_GET['inputUsername']) . "%'";
                }
                if (isset($_GET['searchEmail']) && $_GET['searchEmail'] != NULL) {
                  $query .= " AND Email LIKE '%" . mysqli_real_escape_string($db, $_GET['searchEmail']) . "%'";
                }
                if (isset($_GET['searchVisitsFrom']) && $_GET['searchVisitsFrom'] != NULL) {
                    $visitto = mysqli_real_escape_string($db, (isset($_GET['searchVisitsTo']) && $_GET['searchVisitsTo'] != NULL) ? $_GET['searchVisitsTo'] : $_GET['searchVisitFrom']);
                    if ($_GET['searchVisitFrom'] <= 0 && $visitto >= 0) {
                      $query .= " AND Username NOT IN (SELECT Username FROM Visit GROUP BY Username HAVING COUNT(Username) < " . mysqli_real_escape_string($db, $_GET['searchVisitsFrom']) . " OR COUNT(Username) > " . $visitto . ")";
                    } else {
                      $query .= " AND Username IN (SELECT Username FROM Visit GROUP BY Username HAVING COUNT(Username) >= " . mysqli_real_escape_string($db, $_GET['searchVisitsFrom']) . " AND COUNT(Username) <= " . $visitto . ")";
                    }
                    
                }
            }
            $query .= " ORDER BY Username";
            //echo "<br>" . $query . "<br>";
                  $result = mysqli_query($db, $query);
                   while ($row = mysqli_fetch_array($result)) {?>
                       <tr>
                           <td class="link-color"><a href=<?php echo "visitorList.php?deleteUser=" . $row['Username'];?>>Delete</a></td>
                           <td class="link-color"><a href=<?php echo "visitorList.php?deleteLogs=" . $row['Username'];?>>Delete</a></td>
                           <td><?php echo $row['Username'];?></td>
                           <td><?php echo $row['Email'];?></td>
                           <td><?php
                                      $visitsql = "SELECT COUNT(*) FROM Visit WHERE Username = '" . $row['Username'] . "'";
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
