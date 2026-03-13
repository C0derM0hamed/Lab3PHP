<?php $title = $title ?? 'Student System'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
<?php if (!empty($showNavbar)): ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php?route=students">Student System</a>
        <div class="d-flex align-items-center">
            <span class="text-light me-3">Welcome, <?= htmlspecialchars($_SESSION['username'] ?? 'Guest') ?></span>
            <a href="index.php?route=logout" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </div>
</nav>
<?php endif; ?>
