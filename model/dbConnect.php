<?php
function getConnection()
{
    $server = "localhost";
    $username = "root";
    $pass = "";
    $database = "NextGadgets";

    $con = mysqli_connect($server, $username, $pass, $database);

    if (!$con) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    return $con;
}
?>
