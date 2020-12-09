<?php
include __DIR__ . '/categories.php';
include '../manageAdmins/validations.php';

$category = new Categories();

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'add'){
    if(validate($_POST['name'], 1) == false){
            header('Location: ?invalid=Input is not valid');
    }
    else if(empty($_POST['name']) || empty($_POST['description'])){
        header('Location: ?empty=Please fill in the blanks');
    }
    else {
        $query = sprintf("INSERT INTO %s (name, description) VALUES ('%s', '%s')",
            Categories::$table_name, $_REQUEST['name'], $_REQUEST['description']);

        $category->query($query);
        header('Location: ../public/indexAdmin.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Buy For Fun</title>
</head>
<body>
<form action="?action=add" method="post">
    Title: <input type="text" name="name"><br>
    Description: <br><textarea name="description"></textarea> <br>
    <?php
    if(@$_GET['empty'] == true){
        ?>
        <div class="alert-light text-danger py-3"> <?php echo $_GET['empty'] ?></div>
        <?php
        echo "<br>";
    }
    ?>
    <?php
    if(@$_GET['invalid'] == true){
        ?>
        <div class="alert-light text-danger py-3"> <?php echo $_GET['invalid'] ?></div>
        <?php
        echo "<br>";
    }
    ?>
    <input type="submit" value="Add New Category">
    <button type="submit" formaction="../public/indexAdmin.php">Back to Home</button>
</form>
</body>
</html>
