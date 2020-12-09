<?php
include __DIR__ . '/admins.php';
include 'validations.php';  

$admin = new Admins();
$isValid = true;


if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'add'){
    $fields = array($_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['password']);
    for($i = 0; $i < count($fields); $i++){
        if(empty($fields[$i])){
            header('Location: ?empty=Please fill in the blanks');
            $isValid = false;
        }
    }

    if(validate($fields[0], 1) == false || validate($fields[1], 1) == false){
        $isValid = false;
        header('Location: ?invalid=First/Last Name can only contain letters');
    }
    if(validateEmail($_POST['email']) == false){
        $isValid = false;
        header('Location: ?invalid=Email Address is not valid');
    }

    if($isValid) {
        $query = sprintf("INSERT INTO %s (firstname, lastname, username, email, password) VALUES ('%s', '%s', '%s', '%s', '%s')",
            Admins::$table_name, $_REQUEST['firstname'], $_REQUEST['lastname'], $_REQUEST['username'], $_REQUEST['email'],
            $_REQUEST['password']);

        $admin->query($query);
        $message = "Registration Complete!";
        echo "<script type='text/javascript'>alert('$message'); </script>";
        sleep(1);
        echo "<script type='text/javascript'>window.location='../public/indexLogin.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Register New Admin</title>
</head>
<body>
<form action="?action=add" method="post">
    First Name: <input type="text" name="firstname"><br>
    Last Name: <input type="text" name="lastname"><br>
    Username: <input type="text" name="username"><br>
    Email Address: <input type="email" name="email"><br>
    Password: <input type="password" name="password"><br>
    <?php
    if(@$_GET['empty'] == true){
        ?>
        <div class="alert-light text-danger py-3"> <?php echo $_GET['empty'] ?></div>
        <?php
        echo "<br>";
    }
    ?>
    <?php
    if(isset($_GET['invalid'])){
        ?>
        <div class="alert-light text-danger py-3"> <?php echo $_GET['invalid'] ?></div>
        <?php
        echo "<br> <br>";
    }
    ?>
    <input type="submit" value="Finish">
    <button type="submit" formaction="../public/indexPublic.php">Back to Home</button>
</form>
</body>
</html>
