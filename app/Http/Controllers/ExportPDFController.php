<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportPDFController extends Controller
{
    public function exportPdf(){
        dd('Hellow PDF');
        return Excel::download(new InvoicesExport, 'invoices.pdf', \Maatwebsite\Excel\Excel::MPDF);
    }
}
