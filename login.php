<?php 

session_start(); 

if(isset($_SESSION['user']) && !empty($_SESSION['user'])) :
    header('Location: /appliedit/index');
    
else :
    require_once("controllers/LoginController.php");

    include("views/layouts/components/header.html");
    include("views/layouts/LoginView.php");
    include("views/layouts/components/footer.html"); 

endif;

?>