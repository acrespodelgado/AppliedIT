<?php 

    include 'models/UserModel.php';

    /*
    function validate_password($password) {
        // La contraseña debe tener al menos 8 caracteres, una letra mayúscula, una letra minúscula, un número y un caracter especial
        $regex = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9]).{8,}$/';
        return preg_match($regex, $password);
    }
    */

    if(isset($_POST['email']) && !empty($_POST['email']) && 
        isset($_POST['password']) && !empty($_POST['password'])) :

        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) :
            $email = $_POST['email'];

        else : 
            $_SESSION['error'] = "Your email is not valid, please try again.";

        endif;
        
        $password = $_POST['password'];

        $userMod = new UserModel($email, $password);
        $user = $userMod->logInUser();

        if($user) :
            $_SESSION['user'] = $userMod->getEmail();
            header('Location: /'.getenv('SERVER').'/index');

        else :
            $_SESSION['error'] = "Your email or password is incorrect, please try again.";
        endif;
    
    elseif(isset($_POST['email']) && empty($_POST['email']) || isset($_POST['password']) && empty($_POST['password'])) :
        $_SESSION['error'] = "Complete the form before send it.";

    endif;

?>