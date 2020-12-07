<?php
include __DIR__ . '/categories.php';

$category = new Categories();

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'add'){
    $query = sprintf("INSERT INTO %s (name, description) VALUES ('%s', '%s')",
    Categories::$table_name, $_REQUEST['name'], $_REQUEST['description']);

    $category ->query($query);
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
<form action="?action=add" method="post">
    Title: <input type="text" name="name"><br>
    Description: <br><textarea name="description"></textarea> <br>
    <input type="submit" value="Add New Category">
</form>
</body>
</html>
