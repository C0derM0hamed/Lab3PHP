<?php
$title = 'Student List';
$showNavbar = true;
require __DIR__ . '/../layouts/header.php';
?>
<div class="container py-5">
    <h2 class="mb-4 text-center page-title">Student List</h2>
    <div class="mb-3">
        <a href="index.php" class="btn btn-primary">Add New Student</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Address</th>
                <th>Country</th>
                <th>Gender</th>
                <th>Skills</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= (int)$student['id'] ?></td>
                    <td>
                        <?php if (!empty($student['profile_picture'])): ?>
                            <img src="<?= htmlspecialchars($student['profile_picture']) ?>" alt="Profile" class="rounded-circle" width="40" height="40" style="object-fit:cover;">
                        <?php else: ?>
                            <span class="text-muted">No photo</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?></td>
                    <td><?= htmlspecialchars($student['address']) ?></td>
                    <td><?= htmlspecialchars($student['country']) ?></td>
                    <td><?= htmlspecialchars($student['gender']) ?></td>
                    <td><?= htmlspecialchars($student['skills']) ?></td>
                    <td><?= htmlspecialchars($student['department']) ?></td>
                    <td>
                        <a href="index.php?route=student.edit&id=<?= (int)$student['id'] ?>" class="btn btn-sm btn-warning me-1">Edit</a>
                        <a href="index.php?route=student.delete&id=<?= (int)$student['id'] ?>" class="btn btn-sm btn-danger me-1">Delete</a>
                        <a href="index.php?route=student.view&id=<?= (int)$student['id'] ?>" class="btn btn-sm btn-info">View</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
