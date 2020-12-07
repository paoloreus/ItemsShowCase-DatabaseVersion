<?php
$name_dir ="../images/";
$name_file =$name_dir . basename($_FILES["image"]["name"]);
$upload_info = 1;
$imageType =strtolower(pathinfo($name_file, PATHINFO_EXTENSION));

if(isset($_POST['submit'])){
$check =getimagesize($_FILES["image"]["tmp_name"]);
if($check != false){
echo "File is valid <br>" . "File Type: " . $check["mime"] ."<br>";
$upload_info = 1;
}
else {
echo "File is not an image <br>";
$upload_info = 0;
}
}

if(file_exists($name_file)){
echo "Error: File already exists <br>";
$upload_info = 0;
}

if($_FILES["image"]["size"] > 10000000){
echo "Error: File cannot be larger than 10mb <br>";
$upload_info = 0;
}

if($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif"){
echo "Error: File format is not valid <br>";
$upload_info = 0;
}

if($upload_info == 0){
echo "Error: Failed to upload file <br>";
}
else {
if(move_uploaded_file($_FILES["image"]["tmp_name"], $name_file)){
echo "File " .htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded";
}
else {
echo "Error: Failed to upload file <br>";
}
}
?>