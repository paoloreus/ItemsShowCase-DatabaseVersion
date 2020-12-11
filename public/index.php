<?php
include '../manageItems/items.php';
include '../manageCategories/categories.php';
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
$item = new Items();
        $result = $item->query("SELECT * FROM items i join categories c on i.category = c.name where c.status='SHOW' LIMIT 5");
        echo "<table>
<tr>
<td>Id</td>
<td>Image</td>
<td>Name</td>
<td>Description</td>
<td>Price</td>
<td>Category</td>
</tr>";
            while ($row = $result->fetch_assoc()) {
                    printf("<tr>
<td>%d</td>
<td><img src='../images/%s'</td>
<td><a href='itemDetails.php?id=%d'>%s</a></td>
<td>%s</td>
<td>$%.2f</td>
<td>%s</td>
</tr>
", $row['id'], $row['image'], $row['id'], $row['name'], $row['description'], $row['price'], $row['category']);
            }
echo '</table>';
?>
</body>
</html>
