<?php

class Admin 
{
    use Controller;

    public function index() 
    {
        $this->authorize(['admin']); 
        $this->view('admin_dashboard');
    }

    public function downloadActivityExcel()
    {
        $this->authorize(['admin']);

        $activityModel = new UserActivityModel();
        $rows = $activityModel->getAll();  // array de obiecte cu user_id, controller, etc.

        // Numele fișierului
        $fileName = "activity_log_" . date('Ymd_His') . ".csv";

        // Trimitem antetele pentru download
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        // Oprire caching (opțional)
        header('Pragma: no-cache');
        header('Expires: 0');

        // Deschidem "php://output" ca să scriem direct în fluxul de răspuns
        $output = fopen('php://output', 'w');

        // Scriem un rând de antet (header) pentru coloane
        fputcsv($output, ['ID', 'User ID', 'Controller', 'Method', 'Date Time', 'IP Address']);

        // Acum iterăm datele și scriem fiecare rând în format CSV
        if ($rows) {
            foreach ($rows as $r) {
                // `fputcsv` primește un array cu valorile
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
        exit; // Ne asigurăm că scriptul se oprește aici
    }
    public function logs()
    {
        $this->authorize(['admin']);

        $activityModel = new UserActivityModel();
        $rows = $activityModel->getAll();

        $this->view('admin_logs', ['logs' => $rows]);
    }

    public function view($name, $data = [])
    {
        $filename = '../app/views/' . $name . '.view.php';
        if (!file_exists($filename)) {
            $filename = '../app/views/404.view.php';
        }
        extract($data);
        require $filename;
    }
}

