<?php
   include("config.php");
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {

      $sql = "INSERT INTO User (Username, Email, Password, UserType) VALUES ('" . $_POST['username'] . "', '" . $_POST['email'] . "', '" . md5($_POST['password']) . "', 'OWNER' )";
      $result = mysqli_query($db,$sql);

      if($result) {
          $ispublic = ($_POST['public'] == "true");
          $iscommercial = ($_POST['commercial'] == "true");

          $nextIDresult = mysqli_query($db, "SELECT MAX(ID) FROM Property");
          $nextIDrow = mysqli_fetch_array($nextIDresult);
          $nextID = $nextIDrow['MAX(ID)'] + 1;

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
          '" . $_POST['username'] . "')";

          $resultproperty = mysqli_query($db,$sql);

          if($resultproperty) {
              $resultanimals = true;

              if($_POST['type'] == "farm") {
                  $animalsql = "INSERT INTO Has (PropertyID, ItemName) VALUES ('" . $nextID . "','" . $_POST['animal'] . "')";
                  $resulttwo = mysqli_query($db, $animalsql);
              }

              $cropsql = "INSERT INTO Has (PropertyID, ItemName) VALUES ('" . $nextID . "','" . $_POST['crop'] . "')";
              $resultcrops = mysqli_query($db, $cropsql);

              if($resultanimals && $resultcrops) {
                 $_SESSION['login_user'] = $_POST['username'];
                 $_SESSION['user_type'] = 'OWNER';
                 header("Location: ownerDashboard.php");
              } else {
                 $_SESSION['login_user'] = $_POST['username'];
                 $_SESSION['user_type'] = 'OWNER';
                 echo "<script type='text/javascript'>if(!alert('There was an error adding items')) document.location = 'ownerDashboard.php';</script>";

              }
          } else {
              $_SESSION['login_user'] = $_POST['username'];
              $_SESSION['user_type'] = 'OWNER';
              echo "<script type='text/javascript'>if(!alert('There was an error adding the property, user has been created without a property')) document.location = 'ownerDashboard.php';</script>";
          }
      } else {
          echo "<script type='text/javascript'>alert('Could not create the user (username already taken)');</script>";
      }
   }
?>

<?php
        $allGARDENcropsresult = mysqli_query($db,"SELECT * FROM FarmItem WHERE IsApproved = '1' AND (Type = 'VEGETABLE' OR Type = 'FLOWER')");
        $allORCHARDcropsresult = mysqli_query($db,"SELECT * FROM FarmItem WHERE IsApproved = '1' AND (Type = 'FRUIT' OR Type = 'NUT')");
        $allanimalresult = mysqli_query($db, "SELECT * FROM FarmItem WHERE IsApproved = '1' AND Type = 'ANIMAL'");
?>

<!DOCTYPE html>
<html lang="en">

<?php include("head.php"); ?>

<body>

  <?php include("loginNavbar.php"); ?>

  <!--==========================
    Main Section
    ============================-->
    <section id="hero">
      <div class="hero-container">
       <!--  <h1>Welcome</h1> -->
       <h2>Atlanta Gardens, Farms, and Orchards</h2>

       <div class="card">
        <div class="card-body">
          <form class="form-horizontal" action='newOwnerReg.php' name="newOwnerForm" id="newOwnerForm" method='post'>

              <!-- Form Name -->
              <legend>New Owner Registration</legend>
              <br>

              <div class="row rowspace">
                <!-- Text input-->
                <div class="col-md-4">
                  <input id="email" name="email" type="text" placeholder="Email" class="form-control input-md" required="">
                </div>

                <div class="col-md-4">
                  <input id="password" name="password" type="password" placeholder="Password" class="form-control input-md" required="">
                </div>

                <div class="col-md-4">
                  <input id="confirmpassword" name="confirmpassword" type="password" placeholder="Confirm Password" class="form-control input-md" required="">
                </div>

              </div> <!-- End Row -->





              <div class="row rowspace">

                <!-- Text input-->
                <div class="col-md-4">
                  <input id="username" name="username" type="text" placeholder="Username" class="form-control input-md" required="">
                </div>

                <div class="col-md-4">
                  <input id="propertyName" name="propertyName" type="text" placeholder="Property Name" class="form-control input-md" required="">
                </div>

                <div class="col-md-4">
                  <input id="streetAddress" name="streetAddress" type="text" placeholder="Street Address" class="form-control input-md" required="">
                </div>
              </div> <!-- End Row-->


              <div class="row rowspace">
                <div class="col-md-4">
                  <input id="city" name="city" type="text" placeholder="City" class="form-control input-md" required="">
                </div>
                <div class="col-md-4">
                  <input id="zip" name="zip" type="text" placeholder="Zip" class="form-control input-md" required="">
                </div>
                <div class="col-md-4">
                  <input id="size" name="size" type="text" placeholder="Acres" class="form-control input-md" required="">
                </div>
              </div> <!-- End Row -->

              <div class="row rowspace">
                <div class="col-md-4">
                  <select id="propertyType" name="type" onchange="FarmTypeChanged()" class="form-control">
                    <option value="">Property Type</option>
                    <option value="farm">Farm</option>
                    <option value="garden">Garden</option>
                    <option value="orchard">Orchard</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <select id="animalSelect" name="animal" class="form-control" hidden="true">
                    <option value="">Animal</option>
                    <?php while ($row = mysqli_fetch_array($allanimalresult)) { ?>
                       <option value="<?php echo $row['Name']; ?>"><?php echo $row['Name']; ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="col-md-4">
                  <select id="cropSelect" name="crop" class="form-control">
                    <option value="">Crop</option>
                    <?php while ($row = mysqli_fetch_array($allGARDENcropsresult)) { ?>
                       <option class="allGardenCrops" value="<?php echo $row['Name']; ?>"><?php echo $row['Name']; ?></option>
                    <?php } ?>
                    <?php while ($row = mysqli_fetch_array($allORCHARDcropsresult)) { ?>
                       <option class="allOrchardCrops" value="<?php echo $row['Name']; ?>"><?php echo $row['Name']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="row rowspace">

                <div class="col-md-4">
                  <select id="public" name="public" class="form-control">
                    <option value="">Public?</option>
                    <option value="true">Yes</option>
                    <option value="false">No</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <select id="commercial" name="commercial" class="form-control">
                    <option value="">Commercial?</option>
                    <option value="true">Yes</option>
                    <option value="false">No</option>
                  </select>
                </div>

              </div>

              <br>
              <div class="row">

               <!-- Registration Links -->
               <div class="col-md-3">
                <a class="btn btn-success style-bkg" href="index.php">Back</a> <br>
              </div>


              <!-- Submit Button -->
              <div class="col-md-6">
               <input class="btn-get-started2" onclick="RegisterUser()" type="button" value="Create Account">
             </div>


           </div> <!-- End Row -->
       </form> <!-- End Form -->


     </div> <!-- End Card Body -->
   </div> <!-- End Card -->


 </div>
</section>
<script>
    function RegisterUser() {
        console.log("clicked button")
        if(!validateForm()) {
            console.log("form invalid")
            return false;
        }

        if(document.getElementById("propertyName").value == "" ||
           document.getElementById("streetAddress").value == "" ||
           document.getElementById("city").value == "" ||
           document.getElementById("zip").value == "" ||
           document.getElementById("size").value == "") {
               alert("Error: Please fill in all boxes");
               return false;
           }





        var propertySelect = document.getElementById("propertyType");
        if(propertySelect.options[propertySelect.selectedIndex].text == "Property Type") {
            alert("You must select a property type");
            return false;
        } else if (propertySelect.options[propertySelect.selectedIndex].text == "Farm") {
            var animalSelect = document.getElementById("animalSelect");
            if(animalSelect.options[animalSelect.selectedIndex].text == "Animal") {
                alert("You must select an animal");
                return false;
            }
        }

        var cropSelect = document.getElementById("cropSelect");
        if(cropSelect.options[cropSelect.selectedIndex].text == "Crop") {
            alert("You must select a crop");
            return false;
        }

        var public = document.getElementById("public");
        if(public.options[public.selectedIndex].text == "Public?") {
            alert("You must change the public parameter.");
            return false;
        }

        var commercial = document.getElementById("commercial");
        if(commercial.options[commercial.selectedIndex].text == "Commercial?") {
            alert("You must change the commercial parameter.");
            return false;
        }
        console.log("create owner")
        document.getElementById("newOwnerForm").submit();
    }

    function FarmTypeChanged() {
        var propertySelect = document.getElementById("propertyType");
        var animalSelect = document.getElementById("animalSelect");
        var cropSelect = document.getElementById("cropSelect");
        var allgardenOptions = document.getElementsByClassName("allGardenCrops");
        var allorchardOptions = document.getElementsByClassName("allOrchardCrops");

        cropSelect.selectedIndex = 0;
        animalSelect.selectedIndex = 0;
        if(propertySelect.options[propertySelect.selectedIndex].text == "Farm") {
            for(var i = 0; i < allorchardOptions.length; i++) {
                allorchardOptions[i].hidden = false;
            }
            for(var i = 0; i < allgardenOptions.length; i++) {
                allgardenOptions[i].hidden = false;
            }
            animalSelect.hidden = false;
        } else if(propertySelect.options[propertySelect.selectedIndex].text == "Garden") {
            for(var i = 0; i < allorchardOptions.length; i++) {
                allorchardOptions[i].hidden = true;
            }
            for(var i = 0; i < allgardenOptions.length; i++) {
                allgardenOptions[i].hidden = false;
            }
            animalSelect.hidden = true;
        } else if(propertySelect.options[propertySelect.selectedIndex].text == "Orchard") {
            for(var i = 0; i < allorchardOptions.length; i++) {
                allorchardOptions[i].hidden = false;
            }
            for(var i = 0; i < allgardenOptions.length; i++) {
                allgardenOptions[i].hidden = true;
            }
            animalSelect.hidden = true;
        }
    }

    function validateForm() {
        var x = document.forms["newOwnerForm"]["password"].value;
        var y = document.forms["newOwnerForm"]["confirmpassword"].value;

        if (x != y) {
            alert("Passwords must match");
            return false;
        }

        if (x.length < 8) {
            alert("Passwords must have at least 8 characters");
            return false;
        }

        var email = document.forms["newOwnerForm"]["email"].value;
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(!re.test(String(email).toLowerCase())) {
            alert("Email must be a valid email address");
            return false;
        }

        var username = document.forms["newOwnerForm"]["username"].value;
        if(username == "") {
            alert("Username cannot be empty");
            return false;
        }

        return true;

    }

    FarmTypeChanged();
</script>
</body>
</html>
