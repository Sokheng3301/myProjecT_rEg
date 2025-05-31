<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['departments'] = Department::orderBy('id', 'desc')->get();
        return view('backend.department.index', $data);
    }

    public function create()
    {   
        $data['update'] = null;
        $data['department'] = null;
        return view('backend.department.form', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'dep_code' => 'required|unique:departments,dep_code|string|max:255',
            'dep_name_kh' => 'required|string|max:255',
            'dep_name_en' => 'required|string|max:255',
            'dep_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $data = [
            'dep_code' => $request->dep_code,
            'dep_name_kh' => $request->dep_name_kh,
            'dep_name_en' => $request->dep_name_en,
        ];
        if($request->hasFile('dep_logo')){
            $file = $request->file('dep_logo');
            $data['dep_logo'] = $file->store('uploads/department', 'custom');
        }

        $department = Department::create($data);
        if (!$department) {
            return redirect()->back()->with('error', __('lang.departmentCreateError'))->withInput();
        }else{
            return redirect()->back()->with('success', __('lang.departmentCreateSuccess'));
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
        $data['department'] = Department::findOrFail($id);
        return view('backend.department.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd('update');
        $request->validate([
            'dep_code' => 'required|string|max:255',
            'dep_name_kh' => 'required|string|max:255',
            'dep_name_en' => 'required|string|max:255',
            'dep_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $department = Department::findOrFail($id);
        $data = [
            'dep_code' => $request->dep_code,
            'dep_name_kh' => $request->dep_name_kh,
            'dep_name_en' => $request->dep_name_en,
        ];
        if($request->hasFile('dep_logo')){
            if($department->dep_logo != null){
                if (File::exists($department->dep_logo)) {
                    File::delete($department->dep_logo);
                }
                $file = $request->file('dep_logo');
                $data['dep_logo'] = $file->store('uploads/department', 'custom');
            }
        }else{
            $data['dep_logo'] = $department->dep_logo;
        }
        $department->update($data);
        if (!$department) {
            return redirect()->back()->with('error', __('lang.updateDepartmentError'))->withInput();
        }else{
            return redirect()->route('department.index')->with('success', __('lang.updateDepartmentSuccess'));
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
        $department = Department::findOrFail($id);

        if ($department) {
            if($department->delete_status == 1){
                // Delete 
                $department->update(['delete_status' => 0, 'deleted_at' => now(), 'deleted_by' => @Auth::user()->name]);
                return response()->json(['success' => __('lang.deleteDepartmentSuccess')], 200);
            }else{
                // Restore
                $department->update(['delete_status' => 1]);
                return response()->json(['success' => __('lang.restoreDepartmentSuccess')], 200);
            }
            // return redirect()->back()->with('success', __('lang.deleteDepartmentSuccess'));
        } else {
            return response()->json(['error' => __('lang.deleteDepartmentError')], 404);
        }
    }
}
