<?php include('session.php'); ?>
<?php
if($_SESSION['user_type'] != "ADMIN") {
  header("Location: index.php");
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
                  <th scope="col">Logged Visits</th>
                </tr>
              </thead>
              <tbody>
               <tr>
                <td class="link-color"><a>Delete</a></td>
                <td>Kdog99</td>
                <td>Kdog99@Gmail.com</td>
                <td>69</td>
              </tr>
              <tr>
                <td class="link-color"><a>Delete</a></td>
                <td>Kdog99</td>
                <td>Kdog99@Gmail.com</td>
                <td>69</td>
              </tr>

              <tr>
                <td class="link-color"><a>Delete</a></td>
                <td>Kdog99</td>
                <td>Kdog99@Gmail.com</td>
                <td>69</td>
              </tr>

            </tbody>
          </table>
        </div> <!-- End Property Table Wrapper -->


      </div> <!-- End Column -->
    </div> <!-- End Row -->

  </div> <!-- End Container -->
</section>

</body>
</html>
