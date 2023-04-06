<?php

include '../shared/head.php';
include '../shared/header.php';
include '../shared/aside.php';
include('../app/config.php');
include('../app/function.php');


$errors = [];

if(isset($_GET['editId'])){
   $editId = $_GET['editId'] ;
   $select = "SELECT * FROM admins WHERE id = $editId";
   $s = mysqli_query($conn,$select);
   $row = mysqli_fetch_assoc($s);

   if(isset($_POST['update'])){
   $name = filterValidation($_POST['name']) ;
   $password = filterValidation($_POST['password'] );
   $hashPassword = sha1($password) ;

   if (stringValidation($name, 2)) {
    $errors[] = "Please Enter Admin Name and length > 1 char ";
}
if (stringValidation($password, 3)) {
    $errors[] = "Please Enter password and length > 2 char ";
}

$select = "SELECT * FROM admins where name = '$name' ";
$sAdmin = mysqli_query($conn,$select);
$numRows = mysqli_num_rows ($sAdmin);

if($numRows == 0 ){
if (empty($errors)) {
   $update = "UPDATE `admins` SET name ='$name' , password = '$hashPassword' WHERE id = $editId";
   $i= mysqli_query($conn,$update);
   path('admin/list.php') ;
 }
}
elseif($name == $row['name'] ){
    $update = "UPDATE `admins` SET name = '$row[name]' , password = '$hashPassword' WHERE id = $editId";
    $i= mysqli_query($conn,$update);
    path('admin/list.php') ;
  }
  else{
  
    dangerMessage($numRows !=0 ,"UserName Already Exist");
  }


   }

}else{
    path('admin/list.php') ;
}
auth(2,3);
?>


<section class="p-70 ">
<main id="main" class="main">
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
<h1 class="text-center titlePage"> Edit Admin : <?= $_GET['editId']?> </h1>
<div class="container col-md-6">
    <div class="card">
        <div class="card-body">
            <form method="post">
                <div class="div-form-groub">
                    <input type="text" value="<?= $row['name']?>" class="form-control" placeholder="Admin Name" name="name">
                </div>
                <div class="div-form-groub">
                    <input type="password" value="<?= $row['password']?>" class="form-control" placeholder="Admin password" name="password">
                </div>
                <button name="update" class="btn btn-warning">Update Data</button>
            </form>
        </div>
    </div>
</div>
</main><!-- End #main -->
</section>

<?php include '../shared/footer.php';?>
<?php include '../shared/script.php';?>