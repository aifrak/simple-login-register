function validateAuthFields() {
    trimField('login');

    var valid = true;
    var login = $("#login");
    var password = $("#password");

    if ('' == login.val()) {
        $('#login-error').text('Login is mandatory.');
        valid = false;
    }
    if ('' == password.val()) {
        $('#password-error').text('Password is mandatory.');
        valid = false;
    }
    return valid;
}