<?php 

class UserModel {

    public $db;
    private $table = 'user';

    private $email;
    private $username;
    private $password;
    private $admin;

    public function __construct($email, $password = null) {
        //Por posible compatibilidad con bases de datos futuras, utilizaré el PDO de php en lugar de mysqli
        //PDO Tiene proteccion contra sqlinjection

        $con = "mysql:host=".getenv('DB_HOST').";dbname=".getenv('DB_NAME');
        $this->db = new PDO($con, getenv('DB_USER'), '');

        //Encriptado md5 para password
        if($password) : $password = hash('md5', $password); endif;

        $this->email = $email;
        $this->password = $password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function createUser() {
        $sql = "INSERT INTO " . $this->table . " (email, username, password) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($this->email, $this->username, $this->password));

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function logInUser() {
        $sql = "SELECT * FROM " . $this->table . " WHERE email = ? AND password = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($this->email, $this->password));
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        if($res) :
            $this->username = $res['username'];
            $this->admin = $res['admin'];
            
        endif;

        return $res;
    }

    public function logOutUser() {
        unset($this->email);
        unset($this->username);
        unset($this->password);
        unset($this->admin);
        session_unset();
        session_destroy();
    }
}



?>