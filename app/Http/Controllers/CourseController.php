<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Helpers\AppHelper;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['courses'] = Course::with('department')->orderBy('id', 'desc')->get();
        // foreach ($data['courses'] as $course) {
        //     echo $course->department ? $course->department->dep_name_kh : __('lang.null');
        // }
        return view('backend.course.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['update'] = false;
        $data['departments'] = Department::orderBy('id', 'desc')->get();
        return view('backend.course.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_code' => 'required|string|max:255|unique:courses,course_code',
            'course_name_kh' => 'required|string|max:255',
            'course_name_en' => 'required|string|max:255',
            'course_credit' => 'required|numeric',
            'course_theory' => 'required|numeric',
            'course_execute' => 'required|numeric',
            'course_apply' => 'required|numeric',
            'course_duration' => 'required|numeric',
            'course_type' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        // Validation will automatically redirect back with errors if it fails.

        // dd($request->input());
        $data['course'] = $request->except(['_token']);

        $create = Course::create($data['course']);
        if($create){
            return redirect()->back()->with('success', __('lang.createCourseSuccess'));
        }else{
            return redirect()->back()->with('error', __('lang.createCourseError'))->withInput();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['course'] = Course::with('department')->findOrFail($id);
        $courseType = AppHelper::courseType($data['course']->course_type);
        $createdAt = $data['course']->created_at ? Carbon::parse($data['course']->created_at)->format('d-m-Y H:i:s a') : __('lang.null');
        $deletedAt = $data['course']->deleted_at ? Carbon::parse($data['course']->deleted_at)->format('d-m-Y') : __('lang.null');
        $deletedBy = $data['course']->deleted_by ? $data['course']->deleted_by : __('lang.null');
        // return view('backend.course.show', $data);
        return response()->json([
            'status' => true,
            'data' => $data['course'],
            'courseType' => $courseType,
            'createdAt' => $createdAt,
            'deletedAt' => $deletedAt,
            'deletedBy' => $deletedBy,
            'message' => __('lang.courseDetailSuccess')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['update'] = true;
        $data['course'] = Course::findOrFail($id);
        $data['departments'] = Department::orderBy('id', 'desc')->get();
        // dd($data);
        return view('backend.course.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $checkCourse = Course::findOrFail($id);
        if (!$checkCourse) {
            return redirect()->back()->with('error', __('lang.courseNotFound'));
        }

        $request->validate([
            'course_code' => 'required|string|max:255|unique:courses,course_code,' . $id,
            'course_name_kh' => 'required|string|max:255',
            'course_name_en' => 'required|string|max:255',
            'course_credit' => 'required|numeric',
            'course_theory' => 'required|numeric',
            'course_execute' => 'required|numeric',
            'course_apply' => 'required|numeric',
            'course_duration' => 'required|numeric',
            'course_type' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        if($checkCourse->course_code != $request->course_code){
            //check if course code is unique
            $checkCourseCode = Course::where('course_code', $request->course_code)->first();
            if($checkCourseCode){
                return redirect()->back()->with('error', __('lang.courseCodeExists'))->withInput();
            }
        }



        $data['course'] = $request->except(['_token', '_method']);
        $update = Course::where('id', $id)->update($data['course']);
        if($update){
            return redirect()->route('course.index')->with('success', __('lang.updateCourseSuccess'));
        }else{
            return redirect()->back()->with('error', __('lang.updateCourseError'))->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);

        if ($course) {
            if($course->delete_status == 1){
                // Delete
                $course->update(['delete_status' => 0, 'deleted_at' => now(), 'deleted_by' => @Auth::user()->name]);
                return response()->json(['success' => __('lang.deletecourseSuccess')], 200);
            }else{
                // Restore
                $course->update(['delete_status' => 1]);
                return response()->json(['success' => __('lang.restorecourseSuccess')], 200);
            }
        } else {
            return response()->json(['error' => __('lang.deletecourseError')], 404);
        }
    }
}
