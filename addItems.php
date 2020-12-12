<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: ../public/indexLogin.php');
}
include __DIR__ . '/items.php';
include '../manageAdmins/validations.php';

$item = new Items();

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'add'){
    $count=0;
    $count2=1;
    $imageString='';
    $imageString2='';
    $uploadInfo = true;
    $isValid = true;

    if(empty($_REQUEST['name']) || empty($_REQUEST['description']) || empty($_REQUEST['category']) || empty($_REQUEST['price'])){
        //echo "Please fill in the blanks";
        ?>
        <p style="color:red" class="alert-light text-danger text-center py-3"> Please fill in the blanks</p>
        <?php
        $isValid = false;
    }

    if(validate($_REQUEST['price'], 2) == false){
        //echo "Price can only be numeric";
        ?>
        <p style="color:red" class="alert-light text-danger text-center py-3"> Price can only be numeric</p>
        <?php
        $isValid = false;
    }

    //Generates 2 strings for adding images to the query.
    foreach ($_FILES['image'] as $image) {
        if (!$_FILES['image']['name'][$count] == '') {
            $imageString .= ", image";
            if ($count2 > 1) {
                $imageString .= $count2;
                $imageString2 .= "', '";
            }
            $imageString2 .= $_FILES['image']['name'][$count];
            $name_file = "../images/" . basename($_FILES['image']['name'][$count]);
            //attempts to read an image, if reading is unsuccessful that means it's not an image
            $check = getimagesize($_FILES['image']['tmp_name'][$count]);
            if ($check != false) {
                $uploadInfo = true;
            } else {
               ?>
                <p style="color:red" class="alert-light text-danger text-center py-3"> File is not an image</p>
                    <?php
                $uploadInfo = false;
            }
            //checks if file already exists
            if (file_exists($name_file)) {
                ?>
                <p style="color:red" class="alert-light text-danger text-center py-3"> File already exists</p>
                    <?php
                $uploadInfo = false;
            }

            if ($uploadInfo == true && $isValid == true) {
                move_uploaded_file($_FILES['image']['tmp_name'][$count], $name_file);
                $count2++;

            }
            else {

                ?>
         <p style="color:red" class="alert-light text-danger text-center py-3"> Failed to Upload</p>
                 <?php
            }
            }
            $count++;

        }
        if ($imageString == '') {
            $imageString = ", image";
            $imageString2 = "default.png";
        }
        if($uploadInfo == true && $isValid == true) {
            $query = sprintf("INSERT INTO %s (name, description, price, category$imageString) VALUES ('%s', '%s', '%0.2f', '%s', '%s')",
                Items::$table_name, $_REQUEST['name'], $_REQUEST['description'], $_REQUEST['price'], $_REQUEST['category'], $imageString2);

            $item->query($query);

            header('Location: ../public/indexAdmin.php');
        }

        else {
                ?>
                <p style="color:red" class="alert-light text-danger text-center py-3"> Invalid Input</p>
                <?php
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
<form action="?action=add" method="post" enctype="multipart/form-data">
    Title: <input type="text" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>"><br>
    Price: <input type="text" name="price" value="<?php if(isset($_POST['price'])) echo $_POST['price'];?>"><br>
    <label for="category">Add to category:</label>
    <select name="category"id="category">
    <option> <?php if(isset($_REQUEST['category'])) echo $_REQUEST['category']; ?></option>
        <?php
        include_once '../manageCategories/categories.php';
        $category = new Categories();
        $result = $category ->getNames();
        while($row = $result ->fetch_assoc()){
       if($row['name'] != $_REQUEST['category']) echo "<option value=".$row['name'].">".$row['name']."</option>";
        }
        ?>
    </select> <br>
    Description: <br><textarea name="description"><?php if(isset($_POST['description'])) echo $_POST['description']; ?></textarea> <br>
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
