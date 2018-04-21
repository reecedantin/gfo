<?php include('session.php'); ?>
<?php include('config.php'); ?>
<?php
if($_SESSION['user_type'] != "ADMIN") {
  header("Location: index.php");
}
?>

<?php
    if(isset($_GET['deleteName'])) {
        $sql = "DELETE FROM FarmItem WHERE Name = '" . $_GET['deleteName'] . "'";
        $result = mysqli_query($db,$sql);
        if($result == true) {
            echo "<script type='text/javascript'>if(!alert(\"Successfully deleted: " . $_GET['deleteName'] . "\")) document.location = 'pendingEntities.php';</script>";
        } else {
            echo "<script type='text/javascript'>if(!alert(\"Error: Could not delete: " . $_GET['deleteName'] . "\")) document.location = 'pendingEntities.php';</script>";
        }
    } else if(isset($_GET['approveName'])) {
        $sql = "UPDATE FarmItem SET IsApproved = '1' WHERE Name = '" . $_GET['approveName'] . "'";
        $result = mysqli_query($db,$sql);
        if($result == true) {
            echo "<script type='text/javascript'>if(!alert(\"Successfully approved: " . $_GET['approveName'] . "\")) document.location = 'pendingEntities.php';</script>";
        } else {
            echo "<script type='text/javascript'>if(!alert(\"Error: Could not approve: " . $_GET['approveName'] . "\")) document.location = 'pendingEntities.php';</script>";
        }
    }

    $unapprovedItemsql = "SELECT * FROM FarmItem WHERE IsApproved = '0'";
    $unapprovedItems = mysqli_query($db, $unapprovedItemsql);
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
          <h4>Pending Approval Animals/Crops</h4>
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
            <table class="table table-striped table-sm sortable">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Delete</th>
                  <th scope="col">Approve Selection</th>
                  <th scope="col">Name</th>
                  <th scope="col">Type</th>
                </tr>
              </thead>
              <tbody>
                  <?php while ($row = mysqli_fetch_array($unapprovedItems)) { ?>
                  <tr>
                    <td class="link-color"><a href=<?php echo "\"pendingEntities.php?deleteName=" . $row['Name'] . "\"";?>>Delete</a></td>
                    <td class="link-color"><a href=<?php echo "\"pendingEntities.php?approveName=" . $row['Name'] . "\"";?>>Approve</a></td>
                    <td><?php echo $row['Name']; ?></td>
                    <td><?php echo $row['Type']; ?></td>
                  </tr>
                  <?php } ?>
            </tbody>
          </table>
        </div> <!-- End Property Table Wrapper -->


      </div> <!-- End Column -->
    </div> <!-- End Row -->


  </div> <!-- End Container -->
</section>

</body>
</html>
