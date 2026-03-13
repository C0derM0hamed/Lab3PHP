<?php
$title = 'Edit Student';
$showNavbar = true;
$skillsArray = $student['skills'] ? explode(',', $student['skills']) : [];
require __DIR__ . '/../layouts/header.php';
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title mb-4 text-center">Edit Student</h3>
                    <form id="editForm" action="index.php?route=student.update" method="POST" enctype="multipart/form-data" onsubmit="return validateForm('editForm')">
                        <input type="hidden" name="id" value="<?= (int)$student['id'] ?>">
                        <div class="mb-3">
                            <label class="form-label">First Name:</label>
                            <input type="text" name="FirstName" class="form-control" value="<?= htmlspecialchars($student['first_name']) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name:</label>
                            <input type="text" name="LastName" class="form-control" value="<?= htmlspecialchars($student['last_name']) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address:</label>
                            <input type="text" name="Address" class="form-control" value="<?= htmlspecialchars($student['address']) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Country:</label>
                            <input type="text" name="country" class="form-control" value="<?= htmlspecialchars($student['country']) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender:</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="Gender" value="Male" class="form-check-input" id="male" <?= $student['gender'] === 'Male' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="Gender" value="Female" class="form-check-input" id="female" <?= $student['gender'] === 'Female' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Skills:</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="skills[]" value="PHP" class="form-check-input" id="php" <?= in_array('PHP', $skillsArray, true) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="php">PHP</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="skills[]" value="HTML" class="form-check-input" id="html" <?= in_array('HTML', $skillsArray, true) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="html">HTML</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="skills[]" value="CSS" class="form-check-input" id="css" <?= in_array('CSS', $skillsArray, true) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="css">CSS</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username:</label>
                            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($student['username']) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Profile Picture:</label>
                            <?php if (!empty($student['profile_picture'])): ?>
                                <div class="mb-2">
                                    <img src="<?= htmlspecialchars($student['profile_picture']) ?>" alt="Current Profile" class="rounded" width="80" height="80" style="object-fit:cover;">
                                </div>
                            <?php endif; ?>
                            <input type="file" name="profile_picture" class="form-control" accept=".jpg,.jpeg,.png" />
                            <div class="form-text">JPG or PNG only, max 2MB. Leave empty to keep current picture.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Department:</label>
                            <input type="text" name="department" class="form-control" value="<?= htmlspecialchars($student['department']) ?>">
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="index.php?route=students" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="validate.js"></script>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
