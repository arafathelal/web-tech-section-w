<?php
$fullName = $email = $phone = "";
$password = $confirmPassword = "";

$fullNameErr = $emailErr = $phoneErr = $passwordErr = $confirmPasswordErr = "";
$successMsg = "";

// Function to sanitize input 
function test_input($data) { 
    $data = trim($data); 
    $data = stripslashes($data); 
    $data = htmlspecialchars($data); 
    return $data; 
} 

// Process the form submission if it's a POST request 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Validate full name 
    if (empty($_POST["fullName"])) { 
        $fullNameErr = "Full name is required!";
    } else { 
        $fullName = test_input($_POST["fullName"]); 
        // Only alphabets and spaces
        if (!preg_match("/^[a-zA-Z ]+$/", $fullName)) {
            $fullNameErr = "Name can contain letters and spaces only!";
        }
    } 

    // Validate email 
    if (empty($_POST["email"])) { 
        $emailErr = "Email is required!";
    } else { 
        $email = test_input($_POST["email"]); 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
            $emailErr = "Invalid email format!";
        } 
    } 

    // Validate phone (example: Bangladeshi format 01XXXXXXXXX)
    if (empty($_POST["phone"])) { 
        $phoneErr = "Phone number is required!";
    } else { 
        $phone = test_input($_POST["phone"]); 
        if (!preg_match("/^01[0-9]{9}$/", $phone)) {
            $phoneErr = "Phone must be 11 digits and start with 01!";
        }
    }

    // Validate password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required!";
    } else {
        $password = test_input($_POST["password"]);
        if (strlen($password) < 6) {
            $passwordErr = "Password must be at least 6 characters!";
        }
    }

    // Validate confirm password
    if (empty($_POST["confirmPassword"])) {
        $confirmPasswordErr = "Please confirm your password!";
    } else {
        $confirmPassword = test_input($_POST["confirmPassword"]);
        if ($password !== "" && $password !== $confirmPassword) {
            $confirmPasswordErr = "Passwords do not match!";
        }
    }

    if (
        empty($fullNameErr) && 
        empty($emailErr) && 
        empty($phoneErr) && 
        empty($passwordErr) && 
        empty($confirmPasswordErr)
    ) {
        // Here you would insert into database, etc.
        $successMsg = "Registration successful!";
    }
}
?> 



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/register.css">
</head>

<body>

    <form class="register-form" id="registerForm" method="post" action="">
        <h2>Create Account</h2>
        <p id="errorMsg"></p>
        <label>
            Full Name
            <input type="text" name="fullName" id="fullName" placeholder="Enter your name" required>
        </label>
        <span style="color:red;"><?php echo $fullNameErr; ?></span>

        <label>
            Email Address
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
        </label>
        <span style="color:red;"><?php echo $emailErr; ?></span>

        <label>
            Phone Number
            <input type="tel" name="phone" id="phone" placeholder="01XXXXXXXXX" required>
        </label>
         <span style="color:red;"><?php echo $phoneErr; ?></span>

        <label>
            Password
            <input type="password" name="password" id="password" placeholder="Create password" required>
        </label>
        <span style="color:red;"><?php echo $passwordErr; ?></span>

        <label>
            Confirm Password
            <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm password" required>
        </label>
        <span style="color:red;"><?php echo $confirmPasswordErr; ?></span>


        <button type="submit">Register</button>

        <p class="info">Already have an account? <a href="login.html">Login</a></p>
    </form>

    <video class="bg-video" autoplay muted loop>
        <source src="assets/videos/bg1.mp4" type="video/mp4">
    </video>
    <!-- <script src="assets/js/register.js"></script> -->
</body>

</html>