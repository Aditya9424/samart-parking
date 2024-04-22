<?php
// Assuming your database connection code
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "signup";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user input
$email = $_POST['email'];
$password = $_POST['password'];

// Use prepared statement to prevent SQL injection
$sql = "SELECT * FROM form WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the password from the database
    $row = $result->fetch_assoc();
    $storedPassword = $row['password'];

    // Verify the password (without hashing)
    if ($password == $storedPassword) {
        // Login successful, you can redirect or perform other actions here
        header("Location: http://localhost/miniproject/fuckoff.html"); // Change 'dashboard.php' to your desired location
        exit(); // Make sure to exit to prevent further script execution
    } else {
        // Invalid password
        echo "<script>alert('Invalid email or password');</script>";
    }
} else {
    // Invalid email
    echo "<script>alert('Invalid email or password');</script>";
}

$stmt->close();
$conn->close();
?>
