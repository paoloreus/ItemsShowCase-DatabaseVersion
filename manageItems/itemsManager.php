<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: ../public/indexLogin.php');
}
include __DIR__ . '/items.php';

$item = new Items();
$item_info = $item ->getById($_REQUEST['id']) ->fetch_assoc();

if(empty($item_info)){
    die('Item not found');
}
if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete'){
    $item->query('DELETE FROM items WHERE id = ' . $_REQUEST['id']);
    header('location: ../public/indexAdmin.php');
}
if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'save'){


    $query = sprintf("UPDATE %s SET name = '%s', description = '%s', price = '%.2f', category = '%s', image = '%s' WHERE id = %d",
    Items::$table_name, $_REQUEST['name'], $_REQUEST['description'], $_REQUEST['price'],
        $_REQUEST['category'], $_FILES['image']['name'], $_REQUEST['id']);

    $item ->query($query);
    $name_dir = "../images/";
    $name_file = $name_dir . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $name_file);
    header('location: ../public/indexAdmin.php');
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
<form action="?action=save" method="post" enctype="multipart/form-data">
    Title: <input type="text" name="name" value="<?=$item_info['name']?>"><br>
    Price: <input type="text" name="price" value="<?=$item_info['price']?>"><br>
    Category: <input type="text" name="category" value="<?=$item_info['category']?>"><br>
    Description: <br><textarea name="description"><?=$item_info['description']?></textarea><br>
    Image: <input type="file" name="image" value="<?=$item_info['image']?>"<br>
    <input type="hidden" name="id" value="<?=$item_info['id']?>"><br><br>
    <input type="submit" value="Submit Changes">
    <button type="submit" formaction="../public/indexAdmin.php">Back to Home</button>
</form>
</body>
</html>
