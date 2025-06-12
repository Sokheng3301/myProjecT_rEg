<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentPDFExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {

        return view('backend.exports.studentExport', [
            'list_exports' => $students = Student::all(),
        ]);
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A4:C100')->getFont()->setName('AKbalthom-Naga'); // Replace with the actual font name
    }
}
