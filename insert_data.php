<?php
// Connect to the database
$connect = mysqli_connect(
    'db', // service name
    'php_docker', // username
    'password', // password
    'php_docker' // database name
);

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Start the session to get the user_id of the logged-in user
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to add data.");
}

$user_id = $_SESSION['user_id'];  // Get the logged-in user's ID

// Check if form data has been sent via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['person_name'];
    $email = $_POST['person_email'];
    $number = $_POST['person_number'];
    $date_added = date('Y-m-d'); // Get today's date in YYYY-MM-DD format

    // Prepare and execute the SQL INSERT statement
    $query = "INSERT INTO user_data (user_id, person_name, person_email, person_number, date_added) 
          VALUES ('$user_id', '$name', '$email', '$number', CURDATE())";

    if (mysqli_query($connect, $query)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connect);
    }

    mysqli_close($connect);
}
?>
