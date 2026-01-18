<?php
    session_start();
    require_once '../model/dbConnect.php';

    $email;
    //$password;
     $name="";
    $phone="";


    $email_Err;
   // $password_Err;
     $phone_Err="";
     $name_Err="";

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

        if(empty(trim($_POST['phone'])))
      {
        $phone_Err = "Please Enter your Phone Number!!!!";
        $has_Err = true;
      }
      else if(!preg_match("/^[0-9]+$/", trim($_POST['phone']))) {
        $phone_Err = "Phone number must contain only digits";
        $has_Err = true;
      }

               

                        if(!$has_Err)
                      {
                        $email = $_POST["email"];
                       // $password = $_POST["password"];

                        $phone = $_POST["phone"];
                        $name= $_POST["name"];



                         $con=getConnection();
   
   
                       if (!$con) {
                           
                           die("Database connection failed: " . mysqli_connect_error());
                       }

                       else
                       {
                         
                  $sql = "SELECT * 
                                    FROM users 
                                    WHERE email = '$email'
                                    AND name = '$name'
                                    AND phone = '$phone';";

                       // $result =mysqli_query(con,sql);
                       $result=mysqli_query($con,$sql);
                       $row =mysqli_fetch_assoc($result);
                      
                       if (mysqli_num_rows($result) > 0) {
                            

                              
                            $_SESSION["email"] = $row["email"];
                                 header("Location: changePass.php");
                                      exit;
                                


                            
                      

                       }
                    




                    

                          else{
                          echo "<script>alert('Mismatch of information....try again');</script>";

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
<form action="validateUser.php" method="post">
<legend>Sign In</legend>


<label>Email :</label>
<input type="email" name="email" placeholder="Enter your email">
<br>
<span style="color:#dc2626;"><?php if(isset($email_Err)){echo $email_Err;}?></span>
<br>



<label>Name :</label>
<input type="text" name="name" placeholder="Enter your name">
<br>
<span style="color:#dc2626;"><?php if(isset($name_Err)){echo $name_Err;}?></span>
<br>

<label>Phone number :</label>
<input type="text" name="phone" placeholder="Enter your phone number">
<br>
<span style="color:#dc2626;"><?php if(isset($phone_Err)){echo $phone_Err;}?></span>
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