<?php

include '../shared/head.php';
include '../shared/header.php';
include '../shared/aside.php';
include('../app/config.php');
include('../app/function.php');


$errors = [];
if(isset($_GET['editId'])){
   $editId = $_GET['editId'] ;
   $select = "SELECT * FROM departments WHERE id = $editId";
   $s = mysqli_query($conn,$select);
   $row = mysqli_fetch_assoc($s);

   if(isset($_POST['update'])){
   $name = filterValidation($_POST['name']) ;
   if (stringValidation($name, 2)) {
    $errors[] = "Please Enter Department Name and length > 2 ";
   }

   if (empty($errors)) {
   $update = "UPDATE `departments` SET name ='$name' WHERE id = $editId";
   $i= mysqli_query($conn,$update);
   path('departments/list.php') ;
   }

   }
}else{
   path('departments/list.php') ;

}
auth(2,3)
?>


<section class="p-70 ">
<main id="main" class="main ">
<h1 class="text-center titlePage"> Edit Department : <?= $_GET['editId']?> </h1>
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
                    <input type="text" value="<?= $row['name']?>" class="form-control" placeholder="Department Name" name="name">
                </div>
                <button name="update" class="btn btn-warning">Update Data</button>
            </form>
        </div>
    </div>
</div>
</main>
</section>



<?php include '../shared/footer.php';?>
<?php include '../shared/script.php';?>