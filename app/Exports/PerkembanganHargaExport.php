<?php

namespace App\Exports;

use App\Models\JenisKomoditas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

// use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class PerkembanganHargaExport implements ShouldAutoSize, FromView, WithStyles
{

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function view(): View
    {
        return view('dashboard.perkembangan-harga.perkembangan-harga-print', [
            'perkembanganHargas' => $this->data
        ]);
    }


    public function styles(Worksheet $sheet)
    {
        // Looping untuk mencari baris yang menjadi separator (bold + merge 7 kolom)
        foreach ($sheet->getRowIterator() as $row) {
            $rowIndex = $row->getRowIndex();
            $cellValue = $sheet->getCell('A' . $rowIndex)->getValue();

            // Jika A kolom berisi "komoditas" atau tanda separator
            if ($cellValue && stripos($cellValue, 'Komoditas') !== false) {
                $sheet->getStyle('A' . $rowIndex . ':G' . $rowIndex)->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => 'FFFACD'] // Kuning muda (LemonChiffon)
                    ],
                    'font' => [
                        'bold' => true
                    ]
                ]);
            }
        }

        return [];
    }
}
