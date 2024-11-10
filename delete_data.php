<?php
$connect = mysqli_connect(
    'db', // service name
    'php_docker', // username
    'password', // password
    'php_docker' // database name
);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    
    $query = "DELETE FROM user_data WHERE id = $id";
    if (mysqli_query($connect, $query)) {
        echo "Entry deleted successfully";
    } else {
        echo "Error deleting entry: " . mysqli_error($connect);
    }

    mysqli_close($connect);
}
?>
