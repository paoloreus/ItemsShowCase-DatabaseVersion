<?php
include_once __DIR__ . '/../databases/productsDB.php';

class Items extends productsDB{
    public static $table_name = 'items';
    protected static $fields = array(
        'id' => '',
        'name' => '',
        'description' => '',
        'price' => 0,
        'category' => '',
        'image' => '',
        'image2' => '',
        'image3' => '',
        'image4' => '',
        'image5' => '',
        'views' => ''
    );

    public function getAll(){
        return $this->query('SELECT * FROM ' . self::$table_name);
    }

    public function getById($id){
        return $this->query('SELECT * FROM ' . self::$table_name . ' WHERE id = ' . $id);
    }

    public function getByCategory($category){
        return $this->query('SELECT * FROM ' . self::$table_name . ' WHERE category = ' . "'$category'");
    }

}

/*
$item = new Items();
$result = $item ->getByName("Ford Mustang");

while($row = $result->fetch_assoc()){
    printf("%d - %s (%s) $%.2f %s <br>", $row['id'], $row['name'], $row['description'], $row['price'], $row['category']);
}

$row = $item -> getById(1) ->fetch_assoc();
printf("%d - %s (%s) $%.2f %s <br>", $row['id'], $row['name'], $row['description'], $row['price'], $row['category']);
*/
