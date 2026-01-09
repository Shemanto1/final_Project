<?php
    session_start();
    require_once '../model/dbConnect.php';

    $email;
    $password;

    $email_Err;
    $password_Err;

    $has_Err=false;

              if($_SERVER["REQUEST_METHOD"]=="POST")
              {
                if(empty(trim($_POST['email'])))
                {
                  $email_Err = "Please Enter your Email !!!!";
                  $has_Err = true;
                }
                else{
                  if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
                  {
                      $email_Err="Invalid email format";
                      $has_Err = true;
                  }
                }

                if(empty(trim($_POST['password'])))
                {
                  $password_Err = "Please Enter your password !!!!";
                  $has_Err = true;
                }

                        if(!$has_Err)
                      {
                        $email = $_POST["email"];
                        $password = $_POST["password"];

                         $con=getConnection();
   
   
                       if (!$con) {
                           
                           die("Database connection failed: " . mysqli_connect_error());
                       }

                        else {
                                                        
                               
                                $email_check_query = "SELECT * FROM `users` WHERE `email` = '$email'";
                                $result = mysqli_query($con, $email_check_query);

                                if (mysqli_num_rows($result) > 0) 
                                {

                                    $row = mysqli_fetch_assoc($result);
                                    
                                    if($row['password']== $password)
                                    {
                                      

                                      if($row['role']=="customer")
                                      {
                                        $_SESSION["username"] = $row["email"];
                                        $_SESSION["role"] = $row["role"];
                                        $_SESSION["name"] = $row["name"];
                                        header("Location: customer/userDesh.php");  
                                      
                                    
                                      }
                                      else
                                      {
                                      
                                        $_SESSION["username"] = $row["email"];
                                       
                                        $_SESSION["role"] = $row["role"];
                                       
                                        $_SESSION["name"] = $row["name"];

                                       header("Location: admin/adminDesh.php");
                                 
                                      }
                                    }
                                    else 
                                    {
                                         echo "<script>alert('Wrong password .. please try again');</script>";

                                    }

                            
                                } 
                                
                                else 
                                {

                                   echo "<script>alert('Invalid Email.. please try again');</script>";
                                }


                       }




                      }


              }

             


  






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
background-color: #1e293b; 
display: flex;
justify-content: space-between;
align-items: center;
padding: 40px;
}

.header a{
text-decoration: none;
color: #f8fafc; /
display: inline-block;
margin-right: 100px;
font-size: 20px;
}

.header a:hover{
background-color:#475569; 
}

.logo{
font-size: 30px;
color: #38bdf8; 
text-align: center;
}


body {
min-height: 100vh;
background: linear-gradient(135deg, #e0f2fe, #bae6fd); 
font-family: Arial, sans-serif;
}

.login{
display: flex;
background: linear-gradient(135deg, #6366f1, #22d3ee); 
justify-content: center;
position: fixed;
top: 220px;
right: 30%;
width: 450px;
border: 10px solid #0f172a; 
padding: 10px;
}

.login label{
width: 120px;
display: inline-block;
font-size: 15px;
color: #ffffff; 
}


.login input{
width: 250px;
padding: 8px;
margin: 5px 0;
}

.login span {
width: 300px;
display: inline-block;
position: fixed;
right: 30%;
font-size: 15px;
}

.login legend{
font-size: 20px;
color: #ffffff; 
text-align: center;
display: block;
background-color: #0ea5e9; 
padding: 10px;
margin: 5px;
}

.form-footer{
    text-align: center;
    margin-top: 15px;
}

.form-footer p,
.form-footer a{
    color: white;
    font-size: 14px;
}

.form-footer a{
   
    font-weight: bold;
}

.footer{
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #111827;
    color: #f9fafb;
    padding: 20px;
    text-align: center;
    z-index: 1000;
}









        </style>
</head>
<body>
<header class="header">

<a href="../index.php">Home</a>
<h2 class="logo">NextGadget</h2>
<a href="login.php" style="visibility: hidden;">Login</a>



</header>
<main>

<div class="login">
<form action="login.php" method="post">
<legend>Sign In</legend>


<label>Email :</label>
<input type="email" name="email" placeholder="Enter your email">
<br>
<span style="color:#dc2626;"><?php if(isset($email_Err)){echo $email_Err;}?></span>
<br>



<label>Password :</label>
<input type="password" name="password" placeholder="Enter a Password">
<br>
<span style="color:#dc2626;"><?php if(isset($password_Err)){echo $password_Err;}?></span>
<br>





<label class="creating space" style="visibility: hidden;">Address :</label> <!-- creating space only -->
<input type="submit" name="submit"  value="Login" >

<div class="form-footer">
    <p>Don't have an account?</p>
    <a href="signup.php">Sign Up</a>
    <br>
    <br>
    <p>Forgot your password?</p>
    <a href="#">Recover Password</a>
</div>

</form>
</div>


   </main>

    <footer class="footer">



    <p>© NextGadget. All rights reserved.</p>

        </footer>
    
</body>
</html>