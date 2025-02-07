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
            $this->view('dashboard', [], 'band_member');
        } else {
            $this->view('not_verified', [], 'band_member');
        }
    }

    public function contractForm()
    {
        $this->authorize(['band_member']);
        $this->view('contract_form', [], 'band_member');
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
                $_SESSION['success'] = 'Cererea de contract cu ID-ul ' .$requestId. 'a fost trimisă cu succes!';
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

        $this->view('my_contracts', ['requests' => $myRequests], 'band_member');
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

        $this->view('album_form', [], 'band_member');
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
                $_SESSION['success'] = "Cererea de album cu ID-ul '. $requestId. ' a fost trimisă cu succes!";
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

        $this->view('my_album_requests', ['requests' => $myAlbumRequests], 'band_member');
    }
}

