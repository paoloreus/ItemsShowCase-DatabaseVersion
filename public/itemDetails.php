<?php
include '../manageItems/items.php';
include '../manageCategories/categories.php';
if(isset($_REQUEST['id'])) {
    $item = new Items();
    $activeItem = $item->getById($_REQUEST['id'])->fetch_assoc();
    $cookie_name = "View" . $activeItem['id'];
    if (!isset($_COOKIE[$cookie_name])) {
        setcookie($cookie_name, "viewed", time() + (86400 * 30), "/"); // 86400 = 1 day
        $activeItem['views']++;
        $query = sprintf("UPDATE %s SET views = %d WHERE id = %d",
            Items::$table_name, $activeItem['views'], $activeItem['id']);
        $item ->query($query);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy For Fun</title>

    <style>
        nav ul{
            list-style: none;
            display: flex;
            justify-content: space-evenly;
        }

        body{
            width: 1100px;
            margin: 0 auto;
            height: 100vh;
        }

        table{
            width: 100%;
        }
    </style>
</head>
<body>
<?php
include 'nav.php';
include 'tb_layout_public.php';
if(isset($_REQUEST['id'])) {
    $imageString = "<td><img src='../images/".$activeItem['image']."'</td>\n";
    for ($x=2;$x<=5;$x++) {
        if ($activeItem['image' . $x] != '') {
            $imageString .= "<td><img src='../images/" . $activeItem['image' . $x] . "'</td>\n";
        }
    }
    echo "<table>";
    printf("<tr>
<td>ID: %d</td>
<td>Views: %d</td>
<td>Name: %s</td>
<td>Description: %s</td>
<td>Price: $%.2f</td>
<td>Category: %s</td>
</tr><tr>
$imageString
</tr>
", $activeItem['id'], $activeItem['views'], $activeItem['name'], $activeItem['description'], $activeItem['price'], $activeItem['category']);
    echo '</table>';
}
?>
</body>
</html>
