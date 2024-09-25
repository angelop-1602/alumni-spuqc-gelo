<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>

<form action="" id="login-frm" style="max-width: 400px; padding: 20px; background-color: #ffffff; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); margin: auto;">
    <h3 class="text-center">Login</h3>
    <div class="form-group">
        <label for="username" class="control-label">Email</label>
        <input type="email" name="username" required class="form-control" placeholder="Enter your email">
    </div>
    <div class="form-group">
        <label for="password" class="control-label">Password</label>
        <input type="password" name="password" required class="form-control" placeholder="Enter your password">
        <a href="index.php?page=signup" id="new_account" class="d-block mt-2">Create New Account</a>
    </div>
    <button type="submit" class="btn btn-info btn-block">Login</button>
    <div class="alert-container"></div> <!-- Container for alert messages -->
</form>

<style>
    form {
        display: flex; /* Flexbox for form layout */
        flex-direction: column; /* Vertical layout */
        justify-content: center; /* Center contents vertically */
        align-items: center; /* Center contents horizontally */
    }
    .form-group {
        margin-bottom: 1.5rem; /* Space between form elements */
        width: 100%; /* Full width */
    }
    .alert {
        margin-top: 1rem; /* Space above alert messages */
        padding: 10px; /* Padding inside alert */
        border-radius: 5px; /* Rounded corners */
        color: #ffffff; /* White text color */
    }
    .alert-danger {
        background-color: #dc3545; /* Bootstrap danger color */
    }
    #new_account {
        color: #007bff; /* Link color */
        text-decoration: none; /* No underline */
    }
    #new_account:hover {
        text-decoration: underline; /* Underline on hover */
    }
</style>

<script>
    $('#login-frm').submit(function(e) {
        e.preventDefault();
        $('#login-frm button[type="submit"]').attr('disabled', true).html('Logging in...');
        
        if ($(this).find('.alert-danger').length > 0) {
            $(this).find('.alert-danger').remove();
        }
        
        $.ajax({
            url: 'admin/ajax.php?action=login2',
            method: 'POST',
            data: $(this).serialize(),
            error: function(err) {
                console.log(err);
                $('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
            },
            success: function(resp) {
                if (resp == 1) {
                    location.href = '<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php?page=home'; ?>';
                } else if (resp == 2) {
                    $('.alert-container').prepend('<div class="alert alert-danger">Your account is not yet verified.</div>');
                    $('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
                } else {
                    $('.alert-container').prepend('<div class="alert alert-danger">Email or password is incorrect.</div>');
                    $('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
                }
            }
        });
    });
</script>
