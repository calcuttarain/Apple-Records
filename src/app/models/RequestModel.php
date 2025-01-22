<?php

class RequestModel
{
    use Model;

    protected $table = 'requests';

    protected $allowedColumns = [
        'user_id',
        'request_type',
        'status',
    ];

    public function createRequest($data)
    {
        $keys = array_keys($data);

        $sql = "INSERT INTO {$this->table} (".implode(',', $keys).")
                VALUES (:".implode(',:', $keys).")";

        $this->query($sql, $data);

        $res = $this->query("SELECT LAST_INSERT_ID() AS last_id");
        if ($res && is_array($res) && isset($res[0]->last_id)) {
            return $res[0]->last_id;
        }

        return 0;
    }
}
