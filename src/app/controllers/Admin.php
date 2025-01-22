<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        $rows = $activityModel->getAll(); 

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Raport Activitate');

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'User ID');
        $sheet->setCellValue('C1', 'Controller');
        $sheet->setCellValue('D1', 'Method');
        $sheet->setCellValue('E1', 'Date Time');
        $sheet->setCellValue('F1', 'IP Address');

        $rowNum = 2; 
        if ($rows) {
            foreach ($rows as $r) {
                $sheet->setCellValue('A'.$rowNum, $r->id);
                $sheet->setCellValue('B'.$rowNum, $r->user_id);
                $sheet->setCellValue('C'.$rowNum, $r->controller);
                $sheet->setCellValue('D'.$rowNum, $r->method);
                $sheet->setCellValue('E'.$rowNum, $r->date_time);
                $sheet->setCellValue('F'.$rowNum, $r->ip_address);
                $rowNum++;
            }
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = "activity_log_" . date('Ymd_His') . ".xlsx";

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. $fileName .'"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
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

