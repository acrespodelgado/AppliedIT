<?php 

    include 'models/UserModel.php';
    include 'models/CompanyModel.php';

    function isValidId($id, $array) {
        $idArray = array_column($array, "id");
        return in_array($id, $idArray);
    }

    function validateRegex($value, $regex, $errorMsg) {
        $res = preg_match($regex, $value);
    
        if (!$res) :
            $_SESSION['error'] = $errorMsg;
        endif;
        
        return $res;
    }

    function validateField($value, $errorMsg, $type = null) {
        if(empty($value)) :
            $_SESSION['error'] = $errorMsg;

            return false;
        
        elseif($type) :
            switch($type) : 
                case 'email' :
                    validateRegex($value, '/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/', $errorMsg);
                break;
                
                case 'tax_number' :
                    validateRegex($value, '/^[A-Z]\d{8}$/i', $errorMsg);
                break; 

                case 'phone_number' :
                    validateRegex($value, '/^(\+\d{1,3}[\s-]?)?\(?\d{3}\)?[\s-]?\d{3}[\s-]?\d{3,4}$/', $errorMsg);
                break;

                case 'employees' :
                    if(is_numeric($value)) :
                        return true;
                    
                    else :
                        $_SESSION['error'] = $errorMsg;
                    
                    endif;
                break;
            endswitch;
        else :
            return true;

        endif;
    }

    if(isset($_SESSION['user']) && !empty($_SESSION['user'])) :
        $companyMod = new CompanyModel();
        $_SESSION['companies'] = $companyMod->getCompanies();
        $_SESSION['countries'] = $companyMod->getCountries();
        $_SESSION['activities'] = $companyMod->getActivities();

        $id = $_POST['id'] ?? '';
        $id = intval($id);

        //Recibo formulario
        if(isset($_POST['form']) && !empty($_POST['form'])) :
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $country = $_POST['country'] ?? '';
            $activity = $_POST['activity'] ?? '';
            $tax_number = $_POST['tax_number'] ?? '';
            $employees = $_POST['employees'] ?? '';
            $phone_number = $_POST['phone_number'] ?? '';
            $zip_code = $_POST['zip_code'] ?? '';

            if (!validateField($name, "Invalid name, please try again") ||
                !validateField($email, "Invalid email, please try again") ||
                !validateField($country, "Invalid country, please try again") ||
                !validateField($activity, "Invalid activity, please try again") ||
                !validateField($tax_number, "Invalid tax number, write a valid tax number. Ej: D12345678") ||
                !validateField($employees, "Invalid employees, write a valid number") || 
                !validateField($phone_number, "Invalid phone number, write a valid phone number. Ej: +34 666 111 222") ||
                !validateField($zip_code, "Invalid zip code, please try again")) :

            else :
                $company = new CompanyModel($_POST);
    
                //Actualizo company
                if(!empty($id)) :
                    if($company->editCompany($id)) :
                        $_SESSION['company'] = $companyMod->getCompany($id);
                        $_SESSION['success'] = "Company successfully updated";

                    else :
                        $_SESSION['error'] = "Error updating Company";

                    endif;

                //Creo nueva company
                else :
                    if($company->addCompany()) :
                        $_SESSION['success'] = "Company successfully created";

                    else :
                        $_SESSION['error'] = "Error creating Company";

                    endif;
                endif;
            endif;

        //Elimino company
        elseif(isset($_POST['delete']) && !empty($_POST['delete'])) :
            if($companyMod->deleteCompany($id)) :
                $_SESSION['success'] = "Company successfully deleted";
                
            else :
                $_SESSION['error'] = "Error deleting Company";

            endif;
            //header('Location: /'.getenv('SERVER').'/index');
            
        //Devuelvo datos de la company
        elseif(isset($_POST['view']) && !empty($_POST['view'])) :
            $_SESSION['company'] = $companyMod->getCompany($id);

            header('Location: /'.getenv('SERVER').'/panel');

        endif;
    
    else :
        $_SESSION['error'] = "Login to see the panel.";
        header('Location: /'.getenv('SERVER').'/login');

    endif;
?>