<?php 

session_start(); 

if(isset($_SESSION['user']) && !empty($_SESSION['user'])) :
    if(isset($_SESSION['company'])) :
        unset($_SESSION['company']);

    endif;

    require_once("controllers/PanelController.php");

    include("views/layouts/components/header.html");
    include("views/layouts/PanelView.php");
    include("views/layouts/components/footer.html"); 

else :
    $_SESSION['error'] = "Please log in before access the panel";
    header('Location: /'.getenv('SERVER').'/login');

endif;

?>