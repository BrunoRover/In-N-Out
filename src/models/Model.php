<?php
require_once __DIR__ . '/../config/database.php';


class Model {
    protected static $tableName = '';
    protected static $columns = [];
    protected $values = []; 

    function __construct($arr, $sanitize = true) {
        $this->loadFromArray($arr, $sanitize);
    }

    public function loadFromArray($arr, $sanitize = true) {
        if ($arr) {
            $conn = DataBase::getConnection();
            foreach ($arr as $key => $value) {
                $cleanValue = $value;
                    if($sanitize && isset($cleanValue)){
                        $cleanValue = strip_tags(trim($cleanValue));
                        $cleanValue = htmlentities($cleanValue, ENT_NOQUOTES);
                        $cleanValue = mysqli_real_escape_string($conn, $cleanValue);
                    }
                $this->$key = $cleanValue; 
            }
            $conn->close();
        }
    }

    public function __get($key) {
        return $this->values[$key] ?? null; 
    }

    public function __set($key, $value) {
        $this->values[$key] = $value;
    }

    public function getValues(){
        return $this->values;
    }

    public static function getOne($filters = [], $columns = '*') {
        $class = get_called_class();
        $result = static::getResultFormSelect($filters, $columns);

        return $result ? new $class($result->fetch_assoc()) : null; 
    }

    public static function get($filters = [], $columns = '*') {
        $objects = [];
        $result = static::getResultFormSelect($filters, $columns);
        if ($result) {
            $class = get_called_class();
            while ($row = $result->fetch_assoc()) {
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }

    public static function getResultFormSelect($filters = [], $columns = '*') {
        $sql = "SELECT {$columns} FROM " . static::$tableName . " " . static::getFilters($filters);
        $result = DataBase::getResultFromQuery($sql);
        return ($result->num_rows === 0) ? null : $result; 
    }

    public function insert() {
        $sql = "INSERT INTO " . static::$tableName . " (" . implode(",", static::$columns) . ") VALUES (";

        foreach (static::$columns as $col) {
            $sql .= static::getFormatedValue($this->$col) . ","; 
        }

        $sql = rtrim($sql, ',') . ')'; 
        $id = DataBase::executeSQL($sql);
        $this->id = $id; 
    }

    public function update(){
        $sql = "UPDATE " . static::$tableName . " SET ";
        foreach(static::$columns as $col){
            $sql .= "{$col} = " . static::getFormatedValue($this->$col) . ",";
        }
        $sql = rtrim($sql, ',') . ' '; 
        $sql .= "WHERE id = {$this->id}";
        DataBase::executeSQL($sql);
    }

    public static function getCount($filters = []){
        $result = static::getResultFormSelect($filters, 'count(*) as count');
        return $result->fetch_assoc()['count'];
    }

    public static function deleteById($id){
        $sql = "DELETE FROM " . static::$tableName . " WHERE id = {$id}";
        DataBase::executeSQL($sql);

    }

    private static function getFilters($filters) {
        $sql = '';
        if (count($filters) > 0) {
            $sql .= "WHERE 1 = 1";
            foreach ($filters as $columns => $value) {
                if($columns == 'raw'){
                $sql .= " AND {$value}";
                }else{
                $sql .= " AND {$columns} = " . static::getFormatedValue($value);
                }
            }
        }
        return $sql;
    }

    private static function getFormatedValue($value) {
        if (is_null($value)) {
            return "null";
        } elseif (gettype($value) === "string") {
            return "'{$value}'";
        } else {
            return $value;
        }
    }
}
