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

          <div class="text-center">

           <button class="btn btn-primary style-bkg" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            &#x1f50d Search Table
          </button>

        </div> 

        <div class="collapse" id="collapseExample">
          <form class="form-horizontal" action="pendingEntities.php" method = "GET">
            <fieldset>

              <br>
              <input id="SEARCH" name="SEARCH" value="true" type = "hidden">
              <div class="row rowspace">
                <!-- Select Basic -->
                <div class="col-md-2 offset-md-3">
                  <p>Search name</p>
                </div>

                <!-- Search input-->
                <div class="col-md-4">
                  <input id="inputName" name="inputName" type="search" placeholder="Search Name" class="form-control input-md">
                </div>

              </div> <!-- End Row -->

              <div class="row rowspace">

                <div class="col-md-6 offset-md-3">
                  <select id="Type" name="Type" class="form-control">
                    <option value="0">Type?</option>
                    <option value="ANIMAL">Animal</option>
                    <option value="FRUIT">Fruit</option>
                    <option value="FLOWER">Flower</option>
                    <option value="VEGETABLE">Vegetable</option>
                    <option value="NUT">Nut</option>
                  </select>
                </div>

              </div> <!-- End Row -->  

              
            <br>

              <div class="row">

                <!-- Submit Button -->
                <div class="col-md-6 offset-md-5">
                 <input class="btn btn-primary style-bkg btn-md" type="submit"  width="100%" value="Search Entities">
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
                  <th scope="col">Delete</th>
                  <th scope="col">Approve Selection</th>
                  <th scope="col">Name</th>
                  <th scope="col">Type</th>
                </tr>
              </thead>
              <tbody>
                  <?php 
                  $query = "SELECT * FROM FarmItem WHERE IsApproved = '0'";
                  if (isset($_GET['SEARCH'])) {
                    if (isset($_GET['inputName']) && $_GET['inputName'] != NULL) {
                      $query .= " AND Name LIKE '%" . mysqli_real_escape_string($db, $_GET['inputName']) . "%'";
                    }
                    if (isset($_GET['Type']) && $_GET['Type'] != '0') {
                      $query .= " AND Type = '" . mysqli_real_escape_string($db, $_GET['Type']) . "'";
                    }
                  }
                  $query .= " ORDER BY Name";
                  //echo "<br>" . $query . "<br>";
                  $unapprovedItems = mysqli_query($db, $query);
                  while ($row = mysqli_fetch_array($unapprovedItems)) { ?>
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
