<?php
require_once '../common/header.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/app/services/AuthService.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/app/models/User.php';

session_start();

// Register the user
$authService = new AuthService();
$errors = $authService->register();

if (empty($errors)) {
    // Get data of the user from the session
    $user = unserialize($_SESSION['user']);
    $login = $user->getId();
    $email = $user->getEmail();
}
?>

    <div id="container">
        <div id="content">
            <?php
            if (!empty($errors)) {
                echo '<div class="error center">';
                foreach ($errors as $error) {
                    echo $error . '<br>';
                }
                echo '</div>';
            } else {
                echo '<div>';
                echo 'Welcome ' . $login . '. Your email address is ' . $email;
                echo '</div>';
            }
            ?>
        </div>
    </div>

<?php
require_once("../common/footer.php");
?>