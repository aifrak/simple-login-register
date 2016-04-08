<?php

    require_once $_SERVER["DOCUMENT_ROOT"] . '/app/dbServices/UserDbService.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . '/app/constants/lengthConstants.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . '/app/models/User.php';

    /**
     * Class AuthService
     * Manage the authentication of the users
     */
    class AuthService
    {
        /**
         * Register the user
         * @return array, an array of errors
         */
        function register()
        {
            $login = $_POST['login'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $passwordConfirm = $_POST['passwordConfirm'];

            $errors = $this->validateRegister($login, $email, $password, $passwordConfirm);

            if (empty($errors)) {
                // Hash password
                $hash = password_hash($password, PASSWORD_DEFAULT);

                // Create user
                $userDbService = new UserDbService();
                $createResult = $userDbService->create($login, $email, $hash);
                if (!$createResult) {
                    array_push($errors, 'Error while creating the user.');
                } else {
                    // Reload the user and add its object in the session
                    $dbObj = $userDbService->find($login);
                    $user = new User($dbObj->id, $dbObj->email);
                    $_SESSION['user'] = serialize($user);
                }
            }

            return $errors;
        }

        /**
         * Validate the registration input values
         *
         * @param $login           , login of the user
         * @param $email           , login of the user
         * @param $password        , password of the user
         * @param $passwordConfirm , password confirmation
         *
         * @return array, an array of errors
         */
        function validateRegister($login, $email, $password, $passwordConfirm)
        {
            $errors = [];

            // Trim values
            trim($login);
            trim($email);

            // Check empty fields
            if (empty($login)) {
                array_push($errors, 'Login is mandatory.');
            }
            if (empty($email)) {
                array_push($errors, 'Email is mandatory.');
            }
            if (empty($password)) {
                array_push($errors, 'Password is mandatory.');
            }
            if (empty($passwordConfirm)) {
                array_push($errors, 'Password confirm is mandatory.');
            }

            if (empty($errors)) {
                // Check length and format
                if (MAX_LOGIN_LENGTH < $login) {
                    array_push($errors, 'Login is too long: maximum length is ' . MAX_LOGIN_LENGTH);
                }
                if (MAX_EMAIL_LENGTH < $email) {
                    array_push($errors, 'Login is too long: maximum length is ' . MAX_EMAIL_LENGTH);
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // wrong email format
                    array_push($errors, 'Wrong email format.');
                }
                if (MAX_PASSWORD_LENGTH < $password) {
                    array_push($errors, 'Login is too long: maximum length is ' . MAX_PASSWORD_LENGTH);
                }
                if (MAX_PASSWORD_CONFIRM_LENGTH < $passwordConfirm) {
                    array_push($errors, 'Login is too long: maximum length is ' . MAX_PASSWORD_CONFIRM_LENGTH);
                }
            }
            if (empty($errors)) {
                $userDbService = new UserDbService();
                // Check if login already exists
                if ($userDbService->exists($login)) {
                    array_push($errors, 'This login is already taken.');
                }
            }

            return $errors;
        }

        /**
         * Login the user
         * @return array, an array of errors
         */
        function login()
        {
            $login = $_POST['login'];
            $password = $_POST['password'];

            $errors = $this->validateLogin($login, $password);

            if (empty($errors)) {
                $userDbService = new UserDbService();

                // Load the user from the login & the password
                $dbObj = $userDbService->find($login);
                if (empty($dbObj) || !password_verify($password, $dbObj->password)) {
                    array_push($errors, 'The login and the password do not match.');
                } else {
                    // Add the user object in the session
                    $user = new User($dbObj->id, $dbObj->email);
                    $_SESSION['user'] = $user;
                }
            }

            return $errors;
        }

        /**
         *  Validate the login input values
         *
         * @param $login    , login of the user
         * @param $password , password of the user
         *
         * @return array, an array of errors
         */
        function validateLogin($login, $password)
        {
            $errors = [];

            // Trim values
            trim($login);

            // Check empty fields
            if (empty($login)) {
                array_push($errors, 'Login is mandatory.');
            }
            if (empty($password)) {
                array_push($errors, 'Password is mandatory.');
            }

            if (empty($errors)) {
                // Check length
                if (MAX_LOGIN_LENGTH < $login) {
                    array_push($errors, 'Login is too long: maximum length is ' . MAX_LOGIN_LENGTH);
                }
                if (MAX_PASSWORD_LENGTH < $password) {
                    array_push($errors, 'Login is too long: maximum length is ' . MAX_PASSWORD_LENGTH);
                }
            }

            return $errors;
        }

    }