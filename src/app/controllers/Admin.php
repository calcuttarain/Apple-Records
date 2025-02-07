<?php

class Admin 
{
    use Controller;

    public function index() 
    {
        $this->authorize(['admin']); 
        $this->view('dashboard', [], 'admin');
    }

    public function downloadActivityExcel()
    {
        $this->authorize(['admin']);

        $activityModel = new UserActivityModel();
        $rows = $activityModel->getAll();  

        $fileName = "activity_log_" . date('Ymd_His') . ".csv";

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');

        fputcsv($output, ['ID', 'User ID', 'Controller', 'Method', 'Date Time', 'IP Address']);

        if ($rows) {
            foreach ($rows as $r) {
                fputcsv($output, [
                    $r->id,
                    $r->user_id,
                    $r->controller,
                    $r->method,
                    $r->date_time,
                    $r->ip_address
                ]);
            }
        }

        fclose($output);
        exit; 
    }
    public function logs()
    {
        $this->authorize(['admin']);

        $activityModel = new UserActivityModel();
        $rows = $activityModel->getAll();

        $this->view('logs', ['logs' => $rows], 'admin');
    }
}
