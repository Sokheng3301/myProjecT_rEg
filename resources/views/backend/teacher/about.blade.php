@extends('backend.layout.master')
@section('title')
    {{__('lang.aboutTeacher')}}
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
        {{__('lang.aboutTeacher')}}
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
                        <form class="ui form" method="POST" action="
                                @if ($update)
                                    {{ route('teacher.update', $teacher->id) }}
                                @else
                                    {{ route('teacher.store') }}
                                @endif" enctype="multipart/form-data"  autocomplete="off">
                            @csrf
                            @method($update ? 'PUT' : 'POST')

                            <div class="card-header">
                                <h3 class="card-title">{{__('lang.teacherProfile')}} </h3>
                            </div>
                            <div class="card-body">
                                <!-- Conversations are loaded here -->
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="row">
                                            <div class="col-md-6 mx-auto">
                                                {{-- <label for="teacher_profile" class="file-upload"> --}}
                                                    <img class="ui small image mx-auto bordered" @if ($teacher->profile)
                                                        src="{{ asset($teacher->profile) }}"
                                                        @else
                                                        src="{{ asset('dist/assets/img/white-image.png') }}"
                                                        @endif alt="" id="dep_logo_img">
                                                    <p class="text-center mt-2">{{__("lang.teacherPhoto")}}</p>
                                                    <div class="col-md-10 mx-auto">
                                                        {{-- <div class="header">{{__("lang.remark")}}</div> --}}
                                                        @if($block_info->block_status == 0 || $teacher->leave_status == 0)
                                                            <div class="ui red message">
                                                                @if($block_info->block_status == 0)
                                                                    <p class="fw-bold">{{__("lang.teacherHasBlocked")}}</p>
                                                                    <p class="ps-3"> <i class="bi bi-calendar"></i> {{ \Carbon\Carbon::parse($block_info->blocked_date)->format('d-m-Y') }}</p>
                                                                    <p class="ps-3"> <i class="bi bi-person"></i> {{ $block_info->blocked_by }}</p>
                                                                @endif
                                                                @if($teacher->leave_status == 0)
                                                                    <p class="fw-bold">{{__("lang.teacherHasLeaved")}}</p>
                                                                    <p class="ps-3"> <i class="bi bi-calendar"></i> {{ \Carbon\Carbon::parse($teacher->leave_date)->format('d-m-Y') }}</p>
                                                                    <p class="ps-3"> <i class="bi bi-chat-right-dots"></i> {{ $teacher->leave_description }}</p>
                                                                @endif
                                                            </div>
                                                        @endif


                                                    </div>


                                                {{-- </label> --}}
                                                {{-- <input type="file" name="profile" class="d-none" id="teacher_profile"accept="image/*" onchange="document.getElementById('dep_logo_img').src = window.URL.createObjectURL(this.files[0])"> --}}
                                            </div>
                                        </div>
                                    </div>


                                {{-- section 1 --}}
                                    <div class="col-md-12 my-3">
                                        <h3 class="pb-2 ui red header border-bottom">1. {{__("lang.profileInfomation")}}</h3>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-5 fw-bold">{{ __('lang.idCard') }}</div>
                                                    <p class="col-7">{{ $teacher->id_card ?: __('lang.null') }}</p>
                                                    <div class="col-5 fw-bold">{{ __('lang.fullnameKh') }}</div>
                                                    <p class="col-7">{{ $teacher->fullname_kh }}</p>
                                                    <div class="col-5 fw-bold">{{ __('lang.fullnameEn') }}</div>
                                                    <p class="col-7 text-uppercase">{{ $teacher->fullname_en }}</p>
                                                    <div class="col-5 fw-bold">{{ __('lang.gender') }}</div>
                                                    <p class="col-7">{{ $teacher->gender == 'm' ? __('lang.male') : __('lang.female') }}</p>
                                                    <div class="col-5 fw-bold">{{ __('lang.birthDate') }}</div>
                                                    <p class="col-7">{{ $teacher->birth_date ? \Illuminate\Support\Carbon::parse($teacher->birth_date)->format('d-m-Y') : __("lang.null") }}</p>
                                                    <div class="col-5 fw-bold">{{ __('lang.department') }}</div>
                                                    <p class="col-7">
                                                        @if (session()->has('localization') && session('localization') == 'en')
                                                            {{ $teacher->department->dep_name_en }}
                                                        @else
                                                            {{ $teacher->department->dep_name_kh }}
                                                        @endif
                                                    </p>
                                                    <div class="col-5 fw-bold">{{ __('lang.phone_number') }}</div>
                                                    <p class="col-7">{{ $teacher->phone_number ?: __("lang.null")}}</p>
                                                    <div class="col-5 fw-bold">{{ __('lang.email_add') }}</div>
                                                    <p class="col-7">{{ $teacher->email_add ?: __("lang.null")}}</p>
                                                </div>


                                            </div>

                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-5 fw-bold">{{ __('lang.nationality') }}</div>
                                                    <p class="col-7">{{ $teacher->nationality ?: __('lang.null') }}</p>
                                                    <div class="col-5 fw-bold">{{ __('lang.disability') }}</div>
                                                    <p class="col-7">{{ $teacher->disability ?: __("lang.null") }}</p>
                                                    <div class="col-5 fw-bold">{{ __('lang.idNumber') }}</div>
                                                    <p class="col-7">{{ $teacher->id_number ?: __("lang.null") }}</p>
                                                    <div class="col-5 fw-bold">{{ __('lang.position') }}</div>
                                                    <p class="col-7">{{ $teacher->position ?: __("lang.null") }}</p>
                                                    <div class="col-5 fw-bold">{{ __('lang.office') }}</div>
                                                    <p class="col-7">{{ $teacher->office  ?: __("lang.null") }}</p>
                                                    <div class="col-5 fw-bold">{{ __('lang.placeBirth') }}</div>
                                                    <p class="col-7"> {{ $teacher->place_of_birth ?: __('lang.null')}}</p>
                                                    <div class="col-5 fw-bold">{{ __('lang.current_add') }}</div>
                                                    <p class="col-7"> {{ $teacher->current_add ?: __('lang.null')}}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-6 fw-bold">{{ __('lang.payrollAcc') }}</div>
                                                    <p class="col-6">{{ $teacher->payroll_acc ?: __('lang.null') }}</p>
                                                    <div class="col-6 fw-bold">{{ __('lang.memberBcc') }}</div>
                                                    <p class="col-6">{{ $teacher->memeber_bcc ?: __("lang.null") }}</p>
                                                    <div class="col-6 fw-bold">{{ __('lang.employment_date') }}</div>
                                                    <p class="col-6">{{ $teacher->employment_date ? \Illuminate\Support\Carbon::parse($teacher->employment_date)->format('d-m-Y') : __("lang.null") }}</p>
                                                    <div class="col-6 fw-bold">{{ __('lang.soup_date') }}</div>
                                                    <p class="col-6">{{ $teacher->soup_date ? \Illuminate\Support\Carbon::parse($teacher->soup_date)->format('d-m-Y') : __("lang.null") }}</p>
                                                    <div class="col-6 fw-bold">{{ __('lang.anountment') }}</div>
                                                    <p class="col-6">{{ $teacher->anountment  ?: __("lang.null") }}</p>
                                                    <div class="col-6 fw-bold">{{ __('lang.working_unit') }}</div>
                                                    <p class="col-6"> {{ $teacher->working_unit ?: __('lang.null')}}</p>
                                                    <div class="col-6 fw-bold">{{ __('lang.working_unit_add') }}</div>
                                                    <p class="col-6"> {{ $teacher->working_unit_add ?: __('lang.null')}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-12 my-3">
                                        <div class="ui error message"></div>
                                    </div> --}}






                                {{-- section 2 --}}
                                    <div class="col-md-12 my-3 mt-4">
                                        <h3 class="pb-2 ui red header border-bottom">2. {{__("lang.teacherProfessional")}} </h3>
                                    </div>

                                    <div class="col-md-12 table-responsive">
                                        <table class="table table-sm" id="teacherProfessionalTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col"> {{ __("lang.typeProfessional") }} </th>
                                                    <th scope="col"> {{ __("lang.description") }} </th>
                                                    <th scope="col"> {{ __("lang.numberAnountment") }} </th>
                                                    <th scope="col"> {{ __("lang.recieveDate") }}  </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($teacher_professionals as $tprofess)
                                                    <tr>
                                                        <td class="field"> {{ $tprofess->type_professional ?: __('lang.null') }} </td>
                                                        <td class="field">{{ $tprofess->description ?: __('lang.null') }}</td>
                                                        <td class="field">{{ $tprofess->number_anountment ?: __('lang.null') }}</td>
                                                        <td class="field">{{ $tprofess->recieve_date ? \Illuminate\Support\Carbon::parse($tprofess->recieve_date)->format('d-m-Y') : __('lang.null') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-5 fw-bold">{{ __('lang.rankAndClass') }}</div>
                                            <p class="col-7">{{ $teacher->rank ?: __('lang.null') }}</p>
                                            <div class="col-5 fw-bold">{{ __('lang.refer') }}</div>
                                            <p class="col-7">{{ $teacher->refer ?: __("lang.null") }}</p>
                                            <div class="col-5 fw-bold">{{ __('lang.numbering') }}</div>
                                            <p class="col-7">{{ $teacher->numbering ?: __("lang.null") }}</p>

                                            {{-- <p class="col-7">{{ \Illuminate\Support\Carbon::parse($teacher->employment_date)->format('d-m-Y') ?: __("lang.null") }}</p> --}}
                                            <div class="col-5 fw-bold">{{ __('lang.dateLastIncreSalary') }}</div>
                                            <p class="col-7">{{ $teacher->last_interest_date ? \Illuminate\Support\Carbon::parse($teacher->last_interest_date)->format('d-m-Y') : __("lang.null") }}</p>
                                            <div class="col-5 fw-bold">{{ __('lang.dated') }}</div>
                                            <p class="col-7">{{ $teacher->dated ? \Illuminate\Support\Carbon::parse($teacher->dated)->format('d-m-Y') : __("lang.null") }}</p>
                                            <div class="col-5 fw-bold">{{ __('lang.teachInYear') }}</div>
                                            <p class="col-7"> {{ $teacher->teach_in_year ?: __('lang.null')}}</p>
                                            <div class="col-5 fw-bold">{{ __('lang.englishTeach') }}</div>
                                            <p class="col-7"> {{ $teacher->english_teach ?: __('lang.null')}}</p>
                                            <div class="col-5 fw-bold">{{ __('lang.threeCombine') }}</div>
                                            <p class="col-7">{{ $teacher->three_level_combine ?: __('lang.null') }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">

                                            <div class="col-5 fw-bold">{{ __('lang.technicTeamLeader') }}</div>
                                            <p class="col-7">{{ $teacher->technic_team_leader ?: __("lang.null") }}</p>
                                            <div class="col-5 fw-bold">{{ __('lang.help_teach') }}</div>
                                            <p class="col-7">{{ $teacher->help_teach ?: __("lang.null") }}</p>

                                            {{-- <p class="col-7">{{ \Illuminate\Support\Carbon::parse($teacher->employment_date)->format('d-m-Y') ?: __("lang.null") }}</p> --}}
                                            <div class="col-5 fw-bold">{{ __('lang.two_class') }}</div>
                                            <p class="col-7">{{ $teacher->two_class ?: __("lang.null") }}</p>
                                            <div class="col-5 fw-bold">{{ __('lang.class_charge') }}</div>
                                            <p class="col-7">{{ $teacher->class_charge ?: __("lang.null") }}</p>

                                            {{-- <p class="col-7">{{ \Illuminate\Support\Carbon::parse($teacher->last_interest_date)->format('d-m-Y') ?: __("lang.null") }}</p> --}}
                                            <div class="col-5 fw-bold">{{ __('lang.cross_school') }}</div>
                                            <p class="col-7">{{ $teacher->cross_school ?: __("lang.null") }}</p>

                                            <div class="col-5 fw-bold">{{ __('lang.overtime') }}</div>
                                            <p class="col-7"> {{ $teacher->overtime ?: __('lang.null')}}</p>

                                            <div class="col-5 fw-bold">{{ __('lang.coupling_class') }}</div>
                                            <p class="col-7"> {{ $teacher->coupling_class ?: __('lang.null')}}</p>

                                             <div class="col-5 fw-bold">{{ __('lang.two_lang') }}</div>
                                            <p class="col-7"> {{ $teacher->two_lang ?: __('lang.null')}}</p>
                                        </div>
                                    </div>




                                {{-- section 3 --}}
                                    <div class="col-md-12 my-3 mt-4">
                                        <h3 class="pb-2 ui red header border-bottom">3. {{__("lang.workHistory")}}</h3>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-5 fw-bold">{{ __('lang.work_status') }}</div>
                                            <p class="col-7">{{ $teacher->work_status ?: __('lang.null') }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3 table-responsive">
                                        <table class="table table-sm" id="teacherWorkHistoryTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col"> {{ __("lang.workContinue") }} </th>
                                                    <th scope="col"> {{ __("lang.currentWorkingUnit") }} </th>
                                                    <th scope="col"> {{ __("lang.startDate") }} </th>
                                                    <th scope="col"> {{ __("lang.finishDate") }}  </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($teacher_workhistories as $tworkhistory)
                                                    <tr>
                                                        <td class="field">{{$tworkhistory->work_continue ?: __('lang.null')}}</td>
                                                        <td class="field">{{$tworkhistory->current_working ?: __('lang.null')}}</td>
                                                        <td class="field">{{$tworkhistory->start_date ? \Illuminate\Support\Carbon::parse($tworkhistory->start_date)->format('d-m-Y') : __('lang.null')}}</td>
                                                        <td class="field">{{$tworkhistory->finish_date ? \Illuminate\Support\Carbon::parse($tworkhistory->finish_date)->format('d-m-Y') : __('lang.null')}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>





                                {{-- section 4 --}}
                                    <div class="col-md-12 my-3">
                                        <h3 class="pb-2 ui red header border-bottom">4. {{__("lang.praiseBlame")}}</h3>
                                    </div>

                                    <div class="col-md-12  table-responsive">
                                        <table class="table table-sm" id="teacherPraiseBlameTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col"> {{ __("lang.typePraiseBlame") }} </th>
                                                    <th scope="col"> {{ __("lang.providedBy") }} </th>
                                                    <th scope="col"> {{ __("lang.recieveDate") }} </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($teacher_praiseblames as $tpraiseblame)
                                                    <tr>
                                                        <td class="field"> {{ $tpraiseblame->type_praiseblame ?: __('lang.null') }} </td>
                                                        <td class="field"> {{ $tpraiseblame->provided_by ?: __('lang.null') }} </td>
                                                        <td class="field"> {{ $tpraiseblame->recieve_date ? \Illuminate\Support\Carbon::parse($tpraiseblame->recieve_date)->format('d-m-Y') : __('lang.null') }} </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>



                                {{-- section 5 --}}
                                    <div class="col-md-12 my-3">
                                        <h3 class="pb-2 ui red header border-bottom">5. {{__("lang.culturalLevel")}}</h3>
                                    </div>

                                    <div class="col-md-12  table-responsive">
                                        <table class="table table-sm" id="teacherculturalLevelTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col"> {{ __("lang.culturalLevel") }} </th>
                                                    <th scope="col"> {{ __("lang.majorName") }} </th>
                                                    <th scope="col"> {{ __("lang.recieveDate") }} </th>
                                                    <th scope="col"> {{ __("lang.country") }} </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($teacher_culturallevels as $tcultural)
                                                    <tr>
                                                        <td class="field"> {{ $tcultural->cultural_level ?: __('lang.null') }} </td>
                                                        <td class="field"> {{ $tcultural->major_name ?: __('lang.null') }} </td>
                                                        <td class="field"> {{ $tcultural->recieve_date ? \Illuminate\Support\Carbon::parse($tcultural->recieve_date)->format('d-m-Y') : __('lang.null') }} </td>
                                                        <td class="field"> {{ $tcultural->country ?: __('lang.null') }} </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>



                                {{-- section 6 --}}
                                    <div class="col-md-12 my-3">
                                        <h3 class="pb-2 ui red header border-bottom">6. {{__("lang.pedagogyCourse")}}</h3>
                                    </div>

                                    <div class="col-md-12  table-responsive">
                                        <table class="table table-sm" id="teacherpedagogyCourseTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col"> {{ __("lang.ProfessionalLevel") }} </th>
                                                    <th scope="col"> {{ __("lang.Specialty1") }} </th>
                                                    <th scope="col"> {{ __("lang.Specialty2") }} </th>
                                                    <th scope="col"> {{ __("lang.TrainingSystem") }} </th>
                                                    <th scope="col"> {{ __("lang.recieveDate") }} </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               @foreach ($teacher_pedagogyCourses as $tpedagogycourse)
                                                    <tr>
                                                        <td class="field"> {{ $tpedagogycourse->professional_level ?: __('lang.null') }} </td>
                                                        <td class="field"> {{ $tpedagogycourse->specialty_first ?: __('lang.null') }} </td>
                                                        <td class="field"> {{ $tpedagogycourse->specialty_second ?: __('lang.null') }} </td>
                                                        <td class="field"> {{ $tpedagogycourse->training_system ?: __('lang.null') }} </td>
                                                        <td class="field"> {{ $tpedagogycourse->recieve_date ? \Illuminate\Support\Carbon::parse($tpedagogycourse->recieve_date)->format('d-m-Y') : __('lang.null') }} </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>



                                {{-- section 7 --}}
                                    <div class="col-md-12 my-3">
                                        <h3 class="pb-2 ui red header border-bottom">7. {{__("lang.shortCourse")}}</h3>
                                    </div>

                                    <div class="col-md-12  table-responsive">
                                        <table class="table table-sm" id="teacherShortCourseTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col"> {{ __("lang.section") }} </th>
                                                    <th scope="col"> {{ __("lang.majorName") }} </th>
                                                    <th scope="col"> {{ __("lang.startDate") }} </th>
                                                    <th scope="col"> {{ __("lang.finishDate") }} </th>
                                                    <th scope="col"> {{ __("lang.duration") }} </th>
                                                    <th scope="col"> {{ __("lang.prepareBy") }} </th>
                                                    <th scope="col"> {{ __("lang.supportBy") }} </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($teacher_shortcourses as $tshortcourse)
                                                    <tr>
                                                        <td class="field"> {{ $tshortcourse->section ?: __('lang.null') }} </td>
                                                        <td class="field"> {{ $tshortcourse->major_name ?: __('lang.null') }} </td>
                                                        <td class="field"> {{ $tshortcourse->start_date ? \Illuminate\Support\Carbon::parse($tshortcourse->start_date)->format('d-m-Y')  : __('lang.null') }} </td>
                                                        <td class="field"> {{ $tshortcourse->finish_date ? \Illuminate\Support\Carbon::parse($tshortcourse->finish_date)->format('d-m-Y')  : __('lang.null') }} </td>

                                                        <td class="field"> {{ $tshortcourse->duration ?: __('lang.null') }} </td>
                                                        <td class="field"> {{ $tshortcourse->prepare_by ?: __('lang.null') }} </td>
                                                        <td class="field"> {{ $tshortcourse->support_by ?: __('lang.null') }} </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>



                                {{-- section 8 --}}
                                    <div class="col-md-12 my-3">
                                        <h3 class="pb-2 ui red header border-bottom">8. {{__("lang.Foreignlanguage")}}</h3>
                                    </div>

                                    <div class="col-md-12  table-responsive">
                                        <table class="table table-sm" id="teacherForeignlanguageTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col"> {{ __("lang.language") }} </th>
                                                    <th scope="col"> {{ __("lang.reading") }} </th>
                                                    <th scope="col"> {{ __("lang.writing") }} </th>
                                                    <th scope="col"> {{ __("lang.conversation") }} </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($teacher_foriegnlangs as $tforiegnlang)
                                                    <tr>
                                                        <td class="field"> {{ $tforiegnlang->language ?: __('lang.null') }} </td>
                                                        <td class="field"> {{ $tforiegnlang->reading ?: __('lang.null') }} </td>

                                                        <td class="field"> {{ $tforiegnlang->writing ?: __('lang.null') }} </td>
                                                        <td class="field"> {{ $tforiegnlang->conversation ?: __('lang.null') }} </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>



                                 {{-- section 9 --}}
                                    <div class="col-md-12 my-3">
                                        <h3 class="pb-2 ui red header border-bottom">9. {{__("lang.familyStatus")}}</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-5 fw-bold">{{ __('lang.familyStatus') }}</div>
                                                <p class="col-7">{{ $teacher->family_status ?: __('lang.null') }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.mustBe') }}</div>
                                                <p class="col-7">{{ $teacher->must_be ?: __('lang.null') }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.occupation') }}</div>
                                                <p class="col-7">{{ $teacher->must_be ?: __('lang.occupation') }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.name_confederate') }}</div>
                                                <p class="col-7">{{ $teacher->name_confederate ?: __('lang.null') }}</p>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row">

                                                <div class="col-5 fw-bold">{{ __('lang.confederation') }}</div>
                                                <p class="col-7">{{ $teacher->confederation ?: __('lang.null') }}</p>

                                                <div class="col-5 fw-bold">{{ __('lang.birth_date_spouse') }}</div>
                                                <p class="col-7">{{ $teacher->birth_date_spouse  ? \Illuminate\Support\Carbon::parse($teacher->birth_date_spouse)->format('d-m-Y') : __('lang.null') }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.wife_salary') }}</div>
                                                <p class="col-7">{{ $teacher->wife_salary ?: __('lang.null') }}</p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12 mt-4 table-responsive">
                                        <table class="table table-sm" id="teacherChildrenTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col"> {{ __("lang.childName") }} </th>
                                                    <th scope="col"> {{ __("lang.gender") }} </th>
                                                    <th scope="col"> {{ __("lang.birthDate") }} </th>
                                                    <th scope="col"> {{ __("lang.occupation") }} </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($teacher_childrens as $tchild)
                                                    <tr>
                                                        <td class="field"> {{ $tchild->child_name ?: __('lang.null') }} </td>
                                                        <td class="field"> {{ $tchild->gender ?: __('lang.null') }} </td>

                                                        <td class="field"> {{ $tchild->birth_date ? \Illuminate\Support\Carbon::parse($tchild->birth_date)->format('d-m-Y') : __('lang.null') }} </td>
                                                        <td class="field"> {{ $tchild->occupation ?: __('lang.null') }} </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>


                                    {{-- <div class="col-md-12 d-none">
                                        <div class="two fields">
                                            <div class="field"><input type="hidden" class="d-none" name="trTableProfessional" id="teacherProfessionalTableCountTr" value=""></div>
                                            <div class="field"><input type="hidden" class="d-none" name="trTableWorkHistory" id="teacherWorkHistoryTableCountTr" value=""></div>
                                            <div class="field"><input type="hidden" class="d-none" name="trTablePraiseBlame" id="teacherPraiseBlameTableCountTr" value=""></div>
                                            <div class="field"><input type="hidden" class="d-none" name="trTableCulturalLevel" id="teacherculturalLevelTableCountTr" value=""></div>
                                            <div class="field"><input type="hidden" class="d-none" name="trTablePedagogyCourse" id="teacherpedagogyCourseTableCountTr" value=""></div>
                                            <div class="field"><input type="hidden" class="d-none" name="trTableShortCourse" id="teacherShortCourseTableCountTr" value=""></div>
                                            <div class="field"><input type="hidden" class="d-none" name="trTableForeignlanguage" id="teacherForeignlanguageTableCountTr" value=""></div>
                                            <div class="field"><input type="hidden" class="d-none" name="trTableChildren" id="teacherChildrenTableCountTr" value=""></div>
                                        </div>
                                    </div> --}}

                                </div>
                            </div>
                        </form>
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
