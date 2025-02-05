<?php
session_start();

include_once 'models/UserModel.php';

if(isset($_POST) && !empty($_POST)) :
    if(isset($_SESSION['user'])) : 
        $userModel = new UserModel($_SESSION['user']);
        $userModel->logOutUser();
    endif;
else : 
    header('Location: /'.getenv('SERVER').'/login');
endif;

?>