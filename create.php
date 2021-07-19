<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "project";

$conn = mysqli_connect($servername, $username, $password, $dbname);
?>

<div class="create">
	<h2>Add project</h2>
    <form action="create.php" method="post">
        <label for="ID">Project</label>
        <input type="text" name="project" placeholder="project name" id="id">
        <label for="name">Name</label>
        <input type="text" name="name" placeholder="employee name" id="name">
        <input type="submit" value="Create">
    </form>
</div>

<?php
if (isset($_POST['create']) and $_POST['path'] == 'employees' and $_POST['create'] == 'Create') {
    $sql = "INSERT into employees (employee_name) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $_POST['name']);
    $res = $stmt->execute();

    $stmt->close();
    mysqli_close($conn);
    header("Location: index.php?path=project");
    exit();
}
?>
