<!DOCTYPE html>
<html lang="en">
<?php include_once('connect.php'); ?>
<?php 
   $dbconnect = mysqli_connect("localhost", "root", "", "fpeasset");
   if(!$dbconnect){
    die('not connected');
   }
    $dbconnect = mysqli_query($dbconnect, "SELECT * FROM item ");


 ?>
  <?php 

  include_once('connect.php');
  $query = $connect->prepare("SELECT * FROM item");
  $query->execute();
  $num_row = $query->rowcount();
  
  ?>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>fpe - management</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="index.css">


</head>
<style>
  .total_asset{
     font-weight: bold;
     position: relative;
     margin-right: auto;
     display: flex;
     justify-content: flex-end;
  }
</style>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html">fpe asset</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i ><img src="image_upload/<?php echo $_SESSION['profile']; ?>" style="border-radius: 100px; width:40px; height: 40px; border:2px solid green;"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Home</span>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link " href="add_asset.php">
          <i class="fas fa-fw fa-folder"></i>
          <span>Add asset</span>
        </a>
    
      </li>


       <li class="nav-item ">
        <a class="nav-link" href="add_user.php">
          <i class="fas fa-fw fa-folder"></i>
          <span>Add admin</span>
        </a>
    
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="management.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Management</span></a>
      </li>

       <li class="nav-item">
        <a class="nav-link" href="track_record.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Track Record</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="setting.php">
          <i class="fas fa-fw fa-cog"></i>
          <span>Setting</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">management</li>
        </ol>

        <div class="mt-4">
           <button class="btn btn-primary">   <i class="fas fa-fw fa-pen"></i>Report</button>
           
        </div>

        <!-- DataTables Example -->
         <div class="total_asset">Total asset: <?php echo $num_row; ?></div>
        <div class="card mb-3 mt-2">
          <div class="card-header">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Number</th>
                    <th>Brand</th>
                    <th>Catergory</th>
                    <th>Location</th>
                    <th>Amount</th>
                    <th>Warranty</th>
                    <th>Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                
                <tbody>
                    <?php 
                      while ($row = mysqli_fetch_array($dbconnect)) {
                    
                     ?>
                  <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['item_name'] ?></td>
                    <td><?php echo $row['item_number'] ?></td>    
                    <td><?php echo $row['item_brand'] ?></td>
                    <td><?php echo $row['item_catergory'] ?></td>

                    <td><?php echo $row['item_location'] ?></td>
                    <td><?php echo $row['item_amount'] ?></td>
                    <td><?php echo $row['warranty'] ?></td>
                    <td><?php echo $row['item_date'] ?></td>
                    <td>
                      <a href="Record_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary" >Details</a>
                    </td>



                
                  </tr>

                     <?php } ?>

                </tbody>
              </table>
            </div>
          </div>

        </div>


      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>HC20200102283 Odion Goodnews Osaze</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"> you are ready to logout.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- edit asset -->

    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit asset</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Edit <?php echo $row['item_name']; ?>  </div>
        
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
