<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Major;
use App\Models\Studentclass;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['classes'] = Studentclass::with(['majors'])->orderBy('id', 'desc')->get();
        // dd($data);
        return view('backend.class.index', $data);
    }

    public function create()
    {   
        $data['majors'] = Major::with('departments')->where('delete_status', 1)->orderBy('id', 'desc')->get();
        $data['years'] = Year::select('year')->distinct()->orderBy('year', 'desc')->get();
        $data['update'] = null;
        return view('backend.class.form', $data);
    }

    public function store(Request $request)
    {
        // dd('Store');
        // dd($request->input());

        $request->validate([
            'class_code' => 'required|unique:classes,class_code|numeric',
            'major_id' => 'required|integer',
            'year_level' => 'required|integer',
            'level_study' => 'required|integer',
            'academy_year' => 'required|integer',
        ]);
        // if($request->validate() == true){
        //     dd('Validate');
        // }
        $data = [
            'class_code' => $request->class_code,
            'major_id' => $request->major_id,
            'year_level' => $request->year_level,
            'level_study' => $request->level_study,
            'academy_year' => $request->academy_year,
        ];

        $class = Studentclass::create($data);
        if (!$class) {
            return redirect()->back()->with('error', __('lang.classCreateError'))->withInput();
        }else{
            return redirect()->back()->with('success', __('lang.classCreateSuccess'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $class = StudentClass::with(['majors.departments'])->findOrFail($id);

        $studyLevel = collect(\App\Http\Helpers\AppHelper::getStudyLevel())->get($class->level_study);
        $yearLevel = collect(\App\Http\Helpers\AppHelper::getYearLevel())->get($class->year_level);
        $graduated = $class->graduate_status == 1 ? __('lang.studying') :  __('lang.graduated');

            // ? '<a class="ui orange tiny label">' . __('lang.studying') . '</a>' 
            // : '<a class="ui blue tiny label">' . __('lang.graduated') . '</a>';

        $deleted_at = $class->deleted_date != '' ? Carbon::parse($class->deleted_date)->format('d-m-Y') : __("lang.na");
        $deleted_by = $class->deleted_by != '' ? $class->deleted_by : __("lang.na");
        $created_at = Carbon::parse($class->created_at)->format('d-m-Y h:i:s a');

        return response()->json([
            'class_code' => $class->class_code,
            'department' => session()->has('localization') && session('localization') == 'en'
                ? $class->majors->departments->dep_name_en
                : $class->majors->departments->dep_name_kh,
            'major' => session()->has('localization') && session('localization') == 'en'
                ? $class->majors->major_name_en
                : $class->majors->major_name_kh,
            'level_study' => $studyLevel,
            'level_year' => $yearLevel,
            'academy_year' => $class->academy_year,
            'graduate_status' => $graduated,
            'created_at' => $created_at,
            'deleted_at' => $deleted_at,
            'deleted_by' => $deleted_by,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['update'] = true;
        $data['class'] = Studentclass::findOrFail($id);
        $data['majors'] = Major::with('departments')->where('delete_status', 1)->orderBy('id', 'desc')->get();
        $data['years'] = Year::select('year')->distinct()->orderBy('year', 'desc')->get();
        return view('backend.class.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd('update');
        $class = Studentclass::findOrFail($id);
        $request->validate([
            'class_code' => 'required|numeric',
            'major_id' => 'required|integer',
            'year_level' => 'required|integer',
            'level_study' => 'required|integer',
            'academy_year' => 'required|integer',
        ]);
        // if($request->validate() == true){
        //     dd('Validate');
        // }
        $data = [
            'class_code' => $request->class_code,
            'major_id' => $request->major_id,
            'year_level' => $request->year_level,
            'level_study' => $request->level_study,
            'academy_year' => $request->academy_year,
        ];
        

        $class_update = $class->update($data);
        if (!$class_update) {
            return redirect()->back()->with('error', __('lang.classUpdateError'))->withInput();
        }else{
            return redirect()->route('class.index')->with('success', __('lang.classUpdateSuccess'));
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
        $class = Studentclass::findOrFail($id);

        if ($class) {
            if($class->delete_status == 1){
                // Delete 
                $class->update(['delete_status' => 0, 'deleted_date' => now(), 'deleted_by' => @Auth::user()->name]);
                return response()->json(['success' => __('lang.deleteclassSuccess')], 200);
            }else{
                // Restore
                $class->update(['delete_status' => 1]);
                return response()->json(['success' => __('lang.restoreclassSuccess')], 200);
            }
        } else {
            return response()->json(['error' => __('lang.deleteclassError')], 404);
        }
    }
}
