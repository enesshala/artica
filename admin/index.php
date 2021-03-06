<?php

include 'database/dbconfig.php';



include 'inc/header.php';
include 'inc/navbar.php';


function rowCount($connection, $query)
{
  $stmt = $connection->prepare($query);
  $stmt->execute();
  return $stmt->rowCount();
}

?>


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Users</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

                <h4>Total Users: <?php echo rowCount($connection, "SELECT * FROM users "); ?></h4>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-600"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Administrators</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <h4>Total Admins: <?php echo rowCount($connection, "SELECT * FROM users WHERE status = 'admin'"); ?></h4>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users-cog fa-2x text-gray-600"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Administrators</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <h4>Total Posts: <?php echo rowCount($connection, "SELECT * FROM posts"); ?></h4>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users-cog fa-2x text-gray-600"></i>
            </div>
          </div>
        </div>
      </div>
    </div>



    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-600"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Content Row -->

<?php
include('inc/scripts.php');
include('inc/footer.php');
?>