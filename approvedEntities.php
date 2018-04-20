<?php include('session.php'); ?>
<?php include('config.php'); ?>
<?php
if($_SESSION['user_type'] != "ADMIN") {
  header("Location: index.php");
}
?>

<?php

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['addName']) && isset($_POST['addType'])) {
            $sql = "INSERT INTO FarmItem (Name, IsApproved, Type) VALUES ('" . $_POST['addName'] . "', '1', '" . $_POST['addType'] . "')";
            $result = mysqli_query($db,$sql);
            if($result == true) {
                echo "<script type='text/javascript'>if(!alert(\"Successfully added: " . $_POST['addName'] . "\")) document.location = 'approvedEntities.php';</script>";
            } else {
                echo "<script type='text/javascript'>if(!alert(\"Error: Could not add: " . $_POST['addName'] . "\")) document.location = 'approvedEntities.php';</script>";
            }
        }
    } else {
        if(isset($_GET['deleteName'])) {
            $sql = "DELETE FROM FarmItem WHERE Name = '" . $_GET['deleteName'] . "'";
            $result = mysqli_query($db,$sql);
            if($result == true) {
                echo "<script type='text/javascript'>if(!alert(\"Successfully deleted: " . $_GET['deleteName'] . "\")) document.location = 'approvedEntities.php';</script>";
            } else {
                echo "<script type='text/javascript'>if(!alert(\"Error: Could not delete: " . $_GET['deleteName'] . "\")) document.location = 'approvedEntities.php';</script>";
            }
        }
    }

    $farmItemList = array('ANIMAL', 'FRUIT', 'FLOWER', 'VEGETABLE', 'NUT');

    $approvedItemsql = "SELECT * FROM FarmItem WHERE IsApproved = '1'";
    $approvedItems = mysqli_query($db, $approvedItemsql);
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
          <h4>Approved Animals/Crops</h4>
          <br>
        </div>
      </div> <!-- End Row -->


      <div class="row">
        <div class="col-md-6 offset-md-3">

          <form class="form-horizontal" id="addItemForm" method="post">
              <div class="form-group">
                <label class="col-md-12 control-label"><b>Add New Item</b></label>

                 <label class="col-md-12 control-label" for="type">Type*</label>
                  <div class="col-md-12 rowspace">
                    <select id="addType" name="addType" class="form-control">
                        <option value=""></option>
                        <?php foreach ($farmItemList as &$value) {  ?>
                            <option value="<?php echo $value ?>"><?php echo $value ?></option>
                        <?php } ?>
                    </select>
                  </div>

                <div class="col-md-12 rowspace">
                  <input id="addName" name="addName" type="text" placeholder="Enter New Crop Name" class="form-control input-md">
                </div>

                <div class="col-md-12">
                  <button id="addItem" type="button" onclick="AddItem()" class="btn btn-primary style-bkg" style="width: 100%;">Add to Approved List</button>
                </div>
              </div> <!-- End form group -->
          </form>

        </div> <!-- End Column -->
      </div> <!-- End Row -->  <br>



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
                  <th scope="col">Name</th>
                  <th scope="col">Type</th>
                </tr>
              </thead>
              <tbody>
                  <?php while ($row = mysqli_fetch_array($approvedItems)) { ?>
                  <tr>
                    <td class="link-color"><a href=<?php echo "approvedEntities.php?deleteName=" . $row['Name'];?>>Delete</a></td>
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
<script>
    function AddItem () {
        var typeSelect = document.getElementById("addType");
        var nameText = document.getElementById("addName");
        if(typeSelect.options[typeSelect.selectedIndex].text == "") {
            alert("Error: Please select a type");
            return;
        }

        if(nameText.value == "") {
            alert("Error: Please input a name");
            return;
        }

        document.getElementById("addItemForm").submit();
    }
</script>
</body>
</html>
