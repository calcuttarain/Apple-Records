<?php

class ContractRequestModel
{
    use Model;

    protected $table = 'contract_requests';

    protected $allowedColumns = [
        'request_id',
        'band_name',
        'members_emails',
        'demo_link'
    ];

    public function createContractRequest($data)
    {
        $requestModel = new RequestModel();

        $requestId = $requestModel->createRequest([
            'user_id'      => $data['user_id'],
            'request_type' => 'CONTRACT',
            'status'       => 'pending'
        ]);

        if (!$requestId) {
            return 0; 
        }

        $this->insert([
            'request_id'     => $requestId,
            'band_name'      => $data['band_name'],
            'members_emails' => $data['members_emails'],
            'demo_link'      => $data['demo_link'],
        ]);

        return $requestId;
    }

    public function getContractRequestsByUser($userId)
    {
        $sql = "
            SELECT r.*, cr.band_name, cr.members_emails, cr.demo_link
            FROM requests AS r
            INNER JOIN contract_requests AS cr ON r.id = cr.request_id
            WHERE r.user_id = :uid
              AND r.request_type = 'CONTRACT'
            ORDER BY r.created_at DESC
        ";
        return $this->query($sql, ['uid' => $userId]) ?: [];
    }

    public function getPendingContractRequests()
    {
        $sql = "
            SELECT r.id AS request_id, r.user_id, r.status, r.created_at,
                   cr.band_name, cr.members_emails, cr.demo_link
            FROM requests AS r
            INNER JOIN contract_requests AS cr ON r.id = cr.request_id
            WHERE r.request_type = 'CONTRACT'
              AND r.status = 'pending'
            ORDER BY r.created_at DESC
        ";
        return $this->query($sql) ?: [];
    }

    /**
     * Acceptă cererea de contract:
     *  1. Creăm un nou band în `bands` (cu band_name din contract_requests)
     *  2. Adăugăm user-ul inițiator în `band_members`
     *  3. Setăm `requests.status='accepted'` pentru ID-ul dat
     *
     * Returnează true/false în funcție de succes.
     */
    public function acceptContractRequest($requestId)
    {
        $requestData = $this->getContractRequestById($requestId);
        if (!$requestData) {
            return false; 
        }

        $bandModel = new BandModel();
        $bandId = $bandModel->createBand([
            'name'        => $requestData->band_name,
            'description' => 'Contract semnat recent',
            'date_formed' => date('Y-m-d'), 
        ]);

        if (!$bandId) {
            return false; 
        }

        $bandMemberModel = new BandMemberModel();
        $bandMemberModel->addMember([
            'user_id' => $requestData->user_id,
            'band_id' => $bandId,
            'date_joined' => date('Y-m-d'),
        ]);

        $this->updateRequestStatus($requestId, 'accepted');

        return true;
    }

    public function rejectContractRequest($requestId)
    {
        $requestData = $this->getContractRequestById($requestId);
        if (!$requestData) {
            return false;
        }
        $this->updateRequestStatus($requestId, 'rejected');
        return true;
    }

    private function getContractRequestById($requestId)
    {
        $sql = "
            SELECT r.id AS request_id, r.user_id, r.status, r.created_at,
                   cr.band_name, cr.members_emails, cr.demo_link
            FROM requests AS r
            INNER JOIN contract_requests AS cr ON r.id = cr.request_id
            WHERE r.request_type = 'CONTRACT'
              AND r.id = :rid
            LIMIT 1
        ";
        $res = $this->query($sql, ['rid' => $requestId]);
        return $res ? $res[0] : false;
    }

    private function updateRequestStatus($requestId, $newStatus)
    {
        $sql = "UPDATE requests SET status = :st WHERE id = :rid";
        $this->query($sql, ['st' => $newStatus, 'rid' => $requestId]);
    }
}

