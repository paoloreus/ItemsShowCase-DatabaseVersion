<?php
session_start();
include '../manageAdmins/admins.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Log In</title>
</head>
<body style="background:#CCC;">

<div class="container">
    <div class="row">
        <div class="col-lg-6 m-auto">
          <div class="card bg-dark mt-5">
            <div class="card-title bg-primary text-white mt-5">
            <h3 class="text-center py-3">User Login</h3>
            </div>
              <?php
              if(@$_GET['empty'] == true){
               ?>
                  <div class="alert-light text-danger text-center py-3"> <?php echo $_GET['empty'] ?></div>
              <?php
              }
              ?>

              <?php
              if(@$_GET['invalid'] == true){
                  ?>
                  <div class="alert-light text-danger text-center py-3"> <?php echo $_GET['invalid'] ?></div>
                  <?php
              }
              ?>
              <div class="card-body">
                 <form action="../manageAdmins/login.php" method="post">
                     <input type="text" name="username" placeholder="Username" class="form-control mb-3" value="adminp">
                     <input type="password" name="password" placeholder="Password" class="form-control mb-3" value="password">
                     <button class="btn btn-success mt-3" name="login">Login</button>
                 </form>
              </div>
          </div>
        </div>
    </div>
</div>
</body>
</html>