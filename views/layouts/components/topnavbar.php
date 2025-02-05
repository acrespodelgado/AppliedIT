<div id="topnavbar" class="grey-bg">
    <?php  
    if(isset($_SESSION['success']) && !empty($_SESSION['success'])) : ?>
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <img src="assets/img/icon_ok.svg" class="img-responsive"/>
        <span><?php echo $_SESSION['success']; ?></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <?php 
        //unset($_SESSION['success']);
    endif; ?>

    <?php 
    if(isset($_SESSION['error']) && !empty($_SESSION['error'])) : ?>

    <div class="alert alert-error d-flex align-items-center" role="alert">
        <img src="assets/img/icon_error.svg" class="img-responsive"/>
        <span><?php echo $_SESSION['error']; ?>
        </span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <?php
        //unset($_SESSION['error']);
    endif; ?>