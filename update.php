<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "project";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (isset($_POST['update']) and $_POST['path'] == 'employees' and $_POST['update'] == 'Update') {
    $sql = "UPDATE employees SET employee_name = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $_POST['name'], $_POST['id']);
    $res = $stmt->execute();

    $stmt->close();
    mysqli_close($conn);
    header("Location: index.php?path=employees");
    exit();
}