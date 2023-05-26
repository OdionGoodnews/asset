<!DOCTYPE html>
<html lang="en">
  <?php 
   include_once('connect.php');
    if(isset($_POST['handleUpdate'])){
       $id = $_POST['id'];
     $item_name = $_POST['item_name'];
     $item_number = $_POST['item_number'];
     $item_brand = $_POST['item_brand'];
     $item_catergory = $_POST['item_catergory'];
     $item_location = $_POST['item_location'];
     $item_amount = $_POST['item_amount'];
     $item_date = $_POST['item_date'];
     $warranty = $_POST['warranty'];
     $query = $connect->prepare("UPDATE item SET item_name=:item_name, item_number=:item_number, item_brand=:item_brand, item_catergory=:item_catergory, item_location=:item_location, item_amount=:item_amount, item_date=:item_date, warranty=:warranty WHERE id=:id");
     $query->execute(array(
        "id"=>$id,
        "item_name" =>$item_name,
        "item_number" =>$item_number,
        "item_brand"=>$item_brand,
        "item_catergory" =>$item_catergory,
        "item_location" =>$item_location,
        "item_amount" =>$item_amount,
        "item_date" =>$item_date,
        "warranty" =>$warranty,
        
       
     ));
     $num_row = $query->rowcount();
     if($num_row > 0){
       $data = "updated successfully";
     }

    }


   ?>
  <?php 
     include_once('connect.php');
      $id = $_GET['id'];
      $query = $connect->prepare("SELECT * FROM item WHERE id=:id");
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
           $item_date = $row['item_date'];
           $warranty = $row['warranty'];
           $item_img = $row['item_img'];
         
         }
      }
      
   ?>

   <?php 
      if(isset($_POST['handleDelete'])){
        $id = $_POST['id'];
        $query = $connect->prepare("DELETE FROM item WHERE id=:id");
        $query->execute(array(":id" =>$id));
        $num = $query->rowcount();
        if($num > 0){
           header("location:management.php");
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
<style>
  .form-control{
    margin: 10px 0px;
  }
  .img-border{
    border: 1px solid lightgray;
    height: 250px;
    position: relative;
    top: 14px;
    border-radius: 10px;

  }
  .img_item{
    height: 250px;
    width: 100%;
    border-radius: 10px;
  }
  .btn-form{
    display: flex;
    justify-content: flex-end;
    align-self: center;
    position: relative;
    bottom: 50px;

  }
  .btn-form > button:nth-child(1){
   position: relative;
   right: 20px;
  }
</style>

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

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Details</li>
        </ol>

     
    <div class="card">
      <div class="container mt-4">
        <form method="post" enctype="multipart/form-data">
        <?php 
           if (isset($data)) {
             echo '<div class="alert alert-success">'.$data.'</div>';
           }
         ?>
          <div class="row">
          <div class="col-md-6">

          <div class="form-group">
          <input type="text" name="id" value="<?php echo $id ?>" class="form-control">
          </div>


        <div class="form-group">
          <input type="text" name="item_name" value="<?php echo $item_name ?>" class="form-control">
        </div>


        <div class="form-group">
          <input type="text" name="item_number" value="<?php echo $item_number ?>" class="form-control">
        </div>

        <div class="form-group">
          <input type="text" name="item_brand" value="<?php echo $item_brand ?>" class="form-control">
        </div>

    
        <div class="form-group">
          <input type="text" name="item_location" value="<?php echo $item_location ?>" class="form-control">
        </div>

        <div class="form-group">
          <input type="text" name="item_catergory" value="<?php echo $item_catergory ?>" class="form-control">
        </div>

        <div class="form-group">
          <input type="text" name="item_amount" value="<?php echo $item_amount ?>" class="form-control">
        </div>

        <div class="form-group">
          <input type="text" name="item_date" value="<?php echo $item_date ?>" class="form-control">
        </div>
          </div>

          <div class="col-md-6">
                <div class="img-border">
                   <div>
                      <img src="upload_asset/<?php echo $item_img?>" class="img_item">
                   </div>
                </div>
          <div class="mt-5">

        <div class="form-group">
        <input type="text" name="warranty" value="<?php echo $warranty ?>" class="form-control">
        </div>

          </div>
          </div>
        </div>

          <div class="btn-form"> 
              <button class="btn btn-success" name="handleUpdate">Update</button>
        </form>
        <button class="btn btn-danger" name="handleDelete">Delete</button>
          </div>

      </div>
    <div class="card-body">
       
        
      </div>
    </div>
  </div>

  


     <!--  <footer class="sticky-footer">
        
      </footer> -->

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
