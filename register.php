<?php
// Connect to database
$conn = mysqli_connect("localhost", "root", "", "register");

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error()); 
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirm_password = $_POST["confirm_password"];

  // Validate input
  if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
    echo "All fields are required.";
  } elseif ($password != $confirm_password) {
    echo "Passwords do not match.";
  } else {
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
 if (mysqli_query($conn, $sql)) {
      echo "Registration successful.";
    } else {
      echo "Error: " . mysqli_error($conn);
    }
  }
}

// Close connection
mysqli_close($conn);
?>
