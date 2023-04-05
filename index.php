<?php

include './shared/head.php';

 if(isset($_SESSION['admin'])):


include './shared/header.php';
include './shared/aside.php';
include('./app/config.php');
include('./app/function.php');

auth(2,3);

?>



<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div>


</main>
<!-- End #main -->

<?php include './shared/footer.php';?>
<?php include './shared/script.php';?>


<?php else :header("location:/odc/admin/pages-login.php") ;?>
<?php endif ?>