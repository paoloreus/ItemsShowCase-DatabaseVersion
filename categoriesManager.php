<?php
include __DIR__ . '/categories.php';
include '../manageAdmins/validations.php';
$category = new Categories();
$category_info = $category ->getById($_REQUEST['id']) ->fetch_assoc();

if(empty($category_info)){
    die('Category not found');
}

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'save'){
        $query = sprintf("UPDATE %s SET name = '%s', description = '%s' WHERE id = %d",
            Categories::$table_name, $_REQUEST['name'], $_REQUEST['description'], $_REQUEST['id']);

        $category->query($query);
        header('Location: ../public/indexAdmin.php');

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
Title: <input type="text" name="name" value="<?=$category_info['name']?>"><br>
Description: <br><textarea name="description"><?=$category_info['description']?></textarea> <br>
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
