<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['semesters'] = Semester::orderBy('id', 'desc')->get();
        // dd($data);
        return view('backend.semester.index', $data);
    }

    public function create()
    {   
        // $data['majors'] = Major::with('departments')->where('delete_status', 1)->orderBy('id', 'desc')->get();
        $data['years'] = Year::select('year')->distinct()->orderBy('year', 'desc')->get();
        $data['update'] = null;
        return view('backend.semester.form', $data);
    }

    public function store(Request $request)
    {
        // dd('Store');
        // dd($request->input());

        $request->validate([
            'semester' => 'required|integer',
            'start_date' => 'required|date',
            'finish_date' => 'required|date',
            'academy_year' => 'required|integer',
        ]);
        // if($request->validate() == true){
        //     dd('Validate');
        // }
        $data = [
            'semester' => $request->semester,
            'start_date' => Carbon::parse($request->start_date)->format('Y-m-d'),
            'finish_date' => Carbon::parse($request->finish_date)->format('Y-m-d'),
            'academy_year' => $request->academy_year,
        ];

        $semester = Semester::create($data);
        if (!$semester) {
            return redirect()->back()->with('error', __('lang.semesterCreateError'))->withInput();
        }else{
            return redirect()->back()->with('success', __('lang.semesterCreateSuccess'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $class = Semester::findOrFail($id);
        // $studyLevel = collect(\App\Http\Helpers\AppHelper::getStudyLevel())->get($class->level_study);
        // $yearLevel = collect(\App\Http\Helpers\AppHelper::getYearLevel())->get($class->year_level);
        // $graduated = $class->graduate_status == 1 ? __('lang.studying') :  __('lang.graduated');

        // $deleted_at = $class->deleted_date != '' ? Carbon::parse($class->deleted_date)->format('d-m-Y') : __("lang.na");
        // $deleted_by = $class->deleted_by != '' ? $class->deleted_by : __("lang.na");
        // $created_at = Carbon::parse($class->created_at)->format('d-m-Y h:i:s a');

        // return response()->json([
        //     'class_code' => $class->class_code,
        //     'department' => session()->has('localization') && session('localization') == 'en'
        //         ? $class->majors->departments->dep_name_en
        //         : $class->majors->departments->dep_name_kh,
        //     'major' => session()->has('localization') && session('localization') == 'en'
        //         ? $class->majors->major_name_en
        //         : $class->majors->major_name_kh,
        //     'level_study' => $studyLevel,
        //     'level_year' => $yearLevel,
        //     'academy_year' => $class->academy_year,
        //     'graduate_status' => $graduated,
        //     'created_at' => $created_at,
        //     'deleted_at' => $deleted_at,
        //     'deleted_by' => $deleted_by,
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['update'] = true;
        $data['semester'] = Semester::findOrFail($id);
        $data['years'] = Year::select('year')->distinct()->orderBy('year', 'desc')->get();
        return view('backend.semester.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd('update');
        $semester = Semester::findOrFail($id);
        $request->validate([
            'semester' => 'required|integer',
            'start_date' => 'required|date',
            'finish_date' => 'required|date',
            'academy_year' => 'required|integer',
        ]);
        // if($request->validate() == true){
        //     dd('Validate');
        // }
        $data = [
            'semester' => $request->semester,
            'start_date' => Carbon::parse($request->start_date)->format('Y-m-d'),
            'finish_date' => Carbon::parse($request->finish_date)->format('Y-m-d'),
            'academy_year' => $request->academy_year,
        ];
        

        $semester_update = $semester->update($data);
        if (!$semester_update) {
            return redirect()->back()->with('error', __('lang.semesterUpdateError'))->withInput();
        }else{
            return redirect()->route('semester.index')->with('success', __('lang.semesterUpdateSuccess'));
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
        $semester = Semester::findOrFail($id);

        if ($semester) {
            if($semester->delete_status == 1){
                // Delete 
                $semester->update(['delete_status' => 0, 'deleted_date' => now(), 'deleted_by' => @Auth::user()->name]);
                return response()->json(['success' => __('lang.deletesemestsemesterSuccess')], 200);
            }else{
                // Restore
                $semester->update(['delete_status' => 1]);
                return response()->json(['success' => __('lang.restoresemestsemesterSuccess')], 200);
            }
        } else {
            return response()->json(['error' => __('lang.deletesemestsemesterError')], 404);
        }
    }
}
