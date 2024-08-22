<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Tender & Career Management System</title>
    <link rel="shortcut icon" href="<?= base_url('assets/images/logo.png'); ?>" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9590b3c858.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/auth.css'); ?>">
</head>
<body class="d-flex justify-content-center align-items-center" style="height: 100vh; background-color: #f0f2f5;">
    <div class="login-container">
        <div class="header-section">
            <img src="<?= base_url('assets/images/logo.png'); ?>" alt="Logo"> <!-- Update the src to your logo path -->
            <h4>Careers & Tenders Management System</h4>
        </div>
        <hr>
        <h3 class="text-center">REGISTER</h3>

        <!-- Display success message -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- Display validation errors -->
        <?php if (isset($validation) && $validation->getErrors()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($validation->getErrors() as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/register') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group mb-3">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" placeholder="Enter username" class="form-control" value="<?= esc($data['username'] ?? '') ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Enter email" class="form-control" value="<?= esc($data['email'] ?? '') ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="full_name">Full Name:</label>
                <input type="text" name="full_name" id="full_name" placeholder="Enter full name" class="form-control" value="<?= esc($data['full_name'] ?? '') ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter password" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Register</button>
            <a href="<?= base_url('/login') ?>" class="btn btn-link mt-3">Already have an account? Login</a>
        </form>
    </div>
</body>
</html>
