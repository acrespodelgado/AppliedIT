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
                                    <li class="breadcrumb-item"><a href="index">Administration</a></li>
                                    <li class="breadcrumb-item"><a href="index">Companies</a></li>
                                    <li class="breadcrumb-item active">
                                        <a href="panel">
                                        <?php echo isset($_SESSION['company']) && !empty($_SESSION['company']) ? 'Edit Company' : 'New Company'; ?>
                                        </a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row align-items-center">
                    <?php 
                    if(isset($_SESSION['company']) && !empty($_SESSION['company'])) : ?>
                        <div class="col-12 col-xl-6">
                            <h1><?php echo $_SESSION['company']['name']; ?></h1>
                        </div>
                        <div class="col-12 col-xl-6 d-flex right-xl">
                            <a href="index" class="btn btn-secondary">Cancel</a>
                            <button class="btn btn-primary" onclick="addCompany(<?php echo $_SESSION['company']['id']; ?>)">Edit Company</button>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $_SESSION['company']['id']; ?>"><img src="assets/img/icon_delete_white.svg" class="img-responsive">Delete Company</button>
                            <div class="modal fade" id="modal-<?php echo $_SESSION['company']['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                                            <button type="button" class="btn btn-primary" onclick="deleteCompany(<?php echo $_SESSION['company']['id']; ?>)">Yes, remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    else : ?>
                        <div class="col-12 col-xl-7">
                            <h1>Add new company</h1>
                        </div>
                        <div class="col-12 col-xl-5 d-flex right-xl">
                            <a href="index" class="btn btn-secondary">Cancel</a>
                            <button class="btn btn-primary" onclick="addCompany()">Save new company</button>
                        </div>
                    <?php
                    endif; ?>
                    </div>
                </div>
            </div>
            <div class="form-container">
                <div class="white-bg">
                    <form action="panel" method="POST" id="companyForm">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group pt-0 has-validation">
                                        <label>Company name</label>
                                        <input type="text" class="form-control" name="name" required 
                                            value="<?php echo $_SESSION['company']['name'] ?? ''; ?>">
                                        <div class="invalid-feedback">The field cannot be empty</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 pr-0">
                                    <div class="form-group">
                                        <label>Tax number</label>
                                        <input type="text" class="form-control" name="tax_number"
                                            value="<?php echo $_SESSION['company']['tax_number'] ?? ''; ?>">
                                        <div class="invalid-feedback">Write a valid tax number. Ej: D12345678</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 pl-0">
                                    <div class="form-group">
                                        <label>Employees</label>
                                        <input type="number" class="form-control" name="employees"
                                            value="<?php echo $_SESSION['company']['employees'] ?? ''; ?>">
                                        <div class="invalid-feedback">Write a valid number</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 pr-0">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <select class="form-select" name="country" required>
                                            <option value="0" <?php echo !isset($_SESSION['company']['countryId']) ? 'selected' : ''; ?>>Select an option</option>
                                            <?php if(isset($_SESSION['countries']) && !empty($_SESSION['countries'])) : ?>
                                                <?php foreach($_SESSION['countries'] as $country) : ?>
                                                    <option value="<?php echo $country['id']; ?>" 
                                                        <?php echo isset($_SESSION['company']['countryId']) && $_SESSION['company']['countryId'] == $country['id'] ? 'selected' : ''; ?>>
                                                        <?php echo $country['name']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <option value="0">There aren't countries yet</option>
                                            <?php endif; ?>
                                        </select>
                                        <div class="invalid-feedback">Please choose a country</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 pl-0">
                                    <div class="form-group">
                                        <label>ZIP code</label>
                                        <input type="text" class="form-control" name="zip_code" 
                                            value="<?php echo $_SESSION['company']['zip_code'] ?? ''; ?>">
                                        <div class="invalid-feedback">The field cannot be empty</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 pr-0">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" required
                                            value="<?php echo $_SESSION['company']['email'] ?? ''; ?>">
                                        <div class="invalid-feedback">Write a valid email</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 pl-0">
                                    <div class="form-group">
                                        <label>Phone number</label>
                                        <input type="text" class="form-control" name="phone_number" 
                                            value="<?php echo $_SESSION['company']['phone_number'] ?? ''; ?>">
                                        <div class="invalid-feedback">Write a valid phone number. Ej: +34 222 555 111</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 pr-0">
                                    <div class="form-group">
                                        <label>Company activity</label>
                                        <select class="form-select" name="activity" required>
                                        <?php if (!empty($_SESSION['activities'])): ?>
                                            <option value="0">Select an option</option>
                                            <?php foreach ($_SESSION['activities'] as $activity): 
                                                $selected = ($_SESSION['company']['activityId'] ?? null) == $activity['id'] ? 'selected' : '';
                                            ?>
                                            <option value="<?php echo $activity['id']; ?>" <?php echo $selected; ?>>
                                                <?php echo $activity['name']; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <option value="0">There aren't activities yet</option>
                                        <?php endif; ?>
                                        </select>
                                        <div class="invalid-feedback">Please choose an activity</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 pl-0">
                                    <div class="form-group form-check form-switch">
                                        <label>Collection risk</label>
                                        <div class="d-flex align-items-center">
                                            <input type="checkbox" class="form-check-input" id="risk" name="risk" 
                                                <?php echo isset($_SESSION['company']) && $_SESSION['company']['risk'] ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="risk">This company presents collection risk</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Payment</label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="payment" id="option1" value="Bank" checked
                                                    <?php echo isset($_SESSION['company']) && $_SESSION['company']['payment'] == 'Bank' ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="option1">Bank transfer</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="payment" id="option2" value="Credit" 
                                                    <?php echo isset($_SESSION['company']) && $_SESSION['company']['payment'] == 'Credit' ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="option2">Credit card</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="payment" id="option3" value="Cash" 
                                                    <?php echo isset($_SESSION['company']) && $_SESSION['company']['payment'] == 'Cash' ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="option3">Cash</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $_SESSION['company']['id'] ?? ''; ?>">
                                <input type="hidden" name="form" value="1">
                                <button id="submit-button" type="submit" style="display: none;"></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>