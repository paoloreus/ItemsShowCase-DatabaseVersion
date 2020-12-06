<?php
include '../manageItems/items.php';
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
?>
<?php
$item = new Items();
$result = $item->getAll();
echo '<table>';
while($row = $result ->fetch_assoc()){
    printf("<tr>
<td>%d</td>
<td><img src='../images/%s'</td>
<td>%s</td>
<td>%s</td>
<td>$%.2f</td>
<td>%s</td>
</tr>
", $row['id'], $row['image'], $row['name'], $row['description'], $row['price'], $row['category']);
}
echo '</table>'
?>
</body>
</html>
