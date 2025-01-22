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
}
