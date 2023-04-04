<?php


include '../shared/head.php';
include '../shared/header.php';
include '../shared/aside.php';
include('../app/config.php');
include('../app/function.php');


$select = "SELECT * FROM departments";
$s = mysqli_query($conn,$select);

//Delete
if(isset($_GET['deleteId'])){
  $deleteId = $_GET['deleteId'] ;
  $delete = "DELETE FROM departments WHERE $deleteId= id";
  mysqli_query($conn,$delete);
  path('departments/list.php') ;
}


auth(2,3)

?>
<section class="p-70 ">
<main id="main" class="main ">
<h1 class="text-center titlePage"> List Departments</h1>
<div class="container col-md-6">
    <div class="card">
        <div class="card-body">
          <table class="table  ">
            <tr>
            <th>ID</th>
            <th>Name</th>
            <th >Delete</th> 
            <th >Edit</th> 
            </tr>
            <?php foreach($s as $data): ;?>
            <tr>
                <td><?= $data['id']?></td>
                <td><?= $data['name']?></td>    

                <td> <a class="btn btn-danger" href="/odc/departments/list.php?deleteId=<?= $data['id']?>">Delete</a></td>
                <td> <a class="btn btn-warning"  href="/odc/departments/edit.php?editId=<?= $data['id']?>">Edit</a></td>    
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