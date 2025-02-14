<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    
    <!-- Bootstrap CSS -->
    <link href="<?= ROOT ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ROOT ?>/assets/css/styles.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= ROOT ?>">Apple Records</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?= ROOT ?>/authentication/register">Register</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= ROOT ?>/authentication/login">Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Conținutul principal -->
<div class="container text-center mt-5">
    <h1 class="display-4">Welcome to Apple Records</h1>
    
    <img src="<?= ROOT ?>/assets/images/apple.jpg" alt="Apple Image" class="img-fluid my-4" style="max-width: 300px; border-radius: 10px;">
    
    <div class="d-flex justify-content-center gap-3">
        <a href="<?= ROOT ?>/authentication/register" class="btn btn-primary btn-lg">Register</a>
        <a href="<?= ROOT ?>/authentication/login" class="btn btn-outline-primary btn-lg">Login</a>
    </div>

    <!-- Secțiunea de statistici -->
    <div class="mt-5">
        <?php if (!empty($stats)): ?>
            <div class="card shadow-sm p-3">
                <h5 class="card-title">📊 Site Statistics</h5>
                <p class="card-text"><strong>Număr de vizitatori:</strong> <?= htmlspecialchars($stats->visitors) ?></p>
            </div>
        <?php else: ?>
            <p class="text-muted">Statistici indisponibile momentan.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="<?= ROOT ?>/assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>

