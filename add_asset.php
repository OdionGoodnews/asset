<!DOCTYPE html>
<html lang="en">

   <?php
   include_once('connect.php');
   if(isset($_POST['proceed'])){
       $item_name = $_POST['item_name'];
       $item_number = $_POST['item_number'];
       $item_brand = $_POST['item_brand'];
       $item_catergory = $_POST['item_catergory'];
       $item_location = $_POST['item_location'];
       $item_amount = $_POST['item_amount'];
       $warranty = $_POST['warranty'];
       $item_date = $_POST['item_date'];
       $description = $_POST['description'];
        $enrol_user = $_POST['enrol_user'];
        $images = $_FILES['item_img']['name'];
        $image_dir = $_FILES['item_img']['tmp_name'];
        $imageSize =  $_FILES['item_img']['size'];
        $upload_dir = "upload_asset/";
        $imgExt = strtolower(pathinfo($images, PATHINFO_EXTENSION));
        $valid_extension = array("jpeg", "png", "gif", "pdf", "jpg");
        $item_img = rand(1000, 1000000).".".$imgExt;
        move_uploaded_file($image_dir, $upload_dir.$item_img);
       $query = $connect->prepare("INSERT INTO item(item_name, item_number, item_brand, item_catergory, item_location, item_amount, warranty, item_date, item_img, description, enrol_user) VALUES('$item_name', '$item_number', '$item_brand', '$item_catergory', '$item_location', '$item_amount', '$warranty', '$item_date', '$item_img', '$description', '$enrol_user')");
       $query->execute(array(
           "item_name" =>$item_name,
           "item_number"=>$item_number,
           "item_brand"=>$item_brand,
           "item_catergory"=>$item_catergory,
           "item_location"=>$item_location,
           "item_amount"=>$item_amount,
           "warranty"=>$warranty,
           "item_date"=>$item_date,
           "item_img" =>$item_img,
           "description" =>$description,
           "enrol_user" =>$enrol_user
         
        ));
       $num_row = $query->rowcount();
       if($num_row > 0){
          $data = "Asset save successfully";
       }
       else{
         $data = "something is wrong";
       }
       
    
   } 
      

    ?>
<head>
  

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>fpe - Add asset</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

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
      <li class="nav-item dropdown active">
        <a class="nav-link active" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Add asset</span>
        </a>
       
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add_user.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Add admin</span></a>
      </li>

       <li class="nav-item">
        <a class="nav-link" href="track_record.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Track Record</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="management.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Management</span></a>
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
          <li class="breadcrumb-item active">Add asset</li>
        </ol>

     
    <div class="card">
      <?php 

          if(isset($data)){
             echo '<div class="alert alert-success text-center">'.$data.'</div>';
          }
       ?>

      <div class="card-body">
        <form method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-6">
            	<div class="form-group">
              <input type="text"  name="item_name"  class="form-control" placeholder="Item name" required="required" autofocus="autofocus">
             
          </div>
            </div>

              <div class="col-md-6">
            	<div class="form-group">
              <input type="text"  name="item_number" class="form-control" placeholder="Item number" required="required" autofocus="autofocus">
            
          </div>
            </div>
            
             <div class="col-md-6">
            	<div class="form-group">
              <input type="text"  name="item_brand" class="form-control" placeholder="Item Brand" required="required" autofocus="autofocus">
              
          </div>
            </div>

              <div class="col-md-6">
            	<div class="form-group">
              <input type="text"  name="item_catergory" class="form-control" placeholder="Item catergory" required="required" autofocus="autofocus">
             
          </div>
            </div>

             <div class="col-md-6">
            	<div class="form-group">
              <input type="text"  name="item_location" class="form-control" placeholder="Location" required="required" autofocus="autofocus">
             
          </div>
            </div>

              <div class="col-md-6">
            	<div class="form-group">
              <input type="text"  name="item_amount" class="form-control" placeholder="Purchase amount" required="required" autofocus="autofocus">
             
          </div>
            </div>


             <div class="col-md-6">
            	<div class="form-group">
              <input type="text"  name="warranty" class="form-control" placeholder="Warranty" required="required" autofocus="autofocus">
            
            
          </div>
            </div>

            <div class="col-md-6">
            	<div class="form-group">
              <input type="date"  name="item_date" class="form-control" placeholder="Date of purchase" required="required" autofocus="autofocus">
            
          </div>
            </div>


          <div class="col-md-12">
                  <div class="form-group">
              <input type="file"  name="item_img" class="form-control"  required="required" autofocus="autofocus">
          </div>
              <div class="form-group">
              <input type="text"  class="form-control" name="description" placeholder="Item description" required="required" autofocus="autofocus">
             
          </div>
          <input type="hidden" name="enrol_user" value="<?php echo $_SESSION['email']; ?>">
            </div>

          </div>
           <div class="form-group">
            	<button class="btn btn-success"  name="proceed">Save asset</button>
            </div>

  
        </form>
        
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
          <a class="btn btn-primary" href="login.html">Logout</a>
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
