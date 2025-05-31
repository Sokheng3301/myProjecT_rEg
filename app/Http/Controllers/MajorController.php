<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['majors'] = Major::with('departments')->orderBy('id', 'desc')->get();
        return view('backend.major.index', $data);
    }

    public function create()
    {   
        $data['departments'] = Department::where('delete_status', 1)->orderBy('id', 'desc')->get();
        $data['update'] = null;
        $data['major'] = null;
        return view('backend.major.form', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'major_code' => 'required|unique:majors,major_code|string|max:255',
            'major_name_kh' => 'required|string|max:255',
            'major_name_en' => 'required|string|max:255',
            'department_id' => 'required|numeric|max:255',
        ]);
        $data = [
            'major_code' => $request->major_code,
            'major_name_kh' => $request->major_name_kh,
            'major_name_en' => $request->major_name_en,
            'department_id' => $request->department_id,
        ];
        

        $major = Major::create($data);
        if (!$major) {
            return redirect()->back()->with('error', __('lang.majorCreateError'))->withInput();
        }else{
            return redirect()->back()->with('success', __('lang.majorCreateSuccess'));
        }
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
        $data['update'] = true;
        $data['major'] = Major::findOrFail($id);
        $data['departments'] = Department::where('delete_status', 1)->orderBy('id', 'desc')->get();
        return view('backend.major.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd('update');
        $major = Major::findOrFail($id);
        $request->validate([
            'major_code' => 'required|string|max:255',
            'major_name_kh' => 'required|string|max:255',
            'major_name_en' => 'required|string|max:255',
            'department_id' => 'required|numeric|max:255',
        ]);
        $data = [
            'major_code' => $request->major_code,
            'major_name_kh' => $request->major_name_kh,
            'major_name_en' => $request->major_name_en,
            'department_id' => $request->department_id,
        ];
        

        $major_update = $major->update($data);
        if (!$major_update) {
            return redirect()->back()->with('error', __('lang.majorUpdateError'))->withInput();
        }else{
            return redirect()->route('major.index')->with('success', __('lang.majorUpdateSuccess'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd("delete". $id);   
        // return response($id);
        // $department = Department::findOrFail($id);
        $major = Major::findOrFail($id);

        if ($major) {
            if($major->delete_status == 1){
                // Delete 
                $major->update(['delete_status' => 0, 'deleted_at' => now(), 'deleted_by' => @Auth::user()->name]);
                return response()->json(['success' => __('lang.deletemajorSuccess')], 200);
            }else{
                // Restore
                $major->update(['delete_status' => 1]);
                return response()->json(['success' => __('lang.restoremajorSuccess')], 200);
            }
        } else {
            return response()->json(['error' => __('lang.deletemajorError')], 404);
        }
    }
}
