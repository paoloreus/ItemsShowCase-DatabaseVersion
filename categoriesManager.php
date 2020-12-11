<?php
include __DIR__ . '/categories.php';

$category = new Categories();
$category_info = $category ->getById($_REQUEST['id']) ->fetch_assoc();

if(empty($category_info)){
    die('Category not found');
}

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'save'){

    $query = sprintf("UPDATE %s SET name = '%s', description = '%s', status = '%s'  WHERE id = %d",
    Categories::$table_name, $_REQUEST['name'], $_REQUEST['description'], $_REQUEST['status'], $_REQUEST['id']);

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
<form action="?action=save" method="post">
Title: <input type="text" name="name" value="<?=$category_info['name']?>"><br>
Description: <br><textarea name="description"><?=$category_info['description']?></textarea> <br>

<!-------------START--------------------->
Status: <br>
<input type="radio" id="hide" name="status" value="hide" <?php echo ($category_info['status']=='hide')?'checked':'' ?>>
<label for="hide">Hide</label><br>
<input type="radio" id="show" name="status" value="show" <?php echo ($category_info['status']=='show')?'checked':'' ?>>
<label for="show">Show</label><br>
<!-------------END--------------------->

<input type="hidden" name="id" value="<?=$category_info['id']?>"><br><br>
    <input type="submit" value="Submit Changes">

</form>
</body>
</html>
