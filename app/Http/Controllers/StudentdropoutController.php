<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Student;
use App\Models\Studentclass;
use Illuminate\Http\Request;

class StudentdropoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['years'] = Year::orderBy('id', 'desc')->get();
        $data['classes'] = Studentclass::with('majors', 'departments')->where('delete_status', 1)->orderBy('id', 'desc')->get();
        $data['students'] = '';
        // search here
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $data['students'] = Student::where('fullname_kh', 'like', '%' . $search . '%')
                ->orWhere('fullname_en', 'like', '%' . $search . '%')
                ->orWhere('id_card', 'like', '%' . $search . '%')
                ->where('dropout_status', 0) // only show active students
                ->orderBy('id', 'desc')->get();
                // ->paginate(10);
        } elseif ($request->has('class_id') && $request->class_id != '') {
            $class_id = $request->class_id;
            $data['students'] = Student::where('class_id', $class_id)
                ->where('dropout_status', 0) // only show active students
                ->orderBy('id', 'desc')->get();
                // ->paginate(10);
        } elseif ($request->has('academy_year') && $request->academy_year !== '') {
            $academy_year = $request->academy_year;
            if($request->class_id != ''){
                $class_id = $request->class_id;
                $data['students'] = Student::with('studentClass')
                                    ->where('class_id', $class_id)
                                    ->where('dropout_status', 0) // only show active students
                                    ->orderByDesc('id')->get();
            }else{
                return redirect()->back()->with('selectClass', __('lang.pleaseSelectClass'))->withInput();
            }
        }else{
            $data['students'] = null;
        }

        $data['search'] = $request->search ?? '';
        $data['class_id'] = $request->class_id ?? '';
        $data['year'] = $request->academy_year ?? '';

        return view('backend.student.dropout', $data);
    }
}
