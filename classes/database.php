<?php
class Database extends mysqli {
    private static $dbConnection = null;
    
    /*
     * Verbinden mit Datenbank
     */
    public static function getConnexion(){
        if(self::$dbConnection == null){
            self::$dbConnection = new mysqli(DB_HOST, DB_USER, DB_PW, DB_DB);
            self::$dbConnection->query("SET NAMES utf8");
            if (self::$dbConnection->connect_errno) {
                printf("Connect failed: %s\n", self::$dbConnection->connect_error);
                exit();
            }
           
        }
        
        return self::$dbConnection;
    }
    
    /*
     * Daten auslesen aus Datenbank
     */
    public static function getData($sql){
        $query = self::getConnexion()->query($sql);
        if (!$query) {
            $retval = printf("Errormessage: %s\n", self::$dbConnection->error);
            $retval .= printf("SQL: %s\n", $sql);
        }
        else{
            $retval = $query;
        }
        return $retval;
    }
    
    /*
     * Daten speichern
     */
    public static function saveData($table, $data, $where){
        $sql = "";
        if(empty($where)){
            $sql .= "INSERT INTO " . $table;
        }
        else{
            $sql .= "UPDATE " . $table;
        }
        
        $sql .= " SET ";
        $first = true;
        foreach($data as $key => $value){
            if(!empty($value)){
                if($first == true){
                    $sql .= $key . " = '" . $value . "'";
                    $first = false;
                }
                else{
                    $sql .= ", " . $key . " = '" . $value . "'";
                }
            }
            else{
                if($key != "id" && $value == 0){
                    $sql .= ", " . $key . " = NULL ";
                }
            }
        }
        
        if(!empty($where)){
            $sql .= " WHERE " . $where;
        }
        
        self::getData($sql);
        $lastInsertedId = self::getConnexion()->insert_id;
        return $lastInsertedId;
    }
    
    /*
     * Daten löschen
     */
    public static function deleteData($table, $where){
        $sql = "DELETE FROM " . $table . " " . $where;
        self::getData($sql);
    }
} 