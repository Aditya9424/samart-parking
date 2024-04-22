<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "signup";

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  if(isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Remove the password hashing
    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $sql_query = "INSERT INTO form (fname, lname, email, password)
                  VALUES ('$fname', '$lname', '$email', '$password')";

    if (mysqli_query($conn, $sql_query)) {
       // Redirect to a success page
       header("Location: http://localhost/miniproject/index.html");
       exit(); // Ensure that subsequent code is not executed after the redirect
    } else {
      echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
  }
?>
