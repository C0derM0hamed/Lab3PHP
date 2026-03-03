<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4 text-center">Student List</h2>
    <div class="mb-3">
        <a href="index.php" class="btn btn-primary">Add New Student</a>
    </div>
<?php
require_once "Database.php";

$db = \Database::getInstance()->getConnection();

$sql = $db->query("SELECT * FROM students");

$rows = $sql->fetchAll(PDO::FETCH_ASSOC);

echo "<div class='table-responsive'>";
echo "<table class='table table-striped table-hover table-bordered align-middle'>";
echo "<thead class='table-dark'>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Name</th>";
echo "<th>Adress</th>";
echo "<th>Country</th>";
echo "<th>Gender</th>";
echo "<th>Skills</th>";
echo "<th>Department</th>";
echo "<th>Actions</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

foreach($rows as $r){
    echo "<tr>";
    echo "<td>" . $r['id'] . "</td>";
    echo "<td>" . $r['first_name'] . " " . $r['last_name'] . "</td>";
    echo "<td>" . $r['address'] . "</td>";
    echo "<td>" . $r['country'] . "</td>";    
    echo "<td>" . $r['gender'] . "</td>";
    echo "<td>" . $r['skills'] . "</td>";
    echo "<td>" . $r['department'] . "</td>";
    echo "<td>";
    echo "<a href='edit.php?id=" . $r['id'] . "' class='btn btn-sm btn-warning me-1'>Edit</a>";
    echo "<a href='delete.php?id=" . $r['id'] . "' class='btn btn-sm btn-danger me-1'>Delete</a>";
    echo "<a href='view.php?id=" . $r['id'] . "' class='btn btn-sm btn-info'>View</a>";
    echo "</td>";
    echo "</tr>";
    
}
echo "</tbody>";
echo "</table>";
echo "</div>";
?>
</div>
</body>
</html>
