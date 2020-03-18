<?php
//-----------------------------------------------------------------------------
// Подключение для Админки / Защищенное .. 
//-----------------------------------------------------------------------------
Class DB {
    protected static $_instance;  //экземпляр объекта
    
    public static function getInstance() {  // получить экземпляр данного класса 
        if (self::$_instance === null) {    // если экземпляр данного класса  не создан
            self::$_instance = new self;    // создаем экземпляр данного класса 
        } 
        return self::$_instance; // возвращаем экземпляр данного класса
    }
    
    // конструктор отрабатывает один раз при вызове DB::getInstance();
    private  function __construct() {
        //подключаемся к хосту
        try {
            $this->connect = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connect->exec("set names utf8");
        } catch (PDOException $e) {
            exit('Невозможно выбрать указанную базу - ' . $e->getMessage());
        }
    }
    
    //запрещаем слонирование объекта модификатором private
    private function __clone() {}
    
    //запрещаем слонирование объекта модификатором private
    private function __wakeup() {}

    /***
     * Для выборки SELECT
     *
     * @param $sql
     * @return bool
     */
    public static function query ($sql) {
        //Запуск __construct () 
        DB::getInstance();
        //Соеденение ..
        $obj        = self::$_instance;
        $connect    = $obj->connect;

        if(isset($connect)){
            try {
                $stmt = $connect->query($sql);
            } catch (PDOException $e) {
                exit('<br/><span style="color:red">Ошибка в SQL запросе: </span>' . $e->getMessage());
            }
            return $stmt;
        }
        return false;
    }

    /***
     * Для изменений INSERT, UPDATE, DELETE
     *
     * @param $sql
     * @return bool
     */
    public static function exec ($sql) {
        //Запуск __construct ()
        DB::getInstance();

        $obj        = self::$_instance;
        $connect    = $obj->connect;

        if(isset($connect)){
            try {
                $stmt = $connect->exec($sql);
            } catch (PDOException $e) {
                exit('<br/><span style="color:red">Ошибка в SQL запросе: </span>' . $e->getMessage());
            }
            return $stmt;
        }
        return false;
    }

    //возвращает все записи
    public static function fetchAll ($stmt) {
        return $stmt->fetchALL(PDO::FETCH_OBJ);
    }

    //возвращает запись в виде объекта / OBJECT
    public static function fetchObject($stmt) {
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    //возвращает запись в виде массива / ARRAY NUM
    public static function fetchNum($stmt) {
        return $stmt->fetch(PDO::FETCH_NUM);
    }
    
    //ASSOC
    public static function fetchAssoc($stmt) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    //mysql_insert_id() возвращает ID,
    public static function lastInsertId() {
        $obj        = self::$_instance;
        return $obj->connect->lastInsertId();
    }

    // Аналог mysql_real_escape_string
    public static function quote ($string) {
        $obj = self::$_instance;
        return $obj->connect->quote($string);
    }

    // аналог mysql_num_rows
    public static function numRows($stmt) {
        return $stmt->rowCount();
    }
}

?>