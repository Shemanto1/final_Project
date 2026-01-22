<?php
session_start();
require_once "dbConnect.php";

$con = getConnection();

function dbDelete($id)
{
    global $con;

    $sql = "DELETE FROM users WHERE id = '$id'";

    return mysqli_query($con, $sql);
}
?>
