<?php
require_once "Database.php";

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    echo "Invalid request.";
    exit;
}

if (!isset($_POST['id'])) {
    echo "No ID provided.";
    exit;
}

$id = trim($_POST['id']);

$first  = trim($_POST['FirstName']);
$last   = trim($_POST['LastName']);
$address = trim($_POST['Address']);
$country = trim($_POST['country']);
$gender  = trim($_POST['Gender']);
$username = trim($_POST['username']);
$department = trim($_POST['department']);

$skills = isset($_POST['skills'])
    ? implode(",", $_POST['skills'])
    : "";

// Handle profile picture upload
$profilePicture = null;
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['profile_picture'];
    $allowedTypes = ['image/jpeg', 'image/png'];
    $maxSize = 2 * 1024 * 1024; // 2MB

    if (!in_array($file['type'], $allowedTypes)) {
        echo "Invalid file type. Only JPG and PNG are allowed.";
        exit;
    }

    if ($file['size'] > $maxSize) {
        echo "File is too large. Maximum size is 2MB.";
        exit;
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newFileName = uniqid('profile_', true) . '.' . $ext;
    $destination = 'uploads/' . $newFileName;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        echo "Failed to upload file.";
        exit;
    }

    $profilePicture = $destination;
}

try {

    $db = \Database::getInstance()->getConnection();

    if ($profilePicture !== null) {
        $sql = "UPDATE students SET
                first_name = ?,
                last_name = ?,
                address = ?,
                country = ?,
                gender = ?,
                username = ?,
                skills = ?,
                department = ?,
                profile_picture = ?
                WHERE id = ?";

        $stmt = $db->prepare($sql);

        $stmt->execute([
            $first,
            $last,
            $address,
            $country,
            $gender,
            $username,
            $skills,
            $department,
            $profilePicture,
            $id
        ]);
    } else {
        $sql = "UPDATE students SET
                first_name = ?,
                last_name = ?,
                address = ?,
                country = ?,
                gender = ?,
                username = ?,
                skills = ?,
                department = ?
                WHERE id = ?";

        $stmt = $db->prepare($sql);

        $stmt->execute([
            $first,
            $last,
            $address,
            $country,
            $gender,
            $username,
            $skills,
            $department,
            $id
        ]);
    }

    header("Location: list.php");
    exit;

} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}
?>