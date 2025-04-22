<?php
// Include the database connection file
include('../includes/db_connect.php'); // Updated path to the correct location

session_start(); // Start the session to get user data from login

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['email'])) {
    echo "Please log in first.";
    exit();
}

$message = ''; // Initialize a variable to store the success or error message

// Check if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST['name'];
    $messageContent = $_POST['message'];
    $user_email = $_SESSION['email'];  // Get email from session
    $user_id = $_SESSION['user_id'];  // Get user ID from session

    // Validate input (basic validation for empty fields)
    if (!empty($name) && !empty($messageContent)) {
        // Prepare the SQL query to insert the data into the contact_messages table
        $sql = "INSERT INTO Feedback (name, email, message) VALUES (?, ?, ?)";

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters to the SQL query (s = string)
            $stmt->bind_param("sss", $name, $user_email, $messageContent);  // Using strings for name, email, and message

            // Execute the query
            if ($stmt->execute()) {
                // Success message
                $message = "Your message has been successfully submitted.";
            } else {
                // Error message
                $message = "Error: " . $stmt->error; // Error in execution
            }

            // Close the statement
            $stmt->close();
        } else {
            $message = "Error preparing statement: " . $conn->error;
        }
    } else {
        $message = "Please fill in both the name and message fields.";
    }
}

// Close the database connection
$conn->close();

// Display a response page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Submission</title>
    <link rel="stylesheet" href="../assets/css/contact.css">
    <style>
        .response-message {
            text-align: center;
            margin: 20px auto;
            padding: 20px;
            max-width: 600px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .success {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }
        .error {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }
        .btn-return {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="inner-header">
            <h1 style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">Clubs
                Management System</h1>
            <div class="header-right">
                <a href="../index.html">Home</a>
                <a href="../clubs.html">Clubs</a>
                <a href="../contact.html">Contact Us</a>
                <a href="../auth/logout.php">Logout</a>
            </div>
        </div>
    </div>

    <div class="opacity">
        <div class="back-holder"></div>
    </div>

    <div class="work-area">
        <div class="content-area-medium">
            <div class="response-message <?php echo !empty($message) && strpos($message, 'Error') === false ? 'success' : 'error'; ?>">
                <h2><?php echo !empty($message) && strpos($message, 'Error') === false ? 'Thank You!' : 'Something went wrong'; ?></h2>
                <p><?php echo $message; ?></p>
                <a href="../contact.html" class="btn-return">Return to Contact Page</a>
            </div>
        </div>
    </div>
</body>
</html>