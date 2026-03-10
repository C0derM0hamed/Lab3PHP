<?php
session_start();

// If already logged in, redirect to list page
if (isset($_SESSION['username'])) {
    header("Location: list.php");
    exit;
}

$error = '';
if (isset($_GET['error'])) {
    if ($_GET['error'] === 'invalid') {
        $error = 'Invalid username or password.';
    } elseif ($_GET['error'] === 'empty') {
        $error = 'Please fill in all fields.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
<div class="login-wrapper">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="text-center mb-4">
                <h2 class="page-title">Student System</h2>
                <p class="text-muted">Sign in to your account</p>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title mb-4 text-center">Login</h3>

                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <form id="loginForm" action="login_process.php" method="POST" onsubmit="return validateLogin()">
                        <div class="mb-3">
                            <label class="form-label">Username:</label>
                            <input type="text" name="username" id="loginUsername" class="form-control" />
                            <div class="invalid-feedback" id="usernameError"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password:</label>
                            <input type="password" name="password" id="loginPassword" class="form-control" />
                            <div class="invalid-feedback" id="passwordError"></div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>

                    <p class="text-center mt-3 mb-0">
                        <a href="index.php">Register new student</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
function validateLogin() {
    let isValid = true;
    const username = document.getElementById('loginUsername');
    const password = document.getElementById('loginPassword');
    const usernameError = document.getElementById('usernameError');
    const passwordError = document.getElementById('passwordError');

    // Reset
    username.classList.remove('is-invalid');
    password.classList.remove('is-invalid');

    if (username.value.trim() === '') {
        username.classList.add('is-invalid');
        usernameError.textContent = 'Username is required.';
        isValid = false;
    }

    if (password.value.trim() === '') {
        password.classList.add('is-invalid');
        passwordError.textContent = 'Password is required.';
        isValid = false;
    }

    return isValid;
}
</script>
</body>
</html>
