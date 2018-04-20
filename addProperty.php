<?php include("session.php") ?>
<?php include('config.php'); ?>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
       $ispublic = ($_POST['public'] == "true");
       $iscommercial = ($_POST['commercial'] == "true");

       $nextIDresult = mysqli_query($db, "SELECT COUNT(*) FROM Property");
       $nextIDrow = mysqli_fetch_array($nextIDresult);
       $nextID = $nextIDrow['COUNT(*)'];

       $sql = "INSERT INTO Property (ID, Name, Size, IsCommercial, IsPublic, Street, City, Zip, PropertyType, Owner) VALUES (
       '" . $nextID . "',
       '" . $_POST['propertyName'] . "',
       '" . $_POST['size'] . "',
       '" . $iscommercial . "',
       '" . $ispublic . "',
       '" . $_POST['streetAddress'] . "',
       '" . $_POST['city'] . "',
       '" . $_POST['zip'] . "',
       '" . strtoupper($_POST['type']) . "',
       '" . $_SESSION['login_user'] . "')";

       $resultone = mysqli_query($db,$sql);

       $resulttwo = true;

       if($_POST['type'] == "farm") {
           $animalsql = "INSERT INTO Has (PropertyID, ItemName) VALUES ('" . $nextID . "','" . $_POST['animal'] . "')";
           $resulttwo = mysqli_query($db, $animalsql);
       }

       $cropsql = "INSERT INTO Has (PropertyID, ItemName) VALUES ('" . $nextID . "','" . $_POST['crop'] . "')";
       $resultthree = mysqli_query($db, $cropsql);


       if($resultone && $resulttwo && $resultthree) {
           echo "<script type='text/javascript'>if(!alert(\"Successfully added property\")) document.location = 'index.php';</script>";
       } else {
           echo "<script type='text/javascript'>if(!alert(\"Error: Could not add property\")) document.location = 'index.php';</script>";
       }
    }
?>


<?php
        $allcropsresult = mysqli_query($db, "SELECT * FROM FarmItem WHERE IsApproved = '0' AND Type != 'ANIMAL'");
        $allanimalresult = mysqli_query($db, "SELECT * FROM FarmItem WHERE IsApproved = '0' AND Type = 'ANIMAL'");
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
          <h4>Add New Property</h4>
        </div> <!-- End Column -->
      </div> <!-- End Row -->

      <div class="row">
        <div class="col-md-12">

          <form class="form-horizontal" id="addPropertyForm" method="post">
              <div class="row ">
                <div class="col-md-4 offset-md-2">
                  <label class="col-md-12 control-label" for="propertyName">Property Name*</label>
                  <div class="col-md-12">
                    <input id="propertyName" name="propertyName" type="text" placeholder="Property Name" class="form-control input-md" required="">
                  </div> <br>

                  <label class="col-md-12 control-label" for="address">Street Address*</label>
                  <div class="col-md-12">
                    <input id="streetAddress" name="streetAddress" type="text" placeholder="Street Address" class="form-control input-md" required="">
                  </div> <br>

                  <label class="col-md-12 control-label" for="city">City*</label>
                  <div class="col-md-12">
                    <input id="city" name="city" type="text" placeholder="City" class="form-control input-md" required="">
                  </div> <br>


                  <label class="col-md-12 control-label" for="zip">Zip*</label>
                  <div class="col-md-12">
                    <input id="zip" name="zip" type="text" placeholder="Zip" class="form-control input-md" required="">
                  </div> <br>

                  <label class="col-md-12 control-label" for="size">Size* (acres)</label>
                  <div class="col-md-12">
                    <input id="size" name="size" type="text" placeholder="Size" class="form-control input-md" required="">
                  </div> <br>


                </div> <!-- End Column -->
                <div class="col-md-4">

                  <label class="col-md-12 control-label" for="type">Type*</label>
                  <div class="col-md-12">
                    <select id="propertyType" name="type" class="form-control" onChange="FarmTypeChanged()">
                      <option value="farm">Farm</option>
                      <option value="garden">Garden</option>
                      <option value="orchard">Orchard</option>
                    </select>
                  </div> <br>


                  <label class="col-md-12 control-label" id="animalLabel" for="animal">Animal*</label>
                  <div class="col-md-12">
                    <select id="animalSelect" name="animal" class="form-control">
                        <option value=""></option>
                        <?php while ($row = mysqli_fetch_array($allanimalresult)) { ?>
                           <option value="<?php echo $row['Name']; ?>"><?php echo $row['Name']; ?></option>
                        <?php } ?>
                    </select>
                  </div> <br>

                  <label class="col-md-12 control-label" for="crop">Crop*</label>
                  <div class="col-md-12">
                    <select id="cropSelect" name="crop" class="form-control">
                        <option value=""></option>
                        <?php while ($row = mysqli_fetch_array($allcropsresult)) { ?>
                           <option value="<?php echo $row['Name']; ?>"><?php echo $row['Name']; ?></option>
                        <?php } ?>
                    </select>
                  </div> <br>


                  <label class="col-md-12 control-label" for="public">Public?*</label>
                  <div class="col-md-12">
                    <select id="public" name="public" class="form-control">
                      <option value="true">True</option>
                      <option value="false">False</option>
                    </select>
                  </div> <br>

                  <label class="col-md-12 control-label" for="commercial">Commercial*</label>
                  <div class="col-md-12">
                    <select id="commercial" name="commercial" class="form-control">
                      <option value="true">True</option>
                      <option value="false">False</option>
                    </select>
                  </div> <br>

                </div> <!-- End Column -->
              </div> <!-- End Row -->


              <!-- Button Bar -->
              <div class="row button-adjust">
                <div class="col-md-6">
                  <button type="button" onclick="AddProperty()" class="btn btn-success style-bkg" style="width: 100%;">Add Property</button>
                </div>

                <div class="col-md-6">
                  <a href="index.php"><div class="btn btn-secondary" style="width: 100%;">Cancel</div></a>
                </div>
              </div> <!-- End Row -->
              <br> <br>
          </form>

        </div> <!-- End Outer Column -->
      </div> <!-- End Outer Row -->



    </div> <!-- End Container -->
  </section>
  <script>
    function AddProperty() {
        var propertySelect = document.getElementById("propertyType");
        var animalSelect = document.getElementById("animalSelect");
        var cropSelect = document.getElementById("cropSelect");
        if(propertySelect.options[propertySelect.selectedIndex].text == "Farm") {
            if(animalSelect.selectedIndex == 0) {
                alert("Error: Please select an animal");
                return;
            }
            if(cropSelect.selectedIndex == 0) {
                alert("Error: Please select a crop");
                return;
            }
        } else {
            if(cropSelect.selectedIndex == 0) {
                alert("Error: Please select a crop");
                return;
            }
            animalSelect.selectedIndex = 0;
        }
        document.getElementById("addPropertyForm").submit();
    }

    function FarmTypeChanged() {
        var propertySelect = document.getElementById("propertyType");
        var animalSelect = document.getElementById("animalSelect");
        var animalLabel = document.getElementById("animalLabel");
        if(propertySelect.options[propertySelect.selectedIndex].text == "Farm") {
            animalSelect.hidden = false;
            animalLabel.hidden = false;
        } else {
            animalSelect.hidden = true;
            animalLabel.hidden = true;
        }
    }
  </script>
</body>
</html>
