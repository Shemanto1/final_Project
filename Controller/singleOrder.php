<?php
   session_start();
   require_once"../model/dbConnect.php";
   $con=getConnection();

   if(isset($_SESSION["id"])){
        if(isset($_GET["user_id"],$_GET["product_id"],$_GET["price"])){
            $user_id = $_GET["user_id"];
            $product_id = $_GET["product_id"];
            $price = $_GET["price"];

            $sql = "insert into single_order(user_id,product_id,total_amount) 
                    values('$user_id','$product_id','$price')";

    
            $result = mysqli_query($con,$sql);

            if (!$result) {
                echo "error";
            }
            else {

              
                $order_id = mysqli_insert_id($con);

                $payment_method = "COD";
                $sql_payment = "insert into payments(order_id,user_id,total_amount,payment_method)
                                values('$order_id','$user_id','$price','$payment_method')";
                $result1 = mysqli_query($con,$sql_payment);

                if(!$result1){
                    echo "payment error";
                }
                else {
                    $sql_update_stock = "update products set stock =stock - 1 where id = '$product_id'";
                    $result_update_stock = mysqli_query($con,$sql_update_stock);

                    if (!$result_update_stock) {
                        echo "error";
                    }

                    echo "<script>
                        alert('Order added successfully');
                        window.location.href = '../views/customer/userDesh.php';
                    </script>";
                    exit;
                }
            }
        }     
   }
   else {
        header("Location:userDesh.php");
   }
?>
