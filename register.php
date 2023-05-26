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
     $password = $_POST['password'];
     $confirmpassword = $_POST['confirmpassword'];
     if($password !== $confirmpassword){
        $data = "<div class='alert alert-danger'>password does not match</div>";
     }
     elseif ($password === $confirmpassword) {
         $query = $connect->prepare("INSERT INTO staff_info (firstname, lastname, email, password, confirmpassword) VALUES('$firstname', '$lastname', '$email', '$password', '$confirmpassword')");
         $query->execute(array(
             "firstname" =>$firstname,
             "lastname" =>$lastname,
             "email" =>$email,
             "password" =>$password,
             "confirmpassword" =>$confirmpassword
         ));
         $num_row = $query->rowcount();
          if($num_row > 0){
            $message = "<div class='alert alert-success'>account created!</div>";
          }
     }
    }
  }



  ?>
  <style>
    .btn-primary{
      background: #18122B !important; 
      padding: 15px !important;
      border: none !important;
      box-shadow: none !important;
    }
    .register-section{
      color: #18122B;
      font-weight: bold;
    }
    .account-section{
      display: flex;
      justify-content: space-around;
    }
    .account-section > a:nth-child(2){
      color: #18122B;
      position: relative;
      top: 17px;
      font-weight: bold;
    }
    .account-section > a:nth-child(1){
      color: #18122B;
      position: relative;
      font-weight: bold;
    }
  </style>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>fpe - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-body">
        <div class="register-section">Create Account</div>
        <form method="post" class="mt-3">
           <?php 
                 if(isset($data)){
                   echo ''.$data.'';
                 }
               
            ?>
         
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="firstName" name="firstname" class="form-control" placeholder="First name" required="required" autofocus="autofocus">
                  <label for="firstName">First name</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="lastName" name="lastname" class="form-control" placeholder="Last name" required="required">
                  <label for="lastName">Last name</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required="required">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="required">
                  <label for="inputPassword">Password</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="confirmPassword" name="confirmpassword" class="form-control" placeholder="Confirm password" required="required">
                  <label for="confirmPassword">Confirm password</label>
                </div>
              </div>
            </div>
          </div>
          <button class="btn btn-primary btn-block" name="register">Register</button>
        </form>
        <div class="account-section">
          <a class="d-block small mt-3" href="login.php">Login Page</a>
          <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
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
