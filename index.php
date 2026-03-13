<?php
require_once __DIR__ . '/app/bootstrap.php';
require_once __DIR__ . '/app/models/Database.php';
require_once __DIR__ . '/app/models/Student.php';
require_once __DIR__ . '/app/controllers/StudentController.php';
require_once __DIR__ . '/app/controllers/AuthController.php';

$db = \Database::getInstance($config['db'])->getConnection();
$studentModel = new \Student($db);

$studentController = new \StudentController($studentModel);
$authController = new \AuthController($studentModel);

$route = $_GET['route'] ?? 'register';

switch ($route) {
    case 'register':
        $studentController->showCreate();
        break;
    case 'student.store':
        $studentController->store();
        break;
    case 'students':
        $studentController->index();
        break;
    case 'student.view':
        $studentController->show();
        break;
    case 'student.edit':
        $studentController->edit();
        break;
    case 'student.update':
        $studentController->update();
        break;
    case 'student.delete':
        $studentController->delete();
        break;
    case 'login':
        $authController->showLogin();
        break;
    case 'login.process':
        $authController->login();
        break;
    case 'logout':
        $authController->logout();
        break;
    default:
        http_response_code(404);
        echo 'Route not found.';
        break;
}
