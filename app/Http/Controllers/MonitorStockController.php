<?php

namespace App\Http\Controllers;

use App\Models\MonitorStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;

class MonitorStockController extends Controller
{
    //
    public function index()
    {

        return view("monitor_stock.index");
    }

    public function jsonMonitorList(Request $req)
    {
        $data = MonitorStock::jsonList($req);
        return response()->json($data);
    }

    public function exportMonitorStock(Request $req)
    {

        $data = DB::table('vw_monitorstock as a')
            ->select('a.*')->get();
        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();


        // Set some data in the spreadsheet
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Supplier Name');
        $sheet->setCellValue('C1', 'Part Number');
        $sheet->setCellValue('D1', 'Unit');
        $sheet->setCellValue('E1', 'Volume/Day');
        $sheet->setCellValue('F1', 'Safety Stock');
        $sheet->setCellValue('F2', 'Qty');
        $sheet->setCellValue('G2', 'Day');
        $sheet->setCellValue('H1', 'Qty Stock Supplier');
        $sheet->setCellValue('H2', 'Qty');
        $sheet->setCellValue('I2', 'Day');
        $sheet->setCellValue('J1', 'Updated');
        $sheet->setCellValue('K1', 'Status');


        $sheet->mergeCells('A1:A2');
        $sheet->mergeCells('B1:B2');
        $sheet->mergeCells('C1:C2');
        $sheet->mergeCells('D1:D2');
        $sheet->mergeCells('E1:E2');
        $sheet->mergeCells('F1:G1');
        $sheet->mergeCells('H1:I1');
        $sheet->mergeCells('J1:J2');
        $sheet->mergeCells('K1:K2');

        // Apply borders to a single cell
        $styleArray = [
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
                'inside' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        // Set background color for a range of cells
        $sheet->getStyle('A1:K2')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'f8fc03'], // Magenta background
            ],
            'font' => [
                'bold' => true,
            ],
        ]);

        // Example: Freeze the first row
        $sheet->freezePane('A3');
        // Auto size columns based on the content
        $this->autoSizeColumns($sheet, range('A', 'K'));

        $start = 3;
        $no = 1;

        if (count($data) > 0) {
            foreach ($data as $d) {
                $sheet->setCellValue('A' . $start, $no++);
                $sheet->setCellValue('B' . $start, $d->supplier_name);
                $sheet->setCellValue('C' . $start, $d->part_number);
                $sheet->setCellValue('D' . $start, ucwords(strtoupper($d->part_name)));
                $sheet->setCellValue('E' . $start, $d->volumePerDay);
                $sheet->setCellValue('F' . $start, $d->qtySafety);
                $sheet->setCellValue('G' . $start, $d->safetyForDays);
                $sheet->setCellValue('H' . $start, $d->stockSupplier);
                $sheet->setCellValue('I' . $start, $d->stockUntilDay);
                $sheet->setCellValue('J' . $start, $d->last_update);
                $sheet->setCellValue('K' . $start, $d->stockStatus);
                $start++;
            }
        } else {
            $sheet->setCellValue('A' . $start, "data not found");
            $sheet->mergeCells('A' . $start . ':K' . $start + 1);
        }

        $sheet->getStyle('A1:K' . $start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:K' . $start)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A1:K' . $start - 1)->applyFromArray($styleArray);
        $sheet->getStyle('A1:K' . $start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


        if ($req->act == "xls") {
            // Save the spreadsheet to a file
            $writer = new Xlsx($spreadsheet);
            $tempFile = tempnam(sys_get_temp_dir(), 'php');
            $writer->save($tempFile);

            // Return the file as a response
            return response()->download($tempFile, 'monitor stock.xlsx')->deleteFileAfterSend(true);
        } else if ($req->act == "pdf") {
            // Write the file to a stream
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf($spreadsheet);
            $writer = new Mpdf($spreadsheet);

            // Return the file as a response
            return response()->stream(
                function () use ($writer) {
                    $writer->save('php://output');
                },
                200,
                [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'attachment; filename="monitor stock.pdf"',
                ]
            );
        }
    }

    private function autoSizeColumns($sheet, array $columns)
    {
        foreach ($columns as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    }
}
