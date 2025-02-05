<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-3 p-0">
            <?php include 'components/leftsidebar.php'; ?>
        </div>
        <div class="col-12 col-lg-9 p-0 grey-bg">
            <?php include 'components/topnavbar.php'; ?>
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-12">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active"><a href="/index">Administration</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-8">
                            <h1>Companies</h1>
                        </div>
                        <div class="col-12 col-lg-4 d-flex right-md">
                            <a href="panel" class="btn btn-primary"><img src="assets/img/icon_add.svg" class="img-responsive">New Company</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-container">
                <div class="white-bg">
                    <div class="table-padding table-responsive">
                        <?php 
                        if(isset($_SESSION['companies']) && !empty($_SESSION['companies'])) : ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Tax number</th>
                                    <th scope="col">Employees</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach($_SESSION['companies'] as $company) : ?>
                                <tr>
                                    <td>#<?php echo $company['id']; ?></th>
                                    <td><?php echo $company['name']; ?></td>
                                    <td><?php echo $company['tax_number']; ?></td> 
                                    <td><img src="assets/img/icon_employees.png" class="img-responsive icon_employees"><?php echo $company['employees']; ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                                <img src="assets/img/icon_menu.svg" class="img-responsive">
                                            </button>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <button class="dropdown-item" onclick="viewCompany(<?php echo $company['id']; ?>)"><img src="assets/img/icon_edit.svg" class="img-responsive">Edit Company</button>
                                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $company['id']; ?>"><img src="assets/img/icon_delete.svg" class="img-responsive">Delete Company</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modal-<?php echo $company['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Are you sure to delete this item?</h5>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>This action cannot be undone. This will permanently delete the item.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary" onclick="deleteCompany(<?php echo $company['id']; ?>)">Yes, remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php 
                            endforeach; ?>
                            </tbody>
                        </table>
                        <?php                       
                        else : ?>
                        <div class="no-company text-center">
                            <div class="input-border-bg d-flex">
                                <img src="assets/img/icon_companies_black.svg" class="img-responsive">
                            </div>
                            <h2>No records to display</h2>
                            <a href="panel" class="btn btn-primary"><img src="assets/img/icon_add.svg" class="img-responsive">New Company</a>
                        </div>
                        <?php 
                        endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>