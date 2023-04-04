<?php
include '../shared/head.php';
include '../shared/header.php';
include '../shared/aside.php';
include('../app/config.php');
include('../app/function.php');

$errors = [];
// 
$adminID = $_SESSION['admin']['id'];
// 
$selectProfile = "SELECT * FROM `profileadminjoin` where adminId =$adminID";
$sProfile = mysqli_query($conn, $selectProfile);
$rowProfile = mysqli_fetch_assoc($sProfile);
  

// /////
$select = "SELECT * FROM `adminalldata` where id =$adminID";
$s = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($s);
// /////

if (isset($_POST['save'])) {
  $fullName =filterValidation( $_POST['fullName'] );
  $about = filterValidation($_POST['about'] );
 $company = filterValidation($_POST['company'] );
  $job =filterValidation( $_POST['job']) ;
  $country = filterValidation($_POST['country']) ;
  $address = filterValidation($_POST['address'] );
  $phone = filterValidation($_POST['phone']) ;
  $email = filterValidation($_POST['email'] );
  $twitter =filterValidation( $_POST['twitter'] );
  $facebook = filterValidation($_POST['facebook'] );
  $instagram = filterValidation($_POST['instagram'] );
  $linkedin = filterValidation($_POST['linkedin'] );

  if (stringValidation($fullName, 2)) {
    $errors[] = "Please Enter fullName and length > 3 ";
}
if (stringValidation($about, 2)) {
  $errors[] = "Please Enter about and length > 3 ";
}  if (stringValidation($company, 2)) {
  $errors[] = "Please Enter company and length > 3 ";
}  if (stringValidation($job, 2)) {
  $errors[] = "Please Enter job and length > 3 ";
}  if (stringValidation($country, 2)) {
  $errors[] = "Please Enter country and length > 3 ";
}  if (stringValidation($address, 2)) {
  $errors[] = "Please Enter address and length > 3 ";
}  if (stringValidation($phone, 2)) {
  $errors[] = "Please Enter phone and length > 3 ";
}  if (stringValidation($email, 2)) {
  $errors[] = "Please Enter email and length > 3 ";
}

    // Image Code
    if (empty($_FILES['image']['name'])) {
        $image = $row['image'];
        $image_name = $image;
    } else {
        $image_name = rand(0, 1000) . rand(0, 1000) . $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $location = "upload/" . $image_name;
        $oldImage = $row['image'];
        if ($oldImage != "user_318-159711.jpg") {
            unlink("./upload/$oldImage");
        }

        if (fileSizeValidation($_FILES['image']['name'], $_FILES['image']['size'], 3)) {
          $errors[] = "Your File bigger Than 3 miga";
      }
      if (fileTypeValidation($image_type, "image/jpeg", "image/png", "image/jpg")) {
          $errors[] = "Your File Out Side Types";
      }
      
    }
    if (empty($errors)) {
    $update = "UPDATE admins SET  image ='$image_name' where id =$adminID ";
    $u = mysqli_query($conn, $update);
    move_uploaded_file($tmp_name, $location);

    // 
    }
   
    // 
    if (empty($errors)) {
    $update = "UPDATE profileadminjoin SET  about ='$about',fullName ='$fullName',company ='$company',job ='$job',country ='$country',address ='$address',phone ='$phone',email ='$email',twitterLink ='$twitter',faceLink= '$facebook',instaLink='$instagram',linkedin= '$linkedin' where adminId =$adminID ";
    $u = mysqli_query($conn, $update);
    path("admin/users-profile.php");
    }

}


if (isset($_POST['changePass'])) {

  $password = $_POST['password'] ;
  $hashPassword2 = sha1($password) ;

  $newpassword = $_POST['newpassword'] ;
  $renewpassword = $_POST['renewpassword'] ;

  $hashPassword = sha1($renewpassword) ;

  $select = "SELECT * FROM admins  where id =$adminID ";
  $s = mysqli_query($conn,$select);
  $rowPass = mysqli_fetch_assoc($s);

if ( $hashPassword2 == $rowPass['password']  && $newpassword == $renewpassword){

  $update = "UPDATE admins SET  password = '$hashPassword' where id =$adminID ";
  $u = mysqli_query($conn, $update);
  
 }  
 else{
  dangerMessage( $newpassword != $renewpassword || $hashPassword2 != $rowPass['password'], " please Cofirm the Password and Current Password");
 }
}    




auth(2, 3);
?>

  <main id="main" class="main ">
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
    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/odc/index.php">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="./upload/<?= $row['image'] ?>" alt="Profile" class="rounded-circle">
              <h2><?= $row['name'] ?></h2>
              <h3><?= $row['description']  ?></h3>
              <div class="social-links mt-2">
                <a href="<?= $rowProfile['twitterLink'] ?>" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="<?= $rowProfile['faceLink'] ?>" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="<?= $rowProfile['instaLink'] ?>" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="<?= $rowProfile['linkedin'] ?>" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic"><?= $rowProfile['about']?></p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?= $rowProfile['fullName']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company</div>
                    <div class="col-lg-9 col-md-8"><?= $rowProfile['company']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Job</div>
                    <div class="col-lg-9 col-md-8"><?= $rowProfile['job']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8"><?= $rowProfile['country']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8"><?= $rowProfile['address']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"><?= $rowProfile['phone']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?= $rowProfile['email']?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form  method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="upload">
                        <img src="./upload/<?= $row['image'] ?>" alt="Profile">
                        <div class="pt-2 round">
                          <input type="file" name="image"> <i class = "fa fa-camera" ></i></input>
                        </div>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" value="<?= $rowProfile['fullName']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px"><?= $rowProfile['about']?></textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="company" type="text" class="form-control" id="company" value="<?= $rowProfile['company']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="job" type="text" class="form-control" id="Job" value="<?= $rowProfile['job']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="country" type="text" class="form-control" id="Country" value="<?= $rowProfile['country']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="Address" value="<?= $rowProfile['address']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="Phone" value="<?= $rowProfile['phone']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="<?= $rowProfile['email']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="twitter" type="text" class="form-control" id="Twitter" value="<?= $rowProfile['twitterLink']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="facebook" type="text" class="form-control" id="Facebook" value="<?= $rowProfile['faceLink']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="instagram" type="text" class="form-control" id="Instagram" value="<?= $rowProfile['instaLink']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="linkedin" type="text" class="form-control" id="Linkedin" value="<?= $rowProfile['linkedin']?>">
                      </div>
                    </div>

                    <div class="text-center">
                      <button name="save" type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="post">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div> 

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirm Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button name="changePass" type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->



<?php
include '../shared/footer.php';
include '../shared/script.php';
?>
