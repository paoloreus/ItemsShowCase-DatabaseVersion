<?php
include __DIR__ . '/../databases/productsDB.php';

class Categories extends productsDB{
    public static $table_name = 'categories';
    protected static $fields = array(
        'id' => '',
        'name' => '',
        'description' => ''
    );

    public function getAll(){
        return $this->query('SELECT * FROM ' . self::$table_name);
    }

    public function getById($id){
        return $this->query('SELECT * FROM ' . self::$table_name . ' WHERE id = ' . $id);
    }
}

/*
$category = new Categories();
$result = $category ->getAll();

while($row = $result ->fetch_assoc()){
    printf("%d - %s (%s) <br>", $row['id'], $row['name'], $row['description']);
}

$row = $category ->getById(1) ->fetch_assoc();
printf("%d - %s (%s) <br>", $row['id'], $row['name'], $row['description']);
*/