<!DOCTYPE html>
<html lang="en">

<?php include("head.php"); ?>
<?php include("propertyDetailsModal.php"); ?>
<?php include("config.php"); ?>

<body>

  <?php include("visitorNavbar.php"); ?>

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
               <tr>
                 <td data-toggle="modal" data-target="#propertyDetails" class="link-color">Georgia Tech Garden</td>
                 <td>2018-01-21</td>
                 <td>5</td>
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
