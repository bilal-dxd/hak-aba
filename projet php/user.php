<?php
include_once 'database.php';
    
class User {
    function login($username, $password){
            // Use prepared statement to prevent SQL injection
            $sql = "SELECT * FROM Users WHERE UserName = :username";

            // get database connection
            $database = new Database();
            $db = $database->getConnection();
            // Preparing the SQL statement
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            // extension to fetch data from a database
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($password, $row['Password'])) {
                    // Valid username and password
                    $_SESSION["authorized"] = true;
                    $_SESSION["role"] = $row['role'];
                    if($row['role'] == "admin") {
                        header("Location: php_template_crud_oop-main/add_product.php");
                    }else {
                    header("Location: php_template_crud_oop-main/view_products.php");
                    }
                    exit();
                } else {
                    // Invalid password
                    $error = "Invalid username or password";
                }
            } else {
                // Invalid username
                $error = "Invalid username or password";
            }
        
            // Close the database connection
            unset($db);
    }

    function register($username, $email, $address, $telephone, $password){
        // Creating a new instance of the Database class and getting a connection
        $database = new Database();
        $db = $database->getConnection();

        $insertQuery = "INSERT INTO Users (UserName, Email, Address, Telephone, Password)
                        VALUES ('$username', '$email', '$address', '$telephone', '$password')";

            // Perform the database query
            $result = $db->query($insertQuery);

            // Check if the query was successful
            if ($result) {
                header("Location: login.php");
                } else {
                // If there is an error, use $db->errorInfo() to get the error details
                $errorInfo = $db->errorInfo();
                echo "Error registering user: " . $errorInfo[2] . "<br>";
            }
    }
}