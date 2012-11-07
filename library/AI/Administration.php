<?php 

class AI_Administration
{

    var $adminLogin = "root";
    var $adminPassword = "mot2passe";

    /*
       Create Sql user
       Only mysql admin can do that.
     */

    public static function createSqlUser($user, $password){

        $conn = new mysqli("localhost", $this->adminLogin, $this->adminPassword);

        if (mysqli_connect_errno()) {
            exit('Connection failed'. mysqli_connect_error());
        }

        $sql = "CREATE USER '$user'@'localhost' IDENTIFIED BY '$password';";

        if ($conn->query($sql) === TRUE) {
            echo "User in Database selected: " . $user . "<br/>";
        } else {
            echo "Error: " . $conn->error . "<br/>";
        }
    }

    /*
       Create user database
       Only mysql admin can do that.
     */

    public static function createUserDatabase($user){
        
        $conn = new mysqli("localhost", $this->adminLogin, $this->adminPassword);

        if (mysqli_connect_errno()) {
            exit('Connection failed'. mysqli_connect_error());
        }

        $sql = "CREATE DATABASE `$user`;";

        if ($conn->query($sql) === TRUE) {
            echo "User Database created: " . $user . "<br/>";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    /*
       Set permission user database
       Only mysql admin can do that.
     */

    public static function setPermissionUserDatabase($user, $password){
        
        $conn = new mysqli("localhost", $this->adminLogin, $this->adminPassword);

        if (mysqli_connect_errno()) {
            exit('Connection failed'. mysqli_connect_error());
        }
        $sql = "GRANT ALL PRIVILEGES ON `$user`.* TO '$user'@'localhost';";

        if ($conn->query($sql) === TRUE) {
            echo "User Permission Database created: " . $user . "<br/>";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    /*
       Remove user database
       Only mysql admin can do that
     */

    public static function removeUserDatabase($user){
        
        $conn = new mysqli("localhost", $this->adminLogin, $this->adminPassword);

        if (mysqli_connect_errno()) {
            exit('Connection failed: '. mysqli_connect_error());
        }

        $sql = "DROP DATABASE " . $user . ";";

        if ($conn->query($sql) === TRUE) {
            echo "User Database removed " . $user . "<br/>";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    /*
       Remove software database by user
     */

    public static function removeSoftwareDatabaseByUser($user, $password, $software){
        $conn = new mysqli("localhost", $user, $password);

        if (mysqli_connect_errno()) {
            exit('Connection failed'. mysqli_connect_error());
        }

        $sql = "USE " . $user . ";";

        if ($conn->query($sql) === TRUE) {
            echo "Database selected: " . $user . "<br/>";
        } else {
            echo "Error: " . $conn->error;
        }

        $sql = "DROP TABLE " . $software . "_* ;";

        if ($conn->query($sql) === TRUE) {
            echo "Software selected: " . $user . "<br/>";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    /*
       Remove User in database	
     */

    public static function removeUserInDatabase($user, $password){
        
        $conn = new mysqli("localhost", $this->adminLogin, $this->adminPassword);

        if (mysqli_connect_errno()) {
            exit('Connection failed: '. mysqli_connect_error());
        }

        $sql = "DELETE FROM `mysql`.`user` WHERE `user`.`User` =  '" . $user . "';";

        if ($conn->query($sql) === TRUE) {
            echo "User Database in Database removed " . $user . "<br/>";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    /*
       Remove UserDatabase in database
     */

    public static function removeUserDatabaseInDatabase($user, $password){
        
        $conn = new mysqli("localhost", $this->adminLogin, $this->adminPassword);

        if (mysqli_connect_errno()) {
            exit('Connection failed: '. mysqli_connect_error());
        }

        $sql = "DELETE FROM `mysql`.`db` WHERE `db`.`Db` = '" . $user . "' AND `db`.`User` =   '" . $user . "';";

        if ($conn->query($sql) === TRUE) {
            echo "Database removed " . $user . "<br/>";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    /*
       Create user
     */

    public static function createUser($user, $password){
        createUserSite($user);
        createSqlUser($user, $password);
        createUserDatabase($user);
        setPermissionUserDatabase($user, $password);
    }


    /*
       Create user site
     */

    public static function createUserSite($user){
        mkdir("../../sites/" . $user);
    }
    /*
       Remove user site
     */

    public static function removeUserSite($site) {	
        if (is_dir ($site)) {
            $dh = opendir ($site); 
        }else {     
            exit;
        }

        while (($file = readdir ($dh)) !== false ) { 
            if ($file !== '.' && $file !== '..') { 
                $path = $site.'/'.$file;
                if (is_dir ($path)) {           
                    removeUserSite($path); 
                    rmdir($path);
                }else {   
                    unlink($path);
                }
            }
        }
        closedir ($dh); 
    }
    /*
       Desactivate user site
     */

    public static function activateUserSite($user){
    }
}
?>


