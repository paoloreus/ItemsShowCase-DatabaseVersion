<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: ../public/indexLogin.php');
}
include __DIR__ . '/items.php';

$item = new Items();

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'add'){
    $count=0;
    $count2=1;
    $imageString='';
    $imageString2='';

    //Generates 2 strings for adding images to the query.
    foreach ($_FILES['image'] as $image){
        if(!$_FILES['image']['name'][$count]=='') {
            $imageString .= ", image";
            if ($count2 > 1) {
                $imageString .= $count2;
                $imageString2 .= "', '";
            }
            $imageString2 .= $_FILES['image']['name'][$count];
            $name_file = "../images/" . basename($_FILES['image']['name'][$count]);
            move_uploaded_file($_FILES['image']['tmp_name'][$count], $name_file);
            $count2++;
        }
        $count++;
    }
    if($imageString==''){
        $imageString = ", image";
        $imageString2= "default.png";
    }
    $query = sprintf("INSERT INTO %s (name, description, price, category$imageString) VALUES ('%s', '%s', '%0.2f', '%s', '%s')",
        Items::$table_name, $_REQUEST['name'], $_REQUEST['description'], $_REQUEST['price'], $_REQUEST['category'],$imageString2);

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
    Image: <input type="file" name="image[]"><br>
    Image2: <input type="file" name="image[]"><br>
    Image3: <input type="file" name="image[]"><br>
    Image4: <input type="file" name="image[]"><br>
    Image5: <input type="file" name="image[]"><br><br>
    <input type="submit" value="Add New Item">
    <button type="submit" formaction="../public/indexAdmin.php">Back to Home</button>
</form>
</body>
</html>
