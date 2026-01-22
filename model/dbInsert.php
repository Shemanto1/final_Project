<?php
session_start();
require_once "dbConnect.php";

$con = getConnection();

function dbInsert($name, $email, $gender, $password, $phone, $address, $role)
{
    global $con;

    $sql = "INSERT INTO users 
            (name, email, gender, password, phone, address, role)
            VALUES ('$name', '$email', '$gender', '$password', '$phone', '$address', '$role')";

    return mysqli_query($con, $sql);
}
?>
