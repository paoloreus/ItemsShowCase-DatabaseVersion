<?php
session_start();

if(!isset($_SESSION['username'])){
    header('Location: ../public/indexLogin.php');
}

echo "Welcome " .$_SESSION['username'];
echo "<br>";
echo "Please fill out the information required to change your password";
echo "<br> <br>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Change Password</title>
</head>
<body>
<form action="confirmPassword.php" method="post">
<label for="username">Username</label> <input type="text" name="username" placeholder="Username">
<br>
<label for="oldpassword">Old Password</label> <input type="password" name="oldpassword" placeholder="Old Password">
    <br>
    <label for="newpassword">New Password</label> <input type="password" name="newpassword" placeholder="New Password">
    <br><br>
    <?php
    if(@$_GET['invalid'] == true){
        ?>
        <div class="alert-light text-danger text-center py-3"> <?php echo $_GET['invalid'] ?></div>
        <?php
        echo "<br> <br>";
    }
    ?>
    <input type="submit" value="Submit Changes">
    <br><br>
</form>
</body>
</html>
