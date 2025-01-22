<?php

class AlbumModel
{
    use Model; 

    protected $table = 'albums';  
    protected $allowedColumns = [
        'band_id',
        'title',
        'release_date',
        'format',
        'price',
        'stock_quantity',
        'status',
    ];

    public function getAllActiveWithBandInfo()
    {
        $query = "
            SELECT a.*, b.name AS band_name, b.description AS band_description
            FROM albums AS a
            INNER JOIN bands AS b ON a.band_id = b.id
            WHERE a.status = 'active'
            ORDER BY a.id DESC
        ";

        return $this->query($query); 
    }

    public function decrementStock($albumId, $quantity)
    {
        $sql = "
            UPDATE {$this->table}
            SET stock_quantity = stock_quantity - :q
            WHERE id = :id
              AND stock_quantity >= :q
        ";
        $this->query($sql, [
            'q' => $quantity,
            'id' => $albumId
        ]);
    }

    public function createAlbum($data)
    {
        $keys = array_keys($data);

        $sql = "
            INSERT INTO {$this->table} (".implode(',', $keys).")
            VALUES (:".implode(',:', $keys).")
        ";

        $this->query($sql, $data);

        $res = $this->query("SELECT LAST_INSERT_ID() AS last_id");
        if ($res && isset($res[0]->last_id)) {
            return $res[0]->last_id;
        }
        return 0;
    }
}

