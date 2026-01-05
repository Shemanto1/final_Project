<?php

$name = $email = $gender = $phone = $password = $confirm_password = $address = "";
$name_Err = $email_Err = $gender_Err = $phone_Err = $password_Err = $confirm_password_Err = $address_Err = "";
$has_Err = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Name
    if (empty(trim($_POST["name"]))) {
        $name_Err = "Name is required";
        $has_Err = true;
    } else {
        $name = $_POST["name"];
    }

    // Email
    if (empty(trim($_POST["email"]))) {
        $email_Err = "Email is required";
        $has_Err = true;
    } else {
        $email = $_POST["email"];
    }

    // Gender
    if (!isset($_POST["gender"])) {
        $gender_Err = "Gender is required";
        $has_Err = true;
    } else {
        $gender = $_POST["gender"];
    }

    // Password
    if (empty($_POST["password"])) {
        $password_Err = "Password is required";
        $has_Err = true;
    } else {
        $password = $_POST["password"];
    }

    // Confirm Password
    if (empty($_POST["confirm_password"])) {
        $confirm_password_Err = "Please confirm password";
        $has_Err = true;
    } else {
        $confirm_password = $_POST["confirm_password"];
        if ($password !== $confirm_password) {
            $confirm_password_Err = "Passwords do not match";
            $has_Err = true;
        }
    }

    // Phone
    if (empty(trim($_POST["phone"]))) {
        $phone_Err = "Phone number required";
        $has_Err = true;
    } else {
        $phone = $_POST["phone"];
    }

    // Address
    if (empty(trim($_POST["address"]))) {
        $address_Err = "Address required";
        $has_Err = true;
    } else {
        $address = $_POST["address"];
    }

    // If no error → insert into database
    if (!$has_Err) {

        $server = "localhost";
        $username = "root";
        $pass = "";
        $database = "NextGadgets";

        $con = mysqli_connect($server, $username, $pass, $database);

        if (!$con) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        // Security
        $name = mysqli_real_escape_string($con, $name);
        $email = mysqli_real_escape_string($con, $email);
        $gender = mysqli_real_escape_string($con, $gender);
        $phone = mysqli_real_escape_string($con, $phone);
        $address = mysqli_real_escape_string($con, $address);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $role = "user";

        $sql = "INSERT INTO users (name, email, gender, password, phone, address, role)
                VALUES ('$name', '$email', '$gender', '$hashedPassword', '$phone', '$address', '$role')";

        $result = mysqli_query($con, $sql);

        if (!$result) {
            die("Insert failed: " . mysqli_error($con));
        } else {
            echo "<script>alert('Registration successful');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>NextGadget – Smart Tech, Smarter Life</title>

<style>
*{ margin:0; padding:0; }

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
margin-right: 100px;
font-size: 20px;
}

.logo{
font-size: 30px;
color: #38bdf8;
}

body{
min-height:100vh;
background: linear-gradient(135deg, #e0f2fe, #bae6fd);
font-family: Arial, sans-serif;
}

.signup{
margin-top:160px;
display:flex;
justify-content:center;
}

form{
background: linear-gradient(135deg, #6366f1, #22d3ee);
width:450px;
border:10px solid #0f172a;
padding:20px;
}

label{ width:120px; display:inline-block; color:#fff; }

input, textarea{ width:250px; padding:8px; margin:5px 0; }

span{ color:#dc2626; font-size:14px; }

legend{
font-size:20px;
color:#fff;
text-align:center;
background:#0ea5e9;
padding:10px;
margin-bottom:10px;
}
</style>
</head>

<body>

<header class="header">
<a href="index.php">Home</a>
<h2 class="logo">NextGadget</h2>
<a href="login.php">Login</a>
</header>

<div class="signup">
<form method="post">
<legend>User Details</legend>

<label>Name :</label>
<input type="text" name="name" value="<?= $name ?>">
<span><?= $name_Err ?></span><br>

<label>Email :</label>
<input type="email" name="email" value="<?= $email ?>">
<span><?= $email_Err ?></span><br>

<label>Gender :</label>
<input type="radio" name="gender" value="male"> Male
<input type="radio" name="gender" value="female"> Female
<span><?= $gender_Err ?></span><br>

<label>Password :</label>
<input type="password" name="password">
<span><?= $password_Err ?></span><br>

<label>Confirm :</label>
<input type="password" name="confirm_password">
<span><?= $confirm_password_Err ?></span><br>

<label>Phone :</label>
<input type="text" name="phone" value="<?= $phone ?>">
<span><?= $phone_Err ?></span><br>

<label>Address :</label>
<textarea name="address"><?= $address ?></textarea>
<span><?= $address_Err ?></span><br>

<input type="submit" value="Sign Up">
</form>
</div>

</body>
</html>
