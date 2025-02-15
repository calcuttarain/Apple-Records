<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Comenzile mele | Apple Records</title>

    <!-- Bootstrap CSS -->
    <link href="<?= ROOT ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ROOT ?>/public/assets/css/styles.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include __DIR__ . '/../partials/customer_navbar.php'; ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Comenzile mele</h1>

    <?php if (!empty($orders)): ?>
        <div class="table-responsive">
            <table class="table table-dark-custom table-hover text-center">
                <thead class="thead-custom">
                    <tr>
                        <th>ID Comandă</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Total (RON)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order->id) ?></td>
                        <td><?= htmlspecialchars($order->order_date) ?></td>
                        <td>
                            <span class="badge <?= ($order->status == 'Finalizată') ? 'bg-success' : 'bg-warning' ?>">
                                <?= htmlspecialchars($order->status) ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($order->total_amount) ?> RON</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center text-muted">Momentan nu ai comenzi efectuate.</p>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="<?= ROOT ?>/customer" class="btn btn-custom-outline">Înapoi la lista de albume</a>
    </div>
</div>


<!-- Bootstrap JS -->
<script src="<?= ROOT ?>/public/assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>

