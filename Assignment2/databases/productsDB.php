<?php

Class productsDB extends mysqli{
    protected static $instance;
    public function __construct($host = 'localhost', $username = 'root', $password = 'password', $database = 'items',
                                $port = '3306', $socket = false)
    {
        mysqli_report(MYSQLI_REPORT_OFF);
        parent::__construct($host, $username, $password, $database, $port, $socket);
        if($this->connect_errno){
            echo "Connection failed";
        }
    }

    public static function getInstance(){
        if(!self::$instance)
            self::$instance = new self();
        return self::$instance;
    }

   public function query($query, $resultmode = NULL){
               if(!$this->real_query($query)){
                   throw new exception ($this->error, $this->errno);
               }
               return new mysqli_result($this);
   }
}

/*
try{
    $sql = productsDB::getInstance();
    $result = $sql->query("SELECT * FROM items");
    while($row = $result->fetch_assoc()){
        printf("%s (%s) $%s\n", $row['name'], $row['description'], $row['price']);
    }

} catch(Exception $ex){

    echo $ex->getMessage();
} */