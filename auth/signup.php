<?php
include('../includes/db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['txtEmail'];
    $password = password_hash($_POST['txtPassword'], PASSWORD_BCRYPT);  // Hash the password

    // Check if the email already exists
    $checkEmail = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        // If email already exists, show error using JavaScript alert
        echo "<script>
                alert('Error: Email already exists');
                window.history.back();  // Go back to the signup page
              </script>";
    } else {
        // Insert email and hashed password into the 'users' table
        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            // Success message for the new user creation
            echo "<script>
                    alert('New user created successfully');
                    window.location.href = 'login.html';  // Redirect to login page after successful signup
                  </script>";
        } else {
            // Error message if the insertion fails
            echo "<script>
                    alert('Error: " . $conn->error . "');
                    window.history.back();  // Go back to the signup page
                  </script>";
        }
    }

    $conn->close();  // Close the database connection
}
?>
