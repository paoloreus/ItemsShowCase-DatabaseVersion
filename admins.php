<?php
include __DIR__ . '/../databases/productsDB.php';

class Admins extends productsDB{
public static $table_name = 'members';
protected static $fields = array(
    'id' => '',
    'firstname' => '',
    'lastname' => '',
    'username' => '',
    'email' => '',
    'password' => '',
);

public function getAll(){
    return $this->query('SELECT * FROM ' . self::$table_name);
}

public function getById($id){
    return $this->query('SELECT * FROM ' . self::$table_name . ' WHERE id = ' . $id);
}

public function getLogin($username, $password){
    return $this->query('SELECT * FROM ' . self::$table_name . ' WHERE username = ' . "'$username'".
    ' AND password = ' . "'$password'");
}

public function updatePassword($username, $oldpassword, $newpassword){
    return $this->query("UPDATE " . self::$table_name . " SET password = " . "'$newpassword'" . " WHERE username = " .
    "'$username'" . " AND password = " . "'$oldpassword'");
}



}


/*$admin = new Admins();
$result = $admin ->getAll();
//print_r($result);
while($row = $result ->fetch_assoc()){
    printf('%s %s %s %s <br>', $row['username'], $row['password'], $row['firstname'], $row['lastname']);
}*/
