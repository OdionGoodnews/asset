<!DOCTYPE html>
<html lang="en">
  <?php 
    $id = "";
    $num_row = "";
    $item_name = "";
     include_once('connect.php');
    if(isset($_POST['track'])){
      $id = $_POST['id'];
      $query = $connect->prepare("SELECT * FROM item WHERE id=:id ORDER BY id ");
      $query->execute(array(
          "id"=>$id
      ));
       $num_row = $query->rowcount();
      if($num_row > 0){
         foreach ($query as $row) {
           $id = $row['id'];
           $item_name = $row['item_name'];
           $item_number = $row['item_number'];
           $item_brand = $row['item_brand'];
           $item_catergory = $row['item_catergory'];
           $item_location = $row['item_location'];
           $item_amount = $row['item_amount'];
         }
      }
      else{
         $message = "<div class='alert alert-danger'>No Record found</div>";
      }
      
    }



   ?>

    
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>fpe - Track asset</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="index.css">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html">FPE ASSET</a>

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
      
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="badge badge-danger"></span>
        </a>
      
      </li>
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
      <li class="nav-item dropdown">
        <a class="nav-link active" href="add_asset.php"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Add asset</span>
        </a>
       
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Add admin</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="management.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Management</span></a>
      </li>



       <li class="nav-item">
        <a class="nav-link" href="track_record.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Track Record</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="setting.php">
          <i class="fas fa-fw fa-table"></i>
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
          <li class="breadcrumb-item active">Track asset</li>
        </ol>

     
    <div class="card">
      <?php 

          if(isset($data)){
             echo '<div class="alert alert-success text-center">'.$data.'</div>';
          }
       ?>
      <div class="card-body">
         <?php if(isset($message)){
                 echo ''.$message.'';
              }


               ?>
          <?php if($num_row == 0) { ?>
             <form method="post">
             
            <div class="col-md-6">
            <div class="form-group">
              <input type="text"  name="id"  class="form-control" placeholder="Enter item Id">
            </div>
         
            <div class="form-group">
              <button class="btn btn-primary" name="track">Track asset</button>
            </div>
            </div>
          <p>
           
  
        </form>
          <?php 
        }
        elseif ($num_row > 0) {
        echo '<div class="track_item">' .$item_name.'</div>';
        echo '<div class="track_item">'.$item_number.'</div>';
        echo '<div class="track_item">'.$item_brand.'</div>';
        echo '<div class="track_item">'.$item_catergory.'</div>';
        echo '<div class="track_item">'.$item_location.'</div>';
        echo '<div class="track_item">'.$item_amount.'</div>';
        

        }


               
            
      ?>



          </p>
        
      </div>
    </div>
  </div>

  


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
        <div class="modal-body">Do you want to logout</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>


  <!-- save asset record -->

  <div class="modal fade" id="Proceed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Enter staff Id</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <input type="text" name="" class="form-control" placeholder="Staff Id..." >
            </div>
            <div class="form-group">
              <button class="btn btn-success">Save asset</button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>
  <!-- \end save asset record -->

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
