<?php
//echo "hello project";
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
<a href="index.php">Home</a>
<h2 class="logo">NextGadget</h2>
<a href="views/login.php">Login</a>
</header>

<main class="main">
<?php 
for($i=0;$i<30; $i++){
echo '
<div class="product">
<img src="image/apple.jpeg" alt="image">
<h2>Product Title</h2>
<p>product Description</p>
<p>Product Quantity</p>
<p class="productPrice">product Price</p>
<a href="#">Buy Now</a>
</div>';
}
?>
</main>

<footer class="footer">
<p>© NextGadget. All rights reserved.</p>
</footer>

</body>
</html>
