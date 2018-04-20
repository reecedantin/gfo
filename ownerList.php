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
           $sql = "DELETE FROM User WHERE Username = '" . $_GET['username'] . "'";
           $result = mysqli_query($db,$sql);
           print $result;
           if($result == true) {
               echo "<script type='text/javascript'>if(!alert(\"Successfully deleted user: " . $_GET['username'] . "\")) document.location = 'ownerList.php';</script>";
           } else {
               echo "<script type='text/javascript'>if(!alert(\"Error: Could not delete user: " . $_GET['username'] . "\")) document.location = 'ownerList.php';</script>";
           }
       }
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
          <h4>All Owners In System</h4>
          <br>
        </div>
      </div> <!-- End Row -->

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
                  <input id="searchinput" name="searchinput" type="search" placeholder="Search Owners" class="form-control input-md">
                </div>

                <!-- Submit Button -->
                <div class="col-md-2">
                  <input class="btn btn-primary style-bkg" type="submit" value="Search Owners">
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
                  <th scope="col">Delete Owner</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">Number of properties</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $result = mysqli_query($db, "SELECT * FROM User WHERE UserType = 'OWNER';");
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
