<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title mb-4 text-center">Add Student</h3>
                    <form action="save.php" method="POST">
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
                            <label class="form-label">Department:</label>
                            <input type="text" name="department" value="OpenSource" class="form-control" readonly />
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <a href="list.php" class="btn btn-outline-success">View List</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>