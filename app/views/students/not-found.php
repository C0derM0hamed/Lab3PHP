<?php
$title = 'Not Found';
$showNavbar = true;
require __DIR__ . '/../layouts/header.php';
?>
<div class="container py-5">
    <div class="alert alert-warning text-center"><?= htmlspecialchars($message ?? 'Record not found.') ?></div>
    <div class="text-center">
        <a href="index.php?route=students" class="btn btn-primary">Back to List</a>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
