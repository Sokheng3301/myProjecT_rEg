<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiQRcodeController extends Controller
{
    public function index(string $id){
        
        return view('backend.qrcan.student', compact('id'));
    }
}
