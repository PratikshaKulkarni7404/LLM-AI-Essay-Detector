<?php
// Database connection settings
$host = 'localhost';
$db = 'ai_essay_detector'; // Your database name
$user = 'root'; // Your MySQL username
$pass = ''; // Your MySQL password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data from POST request
$name = $_POST['name'];
$topic = $_POST['topic'];
$essay = $_POST['essay'];
$result = $_POST['result'];

// Prepare SQL to insert the essay submission into the database
$stmt = $conn->prepare("INSERT INTO essays (name, topic, essay, result) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $topic, $essay, $result);

// Execute the query
if ($stmt->execute()) {
    echo "Essay submitted successfully. It has been detected as: " . $result;
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
