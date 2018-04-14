<?php include('session.php'); ?>
<?php
if($_SESSION['user_type'] != "OWNER") {
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include("config.php"); ?>

<?php include("head.php"); ?>
<?php include("propertyDetailsModal.php"); ?>

<body>

  <?php include("ownerNavbar.php"); ?>

  <section>
    <div class="container">

      <div class="row text-center title-space">
        <div class="col-md-12">
          <h4>Property Details</h4>
          <br>
        </div>
      </div> <!-- End Row -->

      <div class ="row">
        <div class = "col-md-6 offset-md-3">

         <table class="table table-condensed">
          <thead>

          </thead>
          <tbody>
            <tr>
              <th>Name</th>
              <td>Kenari Company Farm</td>
            </tr>
            <tr>
              <th>Owner</th>
              <td>ALFI</td>
            </tr>
            <tr>
              <th>Owner Email</th>
              <td>Dalfi@gmail.com</td>
            </tr>
            <tr>
              <th>Visits</th>
              <td>5</td>
            </tr>
            <tr>
              <th>Address</th>
              <td>Highertower Road</td>
            </tr>
            <tr>
              <th>City</th>
              <td>Roswell</td>
            </tr>
            <tr>
              <th>Zip</th>
              <td>30076</td>
            </tr>
            <tr>
              <th>Size (acres)</th>
              <td>10</td>
            </tr>
            <tr>
              <th>Avg Rating</th>
              <td>2.7</td>
            </tr>
            <tr>
              <th>Type</th>
              <td>Farm</td>
            </tr>
            <tr>
              <th>Public</th>
              <td>True</td>
            </tr>
            <tr>
              <th>Commercial</th>
              <td>True</td>
            </tr>
            <tr>
              <th>ID</th>
              <td>00237</td>
            </tr>
            <tr>
              <th>Crops</th>
              <td>Corn, Celery</td>
            </tr>
            <tr>
              <th>Animals</th>
              <td>Chicken</td>
            </tr>
          </tbody>
        </table>
<br> 
               <div class="col-md-4 offset-md-4">
                  <a href="ownerDashboard.php"><button class="btn btn-secondary" style="width: 100%;">&#x2190 Back</button></a>
                </div>
<br> <br>

      </div> <!-- End Column -->
    </div> <!-- End Row -->


  </div> <!-- End Container -->
</section>

</body>
</html>
