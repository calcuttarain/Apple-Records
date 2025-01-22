<?php

class Band_member
{
    use Controller;

    public function index() 
    {
        $this->authorize(['band_member']);
        $this->view('band_member_dashboard');
    }

    public function contractForm()
    {
        $this->authorize(['band_member']);
        $this->view('band_member_contract_form');
    }

    public function createContractRequest()
    {
        $this->authorize(['band_member']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST;

            if (empty($data['band_name']) || empty($data['members_emails']) || empty($data['demo_link'])) {
                $_SESSION['error'] = 'Toate câmpurile sunt obligatorii.';
                header('Location: ' . ROOT . '/band_member/contractForm');
                exit;
            }

            $data['user_id'] = $_SESSION['user_id'];
            $contractRequestModel = new ContractRequestModel();
            $requestId = $contractRequestModel->createContractRequest($data);

            if ($requestId) {
                $_SESSION['success'] = 'Cererea de contract a fost trimisă cu succes (Request #'.$requestId.').';
                header('Location: ' . ROOT . '/band_member');
            } else {
                $_SESSION['error'] = 'Eroare la crearea cererii de contract.';
                header('Location: ' . ROOT . '/band_member/contractForm');
            }
            exit;
        }

        header('Location: ' . ROOT . '/band_member/contractForm');
        exit;
    }

    public function myRequests()
    {
        $this->authorize(['band_member']);
        
        $contractRequestModel = new ContractRequestModel();
        $myRequests = $contractRequestModel->getContractRequestsByUser($_SESSION['user_id']);

        $this->view('band_member_my_contracts', ['requests' => $myRequests]);
    }

    public function view($name, $data = [])
    {
        $filename = '../app/views/' . $name . '.view.php';
        if (!file_exists($filename)) {
            $filename = '../app/views/404.view.php';
        }
        extract($data);
        require $filename;
    }
}

