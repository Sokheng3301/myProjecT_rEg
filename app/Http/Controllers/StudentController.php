<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Year;
use App\Models\Student;
use App\Models\Department;
use App\Models\Studentclass;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Student_sibling;
use function PHPSTORM_META\map;
use App\Models\Student_studyhistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentByClassExport;
use PHPUnit\Framework\MockObject\Builder\Stub;

class StudentController extends Controller
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
                ->where('dropout_status', 1) // only show active students
                ->orderBy('id', 'desc')->get();
                // ->paginate(10);
        } elseif ($request->has('class_id') && $request->class_id != '') {
            $class_id = $request->class_id;
            $data['students'] = Student::where('class_id', $class_id)
                ->where('dropout_status', 1) // only show active students
                ->orderBy('id', 'desc')->get();
                // ->paginate(10);
        } elseif ($request->has('academy_year') && $request->academy_year !== '') {
            $academy_year = $request->academy_year;
            if($request->class_id != ''){
                $class_id = $request->class_id;
                $data['students'] = Student::with('studentClass')
                                    ->where('class_id', $class_id)
                                    ->where('dropout_status', 1) // only show active students
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


        if($data['students'] != null){
            $class_id = $data['students']->first();
            $data['class_id'] = $class_id->class_id;
        }else{
            $data['class_id'] = 0;
        }

        return view('backend.student.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */


    public function createMultiple()
    {
        $data['update'] = null;
        $data['previewlists'] = null;
        $data['classes'] = Studentclass::with('majors', 'departments')->where('delete_status', 1)->orderBy('id', 'desc')->get();
        $data['years'] = Year::orderBy('id', 'desc')->get();
        return view('backend.student.form-multi', $data);
    }


    public function storeMultiple(Request $request)
    {
        $request->validate([
            'number_student' => 'required|integer',
            'class_id' => 'required|integer',
        ]);

        $count_student = $request->number_student;
        $class_id = $request->class_id;
        $checkClassCode = Studentclass::findOrFail($class_id);
        $classCode = $checkClassCode->class_code;

        // Get the maximum id_card for students in the specified class
        $checkMaxIdInStudent = Student::where('class_id', $class_id)->max('id_card');

        // Initialize export data array
        $exportData = [];

        // Generate student IDs and store user records
        for ($i = 1; $i <= $count_student; $i++) {
            $studentId = $checkMaxIdInStudent ? $checkMaxIdInStudent + $i : $classCode + $i;
            $username = $studentId;
            $password = random_int(10000, 99999);
            // echo $password ."<br>";
            // Create User record
            User::create([
                'username' => $username,
                'password' => Hash::make($password),
                'role' => 'student',
                'id_card' => $studentId,
            ]);

            // Store Student record
            Student::create([
                'id_card' => $studentId,
                'class_id' => $class_id,
                'hint_password' => $password,
                // Add other necessary fields as required
            ]);

            // Prepare data for Excel export
            $exportData[] = [
                'no' => $i,
                'username' => $username,
                'password' => $password,
            ];
        }

        // Export to Excel after the loop
        // $export = new class($exportData) implements \Maatwebsite\Excel\Concerns\FromArray, \Maatwebsite\Excel\Concerns\WithHeadings {
        //     protected $data;

        //     public function __construct($data)
        //     {
        //         $this->data = $data;
        //     }

        //     public function array(): array
        //     {
        //         return $this->data;
        //     }

        //     public function headings(): array
        //     {
        //          return [
        //                     __('lang.no'),
        //                     __('lang.username'),
        //                     __('lang.password'),
        //                 ];
        //     }
        // };

        // $downloadExcel = \Maatwebsite\Excel\Facades\Excel::download($export, 'students.xlsx');
        // if($downloadExcel){

        //     return $downloadExcel;

        //     // return response()->json([
        //     //     'success' => 'Done created',
        //     // ]);
        // }


        return redirect()->back()->with([
                    'success' => __('lang.addMultipleStudentSuccess'),
                    'class_id' => $class_id,
                ]);
    }

    public function preview($class_id) {
        $lists = Student::where('class_id', $class_id)->orderBy("id", 'asc')->get();
        $data = '';
        $i = 1;

        foreach ($lists as $list) {
            $data .= '<tr>
                        <td>' . $i++ . '</td>
                        <td>' . $list->id_card . '</td>
                        <td class="text-danger">******</td>
                        <td>' . $list->id_card . '</td>
                        <td>' . $list->fullname_kh . '</td>
                        <td>' . $list->fullname_en . '</td>
                        <td>' . ($list->birth_date ? \Carbon\Carbon::parse($list->birth_date)->format('m-d-Y') : "") . '</td>
                        <td></td>
                    </tr>';
        }

        return response()->json($data);
    }

    public function exportList($class_id) {
        return Excel::download(new StudentByClassExport($class_id), 'student-list-export-'. date('d-m-Y__H-i-s') .'.xlsx');
        // return Excel::download(new StudentByClassExport($class_id), 'student-list-export-'. date('d-m-Y__H-i-s') .'.pdf', \Maatwebsite\Excel\Excel::TCPDF);
    }





    public function create()
    {
        $data['student'] = null;
        $data['update'] = null;
        $data['student_study_history'] = null;
        $data['student_sibling'] = null;
        $data['authInfo'] = null;
        $data['previewlists'] = null;
        $data['search'] = null;
        $data['class_id'] = null;
        $data['class'] = null;
        $data['queryString'] = null;

        $data['years'] = Year::orderBy('id', 'desc')->get();
        $data['classes'] = Studentclass::with('majors', 'departments')->where('delete_status', 1)->orderBy('id', 'desc')->get();
        $data['departments'] = Department::where('delete_status', 1)->orderBy('id', 'desc')->get();

        $data['years'] = Year::orderBy('id', 'desc')->get();
        return view('backend.student.form', $data);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userRun = false;
        $studentRun = false;
        $studyHistoryRun = false;
        $siblingRun = false;

        $request->validate([
            'academy_year' => 'required|integer',
            'class_id' => 'required|integer',
            'username' => 'required|string|max:255|unique:users,id_card',
            'password' => 'required|string|min:4',
            'fullname_kh' => 'required|string|max:255',
            'fullname_en' => 'required|string|max:255',
            'gender' => 'required|string',
        ]);



        $data['login_info'] = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'id_card' => $request->username,
            'role' => 'student',
        ];

        $createInUsers = User::create($data['login_info']);

        if($createInUsers == true) $userRun = true;



        if($request->hasFile('profile')){
            $profile = $request->file('profile')->store('uploads/students', 'custom');
        }else{
            $profile = null;
        }

        $data['students'] = [
            'profile' => $profile,
            'id_card' => $request->username,
            'fullname_kh' => $request->fullname_kh,
            'fullname_en' => $request->fullname_en,
            'class_id' => $request->class_id,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date ? Carbon::parse($request->birth_date)->format('Y-m-d') : NULL,
            'hint_password' => $request->password,
            'national' => $request->national,
            'nationality' => $request->nationality,
            'phone' => $request->phone,
            'email' => $request->email,
            'place_of_birth' => $request->place_of_birth,
            'current_add' => $request->current_add,

            'father_name' => $request->father_name,
            'father_age' => $request->father_age,
            'father_occupation' => $request->father_occupation,
            'father_phone' => $request->father_phone,
            'father_add' => $request->father_current_add,

            'mother_name' => $request->mother_name,
            'mother_age' => $request->mother_age,
            'mother_occupation' => $request->mother_occupation,
            'mother_phone' => $request->mother_phone,
            'mother_add' => $request->mother_current_add,

            'sibling' => $request->sibling,
            'female_sibling' => $request->female_sibling,
        ];

        $createInstudent =  Student::create($data['students']);
        if($createInstudent == true) $studentRun = true;


        $countTableRowStudentHistory = $request->student_study_history_count_tr;
        $countTableRowStudentSibling = $request->student_sibling_count_tr;

        for($i=1; $i<=$countTableRowStudentHistory; $i++){
            $data['study_history'] = [
                'id_card' => $request->username,
                'class_level' => $request->{'level_class_'.$i},
                'school_name' => $request->{'school_name_'.$i},
                'province' => $request->{'province_'.$i},
                'start_year' => $request->{'start_year_'.$i},
                'end_year' => $request->{'end_year_'.$i},
                'certification' => $request->{'certification_'.$i},
                'rank' => $request->{'rank_'.$i},
            ];

            // model here
            $createInStudentStudyHistory = Student_studyhistory::create($data['study_history']);
        }

        if($createInStudentStudyHistory == true) $studyHistoryRun = true;

        for($i=1; $i<=$countTableRowStudentSibling; $i++){
            $data['sibling'] = [
                'id_card' => $request->username,
                'name' => $request->{'name_'.$i},
                'gender' => $request->{'gender_'.$i},
                'birth_date' => $request->{'birth_date_'.$i} ? Carbon::parse($request->{'birth_date_'.$i})->format('Y-m-d') : '',
                'occupation' => $request->{'occupation_'.$i},
                'current_add' => $request->{'current_add_'.$i},
                'phone' => $request->{'phone_'.$i},
            ];

            // model here
            $createInStudentSibling = Student_sibling::create($data['sibling']);
        }

        if($createInStudentSibling == true) $siblingRun = true;

        if($userRun && $studentRun && $studyHistoryRun && $siblingRun == true){
            return redirect()->back()->with('success', __("lang.createStudentSuccess"));
        }else{
            return redirect()->back()->with('error', __("lang.createStudentError"))->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['student'] = Student::with('class')->findOrFail($id);
        $data['student_study_history'] = Student_studyhistory::where('id_card', $data['student']->id_card)->get();
        $data['student_sibling'] = Student_sibling::where('id_card', $data['student']->id_card)->get();
        // dd($data['student']->class->majors->departments->dep_name_en);
        return view('backend.student.about', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $getUrl = url()->previous();
        $queryString = parse_url($getUrl, PHP_URL_QUERY);
        $data['queryString'] = $queryString;


    // Parse the query string into an associative array


        $data['update'] = true;
        $data['student'] = Student::with('class')->findOrFail($id);
        $data['years'] = Year::orderBy('id', 'desc')->get();
        $data['classes'] = Studentclass::with('majors', 'departments')->where('delete_status', 1)->orderBy('id', 'desc')->get();
        $data['departments'] = Department::where('delete_status', 1)->orderBy('id', 'desc')->get();
        $data['student_study_history'] = Student_studyhistory::where('id_card', $data['student']->id_card)->get();
        $data['student_sibling'] = Student_sibling::where('id_card', $data['student']->id_card)->get();
        $data['years'] = Year::orderBy('id', 'desc')->get();
        $data['authInfo'] = User::where('id_card', $data['student']->id_card)->first();


        $id = $data['student']->class_id;
        // $checkMaxIdInStudent = Student::where('class_id', $id)->max('id_card');


        // $classes = Studentclass::findOrFail($class_id);

        $data['class'] = StudentClass::with(['majors' , 'departments'])->findOrFail($id);
        // dd($data['class']->majors->departments->dep_name_en);
        // $studyLevel = collect(\App\Http\Helpers\AppHelper::getStudyLevel())->get($class->level_study);
        // $yearLevel = collect(\App\Http\Helpers\AppHelper::getYearLevel())->get($class->year_level);
        // $graduated = $class->graduate_status == 1 ? __('lang.studying') :  __('lang.graduated');
        // $deleted_at = $class->deleted_date != '' ? Carbon::parse($class->deleted_date)->format('d-m-Y') : __("lang.na");
        // $deleted_by = $class->deleted_by != '' ? $class->deleted_by : __("lang.na");
        // $created_at = Carbon::parse($class->created_at)->format('d-m-Y h:i:s a');

        return view('backend.student.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $queryString = $request->queryString;

        $studentRun = false;
        $studyHistoryRun = false;
        $siblingRun = false;


        $studentInfo = Student::findOrFail($id);
        $studentId = $studentInfo->id_card;

        // dd($studentId);

        $request->validate([
            'fullname_kh' => 'required|string|max:255',
            'fullname_en' => 'required|string|max:255',
            'gender' => 'required|string',
        ]);

        // student info

        if($request->hasFile('profile')){
            if($studentInfo->profile != null){
                if(File::exist($studentInfo->profile)){
                    File::delete($studentInfo->profile);
                }
            }

            $profile = $request->file('profile')->store('uploads/students', 'custom');
        }else{
            $profile = $studentInfo->profile;
        }

        $data['students'] = [
            'profile' => $profile,
            'fullname_kh' => $request->fullname_kh,
            'fullname_en' => $request->fullname_en,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date ? Carbon::parse($request->birth_date)->format('Y-m-d') : NULL,
            'national' => $request->national,
            'nationality' => $request->nationality,
            'phone' => $request->phone,
            'email' => $request->email,
            'place_of_birth' => $request->place_of_birth,
            'current_add' => $request->current_add,

            'father_name' => $request->father_name,
            'father_age' => $request->father_age,
            'father_occupation' => $request->father_occupation,
            'father_phone' => $request->father_phone,
            'father_add' => $request->father_current_add,

            'mother_name' => $request->mother_name,
            'mother_age' => $request->mother_age,
            'mother_occupation' => $request->mother_occupation,
            'mother_phone' => $request->mother_phone,
            'mother_add' => $request->mother_current_add,

            'sibling' => $request->sibling,
            'female_sibling' => $request->female_sibling,
        ];

        $updateStudent = Student::where('id', $id)->update($data['students']);
        if($updateStudent == true) $studentRun = true;




        $countTableRowStudentHistory = $request->student_study_history_count_tr;
        $countTableRowStudentSibling = $request->student_sibling_count_tr;

        // dd($countTableRowStudentHistory . ' - ' . $countTableRowStudentSibling);

        // find in student study history
        $studentStudyHistory = Student_studyhistory::where('id_card', $studentId)->get();
        if($studentStudyHistory->count() > 0){
            // Delete existing study history and sibling records'
            Student_studyhistory::where('id_card', $studentId)->delete();
            for($i=1; $i<=$countTableRowStudentHistory; $i++){
                $data['study_history'] = [
                    'id_card' => $studentId,
                    'class_level' => $request->{'level_class_'.$i},
                    'school_name' => $request->{'school_name_'.$i},
                    'province' => $request->{'province_'.$i},
                    'start_year' => $request->{'start_year_'.$i},
                    'end_year' => $request->{'end_year_'.$i},
                    'certification' => $request->{'certification_'.$i},
                    'rank' => $request->{'rank_'.$i},
                ];

                // model here
                $createInStudentStudyHistory = Student_studyhistory::create($data['study_history']);
            }
        }else{
            for($i=1; $i<=$countTableRowStudentHistory; $i++){
                $data['study_history'] = [
                    'id_card' => $studentId,
                    'class_level' => $request->{'level_class_'.$i},
                    'school_name' => $request->{'school_name_'.$i},
                    'province' => $request->{'province_'.$i},
                    'start_year' => $request->{'start_year_'.$i},
                    'end_year' => $request->{'end_year_'.$i},
                    'certification' => $request->{'certification_'.$i},
                    'rank' => $request->{'rank_'.$i},
                ];

                // model here
                $createInStudentStudyHistory = Student_studyhistory::create($data['study_history']);
            }
        }
        if($createInStudentStudyHistory == true) $studyHistoryRun = true;


        // find in student sibling
        $studentSibling = Student_sibling::where('id_card', $studentId)->get();
        if($studentSibling->count() > 0){
            // Delete existing sibling records
            Student_sibling::where('id_card', $studentId)->delete();
            for($i=1; $i<=$countTableRowStudentSibling; $i++){
                $data['sibling'] = [
                    'id_card' => $studentId,
                    'name' => $request->{'name_'.$i},
                    'gender' => $request->{'gender_'.$i},
                    'birth_date' => $request->{'birth_date_'.$i} ? Carbon::parse($request->{'birth_date_'.$i})->format('Y-m-d') : '',
                    'occupation' => $request->{'occupation_'.$i},
                    'current_add' => $request->{'current_add_'.$i},
                    'phone' => $request->{'phone_'.$i},
                ];

                // model here
                $createInStudentSibling = Student_sibling::create($data['sibling']);
            }
        }else{
            for($i=1; $i<=$countTableRowStudentSibling; $i++){
                $data['sibling'] = [
                    'id_card' => $studentId,
                    'name' => $request->{'name_'.$i},
                    'gender' => $request->{'gender_'.$i},
                    'birth_date' => $request->{'birth_date_'.$i} ? Carbon::parse($request->{'birth_date_'.$i})->format('Y-m-d') : '',
                    'occupation' => $request->{'occupation_'.$i},
                    'current_add' => $request->{'current_add_'.$i},
                    'phone' => $request->{'phone_'.$i},
                ];

                // model here
                $createInStudentSibling = Student_sibling::create($data['sibling']);
            }
        }
        if($createInStudentSibling == true) $siblingRun = true;



        if($updateStudent && $studentRun && $studyHistoryRun && $siblingRun == true){
            return redirect()->route('student.index', $queryString)->with('success', __("lang.updateStudentSuccess"));
        }else{
            return redirect()->back()->with('error', __("lang.updateStudentError"))->withInput();
        }
    }



    public function getClassByYear(Request $request)
    {
        $request->validate([
            'year' => 'required|integer',
        ]);

        $academy_year = $request->year;
        $classes = Studentclass::with('majors', 'departments')
            ->where('academy_year', $academy_year)
            ->orderBy('id', 'desc')
            ->get();

        // Start building the options
        $options = '<option value="">' . __("lang.pleaseSelectClass") . '</option>'; // Default option

        foreach ($classes as $class) {
            $options .= '<option value="' . $class->id . '"';

            // Check for old input to set selected attribute
            if (old('class_id') == $class->id) {
                $options .= ' selected';
            }

            $options .= '>' . $class->class_code . ' - ';

            // Localization check for major name
            if (session()->has('localization') && session('localization') == 'en') {
                $options .= $class->majors->major_name_en;
            } else {
                $options .= $class->majors->major_name_kh;
            }

            // Add study level
            $options .= ' - ' . \App\Http\Helpers\AppHelper::getStudyLevel()[$class->level_study] ?? '';

            // Add year level
            $options .= ' - ' . \App\Http\Helpers\AppHelper::getYearLevel()[$class->year_level] ?? '';

            $options .= '</option>';
        }

        return response()->json($options);
    }

    public function classDetail(Request $request)
    {
        $request->validate([
            'class_id' => 'required|integer',
        ]);



        $id = $request->class_id;
        $checkMaxIdInStudent = Student::where('class_id', $id)->max('id_card');


        // $classes = Studentclass::findOrFail($class_id);


        $class = StudentClass::with(['majors' , 'departments'])->findOrFail($id);

        $studyLevel = collect(\App\Http\Helpers\AppHelper::getStudyLevel())->get($class->level_study);
        $yearLevel = collect(\App\Http\Helpers\AppHelper::getYearLevel())->get($class->year_level);
        $graduated = $class->graduate_status == 1 ? __('lang.studying') :  __('lang.graduated');

            // ? '<a class="ui orange tiny label">' . __('lang.studying') . '</a>'
            // : '<a class="ui blue tiny label">' . __('lang.graduated') . '</a>';

        $deleted_at = $class->deleted_date != '' ? Carbon::parse($class->deleted_date)->format('d-m-Y') : __("lang.na");
        $deleted_by = $class->deleted_by != '' ? $class->deleted_by : __("lang.na");
        $created_at = Carbon::parse($class->created_at)->format('d-m-Y h:i:s a');

        return response()->json([
            'username' => $checkMaxIdInStudent+1,
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

    public function resetPass(Request $request) {
        // Validate the incoming request
        $request->validate([
            'id' => 'required|integer',
            'password' => 'required|string',
        ]);

        // Attempt to find the user by ID
        $user = User::where('id_card', $request->id)->first();

        if (!$user) {
            return response()->json(['error' => __('lang.userNotFound')], 404);
        }

        // Check if the provided password matches the current user's password
        if (Hash::check($request->password, @Auth::user()->password)) {
            // Update the password
            $newPassword = Hash::make('1234');
            $user->password = $newPassword;

            if ($user->save()) {
                return response()->json(['success' => __('lang.resetPassSuccess')]);
            } else {
                return response()->json(['error' => __('lang.resetPassError')], 422);
            }
        } else {
            return response()->json(['error' => __('lang.invalidPassword')], 422);
        }
    }


    public function leave(Request $request, string $id)
    {
        $request->validate([
            'leave_date' => 'required|date',
            'leave_reason' => 'required|string|max:255',
        ]);

        if(validator($request->all())->fails()){
            return response()->json(['error' => __('lang.StudentDropoutError')], 422);
        }

        $leave_date = Carbon::parse($request->leave_date)->format('Y-m-d');
        $leave_description = $request->leave_reason;

        // Find the teacher by ID
        $student = Student::findOrFail($id);

        if ($student) {
            if($student->dropout_status == 1){
                // Delete
                $student->update(['dropout_status' => 0, 'dropout_date' => $leave_date, 'dropout_reason' => $leave_description, 'dropout_by' => @Auth::user()->name]);
                return redirect()->back()->with('success', __('lang.leavestudentSuccess'));
            }else{
                // Restore
                $student->update(['dropout_status' => 1]);
                return redirect()->back()->with('success', __('lang.rebackstudentSuccess'));
            }
        } else {
            return redirect()->back()->with('error', __('lang.leavestudentError'));
        }
    }


    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        if ($student) {
            if($student->delete_status == 1){
                // Delete
                $student->update(['delete_status' => 0, 'deleted_at' => now(), 'deleted_by' => @Auth::user()->name]);
                return response()->json(['success' => __('lang.deletestustudentSuccess')], 200);
            }else{
                // Restore
                $student->update(['delete_status' => 1]);
                return response()->json(['success' => __('lang.restorestustudentSuccess')], 200);
            }
        } else {
            return response()->json(['error' => __('lang.deletestustudentError')], 404);
        }
    }

    public function block(string $id){
        $User = User::where('id_card', $id)->get()->first();
        $student = Student::where('id_card', $id);


        if($User){
            if($User->block_status == 1){
                $User->update(['block_status' => 0, 'blocked_date'=> now(), 'blocked_by' => @Auth::user()->name]);
                $student->update(['block_status' => 0]);

                return response()->json(['success' => __('lang.blockstudentSuccess')], 200);
            }else{
                $User->update(['block_status' => 1]);
                $student->update(['block_status' => 1]);

                return response()->json(['success' => __('lang.unblockstudentSuccess')], 200);
            }
        }
    }

}
