<?php include("session.php") ?>
<!DOCTYPE html>
<html lang="en">

<?php include("head.php"); ?>
<?php include("config.php"); ?>

<body>

  <?php include("navbar.php"); ?>

  <section>
    <div class="container">

      <div class="row text-center title-space">
        <div class="col-md-12">
          <h4>Your Visit History</b></h4>
        </div>
      </div> <!-- End Row -->


      <br>

      <div class ="row">
        <div class = "col-md-6 offset-md-3">

          <div class="property-table">
            <table class="table table-striped table-sm">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Date Logged</th>
                  <th scope="col">Rating</th>
                </tr>
              </thead>
              <tbody>
              <?php
                 $result = mysqli_query($db, "SELECT * FROM Visit INNER JOIN Property ON Visit.PropertyID = Property.ID WHERE Username = '" . $_SESSION['login_user'] . "'");
                 while ($row = mysqli_fetch_array($result)) {?>
                   <tr>
                     <td class="link-color"><a href=<?php echo "propertyDetails.php?id=" . $row['PropertyID'] . "&date=" . $row["VisitDate"];?>><?php echo $row['Name'];?></a></td>
                     <td><?php echo $row['VisitDate'];?></td>
                     <td><?php echo $row['Rating'];?></td>
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
