<?php
    session_start();
    require_once '../model/dbConnect.php';


      if(isset($_SESSION["email"]))
        {
       $email;
    $password;
  


    
    $password_Err;
     
     

    $has_Err=false;

              if($_SERVER["REQUEST_METHOD"]=="POST")
              {
                      if(empty(trim($_POST['password'])))
{
    $password_Err = "Please Enter your password !!!!";
    $has_Err = true;
}
else if(strlen($_POST['password']) < 8)
{
    $password_Err = "Password must be at least 8 characters long";
    $has_Err = true;
}


      if(empty(trim($_POST['confirm_password'])))
{
    $confirm_password_Err = "Please confirm your password !!!!";
    $has_Err = true;
}
else if(trim($_POST['password']) !== trim($_POST['confirm_password']))
{
    $confirm_password_Err = "Passwords do not match !!!!";
    $has_Err = true;
}

               

                        if(!$has_Err)
                      {

                        $con=getConnection();

                        $password = $_POST['password'];
                        $email =$_SESSION["email"];

                        $sql="update users set password='$password' where email='$email' ";
                        $result = mysqli_query($con,$sql);
                        if(mysqli_affected_rows($con))
                        {        session_destroy();
                              //  echo "<script>alert('Password changed successfully....');</script>";

                                echo "<script>
                                            alert('Password changed successfully!');
                                            window.location.href = '../views/login.php';
                                        </script>";
                                    exit;

                                

                        }
              

             


                    }
                }

                

        }
        else
        {header("Location: index.php");

            
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
<form action="changePass.php" method="post">
<legend>Change Password</legend>

<label>Password :</label>
<input type="text" name="password" placeholder="Enter a Password">
<br>
<span style="color:#dc2626;"><?php if(isset($password_Err)){echo $password_Err;}?></span>
<br>
<label>Confirm Password :</label>
<input type="text" name="confirm_password" placeholder="Re-enter Password">
<br>
<span style="color:#dc2626;"><?php if(isset($confirm_password_Err)) echo $confirm_password_Err; ?></span>
<br>





<label class="creating space" style="visibility: hidden;">Address :</label> <!-- creating space only -->
<input type="submit" name="submit"  value="Next" >


</form>
</div>


   </main>

    <footer class="footer">



    <p>© NextGadget. All rights reserved.</p>

        </footer>
    
</body>
</html>