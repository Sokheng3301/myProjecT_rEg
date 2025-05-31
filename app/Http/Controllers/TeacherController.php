<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Teacher_children;
use App\Models\Teacher_praiseblame;
use App\Models\Teacher_shortcourse;
use App\Models\Teacher_workhistory;
use App\Models\Teacher_professional;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Teacher_culturallevel;
use App\Models\Teacher_pedagogycourse;
use App\Models\Teacher_foreignlanguage;
use Illuminate\Support\Facades\File;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data['operators'] = Operator::all();
        $data['teachers'] = Teacher::with(['department'])->where('leave_status', 1)->get()->sortByDesc('id');
        return view('backend.teacher.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['update'] = null;
        $data['teacher'] = null;
        $data['departments'] = Department::where('delete_status', 1)->orderBy('id', 'desc')->get();
        return view('backend.teacher.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_card' => 'required|string|unique:users,id_card',
            'username' => 'required|string|unique:users,username|max:100',
            'password' => 'required|string|min:4|max:100',
            'fullname_kh' => 'required|string|max:255',
            'fullname_en' => 'required|string|max:255',
            'gender' => 'required|string',
            'department_id' => 'required|integer',
        ]);

        // if ($request->errors()->has('username')) {
        //     return redirect()->back()
        //         ->withErrors($request->errors())
        //         ->withInput();
        // }
        $data['users'] = [
            'name' => $request->fullname_en,
            'username' => $request->username,
            'password'=> Hash::make($request->password),
            'id_card' => $request->id_card,
        ];
        // Add to user table
        User::create($data['users']);

        if($request->hasFile('profile')){
            $profile = $request->file('profile')->store('uploads/teachers', 'custom');
        }else{
            $profile = null;
        }

        $data['teacher_info'] = [
            'profile' => $profile,
            'id_card' => $request->id_card,
            'fullname_kh' => $request->fullname_kh,
            'fullname_en' => $request->fullname_en,
            'department_id' => $request->department_id,
            // 'leave_status'
            'gender' => $request->gender,
            'birth_date' => $request->birth_date ? Carbon::parse($request->birth_date)->format('Y-m-d') : null,
            'nationality' => $request->nationality,
            'deisability' => $request->disability,
            // 'officer_id',
            'id_number' => $request->id_number,
            'place_of_birth' => $request->place_of_birth,
            'payroll_acc' => $request->payroll_acc,
            'memeber_bcc' => $request->memeber_bcc,
            'employment_date' => $request->employment_date ? Carbon::parse($request->employment_date)->format('Y-m-d') : null,
            'soup_date' => $request->soup_date ? Carbon::parse($request->soup_date)->format('Y-m-d') : null,
            'working_unit' => $request->working_unit,
            'working_unit_add' => $request->working_unit_add,

            'office' => $request->office,
            'position' => $request->position,
            'anountment' => $request->anountment,
            'rank' => $request->rank_class,
            'refer' => $request->refer,
            'numbering' => $request->numbering,
            'last_interest_date' => $request->last_interest_date ? Carbon::parse($request->last_interest_date)->format('Y-m-d') : null,
            'dated' => $request->dated ? Carbon::parse($request->dated)->format('Y-m-d') : null,
            'teach_in_year' => $request->teach_in_year,
            'english_teach' => $request->english_teach,
            'three_level_combine' => $request->three_level_combine,
            'technic_team_leader' => $request->technic_team_leader,
            'help_teach' => $request->help_teach,
            'two_class' => $request->two_class,
            'class_charge' => $request->class_charge,
            'cross_school' => $request->cross_school,
            'overtime' => $request->overtime,
            'coupling_class' => $request->coupling_class,
            'two_lang' => $request->two_lang,
            'work_status' => $request->work_status,
            'family_status' => $request->family_status,
            'must_be' => $request->must_be,
            'occupation' => $request->occupation,
            'name_confederate' => $request->name_confederate,
            'confederation' => $request->confederation,
            'birth_date_spouse' => $request->birth_date_spouse ? Carbon::parse($request->birth_date_spouse)->format('Y-m-d') : null,
            'wife_salary' => $request->wife_salary,
            'phone_number' => $request->phone_number,
            'email_add' => $request->email_add,
            'current_add' => $request->current_add,
        ];
        // model here
        Teacher::create($data['teacher_info']);



        // 1 Insert data to table t_professional
        $data['TableProfessional'] = []; // Initialize the array
        for ($i = 1; $i <= $request->trTableProfessional; $i++) {
            $data['TableProfessional'] = [
                'teacher_id' => $request->id_card,
                'type_professional' => $request->{'type_professional_' . $i},
                'description' => $request->{'description_' . $i},
                'number_anountment' => $request->{'number_anountment_' . $i},
                'recieve_date' => $request->{'professional_recieve_date_' . $i} ? Carbon::parse($request->{'professional_recieve_date_' . $i})->format('Y-m-d') : null,
            ];

            // model here
            Teacher_professional::create($data['TableProfessional']);
        }

        // 2 Insert data to table t_workhistory
        $data['TableWorkHistory'] = [];
        for($i=1; $i<= $request->trTableWorkHistory; $i++){
            $data['TableWorkHistory'] = [
                'teacher_id' => $request->id_card,
                'work_continue' => $request->{'work_continue_'. $i},
                'current_working' => $request->{'current_working_'. $i},
                'start_date' => $request->{'work_start_date_'. $i} ? Carbon::parse($request->{'work_start_date_'. $i})->format('Y-m-d') : null,
                'finish_date' => $request->{'work_finish_date_'. $i} ? Carbon::parse($request->{'work_finish_date_'. $i})->format('Y-m-d') : null,
            ];
            // model here
            Teacher_workhistory::create($data['TableWorkHistory']);
        }

        //3  Insert data to table t_praiseblame
        $data['PraiseBlameTable'] = [];
        for($i=1; $i<=$request->trTablePraiseBlame; $i++){
            $data['PraiseBlameTable'] = [
                'teacher_id' => $request->id_card,
                'type_praiseblame' => $request->{'type_praiseblame_'. $i},
                'provided_by' => $request->{'provided_by_'. $i},
                'recieve_date' => $request->{'praise_blame_recieve_date_'. $i} ? Carbon::parse($request->{'praise_blame_recieve_date_'. $i})->format('Y-m-d') : null,
            ];

            // model here
            Teacher_praiseblame::create($data['PraiseBlameTable']);
        }

        //4 Insert data to table pedagogyCourseTable
        $data['pedagogyCourseTable'] = [];
        for($i=1; $i<=$request->trTablePedagogyCourse; $i++){
            $data['pedagogyCourseTable'] = [
                'teacher_id' => $request->id_card,
                'professional_level' => $request->{'professional_level_'. $i},
                'specialty_first' => $request->{'specialty_first_'. $i},
                'specialty_second' => $request->{'specialty_second_'. $i},
                'training_system' => $request->{'training_system_'. $i},
                'recieve_date' => $request->{'pedagogyCourse_recieve_date_'. $i} ? Carbon::parse($request->{'pedagogyCourse_recieve_date_'. $i})->format('Y-m-d') : null,
            ];
            // model here
            Teacher_pedagogycourse::create($data['pedagogyCourseTable']);
        }

        //5 Insert data to table t_shortcourses
        $data['ShortCourseTable'] = [];
        for($i=1; $i <= $request->trTableShortCourse; $i++){
            $data['ShortCourseTable'] = [
                'teacher_id' => $request->id_card,
                'section' => $request->{'course_section_'. $i},
                'major_name' => $request->{'course_major_name_'. $i},
                'start_date' => $request->{'course_start_date_'. $i} ? Carbon::parse($request->{'course_start_date_'. $i})->format('Y-m-d') : null,
                'finish_date' => $request->{'course_finish_date_'. $i} ? Carbon::parse($request->{'course_finish_date_'. $i})->format('Y-m-d') : null,
                'duration' => $request->{'course_duration_'. $i},
                'prepare_by' => $request->{'course_prepare_by_'. $i},
                'support_by' => $request->{'course_support_by_'. $i},
            ];
            // model here
            Teacher_shortcourse::create($data['ShortCourseTable']);
        }

        //6 Insert data to table t_culturalLevel
        $data['culturalLevelTable'] = [];
        for($i=1; $i<=$request->trTableCulturalLevel; $i++){
            $data['culturalLevelTable'] = [
                'teacher_id' => $request->id_card,
                'cultural_level' => $request->{'cultural_level_'. $i},
                'major_name' => $request->{'culturalLevel_major_name_'. $i},
                'recieve_date' => $request->{'culturalLevel_recieve_date_'. $i} ? Carbon::parse($request->{'culturalLevel_recieve_date_'. $i})->format('Y-m-d') : null,
                'country' => $request->{'country_'. $i},
            ];

            // model here
            Teacher_culturallevel::create($data['culturalLevelTable']);
        }



        //7 Insert data to table t_forienglanguage
        $data['ForeignlanguageTable'] = [];
        for($i=1; $i<=$request->trTableForeignlanguage; $i++){
           $data['ForeignlanguageTable'] = [
                'teacher_id' => $request->id_card,
                'language' => $request->{'language_'. $i},
                'reading' => $request->{'reading_'. $i},
                'writing' => $request->{'writing_'. $i},
                'conversation' => $request->{'conversation_'. $i},
           ];

            //    model here
            Teacher_foreignlanguage::create($data['ForeignlanguageTable']);
        }


        //8 Insert data to table t_childrens
        $data['ChildrenTable'] = [];
        for($i=1; $i<=$request->trTableChildren; $i++){
            $data['ChildrenTable'] = [
                'teacher_id' => $request->id_card,
                'child_name' => $request->{'child_name_'. $i},
                'gender' => $request->{'chile_gender_'. $i},
                'birth_date' => $request->{'child_birth_date_'. $i} ? Carbon::parse($request->{'child_birth_date_'. $i})->format('Y-m-d') : null,
                'occupation' => $request->{'child_occupation_'. $i},
            ];

            // model here
            Teacher_children::create($data['ChildrenTable']);
        }


        return redirect()->back()->with('success', __('lang.createTeachersuccess'));
        // }else{
        //     return redirect()->back()->with('error', __('lang.createTeacherError'))->withInput();
        // }

        // dd($request->input());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['teacher'] = Teacher::with('department')->findOrFail($id);
        $data['update'] = null;
        $data['departments'] = Department::where('delete_status', 1)->orderBy('id', 'desc')->get();
        $data['teacher_professionals'] = Teacher_professional::where('teacher_id', $data['teacher']->id_card)->get();
        $data['teacher_workhistories'] = Teacher_workhistory::where('teacher_id', $data['teacher']->id_card)->get();
        $data['teacher_praiseblames'] = Teacher_praiseblame::where('teacher_id', $data['teacher']->id_card)->get();
        $data['teacher_culturallevels'] = Teacher_culturallevel::where('teacher_id', $data['teacher']->id_card)->get();
        $data['teacher_pedagogyCourses'] = Teacher_pedagogycourse::where('teacher_id', $data['teacher']->id_card)->get();
        $data['teacher_shortcourses'] = Teacher_shortcourse::where('teacher_id', $data['teacher']->id_card)->get();
        $data['teacher_foriegnlangs'] = Teacher_foreignlanguage::where('teacher_id', $data['teacher']->id_card)->get();
        $data['teacher_childrens'] = Teacher_children::where('teacher_id', $data['teacher']->id_card)->get();

        $data['block_info'] = User::where('id_card', $data['teacher']->id_card)->get()->first();
        // dd($data['teacher_workhistories']);
        return view('backend.teacher.about', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['update'] = true;
        $data['teacher'] = Teacher::findOrFail($id);
        $data['departments'] = Department::where('delete_status', 1)->orderBy('id', 'desc')->get();
        $data['teacher_professionals'] = Teacher_professional::where('teacher_id', $data['teacher']->id_card)->get();
        $data['teacher_workhistories'] = Teacher_workhistory::where('teacher_id', $data['teacher']->id_card)->get();
        $data['teacher_praiseblames'] = Teacher_praiseblame::where('teacher_id', $data['teacher']->id_card)->get();
        $data['teacher_culturallevels'] = Teacher_culturallevel::where('teacher_id', $data['teacher']->id_card)->get();
        $data['teacher_pedagogyCourses'] = Teacher_pedagogycourse::where('teacher_id', $data['teacher']->id_card)->get();
        $data['teacher_shortcourses'] = Teacher_shortcourse::where('teacher_id', $data['teacher']->id_card)->get();
        $data['teacher_foriegnlangs'] = Teacher_foreignlanguage::where('teacher_id', $data['teacher']->id_card)->get();
        $data['teacher_childrens'] = Teacher_children::where('teacher_id', $data['teacher']->id_card)->get();

        return view('backend.teacher.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($id);
        $teacherTable = Teacher::findOrFail($id);
        $id_card = $teacherTable->id_card;
        $profile = null;

        $request->validate([
            'fullname_kh' => 'required|string|max:255',
            'fullname_en' => 'required|string|max:255',
            'gender' => 'required|string',
            'department_id' => 'required|integer',
        ]);

        if($request->hasFile('profile')){
            // delete profile path if exists
            if(File::exists($teacherTable->profile)){
                File::delete($teacherTable->profile);
            }

            $profile = $request->file('profile')->store('uploads/teachers', 'custom');
        }else{
            $profile = $teacherTable->profile;
        }


        // Update to teachers table
        $data['teacher_info'] = [
            'profile' => $profile,
            // 'id_card' => $request->id_card,
            'fullname_kh' => $request->fullname_kh,
            'fullname_en' => $request->fullname_en,
            'department_id' => $request->department_id,
            // 'leave_status'
            'gender' => $request->gender,
            'birth_date' => $request->birth_date ? Carbon::parse($request->birth_date)->format('Y-m-d') : null,
            'nationality' => $request->nationality,
            'disability' => $request->disability,
            // 'officer_id',
            'id_number' => $request->id_number,
            'place_of_birth' => $request->place_fo_birth,
            'payroll_acc' => $request->payroll_acc,
            'memeber_bcc' => $request->memeber_bcc,
            'employment_date' => $request->employment_date ? Carbon::parse($request->employment_date)->format('Y-m-d') : null,
            'soup_date' => $request->soup_date ? Carbon::parse($request->soup_date)->format('Y-m-d') : null,
            'working_unit' => $request->working_unit,
            'working_unit_add' => $request->working_unit_add,

            'office' => $request->office,
            'position' => $request->position,
            'anountment' => $request->anountment,
            'rank' => $request->rank_class,
            'refer' => $request->refer,
            'numbering' => $request->numbering,
            'last_interest_date' => $request->last_interest_date ? Carbon::parse($request->last_interest_date)->format('Y-m-d') : null,
            'dated' => $request->dated ? Carbon::parse($request->dated)->format('Y-m-d') : null,
            'teach_in_year' => $request->teach_in_year,
            'english_teach' => $request->english_teach,
            'three_level_combine' => $request->three_level_combine,
            'technic_team_leader' => $request->technic_team_leader,
            'help_teach' => $request->help_teach,
            'two_class' => $request->two_class,
            'class_charge' => $request->class_charge,
            'cross_school' => $request->cross_school,
            'overtime' => $request->overtime,
            'coupling_class' => $request->coupling_class,
            'two_lang' => $request->two_lang,
            'work_status' => $request->work_status,
            'family_status' => $request->family_status,
            'must_be' => $request->must_be,
            'occupation' => $request->occupation,
            'name_confederate' => $request->name_confederate,
            'confederation' => $request->confederation,
            'birth_date_spouse' => $request->birth_date_spouse ? Carbon::parse($request->birth_date_spouse)->format('Y-m-d') : null,
            'wife_salary' => $request->wife_salary,
            'phone_number' => $request->phone_number,
            'email_add' => $request->email_add,
            'current_add' => $request->current_add,
        ];
        $teacherTable->update($data['teacher_info']);


        // 1 Update data to table t_professional
            $data['TableProfessional'] = []; // Initialize the array
            // delete teacher professional
            Teacher_professional::where('teacher_id', $id_card)->delete();

            for ($i = 1; $i <= $request->trTableProfessional; $i++) {
                $data['TableProfessional'] = [
                    'teacher_id' => $id_card,
                    'type_professional' => $request->{'type_professional_' . $i},
                    'description' => $request->{'description_' . $i},
                    'number_anountment' => $request->{'number_anountment_' . $i},
                    'recieve_date' => $request->{'professional_recieve_date_' . $i} ? Carbon::parse($request->{'professional_recieve_date_' . $i})->format('Y-m-d') : null,
                ];

                // model here add here
                Teacher_professional::create($data['TableProfessional']);
            }

        // 2 Update data to table t_workhistory
            $data['TableWorkHistory'] = [];
            // delete teacher work history
            Teacher_workhistory::where('teacher_id', $id_card)->delete();
            for($i=1; $i<= $request->trTableWorkHistory; $i++){
                $data['TableWorkHistory'] = [
                    'teacher_id' => $id_card,
                    'work_continue' => $request->{'work_continue_'. $i},
                    'current_working' => $request->{'current_working_'. $i},
                    'start_date' => $request->{'work_start_date_'. $i} ? Carbon::parse($request->{'work_start_date_'. $i})->format('Y-m-d') : null,
                    'finish_date' => $request->{'work_finish_date_'. $i} ? Carbon::parse($request->{'work_finish_date_'. $i})->format('Y-m-d') : null,
                ];
                // model here add here
                Teacher_workhistory::create($data['TableWorkHistory']);
            }

        //3  Update data to table t_praiseblame
            $data['PraiseBlameTable'] = [];
            // delete teacher praise blame
            Teacher_praiseblame::where('teacher_id', $id_card)->delete();
            for($i=1; $i<=$request->trTablePraiseBlame; $i++){
                $data['PraiseBlameTable'] = [
                    'teacher_id' => $id_card,
                    'type_praiseblame' => $request->{'type_praiseblame_'. $i},
                    'provided_by' => $request->{'provided_by_'. $i},
                    'recieve_date' => $request->{'praise_blame_recieve_date_'. $i} ? Carbon::parse($request->{'praise_blame_recieve_date_'. $i})->format('Y-m-d') : null,
                ];

                // model here add here
                Teacher_praiseblame::create($data['PraiseBlameTable']);
            }

        //4 Update data to table pedagogyCourseTable
            $data['pedagogyCourseTable'] = [];
            // delete teacher pedagogy course
            Teacher_pedagogycourse::where('teacher_id', $id_card)->delete();
            for($i=1; $i<=$request->trTablePedagogyCourse; $i++){
                $data['pedagogyCourseTable'] = [
                    'teacher_id' => $id_card,
                    'professional_level' => $request->{'professional_level_'. $i},
                    'specialty_first' => $request->{'specialty_first_'. $i},
                    'specialty_second' => $request->{'specialty_second_'. $i},
                    'training_system' => $request->{'training_system_'. $i},
                    'recieve_date' => $request->{'pedagogyCourse_recieve_date_'. $i} ? Carbon::parse($request->{'pedagogyCourse_recieve_date_'. $i})->format('Y-m-d') : null,
                ];
                // model here add here
                Teacher_pedagogycourse::create($data['pedagogyCourseTable']);
            }

        //5 Update data to table t_shortcourses
            $data['ShortCourseTable'] = [];
            // delete teacher short course
            Teacher_shortcourse::where('teacher_id', $id_card)->delete();
            for($i=1; $i <= $request->trTableShortCourse; $i++){
                $data['ShortCourseTable'] = [
                    'teacher_id' => $id_card,
                    'section' => $request->{'course_section_'. $i},
                    'major_name' => $request->{'course_major_name_'. $i},
                    'start_date' => $request->{'course_start_date_'. $i} ? Carbon::parse($request->{'course_start_date_'. $i})->format('Y-m-d') : null,
                    'finish_date' => $request->{'course_finish_date_'. $i} ? Carbon::parse($request->{'course_finish_date_'. $i})->format('Y-m-d') : null,
                    'duration' => $request->{'course_duration_'. $i},
                    'prepare_by' => $request->{'course_prepare_by_'. $i},
                    'support_by' => $request->{'course_support_by_'. $i},
                ];
                // model here add here
                Teacher_shortcourse::create($data['ShortCourseTable']);
            }

        //6 Update data to table t_culturalLevel
            $data['culturalLevelTable'] = [];
            // delete teacher cultural level
            Teacher_culturallevel::where('teacher_id', $id_card)->delete();
            for($i=1; $i<=$request->trTableCulturalLevel; $i++){
                $data['culturalLevelTable'] = [
                    'teacher_id' => $id_card,
                    'cultural_level' => $request->{'cultural_level_'. $i},
                    'major_name' => $request->{'culturalLevel_major_name_'. $i},
                    'recieve_date' => $request->{'culturalLevel_recieve_date_'. $i} ? Carbon::parse($request->{'culturalLevel_recieve_date_'. $i})->format('Y-m-d') : null,
                    'country' => $request->{'country_'. $i},
                ];

                // model here add here
                Teacher_culturallevel::create($data['culturalLevelTable']);
            }

        //7 Update data to table t_forienglanguage
            $data['ForeignlanguageTable'] = [];
            // delete teacher foreign language
            Teacher_foreignlanguage::where('teacher_id', $id_card)->delete();
            for($i=1; $i<=$request->trTableForeignlanguage; $i++){
               $data['ForeignlanguageTable'] = [
                    'teacher_id' => $id_card,
                    'language' => $request->{'language_'. $i},
                    'reading' => $request->{'reading_'. $i},
                    'writing' => $request->{'writing_'. $i},
                    'conversation' => $request->{'conversation_'. $i},
               ];

                //    model here add here
                Teacher_foreignlanguage::create($data['ForeignlanguageTable']);
            }

        //8 Update data to table t_childrens
            $data['ChildrenTable'] = [];
            // delete teacher children
            Teacher_children::where('teacher_id', $id_card)->delete();
            for($i=1; $i<=$request->trTableChildren; $i++){
                $data['ChildrenTable'] = [
                    'teacher_id' => $id_card,
                    'child_name' => $request->{'child_name_'. $i},
                    'gender' => $request->{'chile_gender_'. $i},
                    'birth_date' => $request->{'child_birth_date_'. $i} ? Carbon::parse($request->{'child_birth_date_'. $i})->format('Y-m-d') : null,
                    'occupation' => $request->{'child_occupation_'. $i},
                ];

                // model here add here
                Teacher_children::create($data['ChildrenTable']);
            }
        //End of update data to teacher children
        return redirect()->route('teacher.index')->with('success', __('lang.updateTeachersuccess'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        if ($teacher) {
            if($teacher->delete_status == 1){
                // Delete
                $teacher->update(['delete_status' => 0, 'deleted_at' => now(), 'deleted_by' => @Auth::user()->name]);
                return response()->json(['success' => __('lang.deleteteacherSuccess')], 200);
            }else{
                // Restore
                $teacher->update(['delete_status' => 1]);
                return response()->json(['success' => __('lang.restoreteacherSuccess')], 200);
            }
        } else {
            return response()->json(['error' => __('lang.deleteteacherError')], 404);
        }
    }

    public function block(string $id){
        $User = User::where('id_card', $id)->get()->first();
        $teacher = Teacher::where('id_card', $id);


        if($User){
            if($User->block_status == 1){
                $User->update(['block_status' => 0, 'blocked_date'=> now(), 'blocked_by' => @Auth::user()->name]);
                $teacher->update(['block_status' => 0]);

                return response()->json(['success' => __('lang.blockteacherSuccess')], 200);
            }else{
                $User->update(['block_status' => 1]);
                $teacher->update(['block_status' => 1]);

                return response()->json(['success' => __('lang.unblockteacherSuccess')], 200);
            }
        }
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

    private function checkCredentials($password)
    {
        if($password){
            if(Auth::check($password)){
                return true;
            }else{
                return false;
            }
        }
        // Logic to check if the credentials are valid
        // return true; // or false based on your logic
    }

    public function leave(Request $request, string $id)
    {
        $request->validate([
            'leave_date' => 'required|date',
            'leave_reason' => 'required|string|max:255',
        ]);

        if(validator($request->all())->fails()){
            return response()->json(['error' => __('lang.leaveTeacherError')], 422);
        }

        $leave_date = Carbon::parse($request->leave_date)->format('Y-m-d');
        $leave_description = $request->leave_reason;

        // Find the teacher by ID
        $teacher = Teacher::findOrFail($id);

        if ($teacher) {
            if($teacher->leave_status == 1){
                // Delete
                $teacher->update(['leave_status' => 0, 'leave_date' => $leave_date, 'leave_description' => $leave_description, 'leave_by' => @Auth::user()->name]);
                return redirect()->back()->with('success', __('lang.leaveTeacherSuccess'));
            }else{
                // Restore
                $teacher->update(['leave_status' => 1]);
                return redirect()->back()->with('success', __('lang.rebackTeacherSuccess'));
            }
        } else {
            return redirect()->back()->with('error', __('lang.leaveTeacherError'));
        }
    }

    public function leaveList()
    {
        $data['teachers'] = Teacher::with(['department'])->where('leave_status', 0)->get()->sortByDesc('id');
        return view('backend.teacher.leave-list', $data);
    }
}
