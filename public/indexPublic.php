<?php
include '../manageItems/items.php';
include '../manageCategories/categories.php';
$search = false;
$searchText = "";

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
if(isset($_GET['category'])) {
    $category = new Categories();
    $item = new Items();
    $resultset = $category->getNames();

    while ($rowset = $resultset->fetch_assoc()) {
        if ($_GET['category'] == $rowset['name']) {
            $result = $item->getByCategory($rowset['name']);
            echo "<table>";
        }
    }
}

else if(isset($_GET['search'])){
    $search = true;
    $searchText = $_GET['search'];
    $item = new Items();
    $result = $item->getSearchItems($searchText);
    echo "<table>";

}

else {
    $item = new Items();
    $result = $item->getShowItems();
    echo "<table>";
}
//echo '<table>';
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
//$item = new Items();
//$result = $item->getAll();
?>
</body>
</html>
