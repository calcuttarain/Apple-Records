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
}

