<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../model/dbConnect.php';
    
   $name="";
   $email="";
   $gender="";
   $phone="";
   $password="";
   $address="";
   $confirm_password="";



   $name_Err="";
   $email_Err="";
   $gender_Err="";
   $phone_Err="";
   $password_Err="";
   $address_Err="";
   $confirm_password_Err="";
   $has_Err=false;

   if($_SERVER["REQUEST_METHOD"]=="POST")
   {

      if(empty(trim($_POST['name'])))
      {
        $name_Err = "Please Enter your name !!!!";
        $has_Err = true;
      }
      else
      {
          if(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['name']))
          {
              $name_Err="Only letters and white space allowed";
              $has_Err = true;
          }
      }

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

      if(!isset($_POST['gender']))
{
    $gender_Err = "Please select your Gender !!!!";
    $has_Err = true;
}


      if(empty(trim($_POST['phone'])))
      {
        $phone_Err = "Please Enter your Phone Number!!!!";
        $has_Err = true;
      }
      else if(!preg_match("/^[0-9]+$/", trim($_POST['phone']))) {
        $phone_Err = "Phone number must contain only digits";
        $has_Err = true;
      }

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


      if(empty(trim($_POST['address'])))
      {
        $address_Err = "Please Enter your Address !!!!";
        $has_Err = true;
      }

      if(!$has_Err)
      {
   
       
       
           
           
               $name = $_POST['name'];
               $email = $_POST['email'];
               $password = $_POST['password'];
               $address = $_POST['address'];
               $phone = $_POST['phone'];
               $gender = $_POST['gender'];
               $role = "customer";
   
   
               $con = getConnection();
   
                       if (!$con) {
                           
                           die("Database connection failed: " . mysqli_connect_error());
                       }

                       else {
                                                        
                                
                                $email_check_query = "SELECT * FROM `users` WHERE `email` = '$email'";
                                $email_check_result = mysqli_query($con, $email_check_query);

                                if (mysqli_num_rows($email_check_result) > 0) {
                                    echo "<script>alert('This email has already been used. Try a new email or login.');</script>";
                                } else {
                                  
                                    $sql = "INSERT INTO `users` ( `name`, `email`, `gender`, `password`, `phone`, `address`, `role`) 
                                            VALUES ('$name', '$email', '$gender', '$password', '$phone', '$address', '$role')";

                                    if (mysqli_query($con, $sql)) {
                                        echo "<script>
                                                alert('Your Registration is successful');
                                                window.location.href='login.php';
                                            </script>";
                                    } else {
                                        echo "<script>alert('Your Registration is denied. Try again!');</script>";
                                    }
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
color: #f8fafc; 
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

.signup{
display: flex;
background: linear-gradient(135deg, #6366f1, #22d3ee); 
justify-content: center;
position: fixed;
top: 120px;
right: 30%;
width: 450px;
border: 10px solid #0f172a; 
padding: 10px;
}

.signup label{
width: 120px;
display: inline-block;
font-size: 15px;
color: #ffffff; 
}

.signup input:not([type="radio"]),
.signup textarea{
width: 250px;
padding: 8px;
margin: 5px 0;
}

.signup span {
width: 300px;
display: inline-block;
position: fixed;
right: 32%;
font-size: 15px;
}

.signup legend{
font-size: 20px;
color: #ffffff; 
text-align: center;
display: block;
background-color: #0ea5e9; 
padding: 10px;
margin: 5px;
}

.radio-group{
margin-left: 120px;
}

.gender{
display: flex;
position: fixed;
top: 325px;
}

.address{
position: relative;
top: -30px; 
}





</style>
</head>

<body>

<header class="header">
<a href="../index.php">Home</a>
<h2 class="logo">NextGadget</h2>
<a href="login.php">Login</a>
</header>

<main>
<div class="signup">
<form action="signup.php" method="post">
<legend>User Details</legend>

<label>Name :</label>
<input type="text" name="name" placeholder="Enter your name">
<br>
<span style="color:#dc2626;"><?php if(isset($name_Err)){echo $name_Err;}?></span>
<br>

<label>Email :</label>
<input type="email" name="email" placeholder="Enter your email">
<br>
<span style="color:#dc2626;"><?php if(isset($email_Err)){echo $email_Err;}?></span>
<br>

<label class="gender">Gender :</label>
<div class="radio-group">
<input type="radio" name="gender" id="male" value="male">
<label for="male">Male</label>

<input type="radio" name="gender" id="female" value="female">
<label for="female">Female</label>
</div>
<br>
<span style="color:#dc2626;"><?php if(isset($gender_Err)){echo $gender_Err;}?></span>
<br>

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


<label>Phone number :</label>
<input type="text" name="phone" placeholder="Enter your phone number">
<br>
<span style="color:#dc2626;"><?php if(isset($phone_Err)){echo $phone_Err;}?></span>
<br>

<label class="address">Address :</label>
<textarea name="address" placeholder="Enter your address"></textarea>
<br>
<span style="color:#dc2626;"><?php if(isset($address_Err)){echo $address_Err;}?></span>
<br>
<label class="creating space" style="visibility: hidden;">Address :</label> <!-- creating space only -->
<input type="submit" name="submit"  value="sign up">

</form>
</div>
</main>

<footer class="footer">

</footer>

</body>
</html>  