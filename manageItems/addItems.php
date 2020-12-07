<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: ../public/indexLogin.php');
}
include __DIR__ . '/items.php';

$item = new Items();

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'add'){
$query = sprintf("INSERT INTO %s (name, description, price, category, image) VALUES ('%s', '%s', '%0.2f', '%s', '%s')",
Items::$table_name, $_REQUEST['name'], $_REQUEST['description'], $_REQUEST['price'], $_REQUEST['category'], $_REQUEST['image']);

$item->query($query);
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
<form action="?action=add" method="post" enctype="multipart/form-data">
    Title: <input type="text" name="name"><br>
    Price: <input type="text" name="price"><br>
    Category: <input type="text" name="category"><br>
    Description: <br><textarea name="description"></textarea> <br>
    Image: <input type="file" name="image"><br><br>
    <input type="submit" value="Add New Item">
</form>
</body>
</html>
