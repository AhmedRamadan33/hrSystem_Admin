<?php

include '../shared/head.php';
include '../shared/header.php';
include '../shared/aside.php';
include('../app/config.php');
include('../app/function.php');

$select = "SELECT * FROM departments";
$departments = mysqli_query($conn,$select);

$errors = [];
if(isset($_POST['send'])){
   $name = filterValidation($_POST['name']) ;
   $salary = filterValidation($_POST['salary']) ;
   $departmentId = filterValidation($_POST['departmentId']) ;

// image code
   $image_size = $_FILES['image']['size'];
   $image_type = $_FILES['image']['type'];

   $image_name = rand(0,5000) . time() . $_FILES['image']['name'];
   $tmp_name = $_FILES['image']['tmp_name'];

   $location = "upload/" . $image_name ;

   if (fileSizeValidation($_FILES['image']['name'], $_FILES['image']['size'], 3)) {
    $errors[] = "Your File bigger Than 3 miga";
}
if (fileTypeValidation($image_type, "image/jpeg", "image/png", "image/jpg")) {
    $errors[] = "Your File Out Side Types";
}

if (stringValidation($name, 2)) {
    $errors[] = "Please Enter Employee Name and length > 3 ";
}
if (numberValidation($salary)) {
    $errors[] = "Please Enter Valida Salary";
}

   if (empty($errors)) {
    move_uploaded_file($tmp_name , $location);
   $inesrt = "INSERT INTO employees values(null ,'$name' , $salary ,'$image_name' , $departmentId  ) ";
   $i = mysqli_query($conn,$inesrt);
   testMessage($i ,"Insert process successed");
   }
}
 
auth(2)
?>


<section class="p-70 ">
<main id="main" class="main ">
<h1 class="text-center titlePage"> Add Employees</h1>
<div class="container col-md-6">
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
    <div class="card">
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="form-groub">
                    <input type="text" class="form-control" placeholder="Employee Name" name="name">
                </div>
                <div class="row" id ="cost">
                    <div class="col-md-3">
                    <div class="form-groub">
                    <input type="text" class="form-control" placeholder="Gross salary" >
                </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-groub">
                    <input type="text" class="form-control" placeholder="Tax salary" >
                </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-groub">
                    <input type="text" class="form-control" placeholder="Bouns salary" >
                </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-groub">
                    <input type="text"  class="form-control" readonly placeholder="Net salary" name="salary">
                </div>
                    </div>
                </div>
                <div class="form-groub">
                <span for="">Your Image</span>
                    <input type="file" class="form-control "  name="image">
                </div>
                <div class="form-groub">
                    <span for="">Department Name</span>
                    <select type="text" class="form-control" name="departmentId">
                    <option value="" selected disabled>choose a department name </option>

                        <?php foreach($departments as $data): ?>
                        <option value="<?= $data['id'] ?>"> <?= $data['name']?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button name="send" class="btn btn-info">Send Data</button>
            </form>
        </div>
    </div>
</div>
</main>
</section>



<?php include '../shared/footer.php';?>
<?php include '../shared/script.php';?>