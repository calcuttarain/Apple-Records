<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coș de cumpărături | Apple Records</title>

    <!-- Bootstrap CSS -->
    <link href="<?= ROOT ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ROOT ?>/public/assets/css/styles.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
<?php include __DIR__ . '/../partials/customer_navbar.php'; ?>

    <main class="container mt-5 flex-grow-1">
        <div class="text-center mb-4">
            <h1 class="fw-bold">Coș de cumpărături</h1>
        </div>

        <?php if (!empty($cartDetails)): ?>
            <div class="table-responsive">
                <table class="table table-hover text-center cart-table">
                    <thead>
                        <tr>
                            <th>Trupă</th>
                            <th>Album</th>
                            <th>Preț unitar</th>
                            <th>Cantitate</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartDetails as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['band_name']) ?></td>
                            <td><?= htmlspecialchars($item['title']) ?></td>
                            <td><strong><?= htmlspecialchars($item['price']) ?> RON</strong></td>
                            <td class="d-flex justify-content-center align-items-center">
                                <a href="<?= ROOT ?>/customer/decrementQuantity/<?= $item['album_id'] ?>" class="btn btn-sm btn-outline-light px-3">−</a>
                                <span class="mx-2"><?= htmlspecialchars($item['quantity']) ?></span>
                                <a href="<?= ROOT ?>/customer/incrementQuantity/<?= $item['album_id'] ?>" class="btn btn-sm btn-outline-light px-3">+</a>
                            </td>
                            <td><strong><?= htmlspecialchars($item['item_total']) ?> RON</strong></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="text-center my-4">
                <h3 class="fw-bold">Total: <?= htmlspecialchars($total) ?> RON</h3>
                <a href="<?= ROOT ?>/customer/checkout" class="btn btn-custom-primary shadow-lg px-4 py-2 mt-3">Finalizează comanda</a>
            </div>
        <?php else: ?>
            <p class="text-center text-muted">Coșul este gol.</p>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="<?= ROOT ?>/customer" class="btn btn-custom-outline px-4 py-2">Înapoi la lista de albume</a>
        </div>
    </main>

    <?php include __DIR__ . '/../partials/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="<?= ROOT ?>/public/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

