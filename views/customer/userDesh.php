<?php
    session_start();
    require_once"../../model/dbConnect.php";
    $con=getConnection();

    if(isset($_GET['name_cate'])){

        $category_name =$_GET['name_cate'];

        $sql = "SELECT * FROM products WHERE category_name ='$category_name' AND stock >0";

        $result=mysqli_query($con,$sql);
    }

    else{
        $sql="select * from products where stock>0 ";
        $result=mysqli_query($con,$sql);

    }

  
  
    $sql1 = "select * from categories";
  
    $result1=mysqli_query($con,$sql1);





?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NextGadget – Smart Tech, Smarter Life</title>

<style>
*{
    margin: 0;
    padding: 0;
}


.header{
    position: fixed;
    top: 0;
    width: 100%;
    background-color: #111827; 
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 40px;
}

.header a{
    text-decoration: none;
    color: #f9fafb; 
    display: inline-block;
    margin-right: 100px;
    font-size: 20px;
}

.header a:hover{
    background-color:#374151; 
}


.logo{
    font-size: 30px;
    color: #f9fafb; 
    text-align: center;
}


body{
    min-height: 100vh;
    background: linear-gradient(135deg, #eef2f3, #d9e4f5); 
    font-family: Arial, sans-serif;
}


.main{
    display: flex;
    flex-wrap:wrap;
    justify-content:center;
    margin-top: 130px;
}


.product{
    margin: 10px;
    border: 1px solid #c7d2fe; 
    max-width: 300px;
    text-align: center;
    background-color: #ffffff; 
    box-shadow: 0 4px 10px rgba(0,0,0,0.1); 
}

.product img{
    width: 150px;
}


.productPrice{
    color:#2563eb; 
    font-weight: bold;
}


.product a{
    text-decoration: none;
    color: #ffffff; 
    background-color: #2563eb; 
    padding: 8px;
    margin: 5px;
    text-align: center;
    display: block;
}

.product a:hover{
    background-color:#1e40af; 
}


.footer{
    background-color: #111827; 
    color: #f9fafb; 
    width: 100%;
    padding: 20px;
    text-align: center;
}

@media(max-width):400px{
}
</style>
</head>

<body>

<header class="header">
<a href="../logout.php">Logout</a>
  <ul>
    <?php while($row_cate = mysqli_fetch_assoc($result1)) { ?>
    <li><a href="userDesh.php?name_cate=<?php echo  $row_cate['name'] ?>">
        <?php echo  $row_cate['name'] ?> </a></li>
    </ul>
    <?php  }?>

<a href="userProfile.php">Dashboard</a>

</header>

<main class="main">
<?php 
 while($row=mysqli_fetch_assoc($result)){ ?>
<div class="product">
<img src="../../image/<?php echo $row['image']?>" alt="image">
<h2><?php echo $row['name']?></h2>
<p>Description: <?php echo $row['description']?></p> 
<p>Stock: <?php echo $row['stock']?></p>
<p class="productPrice">Price: <?php echo $row['price']?></p>
<a href="../../controller/singleOrder.php?user_id=<?php echo $_SESSION['id'];?>&product_id=<?php echo $row['id'];?>&price=<?php echo $row['price'];?>">Buy Now</a>
</div>
<?php } ?>

      

</main>

<footer class="footer">
<p>© NextGadget. All rights reserved.</p>
</footer>

</body>
</html>  