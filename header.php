<?php
session_start();

// Connect to the database
$connect = mysqli_connect('db', 'php_docker', 'password', 'php_docker');
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle Registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    // Check if the username already exists
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "Error: Username already taken.";
    } else {
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if (mysqli_query($connect, $query)) {
            $_SESSION['user_id'] = mysqli_insert_id($connect); // Log the user in immediately
            echo "User registered and logged in!";
        } else {
            echo "Error: " . mysqli_error($connect);
        }
    }
}

// Handle Login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($connect, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];  // Store user id in session
        echo "Logged in successfully!";
    } else {
        echo "Invalid credentials!";
    }
}

// Handle Logout
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    echo "Logged out successfully!";
}
?>
