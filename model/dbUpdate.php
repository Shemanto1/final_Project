<?php
session_start();
require_once "dbConnect.php";

$con = getConnection();

function dbUpdate($id, $name, $email, $gender, $password, $phone, $address, $role)
{
    global $con;

    $sql = "UPDATE users SET
                name = '$name',
                email = '$email',
                gender = '$gender',
                password = '$password',
                phone = '$phone',
                address = '$address',
                role = '$role'
            WHERE id = '$id'";

    return mysqli_query($con, $sql);
}
?>
