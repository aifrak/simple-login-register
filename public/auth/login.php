<?php
require_once '../common/header.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/app/constants/lengthConstants.php';
?>

<div id="content">
    <h1>Please login</h1>
    <form id="login-form" action="login_result.php" method="post">
        <div class="row required-fields"> * Required fields </div>

        <div class="row">
            <div class="label">Login:* &nbsp;</div>
            <div class="input">
                <input id="login" type="text" name="login" maxlength="<?php echo MAX_LOGIN_LENGTH; ?>">
            </div>
            <div id="login-error" class="error">&nbsp;</div>
        </div>

        <div class="row">
            <div class="label">Password:* &nbsp;</div>
            <div class="input">
                <input id="password" type="password" name="password" maxlength="<?php echo MAX_PASSWORD_LENGTH; ?>">
            </div>
            <div id="password-error" class="error">&nbsp;</div>
        </div>

        <div class="row center">
            <input id="submit" type="submit" value="Login">
        </div>
    </form>
</div>

<script src="../javascript/auth.js"></script>
<script>
    jQuery(function () {
        $('#submit').click(function () {
            $('.error').html('&nbsp;');
            return validateAuthFields();
        });
    });
</script>

<?php
require_once("../common/footer.php");
?>