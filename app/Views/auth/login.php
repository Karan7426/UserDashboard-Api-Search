<?php $session = session(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #f8f9fa; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container { 
            max-width: 500px; 
            width: 100%; 
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            box-sizing: border-box;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .text-center a {
            color: #007bff;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Login</h2>
        <?php if ($session->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= $session->getFlashdata('success') ?>
            </div>
        <?php elseif ($session->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= $session->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <form method="post" action="<?= base_url('authenticate'); ?>">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required value="<?= old('email') ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            <div class="text-center mt-3">
                Don't have an account? <a href="<?= base_url('register'); ?>">Register here</a>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
