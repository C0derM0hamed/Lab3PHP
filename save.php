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



$sql = "INSERT INTO students (first_name, last_name, address, country, gender, skills, username, department) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$statment = $db->prepare($sql);


$statment->execute([
        $firstName,
        $lastName,
        $address,
        $country,
        $gender,
        $skills,
        $username,
        $department]);

    header("Location: list.php");
    exit;
?>