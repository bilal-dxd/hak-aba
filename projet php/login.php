<?php
session_start();


$error = "";

// Check if the form is submitted

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredUsername = $_POST["uname"];
    $enteredPassword = $_POST["psw"];
    
    include_once 'user.php';
    $user = new User();
    $user->login($enteredUsername, $enteredPassword);



}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fight Store</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<header>
    <nav>
    <?php echo "<img src='img/logo.jpg' style='width: 80px;'>";?>
    </nav>
</header>
<body>
    <div class="wrapper">

    


        <form action="" method="post">
            <h1>login</h1>
                <div class="input-box">
                    <input type="text" placeholder="Username" name="uname" required><br><br>
                    <i class="bx bxs-usr"></i>
                    <input type="password" placeholder="Password" name="psw" required>
                    <i class="bx bxs-lock-alt">
                    <?php echo $error; ?>
                    </i>
                </div>
                <div class="ramenber-forget">
                    <label><input type="checkbox"> Remember </label>
                    <a href="#">forget psw</a>
                </div>
                <button type="submit" class="btn btn-success"> login </button>
                <div class="registre-link">
                <p>Don't have an account? <a href="signup.php">Registre</a></p>
                </div>
        </form>


    </div>
</body>


</html>

