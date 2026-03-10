<?php require_once 'auth_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="list.php">Student System</a>
        <div class="d-flex align-items-center">
            <span class="text-light me-3">Welcome, <?= htmlspecialchars($_SESSION['username']) ?></span>
            <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </div>
</nav>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
<?php
require_once "Database.php";

if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>No ID provided.</div>";
    exit;
}

$id = trim($_GET['id']);

try {

    $db = \Database::getInstance()->getConnection();

    $stmt = $db->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->execute([$id]);

    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$student) {
        echo "<div class='alert alert-warning'>Record not found.</div>";
        exit;
    }

    echo "<div class='card shadow-sm'>";
    echo "<div class='card-body'>";
    echo "<h3 class='card-title mb-4 text-center'>Student Details</h3>";
    echo "<table class='table table-bordered'>";

    echo "<tr><th>ID</th>
    <td>" . $student['id'] . "</td>
    </tr>";
    echo "<tr><th>First Name</th>
    <td>" . $student['first_name'] . "</td>
    </tr>";
    echo "<tr><th>Last Name</th>
    <td>" . $student['last_name'] . "</td>
    </tr>";
    echo "<tr><th>Address</th>
    <td>" . $student['address'] . "</td>
    </tr>";
    echo "<tr><th>Country</th>
    <td>" . $student['country'] . "</td>
    </tr>";
    echo "<tr><th>Gender</th>
    <td>" . $student['gender'] . "</td>
    </tr>";
    echo "<tr><th>Username</th>
    <td>" . $student['username'] . "</td>
    </tr>";

    echo "<tr><th>Skills</th><td>";

    $skillsArray = explode(",", $student['skills']);
    foreach ($skillsArray as $skill) {
        echo "<span class='badge bg-secondary me-1'>" . trim($skill) . "</span>";
    }

    echo "</td></tr>";

    echo "<tr><th>Department</th><td>" . $student['department'] . "</td></tr>";

    echo "</table>";
    echo "<a href='list.php' class='btn btn-primary'>Back to List</a>";
    echo "</div>";
    echo "</div>";

} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Database Error: " . $e->getMessage() . "</div>";
}
?>
        </div>
    </div>
</div>
</body>
</html>