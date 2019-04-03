<?php
class User {
    private $id;
    private $name;
    private $password;
    private $coins;
    private $lastonline;
    private $serie;
    
/* Constructor */
    public function __construct($id = null) {
        if(!is_null($id)){
            $sql = "SELECT * FROM `user` WHERE `id` = " . $id;
            $result = database::getData($sql);
            $res = $result->fetch_assoc();
            $this->id = $res['id'];
            $this->name = $res['name'];
            $this->password = $res['password'];
            $this->coins = $res['coins'];
            $this->lastonline = new DateTime($res['lastonline']);
            $this->serie = $res['serie'];
        }
    }
    
/* Insert + Update */
    public function save(){
        $data = array(
            'id' => $this->id,
            'name' => $this->name,
            'password' => $this->password,
            'coins' => $this->coins,
            'lastonline' => $this->lastonline->format("Y-m-d H:i:s"),
            'serie' => $this->serie,
        );
        
        if(!is_null($this->id)){
            $where = " `id` = " . $this->id;
        }
        else {
            $where = "";
        }
        
        $this->id = Database::saveData("user", $data, $where);
    }
    

    public function setId($id){
        $this->id = $id;
        return $this;
    }
    public function setUsername($name){ 
        $this->name = $name;
        return $this;
    }
    public function setPassword($password){
        $this->password = $password;
        return $this;
    }
    public function setCoins($coins){
        $this->coins = $coins;
        return $this;
    }
    public function setLastonline($lastonline){
        $this->lastonline = $lastonline;
        return $this;
    }
    public function setSerie($serie){
        $this->serie = $serie;
        return $this;
    }

    
/* Getter */
    public function getId(){
        return $this->id;
    }
    public function getUsername(){
        return $this->name;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getCoins(){
        return $this->coins;
    }
    public function getLastonline(){
        return $this->lastonline;
    }
    public function getSerie(){
        return $this->serie;
    }
}