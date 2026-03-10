<?php
session_start();
require_once "Database.php";

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("Location: login.php");
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($username) || empty($password)) {
    header("Location: login.php?error=empty");
    exit;
}

try {
    $db = \Database::getInstance()->getConnection();

    $stmt = $db->prepare("SELECT * FROM students WHERE username = ?");
    $stmt->execute([$username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && isset($user['password']) && password_verify($password, $user['password'])) {
        // Valid credentials - create session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['full_name'] = $user['first_name'] . ' ' . $user['last_name'];

        header("Location: list.php");
        exit;
    } else {
        header("Location: login.php?error=invalid");
        exit;
    }

} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}
?>
