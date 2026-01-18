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


// categories table
   $con1=getConnection();

    if (!$con1) {
        
        die("Database connection failed: " . mysqli_connect_error());
    }

    else 
    {
        $sql1 = "select * from categories";
        $result1 = mysqli_query($con1,$sql1);
        if(isset($_GET["product_id"])){

            $product_id = $_GET["product_id"];
            $sql2="select * from products where id ='$product_id'";
            $result2 = mysqli_query($con1,$sql2);
            $row2=mysqli_fetch_assoc($result2);


        }
        

     }


     if(isset($_POST["submit"])){

        $product_id = $_GET["product_id"];
        $name = $_POST["productName"];
        $price = $_POST["price"];
        $stock = $_POST["stock"];
        $description = $_POST["description"];
        $category_name = $_POST["category_name"];
    
        $image_sql = "";
    
        if(!empty($_FILES["image"]["name"])){
            $image = $_FILES["image"]["name"];
            $tmp = $_FILES["image"]["tmp_name"];
            move_uploaded_file($tmp, "../../image/".$image);
            $image_sql = ", image='$image'";
        }
    
        $sql = "UPDATE products SET
                    name='$name',
                    description='$description',
                    price='$price',
                    stock='$stock',
                    category_name='$category_name'
                    $image_sql
                WHERE id='$product_id'";
    
        $result = mysqli_query($con1, $sql);
    
        if($result){
            header("Location: displayProduct.php");
            exit;
        }else{
            echo mysqli_error($con1);
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
/* Center description textarea */
.productForm textarea{
    display: block;
    margin: 8px auto;   /* centers it horizontally */
}

/* Center preview image in form */
.productForm img {
    display: block;
    margin: 10px auto;  /* horizontal center + some spacing */
    max-width: 150px;   /* optional: limit size */
    border-radius: 6px; /* optional: nice rounded corners */
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
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
<form action="updateProduct.php?product_id=<?php echo $product_id?>" method="post" enctype="multipart/form-data">

<legend>Add Product Details</legend>

<label>Product Name :</label>
<input type="text" name="productName" value="<?php echo $row2['name']?>">
<span><?php echo $productName_Err; ?></span>

<label>Product Price :</label>
<input type="number" min="1" name="price" value="<?php echo $row2['price']?>">
<span><?php echo $price_Err; ?></span>

<label>Product Stock :</label>
<input type="number" min="1" name="stock" value="<?php echo $row2['stock']?>">
<span><?php echo $stock_Err; ?></span>

<textarea name="description" ><?php echo $row2['description']?></textarea>
<span><?php echo $description_Err; ?></span>
 <img src="../../image/<?php echo $row2['image']?>" width="100px" >
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






<input type="submit" name="submit" value="Update Product">


</form>
</div>

</body>
</html>
