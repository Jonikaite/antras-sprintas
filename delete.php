<?php

$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "project";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (isset($_POST['delete']) and $_POST['path'] == 'employees' and $_POST['delete'] == 'Delete') {
    $sql = 'DELETE FROM employees_projects WHERE employee_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_POST['names_id']);
    $res = $stmt->execute();

    $stmt->close();
    mysqli_close($conn);
    header("Location: index.php?path=employees");
    exit();
}

?>