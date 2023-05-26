<!DOCTYPE html>
<html lang="en">
<?php 
    include_once('connect.php');
   
   if(isset($_POST['reset'])){
    $email = $_POST['email'];
    $query = $connect->prepare("SELECT * FROM staff_info WHERE email=:email");
    $query->execute(array(":email"=>$email));
    $num_row = $query->rowcount();
    if($num_row > 0){
      $email = $_POST['email'];
      $password = $_POST['password'];
      $confirmpassword = $_POST['confirmpassword'];
      if($password !== $confirmpassword){
        $message = "<div class='alert alert-danger'>password not match</div>";
      }
      elseif ($password === $confirmpassword) {
        $query = $connect->prepare("UPDATE staff_info SET password=:password, confirmpassword=:confirmpassword WHERE email=:email");
        $query->execute(array(
              "email"=>$email,
              "password" =>$password,
              "confirmpassword" =>$confirmpassword
      
        ));
        $num_row = $query->rowcount();
        if($num_row > 0){
           $message = "<div class='alert alert-success'>password reset successfully</div>";
        }
      }
    }
  
   }
 ?>


 <?php 

    if(isset($_POST['update'])){
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $gender = $_POST['gender'];
    $images = $_FILES['profile']['name'];
    $image_dir = $_FILES['profile']['tmp_name'];
    $imageSize =  $_FILES['profile']['size'];
    $upload_dir = "image_upload/";
    $imgExt = strtolower(pathinfo($images, PATHINFO_EXTENSION));
    $valid_extension = array("jpeg", "png", "gif", "pdf", "jpg");
    $profile = rand(1000, 1000000).".".$imgExt;
    move_uploaded_file($image_dir, $upload_dir.$profile);
    $query = $connect->prepare("UPDATE staff_info SET email=:email, telephone=:telephone, gender=:gender, profile=:profile WHERE email=:email");
    $query->execute(array(
       "email" =>$email,
       "telephone" =>$telephone,
       "gender" =>$gender,
       "profile" =>$profile
 
     ));
    if($query == true){
       $data = "<div class='alert alert-success'>Account updated</div>";
    }

    }
 

  ?>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>fpe - setting</title>

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

    <a class="navbar-brand mr-1" href="index.html">FPE ASSET </a>

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
      <li class="nav-item">
        <a class="nav-link " href="add_asset.php"  >
          <i class="fas fa-fw fa-folder"></i>
          <span>Add asset</span>
        </a>
       
      </li>
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
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

      <li class="nav-item active">
        <a class="nav-link active" href="setting.php">
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
          <li class="breadcrumb-item active">settings</li>
        </ol>

        <!-- Icon Cards-->

       <div class="col-md-12">
         <div class="row">
           <div class="col-md-4">
             <div class="profile-setting  btn-info">
               Profile
             </div>
             <div class="profile-list">
                <input type="text" name="" class="form-control" disabled="true" value="<?php echo $_SESSION['lastname'] ?>">
                <input type="text" name="" class="form-control" disabled="true" value="<?php echo $_SESSION['firstname'] ?>">
                <input type="text" name="" class="form-control" disabled="true" value="<?php echo $_SESSION['email'] ?>">

                <input type="text" name="" class="form-control" disabled="true" value="<?php echo $_SESSION['telephone'] ?>">

                 <input type="text" name="" class="form-control" disabled="true" value="<?php echo $_SESSION['gender'] ?>">
             </div>
           </div>



            <div class="col-md-4">
             <div class="profile-setting btn-success" >
                Update
             </div>
             <div class="mt-2">
               <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" hidden="true" required="true" value="<?php echo $_SESSION['email']; ?>" name="email" placeholder="Enter email" class="form-control">
                </div>


                <div class="form-group">
                    <input type="text" required="true" name="telephone" placeholder="Enter telephone" class="form-control">
                </div>

                <div class="form-group">
                   <select class="form-control" required="true" name="gender">
                     <option>Male</option>
                      <option>Female</option>
                   </select>
                </div>

                <div class="form-group">
                    <input type="file" required="true" name="profile" placeholder="select image" class="form-control">
                </div>

                  <div class="form-group">
                   <button class="btn btn-success btn-block" name="update">Update account</button>
                </div>
                   <?php 
                         if(isset($data)){
                           echo ''.$data.'';
                         }
                    
                 ?>

      



             </form>
             </div>
           </div>



            <div class="col-md-4">
             <div class="profile-setting  btn-primary">
                Security
             </div>
             <div class="mt-2">
               <form method="post">
                  <div class="form-group">
                   <input type="text" required="true" name="email" hidden="true" value="<?php echo $_SESSION['email']; ?>" class="form-control" >
                </div>

                <div class="form-group">
                   <input type="text" required="true" name="password" class="form-control" placeholder="Enter new password">
                </div>

                <div class="form-group">
                   <input type="text" required="true" name="confirmpassword" class="form-control" placeholder="Enter Re-enter new password">
                </div>
                <div class="form-group">
                   <button class="btn btn-primary btn-block" name="reset">Reset password</button>
                </div>
                <?php 
                         if(isset($message)){
                           echo ''.$message.'';
                         }
                    
                 ?>
               </form>
             </div>
           </div>
         </div>
      </div>
     
      
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
        <div class="modal-body">Do you want to logout</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

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
