<div id="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 d-none d-md-block p-0">
                <div id="bg"></div>
            </div>
            <div class="col-12 col-md-6 white-bg">
                <?php 
                if(isset($_SESSION['error']) && !empty($_SESSION['error'])) : ?>
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <img src="assets/img/icon_error.svg" class="img-responsive"/>
                        <span><?php echo $_SESSION['error']; ?></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div> 
                <?php 
                    unset($_SESSION['error']);
                endif; ?>
                <div class="d-flex justify-content-center h-100">
                    <div id="form">
                        <img src="assets/img/logo_login.svg" class="img-responsive">
                        <h1>Sign in</h1>
                        <h2>Welcome back! Please enter your details</h2>
                        <form action="login" method="POST">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Sign in</button>
                        </form>
                        <div id="powered" class="text-center">
                            <img src="assets/img/powered.svg" class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>