<?php
include __DIR__ . '/categories.php';
include '../manageAdmins/validations.php';
$category = new Categories();
$category_info = $category ->getById($_REQUEST['id']) ->fetch_assoc();

if(empty($category_info)){
    die('Category not found');
}

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'save'){
    if(validate($_POST['name'], 1) == false){
        ?>
        <p style="color:red" class="alert-light text-danger text-center py-3"> Name can only contain letters</p>
        <?php
    }
    else if(empty($_POST['name']) || empty($_POST['description'])){
        ?>
        <p style="color:red" class="alert-light text-danger text-center py-3"> Please fill in the blanks</p>
        <?php
    }
    else {
        $query = sprintf("UPDATE %s SET name = '%s', description = '%s', status = '%s' WHERE id = %d",
            Categories::$table_name, $_REQUEST['name'], $_REQUEST['description'], $_REQUEST['status'], $_REQUEST['id']);

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
    <title>Buy For Fun</title>
</head>
<body>
<form action="?action=save" method="post">
Title: <input type="text" name="name" value="<?= isset($_REQUEST['name'])? $_REQUEST['name'] : $category_info['name']?>"><br>
Description: <br><textarea name="description"><?= isset($_REQUEST['description'])? $_REQUEST['description'] : $category_info['description']?></textarea> <br>

Status: <br>
<input type="radio" id="HIDE" name="status" value="hide" <?php echo ($category_info['status'] == 'HIDE')?'checked': ''?>>
    <label for="HIDE">Hide</label><br>
<input type="radio" id="SHOW" name="status" value="show" <?php echo ($category_info['status'] == 'SHOW')?'checked': ''?>>
    <label for="SHOW">Show</label><br>
<input type="hidden" name="id" value="<?=$category_info['id']?>"><br><br>
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
    <input type="submit" value="Submit Changes">
    <button type="submit" formaction="../public/indexAdmin.php">Back to Home</button>
</form>
</body>
</html>
