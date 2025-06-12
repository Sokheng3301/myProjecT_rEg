<?php

namespace App\Http\Controllers;

use TCPDF;
use Dompdf\Dompdf;
use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\StudentPDFExport;

use Maatwebsite\Excel\Facades\Excel;
use KhmerPdf\LaravelKhPdf\Facades\PdfKh;


class ExportPDFController extends Controller
{
    public function exportPdf(){
        // dd('Hellow PDF');
        // return Excel::download(new StudentPDFExport, 'Student-list'.date('d-m-Y__H:i:s').'.pdf', \Maatwebsite\Excel\Excel::MPDF);
        // return Excel::download(new StudentPDFExport, 'Student-list'.date('d-m-Y__H:i:s').'.pdf', \Maatwebsite\Excel\Excel::TCPDF);
        // return Excel::download(new StudentPDFExport, 'Student-list'.date('d-m-Y__H:i:s').'.pdf', \Maatwebsite\Excel\Excel::DOMPDF);

        // $dompdf = new Dompdf();

        // $html = '<html><head><style>
        //     @font-face {
        //         font-family: "KhmerOS";
        //         src: url("fonts/Akbalthom-Naga.ttf") format("truetype");
        //     }
        //     body { font-family: "KhmerOS"; }
        // </style></head><body><p>សួស្តីពិភពលោក!</p></body></html>';

        // $dompdf->loadHtml($html);
        // $dompdf->setPaper('A4', 'portrait');
        // $dompdf->render();
        // $dompdf->stream("khmer_document.pdf");

        // $data = [
        //     'title' => 'របាយការណ៍អតិថិជន',
        //     'customers' => [
        //         ['name' => 'អ្នកគ្រប់គ្រង ស៊ីសុធា', 'email' => 'manager@example.com'],
        //         ['name' => 'អ្នកប្រើប្រាស់ វីរៈ', 'email' => 'user@example.com'],
        //     ],
        //     'date' => now()->format('d/m/Y'),
        // ];

        // $data['list_exports'] = Student::all(); // Fetch all students data

        // // Generate PDF
        // $pdf = Pdf::loadView('backend.exports.studentExport', $data);

        // // Optional: Set paper size and orientation
        // $pdf->setPaper('A4', 'portrait');

        // return $pdf->download('khmer-report.pdf');


        $html = view('backend.exports.studentExport', ['list_exports' => Student::all()])->render();
        return PdfKh::loadHtml($html)->addMPdfConfig([
            'mode' => 'utf-8',
            'format' => 'A4-P   ',
            'margin_top' => 4,
            'margin_bottom' => 4,
            'margin_left' => 0,
            'margin_right' => 0,
            'default_font' => 'KhmerOS',
            'default_font_size' => 11,
            'default_font_color' => [0, 0, 0],
            'font_path' => storage_path('fonts/khmerOS.ttf'),
            'default_font_family' => 'KhmerOS',

            // 'font_path' => public_path(['fonts/Akbalthom-Naga.ttf', 'fonts/Poppins-Regular']),
            // 'default_font_family' => ['Akbalthom-Naga', 'Poppins'],
            // 'default_font' => ['Akbalthom-Naga', 'Poppins'],
            // 'default_font_color' => [0, 0, 0],
            // 'default_font_size' => 5,


        ])
        ->watermarkText(__('lang.ksit'), 0.2, 'KhmerOS', 100)
        ->download('student-list-'.date('d-m-Y__H:i:s').'.pdf');
        // ->watermarkImage(asset('dist/assets/img/logo-bran.png'), 'p', 'p', 1, false)

    }
}
