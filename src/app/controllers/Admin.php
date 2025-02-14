<?php

use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    public function downloadActivityPDF()
    {
        $this->authorize(['admin']);

        $activityModel = new UserActivityModel();
        $rows = $activityModel->getAll();

        require_once ROOT_PATH . '/../vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
            'tempDir' => '/var/www/html/tmp'
        ]);


        $html = "<h1>Raport Activitate Utilizatori</h1>";
        $html .= "<table border='1' cellpadding='5'><tr>
                    <th>ID</th><th>User ID</th><th>Controller</th><th>Method</th><th>Date Time</th><th>IP Address</th>
                  </tr>";

        if ($rows) {
            foreach ($rows as $r) {
                $html .= "<tr>
                            <td>{$r->id}</td>
                            <td>{$r->user_id}</td>
                            <td>{$r->controller}</td>
                            <td>{$r->method}</td>
                            <td>{$r->date_time}</td>
                            <td>{$r->ip_address}</td>
                          </tr>";
            }
        }
        $html .= "</table>";

        $mpdf->WriteHTML($html);
        $mpdf->Output("activity_log_" . date('Ymd_His') . ".pdf", "D");
        exit;
    }

    public function downloadActivityXLSX()
    {
        $this->authorize(['admin']);

        require_once ROOT_PATH . '/../vendor/autoload.php';
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Setăm antetul tabelului
        $sheet->setCellValue('A1', 'ID')
              ->setCellValue('B1', 'User ID')
              ->setCellValue('C1', 'Controller')
              ->setCellValue('D1', 'Method')
              ->setCellValue('E1', 'Date Time')
              ->setCellValue('F1', 'IP Address');

        $activityModel = new UserActivityModel();
        $rows = $activityModel->getAll();

        $rowIndex = 2;
        if ($rows) {
            foreach ($rows as $r) {
                $sheet->setCellValue("A$rowIndex", $r->id)
                      ->setCellValue("B$rowIndex", $r->user_id)
                      ->setCellValue("C$rowIndex", $r->controller)
                      ->setCellValue("D$rowIndex", $r->method)
                      ->setCellValue("E$rowIndex", $r->date_time)
                      ->setCellValue("F$rowIndex", $r->ip_address);
                $rowIndex++;
            }
        }

        // Salvăm fișierul Excel
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $fileName = "activity_log_" . date('Ymd_His') . ".xlsx";

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }


    public function downloadActivityDOC()
    {
        $this->authorize(['admin']);

        $activityModel = new UserActivityModel();
        $rows = $activityModel->getAll();

        $fileName = "activity_log_" . date('Ymd_His') . ".doc";

        header("Content-Type: application/msword");
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo "<h1>Raport Activitate Utilizatori</h1>";
        echo "<table border='1' cellpadding='5'><tr>
                <th>ID</th><th>User ID</th><th>Controller</th><th>Method</th><th>Date Time</th><th>IP Address</th>
              </tr>";

        if ($rows) {
            foreach ($rows as $r) {
                echo "<tr>
                        <td>{$r->id}</td>
                        <td>{$r->user_id}</td>
                        <td>{$r->controller}</td>
                        <td>{$r->method}</td>
                        <td>{$r->date_time}</td>
                        <td>{$r->ip_address}</td>
                      </tr>";
            }
        }
        echo "</table>";
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
