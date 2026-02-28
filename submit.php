<?php
$servername = "localhost";
$username = "root"; // default username for XAMPP
$password = "";     // XAMPP ka default password khali hota hai
$dbname = "smarthome";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get data from form
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// Basic server-side validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  die("Invalid email format.");
}
if (!preg_match('/^\d{10}$/', $phone)) {
  die("Phone number must be exactly 10 digits.");
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO login (Name, Email, Phone) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $phone);

// Execute and redirect
if ($stmt->execute()) {
  echo "<script>alert('Sign in successful!'); window.location.href='home.html';</script>";
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
