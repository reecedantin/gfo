  <!--==========================
  Navbar for Property Owners
  ============================-->
  <header id="header" class="background-Header">
    <div class="container">

      <div id="logo" class="pull-left">
        <h3><a href="index.php" class="nav-title"><img src="img/favicon.png" style="margin-right: 10px; margin-top: -8px;" class="logo-style">ATL GFO</a></h3>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <!-- class="menu-active" puts a green line under the active page, needs to be implemented -->
          <?php
            if($_SESSION['user_type'] == "OWNER") { ?>
                <li><a href="ownerDashboard.php">Your Properties</a></li>
                <li><a href="addProperty.php">Add Property</a></li>
                <li><a href="viewOtherProperties.php">Other Properties</a></li>

            <?php } else if($_SESSION['user_type'] == "ADMIN") { ?>
                <li><a href="adminDashboard.php">Confirmed Prop.</a></li>
                <li><a href="unconfirmedProperties.php">Unconfirmed Prop.</a></li>
                <li><a href="visitorList.php">Vistor List</a></li>
                <li><a href="ownerList.php">Owner List</a></li>
                <li><a href="approvedEntities.php">Approved Entities</a></li>
                <li><a href="pendingEntities.php">Pending Entities</a></li>

            <?php } else if($_SESSION['user_type'] == "VISITOR") { ?>
                <li><a href="visitorDashboard.php">Browse Properties</a></li>
                <li><a href="visitHistory.php">Visit History</a></li>

            <?php } ?>

            <li><a href="logout.php">LogOut</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!-- Adjust for Navbar Space -->
      <br> <br> <br> <br>
