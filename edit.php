<?php require_once 'auth_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
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


    $skillsArray = $student['skills'] ? explode(",", $student['skills']) : [];

} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Database Error: " . $e->getMessage() . "</div>";
    exit;
}
?>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title mb-4 text-center">Edit Student</h3>
                    <form action="update.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $student['id'] ?>">
                        <div class="mb-3">
                            <label class="form-label">First Name:</label>
                            <input type="text" name="FirstName" class="form-control" value="<?= $student['first_name'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name:</label>
                            <input type="text" name="LastName" class="form-control" value="<?= $student['last_name'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address:</label>
                            <input type="text" name="Address" class="form-control" value="<?= $student['address'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Country:</label>
                            <input type="text" name="country" class="form-control" value="<?= $student['country'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender:</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="Gender" value="Male" class="form-check-input" id="male"
                                    <?= $student['gender'] == "Male" ? "checked" : "" ?>>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="Gender" value="Female" class="form-check-input" id="female"
                                    <?= $student['gender'] == "Female" ? "checked" : "" ?>>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Skills:</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="skills[]" value="PHP" class="form-check-input" id="php"
                                    <?= in_array("PHP", $skillsArray) ? "checked" : "" ?>>
                                    <label class="form-check-label" for="php">PHP</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="skills[]" value="HTML" class="form-check-input" id="html"
                                    <?= in_array("HTML", $skillsArray) ? "checked" : "" ?>>
                                    <label class="form-check-label" for="html">HTML</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="skills[]" value="CSS" class="form-check-input" id="css"
                                    <?= in_array("CSS", $skillsArray) ? "checked" : "" ?>>
                                    <label class="form-check-label" for="css">CSS</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username:</label>
                            <input type="text" name="username" class="form-control" value="<?= $student['username'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Profile Picture:</label>
                            <?php if (!empty($student['profile_picture'])): ?>
                                <div class="mb-2">
                                    <img src="<?= $student['profile_picture'] ?>" alt="Current Profile" class="rounded" width="80" height="80" style="object-fit:cover;">
                                </div>
                            <?php endif; ?>
                            <input type="file" name="profile_picture" class="form-control" accept=".jpg,.jpeg,.png" />
                            <div class="form-text">JPG or PNG only, max 2MB. Leave empty to keep current picture.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Department:</label>
                            <input type="text" name="department" class="form-control" value="<?= $student['department'] ?>">
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="list.php" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>