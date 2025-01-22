<?php

class AlbumRequestModel
{
    use Model;

    protected $table = 'album_requests';

    protected $allowedColumns = [
        'request_id',
        'band_id',
        'title',
        'format',
        'notes'
    ];

    public function createAlbumRequest($data)
    {
        $requestModel = new RequestModel();

        $requestId = $requestModel->createRequest([
            'user_id'      => $data['user_id'],
            'request_type' => 'ALBUM',
            'status'       => 'pending'
        ]);

        if (!$requestId) {
            return 0;
        }

        $insertData = [
            'request_id' => $requestId,
            'band_id'    => $data['band_id'],
            'title'      => $data['title'],
            'format'     => $data['format'],
            'notes'      => isset($data['notes']) ? $data['notes'] : ''
        ];

        $this->insert($insertData);

        return $requestId;
    }

    public function getAlbumRequestsByUser($userId)
    {
        $sql = "
            SELECT r.*, ar.band_id, ar.title, ar.format, ar.notes
            FROM requests AS r
            INNER JOIN album_requests AS ar ON r.id = ar.request_id
            WHERE r.user_id = :uid
              AND r.request_type = 'ALBUM'
            ORDER BY r.created_at DESC
        ";
        return $this->query($sql, ['uid' => $userId]) ?: [];
    }
}

