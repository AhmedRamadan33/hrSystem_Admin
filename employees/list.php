<?php

include '../shared/head.php';
include '../shared/header.php';
include '../shared/aside.php';
include('../app/config.php');
include('../app/function.php');

$select = "SELECT * FROM employeesjoindepartments";
$s = mysqli_query($conn,$select);

//Delete
if(isset($_GET['deleteId'])){
  $deleteId = $_GET['deleteId'] ;
  $selectOne = "SELECT * FROM employeesjoindepartments WHERE id = $deleteId";
  $sOne = mysqli_query($conn,$selectOne);
  $row = mysqli_fetch_assoc($sOne);
  $image_name =$row['image'];
  unlink("./upload/$image_name");

  $delete = "DELETE FROM employees WHERE id = $deleteId";
  mysqli_query($conn,$delete);
  path('employees/list.php') ;
}

auth(2)

?>


<section class="p-70 ">
<main id="main" class="main ">
<h1 class="text-center titlePage"> List employees</h1>
<div class="container col-md-6">
    <div class="card">
        <div class="card-body">
          <table class="table ">
            <tr>
            <th>ID</th>
            <th>Name</th>
            <th>salary</th>
            <th>depName</th>
            <th>Image</th>

            <th >Delete</th> 
            <th >Edit</th> 
            </tr>
            <?php foreach($s as $data): ;?>
            <tr>
                <td><?= $data['id']?></td>
                <td><?= $data['empName']?></td>      
                <td><?= $data['salary']?></td>    
                <td><?= $data['depName']?></td>    
                <td> <img class="table_image" src="./upload/<?= $data['image']?>" alt=""> </td>    

                <td> <a class="btn btn-danger" href="/odc/employees/list.php?deleteId=<?= $data['id']?>">Delete</a></td>
           <td><a class="btn btn-warning"  href="/odc/employees/edit.php?editId=<?= $data['id']?>">Edit</a></td>
            </tr>
            <?php endforeach ;?>
          </table>
        </div>
    </div>
</div>
</main>
</section>

<?php include '../shared/footer.php';?>
<?php include '../shared/script.php';?>