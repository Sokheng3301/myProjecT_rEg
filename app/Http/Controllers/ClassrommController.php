<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ClassrommController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['classrooms'] = Classroom::orderBy('id', 'desc')->get();
        // dd($data);
        return view('backend.classroom.index', $data);
    }

    public function create()
    {   
        // $data['majors'] = Major::with('departments')->where('delete_status', 1)->orderBy('id', 'desc')->get();
        // $data['years'] = Year::select('year')->distinct()->orderBy('year', 'desc')->get();
        $data['update'] = null;
        return view('backend.classroom.form', $data);
    }

    public function store(Request $request)
    {
        // dd('Store');
        // dd($request->input());

        $request->validate([
            'class_room' => 'required|string',
            'classroom_en' => 'required|string|unique:class_rooms,classroom_en',
        ]);
        // if($request->validate() == true){
        //     dd('Validate');
        // }
        $data = [
            'class_room' => $request->class_room,
            'classroom_en' => $request->classroom_en,
        ];

        $classroom = Classroom::create($data);
        if (!$classroom) {
            return redirect()->back()->with('error', __('lang.classroomCreateError'))->withInput();
        }else{
            return redirect()->back()->with('success', __('lang.classroomCreateSuccess'));
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
        $data['classroom'] = Classroom::findOrFail($id);
        return view('backend.classroom.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd('update');
        $classroom = Classroom::findOrFail($id);
        $request->validate([
            'class_room' => 'required|string',
            'classroom_en' => 'required|string',
        ]);

        $data = [
            'class_room' => $request->class_room,
            'classroom_en' => $request->classroom_en,
        ];
        

        $classroom_update = $classroom->update($data);
        if (!$classroom_update) {
            return redirect()->back()->with('error', __('lang.classroomUpdateError'))->withInput();
        }else{
            return redirect()->route('classroom.index')->with('success', __('lang.classroomUpdateSuccess'));
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
        $classroom = Classroom::findOrFail($id);

        if ($classroom) {
            if($classroom->delete_status == 1){
                // Delete 
                $classroom->update(['delete_status' => 0, 'deleted_date' => now(), 'deleted_by' => @Auth::user()->name]);
                return response()->json(['success' => __('lang.deletesemestclassroomSuccess')], 200);
            }else{
                // Restore
                $classroom->update(['delete_status' => 1]);
                return response()->json(['success' => __('lang.restoresemestclassroomSuccess')], 200);
            }
        } else {
            return response()->json(['error' => __('lang.deletesemestclassroomError')], 404);
        }
    }
}