<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../../model/dbConnect.php';

if (isset($_SESSION["role"]) && $_SESSION["role"] === "admin") {

    if (isset($_GET['product_id'])) {

        $product_id = $_GET['product_id'];
        $con = getConnection();

        $sql = "DELETE FROM products WHERE id = '$product_id'";
        $result = mysqli_query($con, $sql);

        if (!$result) {
            echo "Error: " . mysqli_error($con);
        } else {
            echo "<script>
                    
                    window.location.href='displayProduct.php';
                    alert('Successfully deleted');
                  </script>";
        }
    }

} else {
    header("Location: ../../index.php");
    exit;
}
?>
