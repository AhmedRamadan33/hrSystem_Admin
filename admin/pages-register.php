<?php
error_reporting(0);
ini_set('display_errors',0);

include '../shared/head.php';
include('../app/config.php');
include('../app/function.php');


$errors = [];
  
if(isset($_POST['send'])){
  $name = filterValidation($_POST['name']) ;
  $password = filterValidation($_POST['password']);
  $hashPassword = sha1($password);
  $rule = $_POST['rule'];


  if (stringValidation($name, 2)) {
    $errors[] = "Please Enter UserName and length >1 ";
   }
   if (stringValidation($password, 3)) {
    $errors[] = "Please Enter password and length >2 ";
   }
   if (numberValidation($rule)) {
    $errors[] = "Please choose rule  ";
   }

  $select = "SELECT * FROM admins WHERE name = '$name'  ";
  $s = mysqli_query($conn,$select);
  $numRows = mysqli_num_rows ($s);

  if($numRows == 0 ){
   if (empty($errors)) {

  $inesrt = "INSERT INTO admins values(null ,'$name' , '$hashPassword' , default , $rule) ";
   $i = mysqli_query($conn,$inesrt);
   testMessage($i ,"Insert New Admin process successed");
  }
}
  else{
    
    dangerMessage($numRows !=0 ,"UserName Already Exist");
  
  }
  
}

$selectRules = "SELECT * FROM rules";
$sRules = mysqli_query($conn,$selectRules);


auth()

?>


  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
            <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?> </li>
                    <hr>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
              <div class="d-flex justify-content-center py-4">
                <a href="/odc/index.php" class="logo d-flex align-items-center w-auto">
                  <img src="/odc/assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">NiceAdmin</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>


                  <form method="post" class="row g-3 needs-validation" novalidate>  

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="name" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please choose a username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                     <div class="form-group">
                       <select name="rule" id="" class="form-control">
                        <option value="" selected disabled>Choose the type of admin</option>
                       <?php foreach($sRules as $data): ?>
                       <option value="<?= $data['id'] ?>"> <?= $data['description']?> </option>
                       <?php endforeach; ?>
                       </select>
                     </div>
                    </div>


                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button name="send" class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="pages-login.php">Log in</a></p>
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
