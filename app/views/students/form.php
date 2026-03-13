<?php
$title = 'Add Student';
$showNavbar = isset($_SESSION['username']);
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

            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title mb-4 text-center">Add Student</h3>
                    <form id="studentForm" action="index.php?route=student.store" method="POST" enctype="multipart/form-data" onsubmit="return validateForm('studentForm')">
                        <div class="mb-3">
                            <label class="form-label">First Name:</label>
                            <input type="text" name="FirstName" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name:</label>
                            <input type="text" name="LastName" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address:</label>
                            <textarea name="Address" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Country:</label>
                            <select name="country" class="form-select">
                                <option value="">-- Select Country --</option>
                                <option value="Cairo">Cairo</option>
                                <option value="Asuit">Asuit</option>
                                <option value="Alexandria">Alexandria</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender:</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="Gender" value="Male" class="form-check-input" id="male">
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="Gender" value="Female" class="form-check-input" id="female">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Skills:</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="skills[]" value="PHP" class="form-check-input" id="php">
                                    <label class="form-check-label" for="php">PHP</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="skills[]" value="HTML" class="form-check-input" id="html">
                                    <label class="form-check-label" for="html">HTML</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="skills[]" value="CSS" class="form-check-input" id="css">
                                    <label class="form-check-label" for="css">CSS</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username:</label>
                            <input type="text" name="username" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password:</label>
                            <input type="password" name="password" class="form-control" />
                            <div class="form-text">Exactly 8 characters: lowercase letters, numbers, and underscore only.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Profile Picture:</label>
                            <input type="file" name="profile_picture" class="form-control" accept=".jpg,.jpeg,.png" />
                            <div class="form-text">JPG or PNG only, max 2MB.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Department:</label>
                            <input type="text" name="department" value="OpenSource" class="form-control" readonly />
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <a href="index.php?route=students" class="btn btn-outline-success">View List</a>
                            <?php if (!isset($_SESSION['username'])): ?>
                                <a href="index.php?route=login" class="btn btn-outline-dark">Login</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="validate.js"></script>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
