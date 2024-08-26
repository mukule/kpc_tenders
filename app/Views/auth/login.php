<!-- /app/Views/login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tender|Career Management System</title>
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
       
        <h3 class="text-center">SIGN IN</h3>
        <?= $this->include('partials/messages'); ?>
        <form action="<?= site_url('/login') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" placeholder="Enter username or Email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Login</button>
            <a href="" class="btn btn-link mt-3">FORGET PASSWORD ? RESET</a>
        </form>
    </div>
</body>
</html>
