<!DOCTYPE html>
<html lang="en">
<?php 
  include_once('connect.php');
  if(isset($_POST['register'])){
    $email = $_POST['email'];
    $query = $connect->prepare("SELECT * FROM staff_info WHERE email=:email");
    $query->execute(array(
     "email" =>$email
    ));
    $num_row = $query->rowcount();
    if($num_row > 0){
      $data = "<div class='alert alert-danger'>This account already exist</div>";
    }
    else{
     $firstname = $_POST['firstname'];
     $lastname = $_POST['lastname'];
     $email = $_POST['email'];
     $telephone = $_POST['telephone'];
     $gender = $_POST['gender'];
     $password = $_POST['password'];
     $confirmpassword = $_POST['confirmpassword'];
    $images = $_FILES['profile']['name'];
    $image_dir = $_FILES['profile']['tmp_name'];
    $imageSize =  $_FILES['profile']['size'];
    $upload_dir = "image_upload/";
    $imgExt = strtolower(pathinfo($images, PATHINFO_EXTENSION));
    $valid_extension = array("jpeg", "png", "gif", "pdf", "jpg");
    $profile = rand(1000, 1000000).".".$imgExt;
    move_uploaded_file($image_dir, $upload_dir.$profile);
     if($password !== $confirmpassword){
        $data = "<div class='alert alert-danger'>password does not match</div>";
     }   elseif ($password === $confirmpassword) {
         $query = $connect->prepare("INSERT INTO staff_info (firstname, lastname, email, telephone, gender, password, confirmpassword, profile) VALUES('$firstname', '$lastname', '$email', '$telephone', '$gender', '$password', '$confirmpassword', '$profile')");
         $query->execute(array(
             "firstname" =>$firstname,
             "lastname" =>$lastname,
             "email" =>$email,
             'telephone' =>$telephone,
             'gender' =>$gender,
             "password" =>$password,
             "confirmpassword" =>$confirmpassword,
             "profile" =>$profile
         ));
         $num_row = $query->rowcount();
         if($num_row > 0){
          $data = "<div class='alert alert-success'>User add successfully</div>";
         }
        
       
     }
  
    }
  }



  ?>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>fpe - add admin</title>

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


       <li class="nav-item active ">
        <a class="nav-link  ">
          <i class="fas fa-fw fa-folder"></i>
          <span>Add admin</span>
        </a>
    
      </li>

      <li class="nav-item ">
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
          <li class="breadcrumb-item active">
            Add user
          </li>
        </ol>


        <!-- DataTables Example -->
        
        <div class="card mb-3 mt-2">
          <div class="card-header">
          <div class="card-body">
               <form method="post" enctype="multipart/form-data">
           <?php 
                 if(isset($data)){
                   echo ''.$data.'';
                 }
               
            ?>
         
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                  <input type="text" id="firstName" name="firstname" class="form-control" placeholder="First name" required="required" autofocus="autofocus">
                 
              </div>
              <div class="col-md-6">
                  <input type="text" id="lastName" name="lastname" class="form-control" placeholder="Last name" required="required">
                 
              </div>
            </div>
          </div>
          <div class="form-group">
              <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required="required">
              
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                  <input type="text" id="inputPassword" name="telephone" class="form-control" placeholder="Telephone" required="required">
                
              </div>
              <div class="col-md-6">
                  <input type="text" id="gender" name="gender" class="form-control" placeholder="Gender" required="required">
                 
              </div>

                <div class="col-md-6 mt-3">
           
                  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="required">
                 
              </div>
              <div class="col-md-6 mt-3">
                  <input type="password" id="confirmPassword" name="confirmpassword" class="form-control" placeholder="Confirm password" required="required">
                
                </div>
              </div>
              <div class=" mt-3">
                <input type="file"  name="profile" class="form-control" >
              </div>

            </div>
          </div>
            <div class="col-md-12">
                     <button class="btn btn-primary " name="register">Register</button>
            </div>
        </form>
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
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
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
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
