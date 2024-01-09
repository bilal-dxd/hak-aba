<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $telephone = $_POST["telephone"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    include_once 'user.php';
    $user = new User();
    $user->register($username, $email, $address, $telephone, $password);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fight Store - Sign Up</title>
    <link rel="stylesheet" href="signup.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="wrapper">
        <form action="#" method="post">
            <h1>Sign Up</h1>
            <div class="input-box">
                <input type="text" placeholder="User Name" id="username" name="username" required>
                <i class="bx bxs-user"></i>
                <input type="email" placeholder="Email" id="email" name="email" required>
                <i class="bx bxs-envelope"></i>
                <input type="text" placeholder="Address" id="address" name="address" required>
                <i class="bx bxs-home"></i>
                <input type="tel" placeholder="Telephone" id="telephone" name="telephone" required>
                <i class="bx bxs-phone"></i>
                <input type="password" placeholder="Password" id="password" name="password" required>
                <i class="bx bxs-lock-alt"></i>
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
            <div class="login-link">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </form>
    </div>
</body>
</html>
