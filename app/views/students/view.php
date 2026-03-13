<?php
$title = 'View Student';
$showNavbar = true;
require __DIR__ . '/../layouts/header.php';
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title mb-4 text-center">Student Details</h3>

                    <?php if (!empty($student['profile_picture'])): ?>
                        <div class="text-center mb-3">
                            <img src="<?= htmlspecialchars($student['profile_picture']) ?>" alt="Profile Picture" class="rounded-circle" width="100" height="100" style="object-fit:cover;">
                        </div>
                    <?php endif; ?>

                    <table class="table table-bordered">
                        <tr><th>ID</th><td><?= (int)$student['id'] ?></td></tr>
                        <tr><th>First Name</th><td><?= htmlspecialchars($student['first_name']) ?></td></tr>
                        <tr><th>Last Name</th><td><?= htmlspecialchars($student['last_name']) ?></td></tr>
                        <tr><th>Address</th><td><?= htmlspecialchars($student['address']) ?></td></tr>
                        <tr><th>Country</th><td><?= htmlspecialchars($student['country']) ?></td></tr>
                        <tr><th>Gender</th><td><?= htmlspecialchars($student['gender']) ?></td></tr>
                        <tr><th>Username</th><td><?= htmlspecialchars($student['username']) ?></td></tr>
                        <tr>
                            <th>Skills</th>
                            <td>
                                <?php foreach (explode(',', $student['skills']) as $skill): ?>
                                    <span class="badge bg-secondary me-1"><?= htmlspecialchars(trim($skill)) ?></span>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                        <tr><th>Department</th><td><?= htmlspecialchars($student['department']) ?></td></tr>
                    </table>

                    <a href="index.php?route=students" class="btn btn-primary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
