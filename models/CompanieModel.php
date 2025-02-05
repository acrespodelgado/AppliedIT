<?php 

class CompanieModel {

    public $db;
    private $table = 'companie';

    public function __construct() {
        //Por posible compatibilidad con bases de datos futuras, utilizaré el PDO de php en lugar de mysqli
        //PDO Tiene proteccion contra sqlinjection

        $con = "mysql:host=".getenv('DB_HOST').";dbname=".getenv('DB_NAME');
        $this->db = new PDO($con, getenv('DB_USER'), '');
    }

    public function getCompanies() {
        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCompanie($id) {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}



?>