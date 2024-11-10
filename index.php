<?php
// Include the header file
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address Book</title>
    <script src="scripts.js"></script>
</head>
<body>
    <?php if (!isset($_SESSION['user_id'])): ?>
        <!-- Registration Form -->
        <h2>Register</h2>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <button type="submit" name="register">Register</button>
        </form>

        <!-- Login Form -->
        <h2>Login</h2>
        <form method="POST">
            <label for="login_username">Username:</label>
            <input type="text" id="login_username" name="username" required><br>

            <label for="login_password">Password:</label>
            <input type="password" id="login_password" name="password" required><br>

            <button type="submit" name="login">Login</button>
        </form>
    <?php else: ?>
        <!-- Logged-in user's page -->
        <h2>Add a New Person</h2>
        <form id="addForm" onsubmit="submitForm(event)"> <!-- Updated here -->
            <label for="person_name">Name:</label>
            <input type="text" id="person_name" name="person_name" required><br>

            <label for="person_email">Email:</label>
            <input type="email" id="person_email" name="person_email" required><br>

            <label for="person_number">Phone Number:</label>
            <input type="text" id="person_number" name="person_number" required><br>

            <button type="submit">Add Person</button>
        </form>

        <p id="message"></p> <!-- Message display -->

        <button onclick="fetchData()">Show Data</button>
        <div id="data-container"></div>

        <!-- Logout Button -->
        <form method="POST" style="margin-top: 20px;">
            <button type="submit" name="logout">Logout</button>
        </form>
    <?php endif; ?>
</body>
</html>
