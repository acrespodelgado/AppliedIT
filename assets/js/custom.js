$(document).ready(function(){
    
    $("#logout").click(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'logout.php',
            data: { ok : 1 },
            success: function() {
                window.location.href = 'login';
            }
        });
    });

});

function viewCompany(id) {
    $.ajax({
        type: 'POST',
        url: 'index.php',
        data: { 
            id: id,
            view : 1
        },
        success: function(response) {
            console.log(response);
            window.location.href = "panel";
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function addCompany(id) {
    $errors = false;
    $name = $('#companyForm input[name="name"]');
    $country = $('#companyForm select[name="country"]');
    $activity = $('#companyForm select[name="activity"]');
    $taxNumber = $('#companyForm input[name="tax_number"]');
    $email = $('#companyForm input[name="email"]');
    $employees = $('#companyForm input[name="employees"]');
    $phoneNumber = $('#companyForm input[name="phone_number"]');
    $zipCode = $('#companyForm input[name="zip_code"]');

    var regex_email = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var regex_taxNumber = /^[A-Z]\d{8}$/i;
    var regex_phoneNumber = /^(\+\d{1,3}[\s-]?)?\(?\d{3}\)?[\s-]?\d{3}[\s-]?\d{3,4}$/;

    //ToggleClass acepta un param boolean para condicion, en este caso le paso los valores para saber si son nulos
    $name.toggleClass('is-invalid', !$name.val());
    $country.toggleClass('is-invalid', !$country.val() || $country.val() == 0);
    $activity.toggleClass('is-invalid', !$activity.val() || $activity.val() == 0);
    $taxNumber.toggleClass('is-invalid', !$taxNumber.val() || !regex_taxNumber.test($taxNumber.val()));
    $email.toggleClass('is-invalid', !$email.val() || !regex_email.test($email.val()));
    $employees.toggleClass('is-invalid', !$employees.val() || isNaN(Number($employees.val())));
    $phoneNumber.toggleClass('is-invalid', !$phoneNumber.val() || !regex_phoneNumber.test($phoneNumber.val()));
    $zipCode.toggleClass('is-invalid', !$zipCode.val());

    if($('.is-invalid').length) {
        $errors = true;
    }

    if(!$errors) {
        $('#submit-button').click();
    }
}

function deleteCompany(id) {
    $.ajax({
        type: 'POST',
        url: 'index.php',
        data: { 
            id: id,
            delete : 1
        },
        success: function(response) {
            console.log(response);
            $('#modal-' + id).modal('hide');
            
            window.location.href = "index";
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}