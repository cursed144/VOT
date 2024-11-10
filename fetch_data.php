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
    die("You must be logged in to view your data.");
}

$user_id = $_SESSION['user_id'];  // Get the logged-in user's ID

// Query to fetch data for the logged-in user
$table_name = "user_data";
$query = "SELECT * FROM $table_name WHERE user_id = '$user_id'"; // Add WHERE clause to filter by user_id
$response = mysqli_query($connect, $query);

if (mysqli_num_rows($response) > 0) {
    while ($i = mysqli_fetch_assoc($response)) {
        echo "<p><strong>Name:</strong> ".$i['person_name']."</p>";
        echo "<p><strong>Email:</strong> ".$i['person_email']."</p>";
        echo "<p><strong>Phone:</strong> ".$i['person_number']."</p>";
        echo "<p><strong>Date Added:</strong> ".$i['date_added']."</p>";
        // Add a delete button with the entry's ID
        echo "<button onclick='deleteEntry(" . $i['id'] . ")'>Delete</button>";
        echo "<hr>";
    }
} else {
    echo "No data found.";
}

mysqli_close($connect);
?>
