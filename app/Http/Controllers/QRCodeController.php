<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Major;
use App\Models\Student;
use App\Models\Studentclass;
use App\Models\Year;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.qrcode.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['update'] = false;
        $data['years'] = Year::orderBy('id', 'desc')->get();
        $data['departments'] = Department::where('delete_status', 1)->orderBy('id', 'desc')->get();
        $data['majors'] = Major::where('delete_status', 1)->orderBy('id', 'desc')->get();
        $data['classes'] = Studentclass::where('delete_status', 1)->orderBy('id', 'desc')->get();
        $data['students'] = Student::where('delete_status', 1)->orderBy('id', 'desc')->get();
        return view('backend.qrcode.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
