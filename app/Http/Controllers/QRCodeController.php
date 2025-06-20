<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Major;
use App\Models\Student;
use App\Models\Department;
use App\Models\Studentclass;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

// use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;

use function PHPUnit\Framework\returnSelf;

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
        dd('hi QR');
    }

    ///Generate QR code

    public function generate(string $id){
        // dd('Generate');
        // dd($id);
        $url = route('api.generateqr', $id);
        // dd($url);
        // $qrCode = QrCode::format('png')
        //                  ->merge(public_path('dist/assets/img/logo-bran.png'), 0.5, true)
        //                  ->size(500)
        //                  ->errorCorrection('H')
        //                  ->generate($url);


        // return response($image)->header('Content-type','image/png');
        $qrCode = QrCode::size(300)->generate($url);
        // update qrcode
        Student::where('id', $id)->update(['qrcode'=> $qrCode]);
        // returnSelf();
        return redirect()->back()->with('success', __("lang.generateQrcodeSuccess"));

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

    public function download(string $id){
        $student = Student::findOrFail($id);
        // dd($student);
        $text = ''; // Get the text from the student object

        // Generate QR code
        $qrCode = QrCode::size(300)
                    // ->errorCorrection('L') // Set to 'L' for low error correction
                    ->generate($text);


        // Create a response to download the image
        return response($qrCode)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="qrcode.png"');
    }
}
