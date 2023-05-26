<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>fpe asset - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">
  
 <?php 
     include_once('connect.php');
     if(isset($_POST['login'])){
      $email = $_POST['email'];
      $password = $_POST['password'];
      $query = $connect->prepare("SELECT * FROM staff_info WHERE email=:email AND password=:password");
      $query->execute(array(
           "email"=>$email,
           "password" =>$password
         
      ));
      $num_row = $query->rowcount();
      if($num_row > 0){
         foreach ($query as $row) {
            $email = $row['email'];
            $password = $row['password'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $telephone = $row['telephone'];
            $gender = $row['gender'];
            $profile = $row['profile'];

            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['telephone'] = $telephone;
            $_SESSION['gender'] = $gender;
            $_SESSION['profile'] = $profile;
            header("location:index.php");
         }
      }
          $data = "invalid details";
     }

     



  ?>
  <style type="text/css">
     .card-login{
      padding: 20px 0px;
      position: relative;
      top: 80px;
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
      font-size: 30px;

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
    .forgot-pass{
    color: #18122B;
    font-weight: bold;
    position: relative;
    top: 17px;
    }
    .account-section{
      display: flex;
      justify-content: space-between;
      position: relative;
      bottom: 10px;
    }
    .account-section > a{
      text-decoration: none;
      cursor: pointer;
    }
    .account-section > a:hover{
      color: #B8621B;
       cursor: pointer;

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
    .fpe-logo{
       height: 100px;
       width: 100px;
       text-align: center;
       position: relative;
       bottom: 40px;
    }
  

  </style>
  <div class="">
     <div class="row">
      <div class="col-md-5 left-sides">
        <div class="left-section">
          <div class="container">
            <div class="project-name">
               <div class="logo-section text-center">
                <img src="img/fpelogo.png" class="fpe-logo">
               </div>
               <h5 class="fpe-ams">FPE Asset Management System</h5>
            <p class="fpe-case">(Case study of federal polytechnic ede)</p>
            </div>
            
          </div>
        </div>
      </div>
      <div class="col-md-7 container">
       <div class="card card-login mx-auto mt-5">
      <div class="card-body mt-10">
        <div class="Admin-login text-center">ADMIN LOGIN</div>
        <form  method="post">
          <?php if(isset($data)){
             echo '<div class="alert alert-danger">'.$data.'</div>';
          }


           ?>
          <div class="form-group mt-4">
            <div class="form-label-group">
              <input type="email" id="inputEmail" name="email" class="shadow-none form-control" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="password"  id="inputPassword" class=" shadow-none form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Remember Password
              </label>
            </div>
          </div>
          <button class="btn btn-primary btn-block" name="login">Login</button>
        </form>
        <div class="account-section">
          <a class="d-block small mt-3 reg-account" href="register.php">Register an Account</a>
          <a class="d-block small forgot-pass" href="forgot-password.php">Forgot Password?</a>
        </div>
      </div>
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
