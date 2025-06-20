<?php
$host = "localhost";     // or your hosting IP
$username = "root";      // DB username
$password = "";          // DB password
$dbname = "portfolio";   // Database name

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize input
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$review = htmlspecialchars($_POST['review']);
$referral = $_POST['referral'];

$sql = "INSERT INTO reviews (name, email, review, referral) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $review, $referral);

if ($stmt->execute()) {
    echo "✅ Thank you for your feedback!";
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
