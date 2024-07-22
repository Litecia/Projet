<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "arcadia_zoo_db";

    // Enable MySQLi error reporting
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        // Create a new MySQLi instance
        $connect = new mysqli($servername, $username, $password, $dbname);
        // if($connect){
        //     echo "connected to the database";
        // };

    } catch (mysqli_sql_exception $err) {
        // Handle connection or query errors
        echo "Error: " . $err->getMessage();
    };
?>
