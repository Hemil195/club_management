<?php
include('../includes/db_connect.php');
session_start();  // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword'];
    
    // Fetch the user record from the database based on the provided email
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // User exists, now check the password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Successful login, set session variables and return success
            $_SESSION['user_id'] = $row['id'];  // Store user ID in the session
            $_SESSION['email'] = $row['email']; // Store user email in the session
            
            echo json_encode(["status" => "success", "message" => "Login successful!"]);
        } else {
            // Invalid password
            echo json_encode(["status" => "error", "message" => "Invalid password."]);
        }
    } else {
        // No user found with the provided email
        echo json_encode(["status" => "error", "message" => "No user found with that email."]);
    }
    
    $conn->close();  // Close the database connection
}
?>
