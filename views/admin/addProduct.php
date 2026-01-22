<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../../model/dbConnect.php';


if(isset($_SESSION["username"]))
{
    if($_SESSION["role"]!="admin")
    {
        echo "go for userDesh board";
        exit;
    }
}
else
{
    header("Location: ../../index.php");
    exit;
}



$productName_Err = "";
$price_Err = "";
$stock_Err = "";
$description_Err = "";
$image_Err = "";
$category_id_Err = "";

$category_name_Err = "";

$has_Err = false;



   $con1=getConnection();

    if (!$con1) {
        
        die("Database connection failed: " . mysqli_connect_error());
    }

    else 
    {
        $sql1 = "select * from categories";
        $result1 = mysqli_query($con1,$sql1);

     }



if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(empty(trim($_POST['productName'])))
    {
        $productName_Err = "Please enter product name !!!!";
        $has_Err = true;
    }

    if(empty(trim($_POST['price'])))
    {
        $price_Err = "Please enter product price !!!!";
        $has_Err = true;
    }

    if(empty(trim($_POST['stock'])))
    {
        $stock_Err = "Please enter product stock !!!!";
        $has_Err = true;
    }

    if(empty(trim($_POST['description'])))
    {
        $description_Err = "Please enter product description !!!!";
        $has_Err = true;
    }
    

    if(!isset($_FILES['image']) || $_FILES['image']['error'] != 0)
    {
        $image_Err = "Please upload product image !!!!";
        $has_Err = true;
    }
   


if(empty($_POST['category_name']))
{
    $category_name_Err = "Please select category name !!!!";
    $has_Err = true;
}


    if(!$has_Err)
    {
        $productName = $_POST["productName"];
        $price = $_POST["price"];
        $stock = $_POST["stock"];
        $description = $_POST['description'];
        $image = $_FILES["image"]["name"];
        $temp_location = $_FILES["image"]["tmp_name"];
        $upload_location= "../../image/";
       // $category_id = $_POST["category_id"];
        $category_name = $_POST["category_name"];
         
                $con=getConnection();
   
   
                       if (!$con) {
                           
                           die("Database connection failed: " . mysqli_connect_error());
                       }

                       else {
                                              
            $sql = "INSERT INTO `products`( `name`, `description`, `price`, `stock`, `image`, `category_name`) 
                                           VALUES ('$productName','$description','$price','$stock','$image','$category_name')";

                            $result = mysqli_query($con, $sql);

                            if(!$result)
                            {
                                echo "<script>alert('Product add not Successfull. Try again!');</script>";
                            }
                            else
                            { 
                                echo "<script>alert('Product added successfully');</script>";
                                move_uploaded_file($temp_location,$upload_location.$image);

                            }
                               
                               

                                    }
                                        }



           
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>

<style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body{
    min-height: 100vh;
    background: linear-gradient(135deg, #e0f2fe, #bae6fd);
    font-family: Arial, sans-serif;
}

.desh_sidebar{
    position: fixed;
    top: 0;
    left: 0;
    width: 200px;
    height: 100%;
    background-color: #1e293b; 
}

.desh_sidebar ul{
    margin-top: 60px;
}

.desh_sidebar ul li{
    list-style: none;
    text-align: center;
}

.desh_sidebar ul li a{
    display: block;
    text-decoration: none;
    color: #f8fafc;
    padding: 15px;
    font-size: 16px;
}

.desh_sidebar ul li a:hover{
    background-color: #475569;
}

/* Product form container */
.productForm{
    display: flex;
    justify-content: center;
    position: fixed;
    left: 30%;
    top: 40px;
}

/* Form box */
.productForm form{
    background: linear-gradient(135deg, #6366f1, #22d3ee);
    width: 500px;
    border: 10px solid #0f172a;
    padding: 15px;
}

/* Legend */
.productForm legend{
    font-size: 20px;
    color: #ffffff;
    text-align: center;
    display: block;
    background-color: #0ea5e9;
    padding: 10px;
    margin-bottom: 10px;
}

/* Labels */
.productForm label{
    width: 140px;
    display: inline-block;
    font-size: 15px;
    color: #ffffff;
}

/* Inputs */
.productForm input:not([type="file"]),
.productForm textarea,
.productForm select{
    width: 250px;
    padding: 8px;
    margin: 5px 0;
}

.productForm textarea{
    resize: none;
    height: 80px;
}

.productForm input[type="file"]{
    display: block;
    margin: 5px auto;
    color: white;
}

.productForm select{
    display: block;
    margin: 5px auto;
}

.productForm input[type="submit"]{
    display: block;
    margin: 8px auto;
    padding: 8px 15px;
    background-color: #0ea5e9;
    border: none;
    color: white;
    font-weight: bold;
    cursor: pointer;
}

.productForm input[type="submit"]:hover{
    background-color: #0284c7;
}

span{
    color:#dc2626;
    display: block;
    text-align: center;
    font-size: 14px;
}

.productForm textarea{
    display: block;
    margin: 8px auto;   
}

</style>
</head>

<body>

<div class="desh_sidebar">
<ul>
    <li><a href="addProduct.php">Add Product</a></li>
    <li><a href="displayProduct.php">View Products</a></li>
       <li><a href="viewOrders.php">View Orders</a></li>
    <li><a href="../logout.php">Logout</a></li>
</ul>
</div>

<div class="productForm">
<form action="addProduct.php" method="post" enctype="multipart/form-data">

<legend>Add Product Details</legend>

<label>Product Name :</label>
<input type="text" name="productName">
<span><?php echo $productName_Err; ?></span>

<label>Product Price :</label>
<input type="number" min="1" name="price">
<span><?php echo $price_Err; ?></span>

<label>Product Stock :</label>
<input type="number" min="1" name="stock">
<span><?php echo $stock_Err; ?></span>

<textarea name="description" placeholder="Enter product Description"></textarea>
<span><?php echo $description_Err; ?></span>

<input type="file" name="image">
<span><?php echo $image_Err; ?></span>





<select name="category_name">
    <option value="">-- Select Category --</option>

    <?php
    while ($row = mysqli_fetch_assoc($result1)) {
    ?>
        <option value="<?php echo $row['name']; ?>">
            <?php echo $row['name']; ?>
        </option>
    <?php } ?>
</select>

<span><?php echo $category_name_Err; ?></span>






<input type="submit" name="Submit">

</form>
</div>

</body>
</html>
