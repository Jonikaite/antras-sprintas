<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

  <body class="container"> 

  <?php
            $servername = "localhost";
            $username = "root";
            $password = "mysql";
            $dbname = "project";
            $title = strtoupper($_GET['path']);
            $paths = array('projects', 'employees');
            if (isset($_GET['path']) and (in_array($_GET['path'], $paths))) {
                $table = $_GET['path'];
            }

            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
?>

    <header>
        <div style="display:inline;">
            <a href="?path=projects">Projects</a>
            <a href="?path=employees">Employees</a>
        </div>
    </header>

<?php

if (!isset($_GET['path']) or (isset($_GET['path']) and $_GET['path'] == 'projects')) {
    $sql = "SELECT project.projects.id as projects_id, project.projects.name as projects_name, GROUP_CONCAT(' ', employees.name) as names  FROM projects
    LEFT JOIN employees_projects ON employees_projects.project_id = projects.id
    LEFT JOIN employees ON employees.id = employees_projects.employee_id
    GROUP BY projects.id";
} elseif (isset($_GET['path']) and $_GET['path'] == 'employees') {
    $sql = "SELECT project.employees.id as employees_id, project.employees.name as employees_name, GROUP_CONCAT(' ', projects.name) as names FROM employees
    LEFT JOIN employees_projects ON employees_projects.employee_id = employees.id
    LEFT JOIN projects ON projects.id = employees_projects.project_id
    GROUP BY employees.id";
}

    $result = mysqli_query($conn, $sql);
        print('<table class="table"><thead>');
        print('<tr><th>Id</th><th>' . $title . '</th><th>Names</th><th>Action</th></tr>');
        print('</thead>');

        if (mysqli_num_rows($result) > 0) { 
            while($row = mysqli_fetch_assoc($result)) {
                if (!isset($table)) {
                    $table = 'projects';
                }
            print("<tr>
                <td>{$row["$table" . "_id"]}</td>
                <td>{$row["$table" . "_name"]}</td>
                <td>{$row["names"]}</td>
                <td>");
            }
        } else {
            echo "0 results";
        }
        print('</table>');

        mysqli_close($conn);
?>    

</body>
</html> 