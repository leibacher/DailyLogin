 <?php
class UsserSelect {
    
/* Get all users from database */
    public static function selectUsers(){
        $retval = array();
        $sql = "SELECT * FROM `user`";
        $result = database::getData($sql);
        while($res = $result->fetch_assoc()){
            $retval[] = new User($res['id']);
        }
        return $retval;
    }

/* Get the user by his username and password */
    public static function selectUserByLogin($username, $password){
        $username = trim($username);
        $password = trim($password);
        $username = htmlspecialchars($username);
        $password = htmlspecialchars($password);
        $username = database::getConnexion()->real_escape_string($username);
        $password = database::getConnexion()->real_escape_string($password);
        $where = " WHERE 1=1 ";
        if(!empty($username)){
            $where .= " AND `name` = '" . $username. "'";
        }
        if(!empty($password)){
            $where .= " AND `password` = '" . $password. "'";
        }
        $sql = "SELECT * FROM `user` ".$where;
        $result = database::getData($sql);
        $res = $result->fetch_assoc();
        $retval = new User($res['id']);
        return $retval;
    }
}