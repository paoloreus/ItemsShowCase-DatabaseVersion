<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: indexLogin.php');
}
if(isset($_GET['view'])) {
    if ($_GET['view'] != 'categories') {
        include '../manageItems/items.php';
    }else {
        include '../manageCategories/categories.php';
    }
}else {
    include '../manageItems/items.php';
}

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
        .link-lookalike {
            background: none;
            border: none;
            color: blue;
            cursor: pointer;
        }

        #link:hover {
            text-decoration: underline;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: space-evenly;
        }

        body{
            width:1100px;
            margin: 0 auto;

            height: 100vh;
        }

        table{
            width: 100%;
        }

        table, td, th{

        }
    </style>
    <script LANGUAGE="JavaScript">
        //Author: Jeremy Buchanan
        //Sends a popup requesting confirmation before deleting an item from the database.
        function confirmSubmit2()
        {
            var agree=confirm("Are you sure you wish to delete that item?");
            if (agree)
                return true ;
            else
                return false ;
        }
    </script>
</head>

<body>
<?php
include 'tb_layout.php';
?>
<?php
//loop through the query of category names and print items based on what categories are in database
if((!isset($_GET['view']) || $_GET['view'] != 'categories') && !isset($_GET['category']) && !isset($_GET['search'])) {
    $item = new Items();
    $result = $item->getAll();
    echo '<table>';
    while ($row = $result->fetch_assoc()) {
        printf("<tr>
<td>%d</td>
<td><img src='../images/%s'></td>
<td>%s</td>
<td>%s</td>
<td>$%.2f</td>
<td>%s</td>
<td><a href='../manageItems/itemsManager.php?id=%d'>Edit</a></td>
<td><form method='post' action='..//itemsManager.php'><input type = hidden name = 'id' value='%d'><input type = 'hidden' name = 'action' value='delete'><Input class='link-lookalike' id='link' type='submit' value='Delete' name='Delete' onClick='return confirmSubmit2()'></form></td>
</tr>", $row['id'], $row['image'], $row['name'], $row['description'], $row['price'], $row['category'], $row['id'], $row['id']);
    }
    echo "<td><a href='../manageItems/addItems.php'>Add New Item</a></td>";
    echo '</table>';
}
?>
<?php
include_once '../manageCategories/categories.php';
if(isset($_GET['view']) && $_GET['view'] == 'categories'){
$category = new Categories();
$result = $category ->getAll();
echo '<table>';
while($row = $result ->fetch_assoc()){
    printf("<tr>
<td>%d</td>
<td>%s</td>
<td>%s</td>
<td><a href='../manageCategories/categoriesManager.php?id=%d'>Edit</a></td>
</tr>", $row['id'], $row['name'], $row['description'], $row['id']);
}
echo "<td><a href='../manageCategories/addCategories.php'>Add New Category</a></td>";
echo "<table>";
}


else if(isset($_GET['category'])) {
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
            while ($row = $result->fetch_assoc()) {
                printf("<tr>
<td>%d</td>
<td><img src='../images/%s'></td>
<td>%s</td>
<td>%s</td>
<td>%.2f</td>
<td>%s</td>
<td><a href='../manageItems/itemsManager.php?id=%d'>Edit</a></td>
<td><form method='post' action='..//itemsManager.php'><input type = hidden name = 'id' value='%d'><input type = 'hidden' name = 'action' value='delete'><Input class='link-lookalike' id='link' type='submit' value='Delete' name='Delete' onClick='return confirmSubmit2()'></form></td>
</tr>", $row['id'], $row['image'], $row['name'], $row['description'], $row['price'], $row['category'], $row['id'],
                    $row['id']);
            }

    echo "<table>";

?>

</body>
</html>

