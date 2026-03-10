<?php
require_once "Database.php";

$db = \Database::getInstance()->getConnection();

if(!isset($_POST['FirstName']) || !isset($_POST['LastName']) || !isset($_POST['Address']) || !isset($_POST['country']) || !isset($_POST['Gender']) || !isset($_POST['skills']) || !isset($_POST['username']) || !isset($_POST['department'])){
    echo "Please fill in all the fields.";
    exit;
}
if(empty($_POST['FirstName']) || empty($_POST['LastName']) || empty($_POST['Address']) || empty($_POST['country']) || empty($_POST['Gender']) || empty($_POST['skills']) || empty($_POST['username']) || empty($_POST['department'])){
    echo "Please fill in all the fields.";
    exit;
}

$firstName = trim($_POST['FirstName']);
$lastName = trim($_POST['LastName']);
$address = trim($_POST['Address']);
$country = trim($_POST['country']);
$gender = trim($_POST['Gender']);
$skills = implode(",", array_map('trim', $_POST['skills']));
$username = trim($_POST['username']);
$department = trim($_POST['department']);

// Handle profile picture upload
$profilePicture = '';
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

$sql = "INSERT INTO students (first_name, last_name, address, country, gender, skills, username, department, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$statment = $db->prepare($sql);

$statment->execute([
        $firstName,
        $lastName,
        $address,
        $country,
        $gender,
        $skills,
        $username,
        $department,
        $profilePicture]);

    header("Location: list.php");
    exit;
?>