<?php
require_once '../common/header.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/app/constants/lengthConstants.php';
?>


<div id="content">
    <h1>Please register</h1>
    <form id="registerForm" action="register_result.php" method="post">
        <div class="row required-fields"> * Required fields </div>

        <div class="row">
            <div class="label">Login:* &nbsp; </div>
            <div class="input">
                <input id="login" type="text" name="login" maxlength="<?php echo MAX_LOGIN_LENGTH; ?>">
            </div>
            <div id="login-error" class="error">&nbsp;</div>
        </div>
        <div class="row">
            <div class="label"> E-mail:* &nbsp;</div>
            <div class="input">
                <input id="email" type="email" name="email" maxlength="<?php echo MAX_EMAIL_LENGTH; ?>">
            </div>
            <div id="email-error" class="error">&nbsp;</div>
        </div>
        <div class="row">
            <div class="label">Password:* &nbsp;</div>
            <div class="input">
                <input id="password" type="password" name="password" maxlength="<?php echo MAX_PASSWORD_LENGTH; ?>">
            </div>
            <div id="password-error" class="error">&nbsp;</div>
        </div>
        <div class="row">
            <div class="label">Password confirm:* &nbsp;</div>
            <div class="input">
                <input id="passwordConfirm" type="password" name="passwordConfirm" maxlength="<?php echo MAX_PASSWORD_CONFIRM_LENGTH; ?>">
            </div>
            <div id="password-confirm-error" class="error">&nbsp;</div>
        </div>

        <div class="row center">
            <input id="submit" type="submit" value="Register">
        </div>
    </form>
</div>

<script src="../javascript/auth.js"></script>
<script>
    jQuery(function () {
        $('#submit').click(function () {
            $('.error').html('&nbsp;');
            var valid = true;

            trimField('email');

            var email = $("#email").val();
            var passwordConfirm = $("#passwordConfirm").val();

            if ('' == email) {
                $('#email-error').text('Email is mandatory.');
                valid = false;
            }
            if ('' == passwordConfirm) {
                $('#password-confirm-error').text('Password confirm is mandatory.');
                valid = false;
            }
            if (valid && !isMatchedPasswords()) {
                $('#password-confirm-error').text('Passwords does not match.');
                valid = false;
            }

            return validateAuthFields() && valid;
        });
    });

    function isMatchedPasswords() {
        return $('#password').val() == $('#passwordConfirm').val();
    }
</script>

<?php
require_once("../common/footer.php");
?>