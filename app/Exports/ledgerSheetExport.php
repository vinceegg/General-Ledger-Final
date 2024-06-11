<?php

namespace App\Exports;

use App\Models\ledgerSheetModel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ledgerSheetExport implements WithHeadings, WithStyles, WithMapping, WithEvents
{
    protected $ls_accountname;

    public function __construct($ls_accountname)
    {
        $this->ls_accountname = $ls_accountname;
    }

    // Removes Account Code in this format: ---->1 01 01 010 - Cash Local Treasury 
    public function removeSuffix($accountName)
    {
        // Use a regular expression to remove all non-numeric characters
        return preg_replace('/[^0-9 ]/', '', $accountName);
    }

    // Removes Account Title in this format: 1 01 01 010 - Cash Local Treasury<----
    public function cleanAccountName($accountName)
    {
        // Remove all digits and dashes from the string
        $cleanedName = preg_replace('/[\d-]+/', '', $accountName);
        // Replace multiple spaces with a single space and trim leading/trailing spaces
        return trim(preg_replace('/\s+/', ' ', $cleanedName));
    }

    public function collection()
    {
        return ledgerSheetModel::select(
            "ls_date",
            "ls_vouchernum",
            "ls_particulars",
            "ls_balance_debit",
            "ls_debit",
            "ls_credit",
            "ls_credit_balance"
        )->where('ls_accountname', $this->ls_accountname)->get();
    }

    public function headings(): array
    {
        return [];
    }

    public function map($row): array
    {
        return [
            $row->ls_date,
            $row->ls_vouchernum,
            $row->ls_particulars,
            $row->ls_balance_debit,
            $row->ls_debit,
            $row->ls_credit,
            $row->ls_credit_balance,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->setCellValue('D1', 'PROVINCIAL FORM NO. 109 (A)-LEDGER SHEET');
        $sheet->getStyle('D1')->getFont()->setBold(true);
        $this->mergeAndSet($sheet, 'F5', 'H5', $this->cleanAccountName($this->ls_accountname));
        $this->mergeAndSet($sheet, 'F6', 'H6', '(Name of fund or account)', false, true);
        $this->mergeAndSet($sheet, 'F8', 'H8', '(Functional classification)', false, true);
        $this->mergeAndSet($sheet, 'F10', 'H10', '(Title of project or expense classification)', false, true);
        $this->mergeAndSet($sheet, 'I2', 'J2', $this->removeSuffix($this->ls_accountname));
        $this->mergeAndSet($sheet, 'I3', 'J3', '(Symbol)', false, true);

        $this->setHeaderCells($sheet);

        return [];
    }

    private function mergeAndSet(Worksheet $sheet, string $startCell, string $endCell, string $value, bool $bold = false, bool $borderTop = false)
    {
        $cells = $startCell . ':' . $endCell;
        $sheet->mergeCells($cells);
        $sheet->setCellValue($startCell, $value);
        $this->alignCenter($sheet, $cells);
        if ($bold) {
            $sheet->getStyle($cells)->getFont()->setBold(true);
        }
        if ($borderTop) {
            $sheet->getStyle($cells)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        }
    }

    private function alignCenter(Worksheet $sheet, string $cells)
    {
        $sheet->getStyle($cells)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle($cells)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    }

    private function setHeaderCells(Worksheet $sheet)
    {
        // Add headings manually at row 13, starting from column D
        $headers = [
            'D13' => 'Date',
            'E13' => 'Voucher Number',
            'F13' => 'Description',
            'G13' => 'Balance Debit',
            'H13' => 'DEBITS',
            'I13' => 'CREDITS',
            'J13' => 'Credit Balance'
        ];

        foreach ($headers as $cell => $value) {
            $sheet->getStyle($cell)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cell)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->setCellValue($cell, $value);
            $sheet->getStyle($cell)->getFont()->setBold(true);
            $sheet->getStyle($cell)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle($cell)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle($cell)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle($cell)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)->getColor()->setRGB('FF0000');
        }

        // Set fixed column widths
        $fixedColumnWidths = [
            'D' => 20,
            'E' => 20,
            'F' => 45,
            'G' => 20,
            'H' => 20,
            'I' => 20,
            'J' => 20,
        ];

        foreach ($fixedColumnWidths as $columnID => $width) {
            $sheet->getColumnDimension($columnID)->setWidth($width);
        }
    }

    // THIS PUTS THE DATA IN CELL D14
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $data = $this->collection()->toArray();
                $startRow = 14;
                $endColumn = 'J';
                $totalRows = count($data) + $startRow - 1;

                foreach ($data as $index => $row) {
                    $currentRow = $startRow + $index;
                    $sheet->setCellValue('D' . $currentRow, $row['ls_date']);
                    $sheet->setCellValue('E' . $currentRow, $row['ls_vouchernum']);
                    $sheet->setCellValue('F' . $currentRow, $row['ls_particulars']);
                    $sheet->setCellValue('G' . $currentRow, $row['ls_balance_debit']);
                    $sheet->setCellValue('H' . $currentRow, $row['ls_debit']);
                    $sheet->setCellValue('I' . $currentRow, $row['ls_credit']);
                    $sheet->setCellValue('J' . $currentRow, $row['ls_credit_balance']);
                }

                // Apply borders to the data range
                $sheet->getStyle("D14:$endColumn$totalRows")->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            }
        ];
    }

}
