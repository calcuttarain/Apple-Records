<?php

class BandModel
{
    use Model;

    protected $table = 'bands';

    protected $allowedColumns = [
        'name',
        'description',
        'date_formed'
    ];

    public function createBand($data)
    {
        $cols = array_keys($data);
        $sql = "
            INSERT INTO {$this->table} (".implode(',', $cols).")
            VALUES (:".implode(',:', $cols).")
        ";
        $this->query($sql, $data);

        $res = $this->query("SELECT LAST_INSERT_ID() AS last_id");
        if ($res && is_array($res) && isset($res[0]->last_id)) {
            return $res[0]->last_id;
        }
        return 0;
    }

}
