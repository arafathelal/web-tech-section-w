<?php
$emailErr = $passwordErr = "";
$email = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Email validation
    if (empty($_POST["email"])) {
        $emailErr = "Email is required!";
    } else {
        $email = $_POST["email"];
    }

    // Password validation
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required!";
    } else {
        $password = $_POST["password"];
    }

    // If no errors, show success page
    if ($emailErr == "" && $passwordErr == "") {
        echo "<h1 style='color:green; text-align:center; margin-top:50px;'>Login Successful!</h1>";
        exit(); // stop HTML from showing
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>

    <form class="login-form" method="post">
        <h2>Login</h2>

        <p style="color:red;"><?php echo $emailErr; ?></p>
        <p style="color:red;"><?php echo $passwordErr; ?></p>

        <label>
            Email Address
            <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Enter your email">
        </label>

        <label>
            Password
            <input type="password" name="password" placeholder="Enter your password">
        </label>

        <button type="submit">Login</button>

        <p class="info">Don't have an account? <a href="registration.html">Register</a></p>
    </form>

    <video class="bg-video" autoplay muted loop playsinline>
        <source src="bg1.mp4" type="video/mp4">
    </video>

</body>

</html>
