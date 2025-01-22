<?php

class Band_member
{
    use Controller;

    public function index() 
    {
        $this->authorize(['band_member']);

        $bandMemberModel = new BandMemberModel();
        $found = $bandMemberModel->findByUserId($_SESSION['user_id']);

        if ($found) {
            $this->view('band_member_dashboard');
        } else {
            $this->view('band_member_not_verified');
        }
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

public function albumForm()
    {
        $this->authorize(['band_member']);

        $bandMemberModel = new BandMemberModel();
        $found = $bandMemberModel->findByUserId($_SESSION['user_id']);
        if (!$found) {
            $_SESSION['error'] = 'Nu poți crea cereri de album dacă nu ești validat în vreo trupă.';
            header('Location: ' . ROOT . '/band_member');
            exit;
        }

        $this->view('band_member_album_form');
    }

    public function createAlbumRequest()
    {
        $this->authorize(['band_member']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST;

            if (empty($data['title']) || empty($data['format'])) {
                $_SESSION['error'] = 'Titlul și formatul sunt obligatorii.';
                header('Location: ' . ROOT . '/band_member/albumForm');
                exit;
            }

            $bandMemberModel = new BandMemberModel();
            $found = $bandMemberModel->findByUserId($_SESSION['user_id']);
            if (!$found) {
                $_SESSION['error'] = 'Nu ești validat ca membru al unei trupe.';
                header('Location: ' . ROOT . '/band_member');
                exit;
            }

            $data['user_id'] = $_SESSION['user_id'];
            $data['band_id'] = $found->band_id;

            $albumRequestModel = new AlbumRequestModel();
            $requestId = $albumRequestModel->createAlbumRequest($data);

            if ($requestId) {
                $_SESSION['success'] = "Cererea de album (#$requestId) a fost trimisă.";
                header('Location: ' . ROOT . '/band_member');
            } else {
                $_SESSION['error'] = 'Eroare la crearea cererii de album.';
                header('Location: ' . ROOT . '/band_member/albumForm');
            }
            exit;
        }

        header('Location: ' . ROOT . '/band_member/albumForm');
        exit;
    }

    public function myAlbumRequests()
    {
        $this->authorize(['band_member']);

        $albumRequestModel = new AlbumRequestModel();
        $myAlbumRequests = $albumRequestModel->getAlbumRequestsByUser($_SESSION['user_id']);

        $this->view('band_member_my_album_requests', ['requests' => $myAlbumRequests]);
    }

}

