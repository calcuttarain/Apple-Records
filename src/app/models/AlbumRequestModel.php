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


    public function getPendingAlbumRequests()
    {
        $sql = "
            SELECT r.id AS request_id, r.user_id, r.status, r.created_at,
                   ar.band_id, ar.title, ar.format, ar.notes
            FROM requests AS r
            INNER JOIN album_requests AS ar ON r.id = ar.request_id
            WHERE r.request_type = 'ALBUM'
              AND r.status = 'pending'
            ORDER BY r.created_at DESC
        ";
        return $this->query($sql) ?: [];
    }

    public function acceptAlbum($requestId, $price, $stock)
    {
        $reqData = $this->getAlbumRequestData($requestId);
        if (!$reqData) {
            return false;
        }

        $bandId   = $reqData->band_id;
        $title    = $reqData->title;
        $format   = $reqData->format;
        $releaseDate = date('Y-m-d');

        $albumModel = new AlbumModel();
        $albumId = $albumModel->createAlbum([
            'band_id'        => $bandId,
            'title'          => $title,
            'release_date'   => $releaseDate,
            'format'         => $format,
            'price'          => $price,
            'stock_quantity' => $stock,
            'status'         => 'active' 
        ]);

        if (!$albumId) {
            return false; 
        }

        $this->updateRequestStatus($requestId, 'accepted');

        return true;
    }

    public function rejectAlbum($requestId)
    {
        return $this->updateRequestStatus($requestId, 'rejected');
    }

    private function getAlbumRequestData($requestId)
    {
        $sql = "
            SELECT r.id AS request_id, r.user_id, r.status,
                   ar.band_id, ar.title, ar.format, ar.notes
            FROM requests AS r
            INNER JOIN album_requests AS ar ON r.id = ar.request_id
            WHERE r.request_type = 'ALBUM'
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
        return true;
    }
}

