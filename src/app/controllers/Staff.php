<?php

class Staff 
{
    use Controller;

    public function index() 
    {
        $this->authorize(['staff']);
        $this->view('staff_dashboard');
    }

    public function contractRequests()
    {
        $this->authorize(['staff']);

        $contractRequestModel = new ContractRequestModel();
        $pendingRequests = $contractRequestModel->getPendingContractRequests();

        $this->view('staff_contract_requests', [
            'requests' => $pendingRequests
        ]);
    }

    public function acceptContract($requestId = null)
    {
        $this->authorize(['staff']);

        if (!$requestId) {
            $_SESSION['error'] = 'Parametru invalid.';
            header('Location: ' . ROOT . '/staff/contractRequests');
            exit;
        }

        $contractRequestModel = new ContractRequestModel();
        $success = $contractRequestModel->acceptContractRequest($requestId);

        if ($success) {
            $_SESSION['success'] = "Cererea #$requestId a fost acceptata cu succes.";
        } else {
            $_SESSION['error'] = "A aparut o problemă la acceptarea cererii #$requestId.";
        }

        header('Location: ' . ROOT . '/staff/contractRequests');
        exit;
    }

    public function rejectContract($requestId = null)
    {
        $this->authorize(['staff']);

        if (!$requestId) {
            $_SESSION['error'] = 'Parametru invalid.';
            header('Location: ' . ROOT . '/staff/contractRequests');
            exit;
        }

        $contractRequestModel = new ContractRequestModel();
        $success = $contractRequestModel->rejectContractRequest($requestId);

        if ($success) {
            $_SESSION['success'] = "Cererea #$requestId a fost respinsă.";
        } else {
            $_SESSION['error'] = "A aparut o problemă la respingerea cererii #$requestId.";
        }

        header('Location: ' . ROOT . '/staff/contractRequests');
        exit;
    }

    public function view($name, $data = [])
    {
        $filename = "../app/views/$name.view.php";
        if (!file_exists($filename)) {
            $filename = "../app/views/404.view.php";
        }
        extract($data);
        require $filename;
    }

    public function albumRequests()
    {
        $this->authorize(['staff']);

        $albumRequestModel = new AlbumRequestModel();
        $pendingRequests = $albumRequestModel->getPendingAlbumRequests();

        $this->view('staff_album_requests', [
            'requests' => $pendingRequests
        ]);
    }

    public function acceptAlbumRequest($requestId = null)
    {
        $this->authorize(['staff']);

        if (!$requestId) {
            $_SESSION['error'] = 'Request ID invalid.';
            header('Location: ' . ROOT . '/staff/albumRequests');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $price = $_POST['price'] ?? null;
            $stock = $_POST['stock_quantity'] ?? null;

            if ($price === null || $stock === null) {
                $_SESSION['error'] = 'Te rugăm să completezi prețul și stocul.';
                header('Location: ' . ROOT . '/staff/albumRequests');
                exit;
            }

            $albumRequestModel = new AlbumRequestModel();
            $success = $albumRequestModel->acceptAlbum($requestId, $price, $stock);

            if ($success) {
                $_SESSION['success'] = "Cererea de album #$requestId a fost acceptată și albumul a fost creat.";
            } else {
                $_SESSION['error'] = "A apărut o problemă la acceptarea cererii de album #$requestId.";
            }

            header('Location: ' . ROOT . '/staff/albumRequests');
            exit;
        }

        header('Location: ' . ROOT . '/staff/albumRequests');
        exit;
    }

    public function rejectAlbumRequest($requestId = null)
    {
        $this->authorize(['staff']);

        if (!$requestId) {
            $_SESSION['error'] = 'Request ID invalid.';
            header('Location: ' . ROOT . '/staff/albumRequests');
            exit;
        }

        $albumRequestModel = new AlbumRequestModel();
        $success = $albumRequestModel->rejectAlbum($requestId);

        if ($success) {
            $_SESSION['success'] = "Cererea de album #$requestId a fost respinsă.";
        } else {
            $_SESSION['error'] = "A apărut o problemă la respingerea cererii de album #$requestId.";
        }

        header('Location: ' . ROOT . '/staff/albumRequests');
        exit;
    }
}
