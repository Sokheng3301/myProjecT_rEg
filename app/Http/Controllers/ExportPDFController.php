<?php

namespace App\Http\Controllers;

use TCPDF;
use Dompdf\Dompdf;
use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\StudentPDFExport;
use App\Models\Studentclass;
use Maatwebsite\Excel\Facades\Excel;
use KhmerPdf\LaravelKhPdf\Facades\PdfKh;


class ExportPDFController extends Controller
{
    public function exportPdf(string $class_id){
        // dd($class_id);
        $class_info = Studentclass::with('majors', 'departments')->where('id', $class_id)->get()->first();
        // dd($class_info);
        // dd($class_info->majors->departments->dep_name_en. ' -  '. $class_info->majors->departments->dep_name_kh);
        $student_list = Student::where('class_id', $class_id)->orderBy('id', 'asc')->get();
        $total_student = Student::where('class_id', $class_id)->count();
        $total_female_student = Student::where('class_id', $class_id)->where('gender', 'f')->count();

        $html = view('backend.exports.studentbyclassExport',
                [
                    'list_exports' => $student_list,
                    'class_info' => $class_info,
                    'total_student' => $total_student,
                    'total_female_student' => $total_female_student
                ])->render();
        return PdfKh::loadHtml($html)->addMPdfConfig([
            'mode' => 'utf-8',
            'format' => 'A4-P   ',
            'margin_top' => 2,
            'margin_bottom' => 2,
            'margin_left' => 0,
            'margin_right' => 0,
            'default_font' => 'KhmerOS',
            'default_font_size' => 11,
            'default_font_color' => [0, 0, 0],
            'font_path' => storage_path('fonts/khmerOS.ttf'),
            'default_font_family' => 'KhmerOS',
        ])
        ->watermarkText(__('lang.ksit'), 0.2, 'KhmerOS', 100)
        ->download('student-list-'.date('d-m-Y__H:i:s').'.pdf');
        // ->watermarkImage(asset('dist/assets/img/logo-bran.png'), 'p', 'p', 1, false)

    }
}
