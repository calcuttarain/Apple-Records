<?php

class BandMemberModel
{
    use Model;

    protected $table = 'band_members';

    protected $allowedColumns = [
        'user_id',
        'band_id',
        'date_joined'
    ];

    public function addMember($data)
    {
        $this->insert($data);
    }

    public function findByUserId($userId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = :uid LIMIT 1";
        $res = $this->query($sql, ['uid' => $userId]);
        return ($res && count($res) > 0) ? $res[0] : false;
    }
}

