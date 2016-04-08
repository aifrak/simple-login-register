<?php

    require_once $_SERVER["DOCUMENT_ROOT"] . '/app/constants/dbConstants.php';

    /**
     * Class DbService
     * Manage the database connection
     */
    class DbService
    {
        /**
         * Connect to the database
         * @return mysqli, the connection to the database
         */
        function connect()
        {
            $hostname = "localhost";
            $port = "3306";
            $username = "php_db_admin";
            $password = "php_db_admin";
            $database = "phpdb";
            $mysqli = mysqli_connect($hostname, $username, $password, $database, $port);

            return mysqli_connect_errno() ? null : $mysqli;
        }

        /**
         * Close the connection to the database
         *
         * @param $mysqli , the connection to the database
         */
        function close($mysqli)
        {
            mysqli_close($mysqli);
        }
    }