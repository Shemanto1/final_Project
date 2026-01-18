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

  $con=getConnection();

  $sql="SELECT * from products";
  $result=mysqli_query($con,$sql);

  if(!$result)
  {
    echo "Error: {$con->error}";
  }
  else
  {


  }






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Deshboard </title>

    <style>

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Sidebar */
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


table {
    position: relative;
    margin-left: 220px;
    margin-top: 20px;
    width: 80%;
    border-collapse: collapse;
    background-color: #e0f2fe; 
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}


th{
    background-color: #0ea5e9; 
    color: #f8fafc;
    border-top: 4px solid #0f172a; 
}


tr, th, td{
    padding: 10px;
    text-align: center;
    border-bottom: 2px solid #38bdf8; 
}


tbody tr:hover{
    background-color: #bae6fd;
}

a.update{
    color: #6366f1; 
    font-weight: bold;
    text-decoration: none;
}

a.update:hover{
    text-decoration: underline;
}

a.delete{
    color: #dc2626; 
    font-weight: bold;
    text-decoration: none;
}

a.delete:hover{
    text-decoration: underline;
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

           <table>
             <thread>
                <tr>
                    <th>Product Title</th>
                    <th>Product Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Image</th>
                    <th>Category Name</th>
                    <th>Action</th>
                    <th>Action</th>
                    </tr>
                </thread>
                <tbody>
                    <?php 
                    while($row = mysqli_fetch_assoc($result)){

                
                    ?>
                    <tr>
                        <td><?php echo $row['name']?></td>
                        <td><?php echo $row['description']?></td>
                        <td><?php echo $row['price']?></td>
                        <td><?php echo $row['stock']?></td>
                        <td>
                        <img src="../../image/<?php echo $row['image']; ?>" width="100">
                         </td>

                        <td><?php echo $row['category_name']?></td>
                        <td> <a class="update" href="updateProduct.php?product_id=<?php echo $row['id'];?>">Update</a></td>
                        <td> <a class="delete" href="../../Controller/deleteProduct.php?product_id=<?php echo $row['id'];?>">delete</a></td>


                        </tr>
                        <?php }  ?>
                    </tbody>
            </table>

    
</body>
</html>