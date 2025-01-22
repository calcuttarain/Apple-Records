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
}

