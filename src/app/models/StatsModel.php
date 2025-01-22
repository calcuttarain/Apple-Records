<?php

class StatsModel
{
    use Model;  

    protected $table = 'site_stats';  

    protected $allowedColumns = [
        'id',
        'visitors',
        'page_views',
        'users_count'
    ];

    public function getSiteStats()
    {
        $stats = $this->select_first(['id' => 1]);

        if (!$stats) {
            $this->insert([
                'id'           => 1,
                'visitors'     => 0,
                'page_views'   => 0,
                'users_count'  => 0,
            ]);

            $stats = $this->select_first(['id' => 1]);
        }
        return $stats;
    }

    public function incrementVisitors()
    {
        $this->getSiteStats();

        $sql = "UPDATE {$this->table} SET visitors = visitors + 1 WHERE id = 1";
        $this->customQuery($sql);
    }

    public function incrementPageViews()
    {
        $this->getSiteStats();
        $sql = "UPDATE {$this->table} SET page_views = page_views + 1 WHERE id = 1";
        $this->customQuery($sql);
    }

    public function incrementUsersCount()
    {
        $this->getSiteStats();
        $sql = "UPDATE {$this->table} SET users_count = users_count + 1 WHERE id = 1";
        $this->customQuery($sql);
    }
}

