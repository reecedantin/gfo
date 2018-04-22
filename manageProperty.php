<?php include('session.php'); ?>
<?php include('config.php'); ?>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['delete'])) {
            $sql = "";

            if($_SESSION['user_type'] == 'OWNER') {
                $sql = "DELETE FROM Property WHERE ID = '" . $_POST['delete'] . "' AND Owner = '" . $_SESSION['login_user'] . "'";
            } else if($_SESSION['user_type'] == 'ADMIN') {
                $sql = "DELETE FROM Property WHERE ID = '" . $_POST['delete'] . "'";
            }
            $result = mysqli_query($db,$sql);

            $resulttwo = true;

            if ($result) {
                $sqltwo = "DELETE FROM Has WHERE PropertyID = '" . $_POST['delete'] . "'";
                $resulttwo = mysqli_query($db,$sqltwo);

                $sqlthree = "DELETE FROM Visit WHERE PropertyID = '" . $_POST['delete'] . "'";
                $resulttwo = ($resulttwo && mysqli_query($db,$sqlthree));
            }

            if($result && $resulttwo) {
                echo "<script type='text/javascript'>if(!alert(\"Successfully deleted property\")) document.location = 'index.php';</script>";
            } else {
                echo "<script type='text/javascript'>if(!alert(\"Error: Could not delete property\")) document.location = 'index.php';</script>";
            }
        }

        if(isset($_POST['id'])) {
            if($_POST['type'] == "FARM" && !isset($_POST['currentAnimals'])) {
                echo "<script type='text/javascript'>if(!alert(\"Error: Farms must have one animal and one crop\")) document.location = 'manageProperty.php?id=" . $_POST['id'] . "';</script>";
                return;
            }

            if(!isset($_POST['currentCrops'])) {
                echo "<script type='text/javascript'>if(!alert(\"Error: Properties must have at least one crop\")) document.location = 'manageProperty.php?id=" . $_POST['id'] . "';</script>";
                return;
            }
           $ispublic = ($_POST['public'] == "true");
           $iscommercial = ($_POST['commercial'] == "true");

           $sql = "";

           if($_SESSION['user_type'] == 'OWNER') {
               $sql = "UPDATE Property SET
               Name = '" . $_POST['propertyName'] . "',
               Street = '" . $_POST['address'] . "',
               City = '" . $_POST['city'] . "',
               Zip = '" . $_POST['zip'] . "',
               Size = '" . $_POST['size'] . "',
               IsPublic = '" . $ispublic . "',
               IsCommercial = '" . $iscommercial . "' WHERE ID = '" . $_POST['id'] . "' AND Owner = '" . $_SESSION['login_user'] . "'";

           } else if($_SESSION['user_type'] == 'ADMIN') {
               $sql = "UPDATE Property SET
                   Name = '" . $_POST['propertyName'] . "',
                   Street = '" . $_POST['address'] . "',
                   City = '" . $_POST['city'] . "',
                   Zip = '" . $_POST['zip'] . "',
                   Size = '" . $_POST['size'] . "',
                   IsPublic = '" . $ispublic . "',
                   ApprovedBy = '" . $_SESSION['login_user'] . "',
                   IsCommercial = '" . $iscommercial . "' WHERE ID = '" . $_POST['id'] . "'";
           }

           $result = mysqli_query($db,$sql);

           $deleteresult = false;

           if($result) {
               $deletesql = "DELETE FROM Has WHERE PropertyID = '" . $_POST['id'] . "'";
               $deleteresult = mysqli_query($db,$deletesql);
           }


           $insertsql = "";
           $addsqlresult = true;

            if($deleteresult) {
                if(isset($_POST['currentCrops'])) {
                    $countupcrops = 0;
                    for ($i = 0; $i < sizeof($_POST['currentCrops']); $i++) {
                        $cropName = NULL;
                        while($cropName == NULL) {
                            $cropName = $_POST['currentCrops'][$countupcrops];
                            $countupcrops++;
                        }
                        $insertsql = $insertsql . "INSERT INTO Has (PropertyID, ItemName) VALUES ('" . $_POST['id'] . "','" . $cropName . "');";
                    }
                }

               if(isset($_POST['currentAnimals'])) {
                   $countupanimals = 0;
                   for ($i = 0; $i < sizeof($_POST['currentAnimals']); $i++) {
                       $animalName = NULL;
                       while($animalName == NULL) {
                           $animalName = $_POST['currentAnimals'][$countupanimals];
                           $countupanimals++;
                       }
                       $insertsql = $insertsql . "INSERT INTO Has (PropertyID, ItemName) VALUES ('" . $_POST['id'] . "','" . $animalName . "');";
                   }
               }
               if($insertsql != "") {
                   $addsqlresult = mysqli_multi_query($db,$insertsql);
               }
           }

           if(!$deleteresult) {
               echo "<script type='text/javascript'>alert(\"Failed to clear farm items\");</script>";
           }

           if(!$addsqlresult) {
               echo "<script type='text/javascript'>alert(\"Failed to add new farm items\");</script>";
           }


           if($result && $deleteresult && $addsqlresult) {
               echo "<script type='text/javascript'>if(!alert(\"Successfully updated property\")) document.location = 'index.php';</script>";
           } else {
               echo "<script type='text/javascript'>if(!alert(\"Error: Could not update property\")) document.location = 'index.php';</script>";
           }
        }

        if(isset($_POST['requestFormValue']) && isset($_POST['requestFormType']) ) {
            $sql = "INSERT INTO FarmItem (Name, IsApproved, Type) VALUES ('" . $_POST['requestFormValue'] . "', '0', '" . $_POST['requestFormType'] . "')";
            $result = mysqli_query($db,$sql);
            if($result == true) {
                echo "<script type='text/javascript'>if(!alert(\"Your request is pending admin approval\")) document.location = 'index.php';</script>";
            } else {
                echo "<script type='text/javascript'>if(!alert(\"Error: Could not request: " . $_POST['addName'] . "\")) document.location = 'index.php';</script>";
            }
        }
    }
?>


<?php
    if($_SESSION['user_type'] == 'OWNER') {
        $propertysql = "SELECT * FROM Property WHERE ID = '" . $_GET['id'] . "' AND Owner = '" . $_SESSION['login_user'] . "'";
    } else if($_SESSION['user_type'] == 'ADMIN') {
        $propertysql = "SELECT * FROM Property WHERE ID = '" . $_GET['id'] . "'";
    } else {
        header("Location: index.php");
    }
    $findpropertywithID = mysqli_query($db, $propertysql);
    $foundproperty = mysqli_fetch_array($findpropertywithID);

    $count = mysqli_num_rows($findpropertywithID);

    if($count == 1) {
        $cropsresult = mysqli_query($db, "SELECT * FROM Has WHERE PropertyID = '" . $foundproperty['ID'] . "' AND ItemName NOT IN (SELECT Name FROM FarmItem WHERE Type = 'ANIMAL')");

        $allcropssql = "SELECT * FROM FarmItem WHERE IsApproved = '1' AND Type != 'ANIMAL'";

        $allanimalresult = mysqli_query($db, "SELECT * FROM FarmItem WHERE IsApproved = '1' AND Type = 'ANIMAL'");

        if($foundproperty['PropertyType'] == "GARDEN") {
            $allcropssql = "SELECT * FROM FarmItem WHERE IsApproved = '1' AND (Type = 'VEGETABLE' OR Type = 'FLOWER')";
        } else if($foundproperty['PropertyType'] == "ORCHARD") {
            $allcropssql = "SELECT * FROM FarmItem WHERE IsApproved = '1' AND (Type = 'FRUIT' OR Type = 'NUT')";
        }

        $allcropsresult = mysqli_query($db, $allcropssql);

        if($foundproperty['PropertyType'] == "FARM") {
            $animalresult = mysqli_query($db, "SELECT * FROM Has WHERE PropertyID = '" . $foundproperty['ID'] . "' AND ItemName IN (SELECT Name FROM FarmItem WHERE Type = 'ANIMAL')");
        }

    } else {
       echo "<script type='text/javascript'>if(!alert(\"Could not find property " . $propertysql .  "   \")) document.location = 'index.php';</script>";
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
          <h4>Manage <b><?php echo $foundproperty['Name'];?></b></h4>
        </div> <!-- End Column -->
      </div> <!-- End Row -->

      <form class="form-horizontal" action='manageProperty.php' method='post'>
      <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4 offset-md-2">
                  <label class="col-md-12 control-label" for="propertyName">Property Name*</label>
                  <div class="col-md-12">
                    <input id="propertyName" name="propertyName" type="text" placeholder="Property Name" class="form-control input-md" required="" value="<?php echo $foundproperty['Name'];?>">
                  </div> <br>

                  <label class="col-md-12 control-label" for="address">Address*</label>
                  <div class="col-md-12">
                    <input id="address" name="address" type="text" placeholder="Address" class="form-control input-md" required="" value="<?php echo $foundproperty['Street'];?>">
                  </div> <br>

                  <label class="col-md-12 control-label" for="city">City*</label>
                  <div class="col-md-12">
                    <input id="city" name="city" type="text" placeholder="City" class="form-control input-md" required="" value="<?php echo $foundproperty['City'];?>">
                  </div> <br>


                  <label class="col-md-12 control-label" for="zip">Zip*</label>
                  <div class="col-md-12">
                    <input id="zip" name="zip" type="text" placeholder="Zip" class="form-control input-md" required="" value="<?php echo $foundproperty['Zip'];?>">
                  </div> <br>


                  <label class="col-md-12 control-label" for="size">Size* (acres)</label>
                  <div class="col-md-12">
                    <input id="size" name="size" type="text" placeholder="Size" class="form-control input-md" required="" value="<?php echo $foundproperty['Size'];?>">
                  </div> <br>

                  <label class="col-md-12 control-label" for="type">Type*</label>
                  <div class="col-md-12">
                    <input id="type" name="type" type="text" placeholder="Type" class="form-control input-md" value="<?php echo $foundproperty['PropertyType'];?>" disabled>
                    <input type="hidden" name="type" value="<?php echo $foundproperty['PropertyType'];?>">
                  </div> <br>

                  <label class="col-md-12 control-label" for="public">Public*</label>
                  <div class="col-md-12">
                    <select id="public" name="public" class="form-control">
                      <option value="true">True</option>
                      <option <?php if ($foundproperty['IsPublic'] == '0') {
                          echo "selected =\"selected\"";
                      } ?> value="false">False</option>
                    </select>
                  </div> <br>

                  <label class="col-md-12 control-label" for="commercial">Commercial*</label>
                  <div class="col-md-12">
                    <select id="commercial" name="commercial" class="form-control">
                      <option value="true">True</option>
                      <option <?php if ($foundproperty['IsCommercial'] == '0') {
                          echo "selected =\"selected\"";
                      } ?>value="false">False</option>
                    </select>
                  </div> <br>

                </div> <!-- End Column -->

                <div class="col-md-4">
                    <label class="col-md-12 control-label" for="type">ID</label>
                    <div class="col-md-12">
                      <input id="id" name="id" type="text" placeholder="Type" class="form-control input-md" value="<?php echo $foundproperty['ID'];?>" disabled>
                      <input type="hidden" name="id" value="<?php echo $foundproperty['ID'];?>">
                    </div> <br>

                  <!-- Multiple Checkboxes -->
                  <div class="form-group">
                    <div class="row">
                        <label class="col-md-6 control-label" for="currentCrops">Current Crops*</label>
                        <?php if(isset($animalresult)) { ?>
                            <label class="col-md-6 control-label" for="currentCrops">Current Animals*</label>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6" id="cropsList">
                            <?php
                            $cropCount = 0;
                            while ($row = mysqli_fetch_array($cropsresult)) { ?>
                              <div class="checkbox">
                                <label for="currentCrops">
                                  <input type="checkbox" name="currentCrops<?php echo "[" . $cropCount . "]"; ?>" value="<?php echo $row['ItemName']; ?>" checked="checked">
                                  <?php echo $row['ItemName']; ?>
                                </label>
                              </div>
                            <?php
                                $cropCount++;
                            } ?>
                        </div>

                        <?php if(isset($animalresult)) { ?>
                            <div class="col-md-6" id="animalList">
                                <?php
                                $animalCount = 0;
                                while ($row = mysqli_fetch_array($animalresult)) { ?>
                                  <div class="checkbox">
                                    <label for="currentAnimals">
                                      <input type="checkbox" name="currentAnimals<?php echo "[" . $animalCount . "]"; ?>" value="<?php echo $row['ItemName']; ?>" checked="checked">
                                      <?php echo $row['ItemName']; ?>
                                    </label>
                                  </div>
                                <?php
                                    $animalCount++;
                                } ?>
                            </div>
                        <?php } ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-12 control-label" for="addCrop">Add New Crop</label>

                    <div class="col-md-12 rowspace">
                      <select id="cropSelect" class="form-control">
                          <option value=""></option>
                         <?php while ($row = mysqli_fetch_array($allcropsresult)) { ?>
                            <option value="<?php echo $row['Name']; ?>"><?php echo $row['Name']; ?></option>
                         <?php } ?>
                      </select>
                    </div>
                    <div class="col-md-12">
                      <button id="addCrop" type="button" name="addCrop" onclick="AddCrop()" class="btn btn-primary style-bkg" style="width: 100%;">Add Crop to Property</button>
                    </div>
                  </div> <!-- End form group --> <br>

                    <?php if(isset($animalresult)) { ?>
                      <div class="form-group">
                        <label class="col-md-12 control-label" for="addAnimal">Add New Animal</label>

                        <div class="col-md-12 rowspace">
                          <select id="animalSelect" class="form-control">
                            <option value=""></option>
                             <?php while ($row = mysqli_fetch_array($allanimalresult)) { ?>
                                <option value="<?php echo $row['Name']; ?>"><?php echo $row['Name']; ?></option>
                             <?php } ?>
                          </select>
                        </div>
                        <div class="col-md-12">
                          <button id="addAnimal" type="button" name="addAnimal" onclick="AddAnimal()" class="btn btn-primary style-bkg" style="width: 100%;">Add Animal to Property</button>
                        </div>
                      </div> <!-- End form group --> <br>
                    <?php } ?>

                    <label class="col-md-12 control-label" for="reqCrop">Request Crop Approval</label>

                    <div class="col-md-12 rowspace">
                      <input id="cropRequest" type="text" placeholder="Enter New Crop Name" class="form-control input-md">
                    </div>
                    <div class="col-md-12 rowspace">
                      <select id="cropRequestSelect" class="form-control">
                          <option value=""></option>
                          <option value="ANIMAL">ANIMAL</option>
                          <option value="FRUIT">FRUIT</option>
                          <option value="FLOWER">FLOWER</option>
                          <option value="VEGETABLE">VEGETABLE</option>
                          <option value="NUT">NUT</option>
                         <!-- <?php while ($row = mysqli_fetch_array($allcropsresult)) { ?>
                            <option value="<?php echo $row['Name']; ?>"><?php echo $row['Name']; ?></option>
                         <?php } ?> -->

                      </select>
                    </div>

                    <div class="col-md-12">
                      <button id="cropRequest" type="button" onclick="RequestCrop()" class="btn btn-primary style-bkg" style="width: 100%;">Submit Request</button>
                    </div>
                  <br>

                </div> <!-- End Column -->
              </div> <!-- End Row -->
          </div>

        </div> <!-- End Outer Column -->
            <div class="row">
              <div class="col-md-2 offset-md-3">
                <button id="saveProperty" name="saveProperty" class="btn btn-success style-bkg" style="width: 100%;"><?php if($_SESSION['user_type'] == 'ADMIN' && $foundproperty['ApprovedBy'] == NULL) {
                    echo "Save and Confirm";
                } else {
                    echo "SAVE";
                } ?></button>
              </div>

              <div class="col-md-2">
                <button  type="button" onclick="DeleteProperty()" name="deleteProperty" class="btn btn-danger" style="width: 100%;">Delete Property</button>
              </div>

              <div class="col-md-2">
                <a href="index.php"><div class="btn btn-secondary" style="width: 100%;">Cancel</div></a>
              </div>
            </div> <!-- End Row -->
            <br> <br>
        </form>
  </div> <!-- End Outer Row -->

    </div> <!-- End Container -->
  </section>
  <form action="manageProperty.php" id="deleteform" method="post">
      <input type="hidden" name="delete" value="<?php echo $foundproperty['ID'];?>">
  </form>

  <form action="manageProperty.php" id="requestForm" method="post">
      <input type="hidden" id="requestFormValue" name="requestFormValue" value="">
      <input type="hidden" id="requestFormType" name="requestFormType" value="">
  </form>

  <script>

    function AddCrop() {
            var selectBox = document.getElementById("cropSelect");
            var cropString = selectBox.options[selectBox.selectedIndex].text;
            if(cropString == "") {
                return;
            }
            var numberOfCrops = 0;
            var checkList = document.getElementById("cropsList");
            var checkListChildren = checkList.childNodes;
            for(var i = 0; i < checkListChildren.length; i++) {
                if(checkListChildren[i].childNodes.length == 3) {
                    numberOfCrops++;
                    if(cropString == checkListChildren[i].childNodes[1].children["0"].value) {
                        return;
                    }
                } else if(checkListChildren[i].childNodes.length == 1){
                    numberOfCrops++;
                    if(cropString == checkListChildren[i].childNodes[0].children["0"].value) {
                        return;
                    }
                }
            }

            var div = document.createElement("div");
            div.classList.add("checkbox");
            var label = document.createElement("label");
            var input = document.createElement("input");
            input.type = "checkbox";
            input.name = "currentCrops[" + numberOfCrops + "]";
            input.value = cropString;
            input.checked = "checked";
            label.append(input);
            label.append(" " + cropString);
            div.append(label);
            checkList.append(div)
            console.log(cropString);
    }

    function AddAnimal() {
            var selectBox = document.getElementById("animalSelect");
            var animalString = selectBox.options[selectBox.selectedIndex].text;
            if(animalString == "") {
                return;
            }
            var numberOfAnimals = 0;
            var checkList = document.getElementById("animalList");
            var checkListChildren = checkList.childNodes;
            for(var i = 0; i < checkListChildren.length; i++) {
                if(checkListChildren[i].childNodes.length == 3) {
                    numberOfAnimals++;
                    if(animalString == checkListChildren[i].childNodes[1].children["0"].value) {
                        return;
                    }
                } else if(checkListChildren[i].childNodes.length == 1){
                    numberOfAnimals++;
                    if(animalString == checkListChildren[i].childNodes[0].children["0"].value) {
                        return;
                    }
                }
            }

            var div = document.createElement("div");
            div.classList.add("checkbox");
            var label = document.createElement("label");
            var input = document.createElement("input");
            input.type = "checkbox";
            input.name = "currentAnimals[" + numberOfAnimals + "]";
            input.value = animalString;
            input.checked = "checked";
            label.append(input);
            label.append(" " + animalString);
            div.append(label);
            checkList.append(div)
            console.log(animalString);
    }

    function DeleteProperty() {
        document.getElementById("deleteform").submit();
    }

    function RequestCrop() {
        if(!(document.getElementById("cropRequest").value == "") && !(document.getElementById("cropRequestSelect").value == "")) {
            document.getElementById("requestFormValue").value = document.getElementById("cropRequest").value;
            document.getElementById("requestFormType").value = document.getElementById("cropRequestSelect").value;
            document.getElementById("requestForm").submit();
        }
    }
  </script>
</body>
</html>
