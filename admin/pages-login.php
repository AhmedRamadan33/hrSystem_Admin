<?php

include '../shared/head.php';
include('../app/config.php');
include('../app/function.php');

if(isset($_POST['login'])){
  $name = $_POST['name'] ;
  $password = $_POST['password'];
  $hashPassword = sha1($password);

  $select = "SELECT * FROM adminalldata WHERE name = '$name' and password ='$hashPassword' ";
  $s = mysqli_query($conn,$select);
  $row = mysqli_fetch_assoc($s);
  $numRows = mysqli_num_rows ($s);

  if($numRows == 1){
    $_SESSION['admin'] = [
      "name" =>$name,
      "rule" =>$row['rule'],
      "id" =>$row['id'],
      "description" =>$row['description'],
      "image" =>$row['image'],

    ] ;

    $adminID = $_SESSION['admin']['id'];

    $selectprofileadmin = "SELECT * FROM profileadmin WHERE adminId = $adminID ";
    $sprofileadmin = mysqli_query($conn,$selectprofileadmin);
  
    $numprofileadmin = mysqli_num_rows ($sprofileadmin);
    
    if($numprofileadmin == 0){
        
      $inesrt = "INSERT INTO profileadmin values(null ,Default , Default ,Default ,Default ,Default ,Default ,Default , Default , Default, Default, Default, Default, $adminID ) ";
      $i = mysqli_query($conn,$inesrt);
    }
    
  
    path('index.php') ;
    
 

  }else{
    
    dangerMessage($numRows !=1 ,"incorrect password or email");
    // header("location:/odc/admin/pages-login.php") ;
  }
}

 if(isset($_SESSION['admin'])){
  path('index.php') ;
 }

?>
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="pages-login.php" class="logo d-flex align-items-center w-auto">
                  <img src="/odc/assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">NiceAdmin</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form method="post" class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="name" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button name="login" class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="pages-register.php">Create an account</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>

            </div>
          </div>
        </div>

      </section>
    </div>
  </main><!-- End #main -->


  <?php
include '../shared/footer.php';
include '../shared/script.php';
?>
