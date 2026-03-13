<?php

class StudentController
{
    private $studentModel;

    public function __construct($studentModel)
    {
        $this->studentModel = $studentModel;
    }

    public function showCreate(): void
    {
        $errors = $_SESSION['form_errors'] ?? [];
        unset($_SESSION['form_errors']);

        view('students/form', ['errors' => $errors]);
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirectTo('index.php');
        }

        $errors = $this->validateCreateRequest($_POST);
        if (!empty($errors)) {
            $_SESSION['form_errors'] = $errors;
            redirectTo('index.php');
        }

        $username = trim($_POST['username']);
        if ($this->studentModel->findByUsername($username)) {
            $_SESSION['form_errors'] = ['Username already exists.'];
            redirectTo('index.php');
        }

        $profilePicture = $this->handleProfileUpload('profile_picture', false);
        if ($profilePicture === false) {
            redirectTo('index.php');
        }

        $this->studentModel->create([
            'first_name' => trim($_POST['FirstName']),
            'last_name' => trim($_POST['LastName']),
            'address' => trim($_POST['Address']),
            'country' => trim($_POST['country']),
            'gender' => trim($_POST['Gender']),
            'skills' => implode(',', array_map('trim', $_POST['skills'] ?? [])),
            'username' => $username,
            'password' => password_hash(trim($_POST['password']), PASSWORD_DEFAULT),
            'department' => trim($_POST['department']),
            'profile_picture' => $profilePicture ?: '',
        ]);

        redirectTo('index.php?route=students');
    }

    public function index(): void
    {
        requireAuth();
        $students = $this->studentModel->all();
        view('students/list', ['students' => $students]);
    }

    public function show(): void
    {
        requireAuth();

        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            view('students/not-found', ['message' => 'No ID provided.']);
            return;
        }

        $student = $this->studentModel->findById($id);
        if (!$student) {
            view('students/not-found', ['message' => 'Record not found.']);
            return;
        }

        view('students/view', ['student' => $student]);
    }

    public function edit(): void
    {
        requireAuth();

        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            view('students/not-found', ['message' => 'No ID provided.']);
            return;
        }

        $student = $this->studentModel->findById($id);
        if (!$student) {
            view('students/not-found', ['message' => 'Record not found.']);
            return;
        }

        $errors = $_SESSION['form_errors'] ?? [];
        unset($_SESSION['form_errors']);

        view('students/edit', ['student' => $student, 'errors' => $errors]);
    }

    public function update(): void
    {
        requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirectTo('index.php?route=students');
        }

        $id = (int)($_POST['id'] ?? 0);
        if ($id <= 0) {
            redirectTo('index.php?route=students');
        }

        $errors = $this->validateUpdateRequest($_POST);
        if (!empty($errors)) {
            $_SESSION['form_errors'] = $errors;
            redirectTo('index.php?route=student.edit&id=' . $id);
        }

        $profilePicture = $this->handleProfileUpload('profile_picture', true);
        if ($profilePicture === false) {
            redirectTo('index.php?route=student.edit&id=' . $id);
        }

        $this->studentModel->update($id, [
            'first_name' => trim($_POST['FirstName']),
            'last_name' => trim($_POST['LastName']),
            'address' => trim($_POST['Address']),
            'country' => trim($_POST['country']),
            'gender' => trim($_POST['Gender']),
            'skills' => implode(',', array_map('trim', $_POST['skills'] ?? [])),
            'username' => trim($_POST['username']),
            'department' => trim($_POST['department']),
            'profile_picture' => $profilePicture,
        ]);

        redirectTo('index.php?route=students');
    }

    public function delete(): void
    {
        requireAuth();

        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->studentModel->delete($id);
        }

        redirectTo('index.php?route=students');
    }

    private function validateCreateRequest(array $request): array
    {
        $errors = [];
        $required = ['FirstName', 'LastName', 'Address', 'country', 'Gender', 'username', 'password', 'department'];

        foreach ($required as $field) {
            if (!isset($request[$field]) || trim((string)$request[$field]) === '') {
                $errors[] = $field . ' is required.';
            }
        }

        if (empty($request['skills'])) {
            $errors[] = 'Please select at least one skill.';
        }

        if (!empty($request['FirstName']) && preg_match('/\d/', $request['FirstName'])) {
            $errors[] = 'First name must not contain numbers.';
        }

        if (!empty($request['LastName']) && preg_match('/\d/', $request['LastName'])) {
            $errors[] = 'Last name must not contain numbers.';
        }

        if (!empty($request['password'])) {
            $password = (string)$request['password'];
            if (strlen($password) !== 8) {
                $errors[] = 'Password must be exactly 8 characters.';
            }
            if (preg_match('/[A-Z]/', $password)) {
                $errors[] = 'Password must not contain capital letters.';
            }
            if (!preg_match('/^[a-z0-9_]{8}$/', $password)) {
                $errors[] = 'Password can only contain lowercase letters, numbers, and underscore.';
            }
        }

        return $errors;
    }

    private function validateUpdateRequest(array $request): array
    {
        $errors = [];
        $required = ['FirstName', 'LastName', 'Address', 'country', 'Gender', 'username', 'department'];

        foreach ($required as $field) {
            if (!isset($request[$field]) || trim((string)$request[$field]) === '') {
                $errors[] = $field . ' is required.';
            }
        }

        if (empty($request['skills'])) {
            $errors[] = 'Please select at least one skill.';
        }

        if (!empty($request['FirstName']) && preg_match('/\d/', $request['FirstName'])) {
            $errors[] = 'First name must not contain numbers.';
        }

        if (!empty($request['LastName']) && preg_match('/\d/', $request['LastName'])) {
            $errors[] = 'Last name must not contain numbers.';
        }

        return $errors;
    }

    private function handleProfileUpload(string $fieldName, bool $isOptional)
    {
        if (!isset($_FILES[$fieldName])) {
            return $isOptional ? null : '';
        }

        $file = $_FILES[$fieldName];

        if ($file['error'] === UPLOAD_ERR_NO_FILE) {
            return $isOptional ? null : '';
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['form_errors'] = ['File upload failed.'];
            return false;
        }

        $allowedTypes = ['image/jpeg', 'image/png'];
        if (!in_array($file['type'], $allowedTypes, true)) {
            $_SESSION['form_errors'] = ['Invalid file type. Only JPG and PNG are allowed.'];
            return false;
        }

        if ($file['size'] > 2 * 1024 * 1024) {
            $_SESSION['form_errors'] = ['File is too large. Maximum size is 2MB.'];
            return false;
        }

        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newFileName = uniqid('profile_', true) . '.' . $extension;
        $destination = 'uploads/' . $newFileName;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            $_SESSION['form_errors'] = ['Failed to upload file.'];
            return false;
        }

        return $destination;
    }
}
