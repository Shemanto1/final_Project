<?php
session_start();

        if(isset($_SESSION["username"]))
        {
                   if($_SESSION["role"]=="admin")
                   {
                 
                   }
                   else
                   {
                    echo "go for userDesh board";
                   }
        }
        else
        {header("Location: index.php");

            
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


.desh_main{
    margin-left: 240px;
    margin-top: 80px;
    padding: 30px;
    background: linear-gradient(135deg, #6366f1, #22d3ee);
    border: 8px solid #0f172a;
    color: white;
    width: calc(100% - 300px);
}


.desh_main p{
    font-size: 16px;
    line-height: 1.6;
}

            
            </style>
</head>
<body>  
         <div class="desh_sidebar">
             <ul>

                     <li><a href="addProduct.php">Add Product</a></li>
                     <li><a href="">View Order</a></li>
                     <li><a href="../logout.php">Logout</a></li>

             </ul>




            </div>

            <div class="desh_main">
                <p>hello Admin : <?php 
                  $email = $_SESSION["username"];
                  $name = $_SESSION["name"];
                  $role = $_SESSION["role"];
               
                  echo "$name";
                 // echo " hi"
                                        ?></p>
                </div>

    
</body>
</html>