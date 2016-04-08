<?php

    require_once 'DbService.php';

    /**
     * Class UserDbService
     * Manage users from the database
     */
    class UserDbService
    {
        /**
         * Create the user in the database
         *
         * @param $id
         * @param $email
         * @param $password
         *
         * @return bool|mysqli_result FALSE on failure.
         */
        function create($id, $email, $password)
        {
            $result = false;

            $dbService = new DbService();

            // Connect to database
            $mysqli = $dbService->connect();

            if (isset($mysqli)) {
                // Insert user
                $query = "INSERT INTO user(id, email, password) VALUES('" . $id . "', '" . $email . "', '" . $password
                         . "')";
                $result = mysqli_query($mysqli, $query);

                // Close connection from database
                $dbService->close($mysqli);
            }

            return $result;
        }

        /**
         * Find the user in the database
         *
         * @param $id , the user id
         *
         * @return object $dbObj, the result of the query in a object
         */
        function find($id)
        {
            $dbObj = null;

            $dbService = new DbService();

            // Connect to database
            $mysqli = $dbService->connect();

            if (isset($mysqli)) {
                // Find the user
                $query = "SELECT id, email, password FROM user WHERE id = '" . $id . "'";
                $dbObj = mysqli_query($mysqli, $query)->fetch_object();

                // Close connection from database
                $dbService->close($mysqli);
            }

            return $dbObj;
        }


        /**
         * Check if the user exists in the database
         *
         * @param $id , the user id
         *
         * @return bool, TRUE if the user exists
         */
        function exists($id)
        {
            $result = false;

            $dbService = new DbService();

            // Connect to database
            $mysqli = $dbService->connect();

            if (isset($mysqli)) {
                // Check if user already exists
                $query = "SELECT COUNT(id) FROM user WHERE id = '" . $id . "'";
                $result = 0 < mysqli_query($mysqli, $query)->fetch_row()[0];

                // Close connection from database
                $dbService->close($mysqli);
            }

            return $result;
        }
    }