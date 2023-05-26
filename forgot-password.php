<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Fpe asset - Forgot Password</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>
 <?php 
     include_once('connect.php');
     if(isset($_POST['forgotten_password'])){
      $email = $_POST['email'];
      $query = $connect->prepare("SELECT * FROM staff_info WHERE email=:email");
      $query->execute(array(
           "email"=>$email
      ));
      $num_row = $query->rowcount();
      if($num_row > 0){
         $email = $_POST['email'];
         $password = $_POST['password'];
         $confirmpassword = $_POST['confirmpassword'];
         if($password !== $confirmpassword){
           $data = "<div class='alert alert-danger'>password does not match</div>";
         }
         elseif ($password === $confirmpassword) {
           $query = $connect->prepare("UPDATE staff_info SET password=:password, confirmpassword=:confirmpassword WHERE email=:email");
           $query->execute(array(
              "email" =>$email,
              "password" =>$password,
              "confirmpassword" =>$confirmpassword
           ));
           $num_row = $query->rowcount();
           if($num_row > 0){
             $data = "<div class='alert alert-success'>password reset successfully</div>";
           }
         }
       }
      else{
         $data = "<div class='alert alert-danger'>account not found</div>";
      }
    }

 ?>
<style type="text/css">
     .card-login{
      padding: 20px 0px;
     }
      label{
         color: #18122B !important;
         font-weight: bold;
         font-family: sans-serif;
         font-size: 14px;
      }
     input[type="email"]{
       color: #18122B !important;
       font-weight: bold;
       font-size: 14px;
    
    }
    input[type="password"]{
       font-size: 14px;
       color: #18122B !important;
       font-weight: bold;
     
    }
    label{
      color: white;
    }
    .text-center >a{
      text-decoration: none;
    }
    .Admin-login {
      font-weight: bold;
       color: #18122B;
    }
    .form-group{
      position: relative;

    }
    .left-sides{
      background: #B8621B;
      min-height: 100vh

    }
   
    body{
      overflow: hidden;
    }
    .fpe-ams{
      color: #18122B;
      font-weight: bold;
      text-align: center;

    }
    .left-section{
      margin-top: 50px;
      align-items: center;

    }
    .btn-primary{
       background: #18122B !important;
       padding: 10px;
       border: none;
    }
    .reg-account{
      color: #18122B;
      font-weight: bold;
      text-decoration: none;
    }
    .login-account{
    color: #18122B;
    font-weight: bold;
    position: relative;
    top: 17px;
    }
 
    
    .fpe-case{
      text-align: center;
      color:#18122B;
      font-weight: bold; 
    }
    .section-details{
      text-align: center;
    }
    .project-name{
      position: relative;
      justify-content: center;
      top: 130px;
    }
  

  </style>
<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">

      <div class="card-body">
        <div class="text-center mb-4">
          <h4>Forgot your password?</h4>
          <p>Enter your email address and we will send you instructions on how to reset your password.</p>
        </div>
        <form method="post">
           <?php 
                if(isset($data)){
                   echo ''.$data.'';
                }

             
            ?>
          <div class="form-group">
           
              <input type="email"  name="email" class="form-control no-shadow" placeholder="Enter email address" required="required" autofocus="autofocus">
          </div>

           <div class="form-group">
            
              <input type="text"  name="password" class="form-control" placeholder="Enter password" required="required" autofocus="autofocus">
             
          </div>

          <div class="form-group">
              <input type="text"  name="confirmpassword" class="form-control" placeholder="Enter Re-enter password" required="required" autofocus="autofocus">
          </div>

          <button class="btn btn-primary btn-block" name="forgotten_password">verify</button>

        </form>
        
        <div class="text-center">
          <a class="d-block small login-account" href="login.php">Login account</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
