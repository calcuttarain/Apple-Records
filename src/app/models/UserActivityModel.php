<?php

class UserActivityModel
{
    use Model; 

    protected $table = 'user_activity';
    protected $allowedColumns = [
        'user_id',
        'controller',
        'method',
        'date_time',
        'ip_address',
    ];

    public function logAction($data)
    {
        return $this->insert($data);
    }

    public function getAll()
    {
        return $this->findAll();
    }
}

