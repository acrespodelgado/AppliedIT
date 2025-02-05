<?php 

session_start(); 

if(isset($_SESSION['user']) && !empty($_SESSION['user'])) :
    if(isset($_SESSION['success'])) :
        unset($_SESSION['success']);

    endif;

    if(isset($_SESSION['error'])) :
        unset($_SESSION['error']);
        
    endif;
    
    require_once("controllers/PanelController.php");

    include("views/layouts/components/header.html");
    include("views/layouts/PanelFormView.php");
    include("views/layouts/components/footer.html"); 

else :
    $_SESSION['error'] = "Please log in before access the panel";
    header('Location: /'.getenv('SERVER').'/login');

endif;

?>