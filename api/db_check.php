<?php
// Include the database connection file
include('../includes/db_connect.php');

// Check if the Feedback table exists
$tableCheck = $conn->query("SHOW TABLES LIKE 'Feedback'");

if ($tableCheck->num_rows == 0) {
    // Table doesn't exist, create it
    $createTable = "CREATE TABLE Feedback (
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        message TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if ($conn->query($createTable)) {
        echo "Feedback table created successfully!";
    } else {
        echo "Error creating Feedback table: " . $conn->error;
    }
} else {
    echo "Feedback table already exists.";
}

// Display the tables in the database for debugging
echo "<h2>Tables in the database:</h2>";
$result = $conn->query("SHOW TABLES");
if ($result->num_rows > 0) {
    echo "<ul>";
    while($row = $result->fetch_row()) {
        echo "<li>" . $row[0] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No tables found in the database.";
}

// Close the database connection
$conn->close();
?> 