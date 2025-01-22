<?php

class StatsModel
{
    use Model;  // Folosește metodele din trait Model (select, update, customQuery etc.)

    protected $table = 'site_stats';  // Numele tabelei în DB

    /**
     * Coloanele permise (filtrare la insert / update).
     */
    protected $allowedColumns = [
        'id',
        'visitors',
        'page_views',
        'users_count'
    ];

    /**
     * Obține statistica site-ului de pe rândul cu id=1.
     * Dacă acel rând nu există încă, îl creăm.
     */
    public function getSiteStats()
    {
        // Încearcă să selectezi rândul cu id=1
        $stats = $this->select_first(['id' => 1]);

        if (!$stats) {
            // Dacă nu există, îl creăm cu valori inițiale (0).
            $this->insert([
                'id'           => 1,
                'visitors'     => 0,
                'page_views'   => 0,
                'users_count'  => 0,
            ]);

            // Și apoi îl selectăm din nou
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

