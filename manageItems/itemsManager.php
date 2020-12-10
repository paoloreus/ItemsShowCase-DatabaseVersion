<?php
session_start();
function uploadFile($file,$name){
    $name_dir = "../images/";
    $name_file = $name_dir . basename($file);
    move_uploaded_file($name, $name_file);
}

if(!isset($_SESSION['username'])){
    header('Location: ../public/indexLogin.php');
}
include __DIR__ . '/items.php';


$item = new Items();
$item_info = $item ->getById($_REQUEST['id']) ->fetch_assoc();


//Generates Image Information
$image_string ='';

if(isset($_FILES['image']['name'][0])){
    if(!$_FILES['image']['name'][0]==''){
        $item_info["image"] = $_FILES['image']['name'][0];
        uploadFile($_FILES['image']['name'][0],$_FILES['image']['tmp_name'][0]);
    }
}

if(isset($_POST['delete1'])) {
    $item_info["image"] = "default.png";
}

if(isset($_POST['select'])){
    $select=$_POST['select'];
    if($select>1){
        if($item_info["image"] == "default.png"){
            $item_info['image']=$item_info['image'.$select];
            $item_info['image'.$select]='';
        } else {
            $temp = $item_info['image'];
            $item_info['image']=$item_info['image'.$select];
            $item_info['image'.$select] = $temp;
        }
    }
}

$images_info[]= $item_info['image'];
for($x=2;$x<=5;$x++) {
    if(isset($_FILES['image']['name'][$x-1])) {
        if (!$_FILES['image']['name'][$x-1]=='' && !$select==$x) {
            $item_info["image$x"] = $_FILES['image']['name'][$x - 1];
            uploadFile($_FILES['image']['name'][$x - 1],$_FILES['image']['tmp_name'][$x - 1]);
        }
    }
    if(isset($_POST["delete".$x])) {
        $item_info["image$x"] = '';
    }
    if (!$item_info["image$x"] == '') {
        if ($images_info[0] == 'default.png') {
            $images_info[0] =$item_info["image$x"];
        } else {
            $images_info[]=$item_info["image$x"];
            $image_string .="', image".count($images_info)." = '".$item_info["image$x"];
        }
    }
}
$count = count($images_info);
if(empty($item_info)){
    die('Item not found');
}
if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete'){
    $item->query('DELETE FROM items WHERE id = ' . $_REQUEST['id']);
    header('location: ../public/indexAdmin.php');
}
if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'save'){
    for($x=$count+1;$x<=5;$x++){
        $image_string .= "', image".$x." = '";
    }


    $query = sprintf("UPDATE %s SET name = '%s', description = '%s', price = '%.2f', category = '%s', image = '%s%s' WHERE id = %d",
        Items::$table_name, $_REQUEST['name'], $_REQUEST['description'], $_REQUEST['price'],
        $_REQUEST['category'], $images_info[0],$image_string,$_REQUEST['id']);
    echo $query;
    $item ->query($query);
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
    <?php
    if($images_info[0]=="default.png"){
        echo "Current Image:" . $images_info[0] . "<input type='file' name='image[]'><br>";
    }else {
        echo "Current Image:" . $images_info[0] . "<input type='file' name='image[]'> Display <input type='radio' name='select' value='1' checked> Remove <input type='checkbox' name='delete1' value='1'><br>\n";
    }
    for($x=1;$x<$count;$x++){
        $y=$x+1;
        echo "Current Image: $images_info[$x]<input type='file' name='image[]'> Display <input type='radio' name='select' value='$y'>Remove <input type='checkbox' name='delete$y' value='$y'><br>\n";
    }
    for($x=$count+1;$x<=5;$x++){
        echo "Add Image: <input type='file' name='image[]'><br>\n";
    }
    ?>
    <input type="hidden" name="id" value="<?=$item_info['id']?>"><br><br>
    <input type="submit" value="Submit Changes">
    <button type="submit" formaction="../public/indexAdmin.php">Back to Home</button>
</form>
</body>
</html>