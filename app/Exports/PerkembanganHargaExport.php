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
    public function view(): View
    {
        $perkembanganHargas = JenisKomoditas::with(['harga_monitorings.pasar.uptd', 'komoditas', 'harga_monitorings.jenis_komoditas'])->whereHas('harga_monitorings')->get()->map(function ($perkembangan) {
            return [
                'komoditas' => $perkembangan->komoditas->nama_komoditas,
                'harga_monitorings' => $perkembangan->harga_monitorings,
            ];
        });

        return view('dashboard.perkembangan-harga.perkembangan-harga-print', compact('perkembanganHargas'));
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
