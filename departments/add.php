<?php

include '../shared/head.php';
include '../shared/header.php';
include '../shared/aside.php';
include('../app/config.php');
include('../app/function.php');

$errors = [];
if(isset($_POST['send'])){
   $name = filterValidation($_POST['name']) ;

   if (stringValidation($name, 2)) {
    $errors[] = "Please Enter Department Name and length > 1 ";
   }
   if (empty($errors)) {
   $inesrt = "INSERT INTO departments values(null ,'$name') ";
   $i = mysqli_query($conn,$inesrt);
   testMessage($i ,"Insert process successed");
   }
   

}
auth(2,3)
?>

<section class="p-70 ">
<main id="main" class="main ">
<h1 class="text-center titlePage"> Add Departments</h1>
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
            <form method="post">
                <div class="div-form-groub">
                    <input type="text" class="form-control" placeholder="Department Name" name="name">
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