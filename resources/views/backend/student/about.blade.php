@extends('backend.layout.master')
@section('title')
    {{__('lang.aboutStudent')}}
@endsection
@section('content')

    {{-- <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">{{__("lang.Major")}}</h3></div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#"> {{ __('lang.home') }} </a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('lang.Major')}}</li>
                </ol>
                </div>
            </div>
        </div>
    </div> --}}

    @section('pageTitle')
        {{__('lang.aboutStudent')}}
    @endsection

    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row">
            <!-- Start col -->
                <div class="col-md-12 connectedSortable">

                <!-- /.card -->
                <!-- DIRECT CHAT -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">{{__('lang.studentProfile')}} </h3>
                        </div>
                        <div class="card-body">
                            <!-- Conversations are loaded here -->
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="row">
                                        <div class="col-md-6 mx-auto">
                                            {{-- <label for="teacher_profile" class="file-upload"> --}}
                                                <img class="ui small image mx-auto" @if ($student->profile)
                                                    src="{{ asset($student->profile) }}"
                                                    @else
                                                    src="{{ asset('dist/assets/img/white-image.png') }}"
                                                    @endif alt="" id="dep_logo_img">
                                                <p class="text-center mt-2">{{__("lang.studentPhoto")}}</p>
                                                <div class="col-md-10 mx-auto">
                                                    {{-- @if($block_info->block_status == 0 || $student->leave_status == 0)
                                                        <div class="ui red message">
                                                            @if($block_info->block_status == 0)
                                                                <p class="fw-bold">{{__("lang.teacherHasBlocked")}}</p>
                                                                <p class="ps-3"> <i class="bi bi-calendar"></i> {{ \Carbon\Carbon::parse($block_info->blocked_date)->format('d-m-Y') }}</p>
                                                                <p class="ps-3"> <i class="bi bi-person"></i> {{ $block_info->blocked_by }}</p>
                                                            @endif
                                                            @if($student->leave_status == 0)
                                                                <p class="fw-bold">{{__("lang.teacherHasLeaved")}}</p>
                                                                <p class="ps-3"> <i class="bi bi-calendar"></i> {{ \Carbon\Carbon::parse($student->leave_date)->format('d-m-Y') }}</p>
                                                                <p class="ps-3"> <i class="bi bi-chat-right-dots"></i> {{ $student->leave_description }}</p>
                                                            @endif
                                                        </div>
                                                    @endif --}}


                                                </div>


                                            {{-- </label> --}}
                                            {{-- <input type="file" name="profile" class="d-none" id="teacher_profile"accept="image/*" onchange="document.getElementById('dep_logo_img').src = window.URL.createObjectURL(this.files[0])"> --}}
                                        </div>
                                    </div>
                                </div>


                            {{-- section 1 --}}
                                <div class="col-md-12 my-3">
                                    <h3 class="pb-2 ui red header border-bottom">1. {{__("lang.studentInfo")}}</h3>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row mb-3">
                                                <div class="col-5 fw-bold">{{ __('lang.idCard') }}</div>
                                                <p class="col-7">{{ $student->id_card ?: __('lang.null') }}</p>

                                                <div class="col-5 fw-bold">{{ __('lang.fullnameKh') }}</div>
                                                <p class="col-7">{{ $student->fullname_kh ?? __('lang.null') }}</p>

                                                <div class="col-5 fw-bold">{{ __('lang.fullnameEn') }}</div>
                                                <p class="col-7 text-uppercase">{{ $student->fullname_en ?? __('lang.null') }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.gender') }}</div>
                                                <p class="col-7">{{ $student->gender == 'm' ? __('lang.male') : __('lang.female') }}</p>

                                                <div class="col-5 fw-bold">{{ __('lang.national') }}</div>
                                                <p class="col-7">{{ $student->national ?: __('lang.null') }}</p>

                                                <div class="col-5 fw-bold">{{ __('lang.nationality') }}</div>
                                                <p class="col-7">{{ $student->nationality ?: __('lang.null') }}</p>

                                                <div class="col-5 fw-bold">{{ __('lang.birthDate') }}</div>
                                                <p class="col-7">{{ $student->birth_date ? \Illuminate\Support\Carbon::parse($student->birth_date)->format('d-m-Y') : __("lang.null") }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.placeBirth') }}</div>
                                                <p class="col-7">{{ $student->place_of_birth ?: __('lang.null') }}</p>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row mb-3">
                                                <div class="col-5 fw-bold">{{ __('lang.department') }}</div>
                                                <p class="col-7">
                                                    @if (session()->has('localization') && session('localization') == 'en')
                                                        {{ $student->class->majors->departments->dep_name_en }}
                                                    @else
                                                        {{ $student->class->majors->departments->dep_name_kh }}
                                                    @endif
                                                </p>

                                                <div class="col-5 fw-bold">{{ __('lang.major') }}</div>
                                                <p class="col-7">
                                                        @if (session()->has('localization') && session('localization') == 'en')
                                                        {{ $student->class->majors->major_name_en }}
                                                    @else
                                                        {{ $student->class->majors->major_name_kh }}
                                                    @endif
                                                </p>
                                                <div class="col-5 fw-bold">{{ __('lang.studyLevel') }}</div>
                                                <p class="col-7">{{ \App\Http\Helpers\AppHelper::studyLevel($student->class->level_study) ?? __("lang.null") }}</p>

                                                <div class="col-5 fw-bold">{{ __('lang.yearLevel') }}</div>
                                                <p class="col-7">{{ \App\Http\Helpers\AppHelper::yearLevel($student->class->year_level) ?? __("lang.null") }}</p>

                                                <div class="col-5 fw-bold">{{ __('lang.startAcademyYear') }}</div>
                                                <p class="col-7">{{ $student->class->academy_year  ?: __("lang.null") }}</p>

                                                <div class="col-5 fw-bold">{{ __('lang.current_add') }}</div>
                                                <p class="col-7"> {{ $student->current_add ?: __('lang.null')}}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.phone_number') }}</div>
                                                <p class="col-7">{{ $student->phone ?: __("lang.null")}}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.email_add') }}</div>
                                                <p class="col-7">{{ $student->email ?: __("lang.null")}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-md-12 my-3">
                                    <div class="ui error message"></div>
                                </div> --}}





                            {{-- section 2 --}}
                                <div class="col-md-12 my-3">
                                    <h3 class="pb-2 ui red header border-bottom">2. {{__("lang.studyHistory ")}} </h3>
                                </div>

                                <div class="col-md-12 table-responsive">
                                    <div class="myresponsive_table">
                                        <table class="table table-sm" id="studentStudyHistory">
                                            <thead>
                                                <tr>
                                                    <th scope="col"> {{ __('lang.levelClass') }} </th>
                                                    <th scope="col"> {{ __('lang.schoolName') }} </th>
                                                    <th scope="col"> {{ __('lang.province') }} </th>
                                                    <th scope="col"> {{ __('lang.startYear') }} </th>
                                                    <th scope="col"> {{ __('lang.endYear') }} </th>
                                                    <th scope="col"> {{ __('lang.certificateRecieve') }} </th>
                                                    <th scope="col"> {{ __('lang.rank') }} </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($student_study_history->isEmpty())
                                                    <tr>
                                                        <td colspan="7" class="text-center">{{ __('lang.noDataAvailable') }}</td>
                                                    </tr>
                                                @else
                                                    @foreach ($student_study_history as $study)
                                                        <tr>
                                                            <td class="field">{{ $study->class_level ?: __('lang.null') }}</td>
                                                            <td class="field">{{ $study->school_name ?: __('lang.null') }}</td>
                                                            <td class="field">{{ $study->province ?: __('lang.null') }}</td>
                                                            <td class="field">{{ $study->start_year ?: __('lang.null') }}</td>
                                                            <td class="field">{{ $study->end_year ?: __('lang.null') }}</td>
                                                            <td class="field">{{ $study->certification ?: __('lang.null') }}</td>
                                                            <td class="field">{{ $study->rank ?: __('lang.null') }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            {{-- section 3 --}}
                                <div class="col-md-12 my-3">
                                    <h3 class="pb-2 ui red header border-bottom">3. {{__("lang.familyInformation")}} </h3>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <h4 class="my-3"> <i class="bi bi-dot text-danger"></i> {{__('lang.aboutFather')}}</h4>
                                            <div class="row mb-3">
                                                <div class="col-5 fw-bold">{{ __('lang.fatherName') }}</div>
                                                <p class="col-7">{{ $student->father_name ?: __('lang.null') }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.age') }}</div>
                                                <p class="col-7">{{ $student->father_age ? $student->father_age . ' ' .__("lang.year") : __('lang.null') }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.occupation') }}</div>
                                                <p class="col-7">{{ $student->father_occupation ?: __('lang.null') }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.phoneNumber') }}</div>
                                                <p class="col-7">{{ $student->father_phone ?: __('lang.null') }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.current_add') }}</div>
                                                <p class="col-7">{{ $student->father_add ?: __('lang.null') }}</p>
                                            </div>
                                        </div>

                                            <div class="col-md-6 mb-2">
                                            <h4 class="my-3"> <i class="bi bi-dot text-danger"></i> {{__('lang.aboutMother')}}</h4>
                                            <div class="row mb-3">
                                                <div class="col-5 fw-bold">{{ __('lang.motherName') }}</div>
                                                <p class="col-7">{{ $student->mother_name ?: __('lang.null') }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.age') }}</div>
                                                <p class="col-7">{{ $student->mother_age ? $student->mother_age . ' ' .__("lang.year") : __('lang.null') }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.occupation') }}</div>
                                                <p class="col-7">{{ $student->mother_occupation ?: __('lang.null') }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.phoneNumber') }}</div>
                                                <p class="col-7">{{ $student->mother_phone ?: __('lang.null') }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.current_add') }}</div>
                                                <p class="col-7">{{ $student->mother_add ?: __('lang.null') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="row">
                                                <div class="col-5 fw-bold">{{ __('lang.totalSibling') }}</div>
                                                <p class="col-7">{{ $student->sibling ?  $student->sibling .  ' ' . __('lang.person')  : __('lang.null') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="row">
                                                <div class="col-5 fw-bold">{{ __('lang.femaleMemeber') }}</div>
                                                <p class="col-7">{{ $student->female_sibling ? $student->female_sibling . ' '. __('lang.person') : __('lang.null') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12 mt-2 table-responsive">
                                    <div class="myresponsive_table">
                                        <table class="table table-sm" id="studentSiblingTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col"> {{ __('lang.name') }} </th>
                                                    <th scope="col"> {{ __('lang.gender') }} </th>
                                                    <th scope="col"> {{ __('lang.birthDate') }} </th>
                                                    <th scope="col"> {{ __('lang.occupation') }} </th>
                                                    <th scope="col"> {{ __('lang.current_add') }} </th>
                                                    <th scope="col"> {{ __('lang.phone') }} </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($student_sibling->isEmpty())
                                                    <tr>
                                                        <td colspan="6" class="text-center">{{ __('lang.noDataAvailable') }}</td>
                                                    </tr>
                                                @else
                                                    @foreach ($student_sibling as $sibling)
                                                        <tr>
                                                            <td>{{$sibling->name ?: __('lang.null')}}</td>
                                                            <td>{{$sibling->gender ?: __('lang.null')}}</td>
                                                            <td>
                                                                @if($sibling->birth_date != null)
                                                                    {{Carbon\Carbon::parse($sibling->birth_date) -> format('d-m-Y') }}
                                                                @else
                                                                    {{__('lang.null')}}
                                                                @endif
                                                            </td>
                                                            <td>{{$sibling->occupation ?: __('lang.null')}}</td>
                                                            <td>{{$sibling->current_add ?: __('lang.null')}}</td>
                                                            <td>{{$sibling->phone ?: __('lang.null')}}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // form validator
        $('.ui.form').form({
            fields: {
                id_card: {
                    identifier: 'id_card',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : '{{__("lang.pleaseEnterid_card")}}'
                        }
                    ]
                },
                username: {
                    identifier: 'username',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : '{{ __("lang.pleaseEnterusername") }}'
                        }
                    ]
                },
                password: {
                    identifier: 'password',
                    rules: [
                        {

                            type   : 'minLength[4]',
                            prompt : '{{ __("lang.pleaseEnterpasswordLest4Charecter") }}'
                        }
                    ]
                },
                confirm_password: {
                    identifier: 'confirm_password',
                    rules: [
                        {
                            type   : 'match[password]',
                            prompt : '{{ __("lang.pleaseEnterconfirm_passwordAndMatchWithPassword") }}'
                        }
                    ]
                },

                department_id: {
                    identifier: 'department_id',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : '{{ __("lang.pleaseSelectDepartment") }}'
                        }
                    ]
                },
                fullname_kh: {
                    identifier: 'fullname_kh',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : '{{ __("lang.pleaseEnterfullname_kh") }}'
                        }
                    ]
                },
                fullname_en: {
                    identifier: 'fullname_en',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : '{{ __("lang.pleaseEnterfullname_en") }}'
                        }
                    ]
                },
                gender: {
                    identifier: 'gender',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : '{{ __("lang.pleaseSelectgender") }}'
                        }
                    ]
                },
            }
        });


        // Add row for table
        $(document).ready(function () {

            // 1 table teacher professional
            $('#teacherProfessionalTableAddrowBtn').click(function() {
                var addRow = parseInt($('#teacherProfessionalTableAddrowValue').val());
                var rowCount = $('#teacherProfessionalTable tbody tr').length;
                // Create a new row with example data
                if (addRow >= 1) {
                    for (var i = 1; i <= addRow; i++) {
                        var threeIncrement = i + rowCount;
                        var newRow = `
                            <tr>
                                <td class="field">
                                    <input type="text" name="type_professional_${threeIncrement}" placeholder="{{ __('lang.typeProfessional') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="description_${threeIncrement}" placeholder="{{ __('lang.description') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="number_anountment_${threeIncrement}" placeholder="{{ __('lang.numberAnountment') }}">
                                </td>
                                <td class="field">
                                    <input type="text" id="professional_recieve_date_${threeIncrement}" name="professional_recieve_date_${threeIncrement}" placeholder="{{ __('lang.recieveDate') }}">
                                </td>
                            </tr>
                        `;
                        $('#teacherProfessionalTable tbody tr:last').after(newRow);
                    }
                    for (var j = rowCount + 1; j <= rowCount + addRow; j++) {
                        $("#professional_recieve_date_" + j).datepicker();
                    }
                }
                $('#teacherProfessionalTableCountTr').val(rowCount + addRow);
            });


            // 2 table teacher work history
            $('#teacherWorkHistoryTableAddrowBtn').click(function() {
                var addRow = parseInt($('#teacherWorkHistoryTableAddrowValue').val());
                var rowCount = $('#teacherWorkHistoryTable tbody tr').length;

                // Create a new row with example data
                if (addRow >= 1) {
                    for (var i = 1; i <= addRow; i++) {
                        var threeIncrement = i + rowCount;
                        var newRow = `
                            <tr>
                                <td class="field">
                                    <input type="text" name="work_continue_${threeIncrement}" placeholder="{{ __('lang.workContinue') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="current_working_${threeIncrement}" placeholder="{{ __('lang.currentWorkingUnit') }}">
                                </td>
                                <td class="field">
                                    <input type="text" id="workdate_start_${threeIncrement}" name="work_start_date_${threeIncrement}" placeholder="{{ __('lang.startDate') }}">
                                </td>
                                <td class="field">
                                    <input type="text" id="workdate_finish_${threeIncrement}" name="work_finish_date_${threeIncrement}" placeholder="{{ __('lang.finishDate') }}">
                                </td>
                            </tr>
                        `;
                        $('#teacherWorkHistoryTable tbody tr:last').after(newRow);
                    }

                    // Initialize datepicker for the new datepicker fields
                    for (var j = rowCount + 1; j <= rowCount + addRow; j++) {
                        $("#workdate_start_" + j).datepicker();
                        $("#workdate_finish_" + j).datepicker();
                    }
                }
                $('#teacherWorkHistoryTableCountTr').val(rowCount + addRow);
            });


            //3 table teacher praise and blame
            $('#teacherPraiseBlameTableAddrowBtn').click(function() {
                // alert('HI');
                var addRow = parseInt($('#teacherPraiseBlameTableAddrowValue').val());
                var rowCount = $('#teacherPraiseBlameTable tbody tr').length;

                // Create a new row with example data
                if (addRow >= 1) {
                    for (var i = 1; i <= addRow; i++) {
                        var threeIncrement = i + rowCount;
                        var newRow = `
                            <tr>
                                <td class="field">
                                    <input type="text" name="type_praiseblame_${threeIncrement}" placeholder="{{ __('lang.typePraiseBlame') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="provided_by_${threeIncrement}" placeholder="{{ __('lang.providedBy') }}">
                                </td>
                                <td class="field">
                                    <input type="text" id="PraiseBlamerecieveDate_${threeIncrement}" name="praise_blame_recieve_date_${threeIncrement}" placeholder="{{ __('lang.recieveDate') }}">
                                </td>
                            </tr>
                        `;
                        $('#teacherPraiseBlameTable tbody tr:last').after(newRow);
                    }

                    // Initialize datepicker for the new datepicker fields
                    for (var j = rowCount + 1; j <= rowCount + addRow; j++) {
                        // $("#workdate_start_" + j).datepicker();
                        $("#PraiseBlamerecieveDate_" + j).datepicker();
                    }
                }
                $('#teacherPraiseBlameTableCountTr').val(rowCount + addRow);
            });


            //4 table teacher cultural level
            $('#teacherculturalLevelTableAddrowBtn').click(function() {
                // alert('HI');
                var addRow = parseInt($('#teacherculturalLevelTableAddrowValue').val());
                var rowCount = $('#teacherculturalLevelTable tbody tr').length;

                // Create a new row with example data
                if (addRow >= 1) {
                    for (var i = 1; i <= addRow; i++) {
                        var threeIncrement = i + rowCount;
                        var newRow = `
                            <tr>
                                <td class="field">
                                    <input type="text" name="cultural_level_${threeIncrement}" placeholder="{{ __('lang.culturalLevel') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="culturalLevel_major_name_${threeIncrement}" placeholder="{{ __('lang.majorName') }}">
                                </td>
                                <td class="field">
                                    <input type="text" id="cultural_recieveDate_${threeIncrement}" name="culturalLevel_recieve_date_${threeIncrement}" placeholder="{{ __('lang.recieveDate') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="country_${threeIncrement}" placeholder="{{ __('lang.country') }}">
                                </td>
                            </tr>
                        `;
                        $('#teacherculturalLevelTable tbody tr:last').after(newRow);
                    }

                    // Initialize datepicker for the new datepicker fields
                    for (var j = rowCount + 1; j <= rowCount + addRow; j++) {
                        // $("#workdate_start_" + j).datepicker();
                        $("#cultural_recieveDate_" + j).datepicker();
                    }
                }
                $('#teacherculturalLevelTableCountTr').val(rowCount + addRow);
            });


            //5 table teacher pedagogy Course Table
            $('#teacherpedagogyCourseTableAddrowBtn').click(function() {
                // alert('HI');
                var addRow = parseInt($('#teacherpedagogyCourseTableAddrowValue').val());
                var rowCount = $('#teacherpedagogyCourseTable tbody tr').length;

                // Create a new row with example data
                if (addRow >= 1) {
                    for (var i = 1; i <= addRow; i++) {
                        var threeIncrement = i + rowCount;
                        var newRow = `
                            <tr>
                                <td class="field">
                                    <input type="text" name="professional_level_${threeIncrement}" placeholder="{{ __('lang.ProfessionalLevel') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="specialty_first_${threeIncrement}" placeholder="{{ __('lang.Specialty1') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="specialty_second_${threeIncrement}" placeholder="{{ __('lang.Specialty2') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="training_system_${threeIncrement}" placeholder="{{ __('lang.TrainingSystem') }}">
                                </td>
                                <td class="field">
                                    <input type="text" id="pedagogyCourse_${threeIncrement}" name="pedagogyCourse_recieve_date_${threeIncrement}" placeholder="{{ __('lang.recieveDate') }}">
                                </td>
                            </tr>
                        `;
                        $('#teacherpedagogyCourseTable tbody tr:last').after(newRow);
                    }

                    // Initialize datepicker for the new datepicker fields
                    for (var j = rowCount + 1; j <= rowCount + addRow; j++) {
                        // $("#workdate_start_" + j).datepicker();
                        $("#pedagogyCourse_" + j).datepicker();
                    }
                }
                $('#teacherpedagogyCourseTableCountTr').val(rowCount + addRow);
            });



            //6 table teacher short Course Table
            $('#teacherShortCourseTableAddrowBtn').click(function() {
                // alert('HI');
                var addRow = parseInt($('#teacherShortCourseTableAddrowValue').val());
                var rowCount = $('#teacherShortCourseTable tbody tr').length;

                // Create a new row with example data
                if (addRow >= 1) {
                    for (var i = 1; i <= addRow; i++) {
                        var threeIncrement = i + rowCount;
                        var newRow = `
                            <tr>
                                <td class="field">
                                    <input type="text" name="course_section_${threeIncrement}" placeholder="{{ __('lang.section') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="course_major_name_${threeIncrement}" placeholder="{{ __('lang.majorName') }}">
                                </td>
                                <td class="field">
                                    <input type="text" id="course_start_date_${threeIncrement}" name="course_start_date_${threeIncrement}" placeholder="{{ __('lang.startDate') }}">
                                </td>
                                <td class="field">
                                    <input type="text" id="course_finish_date_${threeIncrement}" name="course_finish_date_${threeIncrement}" placeholder="{{ __('lang.finishDate') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="course_duration_${threeIncrement}" placeholder="{{ __('lang.duration') }}">
                                </td>

                                <td class="field">
                                    <input type="text" name="course_prepare_by_${threeIncrement}" placeholder="{{ __('lang.prepareBy') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="course_support_by_${threeIncrement}" placeholder="{{ __('lang.supportBy') }}">
                                </td>
                            </tr>
                        `;
                        $('#teacherShortCourseTable tbody tr:last').after(newRow);
                    }

                    // Initialize datepicker for the new datepicker fields
                    for (var j = rowCount + 1; j <= rowCount + addRow; j++) {
                        // $("#workdate_start_" + j).datepicker();
                        $("#course_start_date_" + j).datepicker();
                        $("#course_finish_date_" + j).datepicker();
                    }
                }
                $('#teacherShortCourseTableCountTr').val(rowCount + addRow);
            });



            //7 table teacher Foreign language  Table
            $('#teacherForeignlanguageTableAddrowBtn').click(function() {
                // alert('HI');
                var addRow = parseInt($('#teacherForeignlanguageTableAddrowValue').val());
                var rowCount = $('#teacherForeignlanguageTable tbody tr').length;

                // Create a new row with example data
                if (addRow >= 1) {
                    for (var i = 1; i <= addRow; i++) {
                        var threeIncrement = i + rowCount;
                        var newRow = `
                            <tr>
                                <td class="field">
                                    <input type="text" name="language_${threeIncrement}" placeholder="{{ __('lang.language') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="reading_${threeIncrement}" placeholder="{{ __('lang.reading') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="writing_${threeIncrement}" placeholder="{{ __('lang.writing') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="conversation_${threeIncrement}" placeholder="{{ __('lang.conversation') }}">
                                </td>
                            </tr>
                        `;
                        $('#teacherForeignlanguageTable tbody tr:last').after(newRow);
                    }

                    // Initialize datepicker for the new datepicker fields
                    // for (var j = rowCount + 1; j <= rowCount + addRow; j++) {
                    //     // $("#workdate_start_" + j).datepicker();
                    //     $("#course_start_date_" + j).datepicker();
                    //     $("#course_finish_date_" + j).datepicker();
                    // }
                }
                $('#teacherForeignlanguageTableCountTr').val(rowCount + addRow);
            });



            //8 table teacher children  Table
            $('#teacherChildrenTableAddrowBtn').click(function() {
                // alert('HI');
                var addRow = parseInt($('#teacherChildrenTableAddrowValue').val());
                var rowCount = $('#teacherChildrenTable tbody tr').length;

                // Create a new row with example data
                if (addRow >= 1) {
                    for (var i = 1; i <= addRow; i++) {
                        var threeIncrement = i + rowCount;
                        var newRow = `
                            <tr>
                                <td class="field">
                                    <input type="text" name="child_name_${threeIncrement}" placeholder="{{ __('lang.childName') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="child_gender_${threeIncrement}" placeholder="{{ __('lang.gender') }}">
                                </td>
                                <td class="field">
                                    <input type="text" id="childBirthDate_${threeIncrement}" name="child_birth_date_${threeIncrement}" placeholder="{{ __('lang.birthDate') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="child_occupation_${threeIncrement}" placeholder="{{ __('lang.occupation') }}">
                                </td>
                            </tr>
                        `;
                        $('#teacherChildrenTable tbody tr:last').after(newRow);
                    }

                    // Initialize datepicker for the new datepicker fields
                    for (var j = rowCount + 1; j <= rowCount + addRow; j++) {
                        $("#childBirthDate_" + j).datepicker();
                    }
                    $('#teacherChildrenTableCountTr').val(rowCount + addRow);
                }
            });


            // count tr tag for each table




        });

        $(document).ready(function () {
            var rowCount1 = $('#teacherProfessionalTable tbody tr').length;
            var rowCount2 = $('#teacherWorkHistoryTable tbody tr').length;
            var rowCount3 = $('#teacherPraiseBlameTable tbody tr').length;
            var rowCount4 = $('#teacherculturalLevelTable tbody tr').length;
            var rowCount5 = $('#teacherpedagogyCourseTable tbody tr').length;
            var rowCount6 = $('#teacherShortCourseTable tbody tr').length;
            var rowCount7 = $('#teacherForeignlanguageTable tbody tr').length;
            var rowCount8 = $('#teacherChildrenTable tbody tr').length;

            $('#teacherProfessionalTableCountTr').val(rowCount1);
            $('#teacherWorkHistoryTableCountTr').val(rowCount2);
            $('#teacherPraiseBlameTableCountTr').val(rowCount3);

            $('#teacherculturalLevelTableCountTr').val(rowCount4);
            $('#teacherpedagogyCourseTableCountTr').val(rowCount5);
            $('#teacherShortCourseTableCountTr').val(rowCount6);

            $('#teacherForeignlanguageTableCountTr').val(rowCount7);
            $('#teacherChildrenTableCountTr').val(rowCount8);
        });


    </script>
@endsection
