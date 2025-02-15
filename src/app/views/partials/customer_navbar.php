<nav class="navbar navbar-expand-lg bg-dark navbar-custom fixed-top shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= ROOT ?>/customer"><strong>Apple Records</strong></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?= ROOT ?>/customer/cart"><strong>Coșul meu</strong></a></li>
                <li class="nav-item"><a class="nav-link" href="<?= ROOT ?>/customer/orders"><strong>Comenzile mele</strong></a></li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="<?= ROOT ?>/authentication/logout">
                        <strong>Logout</strong>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

