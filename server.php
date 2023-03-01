<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user's data from a form or other source
$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];
$fullname = $_POST["fullname"];

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and bind the SQL statement
$stmt = $conn->prepare("INSERT INTO users (username, password, email, fullname) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $username, $hashed_password, $email, $fullname);

// Execute the SQL statement
if ($stmt->execute() === TRUE) {
    echo "New user created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$conn->close();
?>

