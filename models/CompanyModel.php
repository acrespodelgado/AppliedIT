<?php 

//Por posible compatibilidad con bases de datos futuras, utilizaré el PDO de php en lugar de mysqli
//PDO Tiene proteccion contra sqlinjection

class CompanyModel {

    public $db;
    private $table = 'company';

    private $name;
    private $tax_number;
    private $employees;
    private $country;
    private $zip_code;
    private $email;
    private $phone_number;
    private $activity;
    private $risk;
    private $payment;

    public function __construct(array $data = null) {
        $con = "mysql:host=".getenv('DB_HOST').";dbname=".getenv('DB_NAME');
        $this->db = new PDO($con, getenv('DB_USER'), '');

        if(!is_null($data)) :
            $this->name = $data['name'];
            $this->tax_number = $data['tax_number'];
            $this->employees = intval($data['employees']);
            $this->country = $data['country'];
            $this->zip_code = $data['zip_code'];
            $this->phone_number = $data['phone_number'];
            $this->activity = $data['activity'];
            $this->payment = $data['payment'];

            if(filter_var($data['email'], FILTER_VALIDATE_EMAIL)) :
                $this->email = $data['email'];

            endif;

            $this->risk = isset($data['risk']) ? 1 : 0;

        endif;
    }

    public function getCountries() {
        $sql = "SELECT * FROM country";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getActivities() {
        $sql = "SELECT * FROM activity";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getCompanies() {
        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCompany($id) {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addCompany() {
        $sql = "INSERT INTO " . $this->table . " VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $res = $stmt->execute([
            0,
            $this->name,
            $this->tax_number,
            $this->employees,
            $this->country,
            $this->zip_code,
            $this->email,
            $this->phone_number,
            $this->activity,
            $this->risk,
            $this->payment
        ]);

        return $res;
    }

    public function editCompany($id) {
        $sql = "UPDATE " . $this->table . " SET 
            name = ? ,
            tax_number = ? ,
            employees = ? ,
            countryId = ? ,
            zip_code = ? ,
            email = ? ,
            phone_number = ? ,
            activityId = ? ,
            risk = ? ,
            payment = ? 
        WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $res = $stmt->execute([
            $this->name,
            $this->tax_number,
            $this->employees,
            $this->country,
            $this->zip_code,
            $this->email,
            $this->phone_number,
            $this->activity,
            $this->risk,
            $this->payment,
            $id
        ]);

        return $res;
    }

    public function deleteCompany($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $res = $stmt->execute([$id]);
        
        return $res;
    }
}

?>