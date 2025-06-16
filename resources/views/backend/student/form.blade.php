@extends('backend.layout.master')
@section('title')
    {{ __('lang.Student') }}
@endsection
@section('content')

    @section('pageTitle')
        @if ($update)
            {{ __('lang.updateStudent') }}
        @else
            {{ __('lang.addStudent') }}
        @endif
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
                    <form class="ui form" method="POST"
                        action="
                                @if ($update) {{ route('student.update', $student->id) }}
                                @else
                                    {{ route('student.store') }} @endif"
                        enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method($update ? 'PUT' : 'POST')

                        <div class="card-header">
                            <h3 class="card-title">
                                @if ($update)
                                    {{ __('lang.updateStudent') }}
                                @else
                                    {{ __('lang.addStudent') }}
                                @endif
                            </h3>
                            <div class="card-tools">
                                {{-- <span title="3 New Messages" class="badge text-bg-primary"> 3 </span> --}}
                                <a href="@if($student && $student->dropout_status == 0)
                                    {{ route('student.dropoutList') }}
                                @else
                                    {{ route('student.index') }}
                                @endif" class="ui button small">
                                    {{ __('lang.studentList') }}
                                </a>
                                <button type="submit"
                                    class="ui button small @if ($update) {{-- {{ $student->dep_code }} --}}
                                            green
                                        @else
                                            primary @endif"
                                    title="Save">
                                    {{-- <i class="bi bi-plus-circle-fill"></i> --}}
                                    @if ($update)
                                        {{ __('lang.update') }}
                                    @else
                                        {{ __('lang.save') }}
                                    @endif
                                </button>
                                {{-- <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                    <i class="bi bi-x-lg"></i>
                                    </button> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Conversations are loaded here -->
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="row">
                                        <div class="col-md-6 mx-auto">
                                            <label for="teacher_profile" class="file-upload">
                                                <img class="ui small image"
                                                    @if ($update && $student->profile) src="{{ asset($student->profile) }}"
                                                        @else
                                                        src="{{ asset('dist/assets/img/white-image.png') }}" @endif
                                                    alt="" id="dep_logo_img">
                                                <p class="text-center mt-3">{{ __('lang.choseProfileToUpload') }}</p>
                                            </label>
                                            <input type="file" name="profile" class="d-none"
                                                id="teacher_profile"accept="image/*"
                                                onchange="document.getElementById('dep_logo_img').src = window.URL.createObjectURL(this.files[0])">
                                        </div>
                                    </div>
                                </div>



                                {{-- section 1 --}}
                                <div class="col-md-12 my-3">
                                    <h3 class="pb-2 ui red header border-bottom">1. {{ __('lang.requiredInfomation') }}
                                        <small class="text-dark">( * )</small>
                                    </h3>
                                </div>

                                <div class="col-md-12">
                                    <div class="row bg-light py-3 ">
                                        {{-- add here  --}}
                                        <div class="col-md-6">

                                            <div class="field">
                                                <label>{{ __('lang.academyYear') }} <span
                                                        class="text-danger">*</span></label>
                                                <select class="ui search dropdown" @if ($update)
                                                    disabled
                                                @endif name="academy_year" id="academy_year" >
                                                    <option value="">{{ __('lang.academyYear') }}
                                                    </option>
                                                    @foreach ($years as $y)
                                                        <option value="{{ $y->year }}"
                                                            @if ($update && $student->class->academy_year == $y->year) selected @endif
                                                            @if (old('academy_year') == $y->year) selected @endif>
                                                            {{ $y->year }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="field">
                                                <label>{{ __('lang.selectclass') }} <span
                                                        class="text-danger">*</span></label>
                                                <select class="ui search dropdown1" name="class_id" id="class" @if ($update)  disabled  @endif>
                                                    <option value="">{{ __('lang.selectclass') }}
                                                    </option>
                                                    @foreach ($classes as $cl)
                                                        <option value="{{ $cl->id }}"
                                                            @if ($update && $student->class_id == $cl->id) selected @endif
                                                            @if (old('class_id') == $cl->id) selected @endif>
                                                            {{ $cl->class_code }} -
                                                            @if (session()->has('localization') && session('localization') == 'en')
                                                                {{ $cl->majors->major_name_en }}
                                                            @else
                                                                {{ $cl->majors->major_name_kh }}
                                                            @endif
                                                            -
                                                            @foreach (\App\Http\Helpers\AppHelper::getStudyLevel() as $key => $item)
                                                                @if ($key == $cl->level_study)
                                                                    {{ $item }}
                                                                @endif
                                                            @endforeach
                                                            -
                                                            @foreach (\App\Http\Helpers\AppHelper::getYearLevel() as $key => $item)
                                                                @if ($key == $cl->year_level)
                                                                    {{ $item }}
                                                                @endif
                                                            @endforeach
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class=" @if(!$update) two @endif  fields">
                                                <div class="field @if($update) w-100 @endif">
                                                    <label>{{ __('lang.username') }} <span class="text-danger">*</span>
                                                        @if ($errors->has('username'))
                                                            <small
                                                                class="fw-normal text-danger">{{ $errors->first('username') }}</small>
                                                        @endif
                                                    </label>
                                                    <input type="text" @if ($update) disabled @endif readonly
                                                        name="username" id="username" class="text-danger"
                                                        placeholder="{{ __('lang.username') }}"
                                                        value="@if($update){{ $authInfo->username }}@else{{ old('username') }}@endif">
                                                </div>


                                                <div class="field @if($update)d-none @endif">
                                                    <label>{{ __('lang.password') }} <span
                                                            class="text-danger">*</span></label>
                                                    {{-- <div class="ui  input">
                                                         <input type="password" name="password"
                                                        placeholder="{{ __('lang.password') }}"
                                                        value="{{ old('password') }}">
                                                        <button class="ui button">Search</button>
                                                    </div> --}}
                                                    <div class="ui right action input w-100">
                                                        {{-- <label for="amount" class="ui label">$</label> --}}
                                                        <input type="password" name="password" id="password"
                                                            placeholder="{{ __('lang.password') }}"
                                                            value="@if($update) 3301 @endif">
                                                        <button type="button" id="random_password" title="{{ __("lang.random") }}" class="ui green mini button"><i class="bi bi-shuffle fw-bold"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="field">
                                                <label>{{ __('lang.confirmPassword') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="password" name="confirm_password"
                                                    placeholder="{{ __('lang.confirmPassword') }}"
                                                    value="">
                                            </div> --}}
                                        </div>

                                        <div class="col-md-6 ">
                                            <div class="row">
                                                <div class="field">
                                                    <label>{{ __('lang.fullnameKh') }} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="fullname_kh"
                                                        placeholder="{{ __('lang.fullnameKh') }}"
                                                        value="@if($update){{ $student->fullname_kh }}@else{{ old('fullname_kh') }}@endif">
                                                </div>
                                                <div class="field">
                                                    <label>{{ __('lang.fullnameEn') }} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="fullname_en"
                                                        placeholder="{{ __('lang.fullnameEn') }}"
                                                        value="@if($update){{ $student->fullname_en }}@else{{ old('fullname_en') }}@endif">
                                                </div>
                                                <div class="field">
                                                    <label>{{ __('lang.gender') }} <span
                                                            class="text-danger">*</span></label>
                                                    <select class="ui search dropdown2" name="gender">
                                                        <option value="">{{ __('lang.selectGender') }}</option>
                                                        <option value="f" @if($update && $student->gender == 'f') selected @endif  @if (old('gender') == 'f') selected @endif>{{ __('lang.female') }}</option>
                                                        <option value="m" @if($update && $student->gender == 'm') selected @endif  @if (old('gender') == 'm') selected @endif>{{ __('lang.male') }}</option>
                                                    </select>
                                                </div>

                                                {{-- <div class="field">
                                                    <label>{{ __('lang.department') }} <span
                                                            class="text-danger">*</span></label>
                                                    <select class="ui search dropdown" name="department_id">
                                                        <option value="">{{ __('lang.selectDepartment') }}
                                                        </option>
                                                        @foreach ($departments as $d)
                                                            <option value="{{ $d->id }}"
                                                                @if (old('department_id') == $d->id) selected @endif>
                                                                {{ $d->dep_code }} -
                                                                @if (session()->has('localization') && session('localization') == 'en')
                                                                    {{ $d->dep_name_en }}
                                                                @else
                                                                    {{ $d->dep_name_kh }}
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div> --}}
                                            </div>
                                        </div>

                                        <div id="class_detail" class="d-none mt-3">
                                            <div class="row ui info message">
                                                <div class="header mb-2">{{__('lang.aboutClass')}}</div>
                                                <div class="col-4 col-sm-4 col-md-3 pb-2">{{__('lang.classCode')}}</div> <div class="col-1">:</div> <div class="col-7 col-sm-7 col-md-8" id="classCodeValue">  </div>
                                                <div class="col-4 col-sm-4 col-md-3 pb-2">{{__('lang.department')}}</div> <div class="col-1">:</div> <div class="col-7 col-sm-7 col-md-8" id="departmentValue">  </div>
                                                <div class="col-4 col-sm-4 col-md-3 pb-2">{{__('lang.major')}}</div> <div class="col-1">:</div> <div class="col-7 col-sm-7 col-md-8" id="majorValue">  </div>
                                                <div class="col-4 col-sm-4 col-md-3 pb-2">{{__('lang.studyLevel')}}</div> <div class="col-1">:</div> <div class="col-7 col-sm-7 col-md-8" id="studyLevelValue">  </div>
                                                <div class="col-4 col-sm-4 col-md-3 pb-2">{{__('lang.yearLevel')}}</div> <div class="col-1">:</div> <div class="col-7 col-sm-7 col-md-8" id="yearLevelValue">  </div>
                                                <div class="col-4 col-sm-4 col-md-3 pb-2">{{__('lang.academicYear')}}</div> <div class="col-1">:</div> <div class="col-7 col-sm-7 col-md-8" id="academyYearValue">  </div>
                                            </div>
                                        </div>


                                        {{-- message here  --}}
                                        <div class="col-md-12">
                                            <div class="ui error message mt-3"></div>
                                        </div>

                                        @if ($errors->any())
                                            <div class="col-md-12 mt-3">
                                                <div class="ui negative message">
                                                    <div class="header">
                                                        {{ __('lang.messageFromAddTeacher') }}
                                                    </div>
                                                    <ul class="list">
                                                        <li> {{ __('lang.checkIDcard') }} </li>
                                                        <li> {{ __('lang.checkUsername') }} </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif


                                    </div>
                                </div>

                                {{-- section 2/ --}}
                                <div class="col-md-12 my-3">
                                    <h3 class="pb-2 ui red header border-bottom">2. {{ __('lang.studentInfo') }}
                                        <small class="text-dark">( {{ __("lang.optional") }} )</small>
                                    </h3>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="field">
                                                <label for="">{{__('lang.birthDate')}}</label>
                                                <input type="text" name="birth_date"
                                                    id="datepicker"
                                                    value="@if($update){{ $student->birth_date ? \Carbon\Carbon::parse($student->birth_date)->format('m/d/Y') : '' }}@else{{ old('birth_date') ? \Carbon\Carbon::pase(old('birth_date'))->formath('m/d/Y') : '' }}@endif"
                                                    placeholder="{{ __('lang.birthDate') }}">
                                                </div>

                                            <div class="two fields">
                                                <div class="field">
                                                    <label for="">{{__('lang.national')}}</label>
                                                    <input type="text" name="national"
                                                    placeholder="{{ __('lang.national') }}"
                                                    value="@if($update){{ $student->national }}@else{{ old('national') }}@endif">
                                                </div>
                                                <div class="field">
                                                    <label for="">{{__('lang.nationality')}}</label>
                                                    <input type="text" name="nationality"
                                                    placeholder="{{ __('lang.nationality') }}"
                                                    value="@if($update){{ $student->nationality }}@else{{ old('nationality')}}@endif">
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label for="">{{__('lang.placeBirth')}}</label>
                                                <textarea name="place_of_birth" id="" cols="30" rows="5"
                                                placeholder="{{__('lang.placeBirth')}}">@if($update){{$student->place_of_birth}}@else{{old('place_of_birth')}}@endif</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="field">
                                                <label for="">{{__('lang.phone_number')}}</label>
                                                <input type="text" name="phone" placeholder="{{ __('lang.phone_number') }}"
                                                value="@if($update){{ $student->phone }}@else{{ old('phone') }}@endif">
                                            </div>

                                            <div class="field">
                                                <label for="">{{__('lang.email_add')}}</label>
                                                <input type="email" name="email" placeholder="{{ __('lang.email_add') }}"
                                                value="@if($update){{ $student->email }}@else{{ old('email') }}@endif">
                                            </div>


                                            <div class="field">
                                                <label for="">{{__('lang.current_add')}}</label>
                                                <textarea name="current_add" id="" cols="30" rows="5"
                                                placeholder="{{__('lang.current_add')}}">@if($update){{$student->current_add}}@else{{old('current_add')}}@endif</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- section 3/ --}}
                                <div class="col-md-12 my-3">
                                    <h3 class="pb-2 ui red header border-bottom">3. {{ __('lang.studyHistory ') }}
                                        <small class="text-dark">( {{ __("lang.optional") }} )</small>
                                    </h3>
                                </div>

                                {{-- study history  --}}
                                <div class="col-md-12 table-responsive">
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
                                            @if ($update && $student_study_history->count() > 0)
                                                {{-- if update and have study history --}}
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @foreach ($student_study_history as $studyHistory)
                                                    <tr>
                                                        <td class="field">
                                                            <input type="text" name="level_class_{{ $i }}" value="{{ $studyHistory->class_level }}"
                                                                placeholder="{{ __('lang.levelClass') }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text" name="school_name_{{ $i }}" value="{{ $studyHistory->school_name }}"
                                                                placeholder="{{ __('lang.schoolName') }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"  name="province_{{ $i }}" value="{{ $studyHistory->province }}"
                                                                placeholder="{{ __('lang.province') }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="number" min="0" name="start_year_{{ $i }}" value="{{ $studyHistory->start_year }}"
                                                                placeholder="{{ __('lang.startYear') }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="number" min="0" name="end_year_{{ $i }}" value="{{ $studyHistory->end_year }}"
                                                                placeholder="{{ __('lang.endYear') }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text" name="certification_{{ $i }}" value="{{ $studyHistory->certification }}"
                                                                placeholder="{{ __('lang.certificateRecieve') }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text" name="rank_{{ $i }}" value="{{ $studyHistory->rank }}"
                                                                placeholder="{{ __('lang.rank') }}">
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endforeach

                                            @elseif (old('student_study_history_count_tr'))
                                                @for ($i = 1; $i <= old('student_study_history_count_tr'); $i++)
                                                    <tr>
                                                        <td class="field">
                                                            <input type="text" name="level_class_{{ $i }}" value="{{ old('level_class_'.$i) }}"
                                                                placeholder="{{ __('lang.levelClass') }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text" name="school_name_{{ $i }}" value="{{ old('school_name_'.$i) }}"
                                                                placeholder="{{ __('lang.schoolName') }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"  name="province_{{ $i }}" value="{{ old('province_'.$i) }}"
                                                                placeholder="{{ __('lang.province') }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="number" min="0" name="start_year_{{ $i }}" value="{{ old('start_year_'.$i) }}"
                                                                placeholder="{{ __('lang.startYear') }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="number" min="0" name="end_year_{{ $i }}" value="{{ old('end_year_'.$i) }}"
                                                                placeholder="{{ __('lang.endYear') }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text" name="certification_{{ $i }}" value="{{ old('certification_'.$i) }}"
                                                                placeholder="{{ __('lang.certificateRecieve') }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text" name="rank_{{ $i }}" value="{{ old('rank_'.$i) }}"
                                                                placeholder="{{ __('lang.rank') }}">
                                                        </td>
                                                    </tr>
                                                @endfor
                                            @else
                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="level_class_1"
                                                            placeholder="{{ __('lang.levelClass') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="school_name_1"
                                                            placeholder="{{ __('lang.schoolName') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text"  name="province_1"
                                                            placeholder="{{ __('lang.province') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="number" min="0" name="start_year_1"
                                                            placeholder="{{ __('lang.startYear') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="number" min="0" name="end_year_1"
                                                            placeholder="{{ __('lang.endYear') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="certification_1"
                                                            placeholder="{{ __('lang.certificateRecieve') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="rank_1"
                                                            placeholder="{{ __('lang.rank') }}">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="level_class_2"
                                                            placeholder="{{ __('lang.levelClass') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="school_name_2"
                                                            placeholder="{{ __('lang.schoolName') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text"  name="province_2"
                                                            placeholder="{{ __('lang.province') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="number" min="0" name="start_year_2"
                                                            placeholder="{{ __('lang.startYear') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="number" min="0" name="end_year_2"
                                                            placeholder="{{ __('lang.endYear') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="certification_2"
                                                            placeholder="{{ __('lang.certificateRecieve') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="rank_2"
                                                            placeholder="{{ __('lang.rank') }}">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="level_class_3"
                                                            placeholder="{{ __('lang.levelClass') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="school_name_3"
                                                            placeholder="{{ __('lang.schoolName') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text"  name="province_3"
                                                            placeholder="{{ __('lang.province') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="number" min="0" name="start_year_3"
                                                            placeholder="{{ __('lang.startYear') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="number" min="0" name="end_year_3"
                                                            placeholder="{{ __('lang.endYear') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="certification_3"
                                                            placeholder="{{ __('lang.certificateRecieve') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="rank_3"
                                                            placeholder="{{ __('lang.rank') }}">
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>

                                    <div class="two wide field ui mini action input mb-3">
                                        <input type="number" id="studentStudyHistoryAddrowValue" value="1"
                                            min="1" max="5">
                                        <button type="button" class="mini ui button"
                                            id="studentStudyHistoryAddrowBtn"> <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                </div>


                                {{-- section 4/ --}}
                                <div class="col-md-12 my-3">
                                    <h3 class="pb-2 ui red header border-bottom">4. {{ __('lang.familyInformation') }}
                                        <small class="text-dark">( {{ __("lang.optional") }} )</small>
                                    </h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 class="my-3"> <i class="bi bi-dot text-danger"></i> {{__('lang.aboutFather')}}</h4>
                                            <div class="field">
                                                <label for="">{{__('lang.fatherName')}}</label>
                                                <input type="text" name="father_name" placeholder="{{ __('lang.fatherName') }}" value="{{ old('father_name') }}">
                                            </div>
                                            <div class="field">
                                                <label for="">{{__('lang.age')}}</label>
                                                <div class="ui right labeled input">
                                                    <input type="number" min="0" name="father_age" placeholder="{{ __('lang.age') }}" value="{{ old('father_age') }}">
                                                    <div class="ui label">{{__('lang.year')}}</div>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label for="">{{__('lang.occupation')}}</label>
                                                <input type="text" name="father_occupation" placeholder="{{ __('lang.occupation') }}" value="{{ old('father_occupation') }}">
                                            </div>

                                            <div class="field">
                                                <label for="">{{__('lang.phone')}}</label>
                                                <input type="text" name="father_phone" placeholder="{{ __('lang.phone') }}" value="{{ old('father_phone') }}">
                                            </div>

                                            <div class="field">
                                                <label for="">{{__('lang.current_add')}}</label>
                                                <textarea name="father_current_add" id="" cols="30" rows="4" placeholder="{{ __('lang.current_add') }}">{{old('father_current_add')}}</textarea>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="my-3"> <i class="bi bi-dot text-danger"></i> {{__('lang.aboutMother')}}</h4>
                                            <div class="field">
                                                <label for="">{{__('lang.motherName')}}</label>
                                                <input type="text" name="mother_name" placeholder="{{ __('lang.motherName') }}" value="{{ old('motherName') }}">
                                            </div>
                                            <div class="field">
                                                <label for="">{{__('lang.age')}}</label>
                                                <div class="ui right labeled input">
                                                    <input type="number" min="0" name="mother_age" placeholder="{{ __('lang.age') }}" value="{{ old('mother_age') }}">
                                                    <div class="ui label">{{__('lang.year')}}</div>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label for="">{{__('lang.occupation')}}</label>
                                                <input type="text" name="mother_occupation" placeholder="{{ __('lang.occupation') }}" value="{{ old('mother_occupation') }}">
                                            </div>

                                            <div class="field">
                                                <label for="">{{__('lang.phone')}}</label>
                                                <input type="text" name="mother_phone" placeholder="{{ __('lang.phone') }}" value="{{ old('mother_phone') }}">
                                            </div>

                                            <div class="field">
                                                <label for="">{{__('lang.current_add')}}</label>
                                                <textarea name="mother_current_add" id="" cols="30" rows="4" placeholder="{{ __('lang.current_add') }}">{{old('mother_current_add')}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 my-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="field">
                                                <label for="">{{__('lang.totalSibling')}}</label>
                                                <div class="ui right labeled input">
                                                    <input type="number" min="0" name="sibling" value="{{ old('sibling') }}" placeholder="{{ __('lang.totalSibling') }}">
                                                    <div class="ui label">{{__('lang.person')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="field">
                                                <label for="">{{__('lang.femaleMemeber')}}</label>
                                                <div class="ui right labeled input">
                                                    <input type="number" min="0" name="female_sibling" value="{{ old('female_sibling') }}" placeholder="{{ __('lang.femaleMemeber') }}">
                                                    <div class="ui label">{{__('lang.person')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12 mt-3 table-responsive">
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
                                            @if ($update)
                                                @php
                                                    $increment = 1;
                                                @endphp
                                                @foreach ($student_sibling as $studnetSibling)
                                                    <tr>
                                                        <td class="field">
                                                            <input type="text" name="name_{{ $increment }}" value="{{ $studnetSibling->name }}"
                                                                placeholder="{{ __('lang.name') }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text" name="gender_{{ $increment }}" value="{{ $studnetSibling->gender }}"
                                                                placeholder="{{ __('lang.gender') }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"  name="birth_date_{{ $increment }}" id="birth_date{{ $increment }}" value="{{ $studnetSibling->birth_date ? \Carbon\Carbon::parse($studnetSibling->birth_date)->format('d/m/Y') : '' }}"
                                                                placeholder="{{ __('lang.birthDate') }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text" name="occupation_{{ $increment }}" value="{{ $studnetSibling->occupation }}"
                                                                placeholder="{{ __('lang.occupation') }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text" name="current_add_{{ $increment }}" placeholder="{{ __('lang.current_add') }}" value="{{ $studnetSibling->current_add }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text" name="phone_{{ $increment }}" value="{{ $studnetSibling->phone }}"
                                                                placeholder="{{ __('lang.phone') }}">
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $increment++;
                                                    @endphp
                                                @endforeach

                                            @elseif (old('student_sibling_count_tr'))
                                                @for ($i = 1; $i <= old('student_sibling_count_tr'); $i++)
                                                    <tr>
                                                        <td class="field">
                                                            <input type="text" name="name_{{ $i }}" value="{{ old('name_'. $i) }}"
                                                                placeholder="{{ __('lang.name') }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text" name="gender_{{ $i }}" value="{{ old('gender_'. $i) }}"
                                                                placeholder="{{ __('lang.gender') }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"  name="birth_date_{{ $i }}" id="birth_date{{ $i }}" value="{{ old('birth_date_'. $i ) ? \Carbon\Carbon::pase(old('birth_date_'. $i)) : '' }}"
                                                                placeholder="{{ __('lang.birthDate') }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text" name="occupation_{{ $i }}" value="{{ old('occupation_'. $i) }}"
                                                                placeholder="{{ __('lang.occupation') }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text" name="current_add_{{ $i }}" placeholder="{{ __('lang.current_add') }}" value="{{ old('current_add_'. $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text" name="phone_{{ $i }}" value="{{ old('phone_'. $i) }}"
                                                                placeholder="{{ __('lang.phone') }}">
                                                        </td>
                                                    </tr>
                                                @endfor
                                            @else
                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="name_1"
                                                            placeholder="{{ __('lang.name') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="gender_1"
                                                            placeholder="{{ __('lang.gender') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text"  name="birth_date_1" id="birth_date1"
                                                            placeholder="{{ __('lang.birthDate') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="occupation_1"
                                                            placeholder="{{ __('lang.occupation') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="current_add_1" placeholder="{{ __('lang.current_add') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="phone_1"
                                                            placeholder="{{ __('lang.phone') }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="name_2"
                                                            placeholder="{{ __('lang.name') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="gender_2"
                                                            placeholder="{{ __('lang.gender') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text"  name="birth_date_2" id="birth_date2"
                                                            placeholder="{{ __('lang.birthDate') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="occupation_2"
                                                            placeholder="{{ __('lang.occupation') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="current_add_2" placeholder="{{ __('lang.current_add') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="phone_2"
                                                            placeholder="{{ __('lang.phone') }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="name_3"
                                                            placeholder="{{ __('lang.name') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="gender_3"
                                                            placeholder="{{ __('lang.gender') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text"  name="birth_date_3" id="birth_date3"
                                                            placeholder="{{ __('lang.birthDate') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="occupation_3"
                                                            placeholder="{{ __('lang.occupation') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="current_add_3" placeholder="{{ __('lang.current_add') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="phone_3"
                                                            placeholder="{{ __('lang.phone') }}">
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>

                                    <div class="two wide field ui mini action input mb-3">
                                        <input type="number" id="studentSiblingTableAddrowValue" value="1"
                                            min="1" max="5">
                                        <button type="button" class="mini ui button"
                                            id="studentSiblingTableAddrowBtn"> <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                </div>


                                <div class="col-md-6 d-none">
                                    <div class="two fields">
                                        <div class="field">
                                            <input type="hidden" class="d-none" name="student_study_history_count_tr" id="student_study_history_count_tr" >
                                        </div>
                                        <div class="field">
                                            <input type="hidden" class="d-none" name="student_sibling_count_tr" id="student_sibling_count_tr">
                                        </div>
                                    </div>
                                </div>
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
            academy_year: {
                identifier: 'academy_year',
                rules: [{
                    type: 'empty',
                    prompt: '{{ __('lang.pleaseSelectAcademyYear') }}'
                }]
            },
            class_id: {
                identifier: 'class_id',
                rules: [{
                    type: 'empty',
                    prompt: '{{ __('lang.pleaseSelectClass') }}'
                }]
            },
            username: {
                identifier: 'username',
                rules: [{

                    type: 'empty',
                    prompt: '{{ __('lang.pleaseSelectClassToGetUsername') }}'
                }]
            },
            password: {
                identifier: 'password',
                rules: [{

                    type: 'minLength[4]',
                    prompt: '{{ __('lang.pleaseEnterpasswordLest4Charecter') }}'
                }]
            },


            fullname_kh: {
                identifier: 'fullname_kh',
                rules: [{
                    type: 'empty',
                    prompt: '{{ __('lang.pleaseEnterfullname_kh') }}'
                }]
            },
            fullname_en: {
                identifier: 'fullname_en',
                rules: [{
                    type: 'empty',
                    prompt: '{{ __('lang.pleaseEnterfullname_en') }}'
                }]
            },
            gender: {
                identifier: 'gender',
                rules: [{
                    type: 'empty',
                    prompt: '{{ __('lang.pleaseSelectgender') }}'
                }]
            },
        }
    });


    // Add row for table
    $(document).ready(function() {

        // Acadmey year with class
            $(document).on('change', '#academy_year', function () {
                var academyYear = $(this).val();
                var url = "{{ route('student.getClass') }}";

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        '_token' : "{{ csrf_token() }}",
                        'year' : academyYear,
                    },
                    dataType: "json",
                    success: function (response) {
                        $('#class').html(response);
                    }
                });
            });

            $(document).on('change', '#class', function () {
                var class_id = $(this).val();
                var url = "{{ route('student.classDetail') }}";

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        '_token' : "{{ csrf_token() }}",
                        'class_id' : class_id,
                    },
                    dataType: "json",
                    success:function(data){
                            $('#class_detail').removeClass('" d-none "');

                            $('#username').val(data.username);

                            $('#classCodeValue').text(data.class_code);
                            $('#departmentValue').text(data.department);
                            $('#majorValue').text(data.major);
                            $('#studyLevelValue').text(data.level_study);
                            $('#yearLevelValue').text(data.level_year);
                            $('#academyYearValue').text(data.academy_year);

                            $('#graduatedValue').text(data.graduate_status);
                            $('#createdAtValue').text(data.created_at);
                            $('#deletedAtValue').text(data.deleted_at);
                            $('#deletedByValue').text(data.deleted_by);

                        }
                });
            });

            $(document).on('click', '#random_password', function () {
                var randomPassword = Math.floor(10000 + Math.random() * 90000); // Generates a number between 10000 and 99999
                $('#password').val(randomPassword);
                $('#password').attr('type', 'text');
            });
        ///


        // 1 table student study history
        $('#studentStudyHistoryAddrowBtn').click(function() {
            var addRow = parseInt($('#studentStudyHistoryAddrowValue').val());
            var rowCount = $('#studentStudyHistory tbody tr').length;

            // Create a new row with example data
            if (addRow >= 1) {
                for (var i = 1; i <= addRow; i++) {
                    var threeIncrement = i + rowCount;
                    var newRow = `
                            <tr>
                                <td class="field">
                                    <input type="text" name="level_class_${threeIncrement}"
                                        placeholder="{{ __('lang.levelClass') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="school_name_${threeIncrement}"
                                        placeholder="{{ __('lang.schoolName') }}">
                                </td>
                                <td class="field">
                                    <input type="text"  name="province_${threeIncrement}"
                                        placeholder="{{ __('lang.province') }}">
                                </td>
                                <td class="field">
                                    <input type="number" min="0" name="start_year_${threeIncrement}"
                                        placeholder="{{ __('lang.startYear') }}">
                                </td>
                                <td class="field">
                                    <input type="number" min="0" name="end_year_${threeIncrement}"
                                        placeholder="{{ __('lang.endYear') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="certification_${threeIncrement}"
                                        placeholder="{{ __('lang.certificateRecieve') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="rank_${threeIncrement}"
                                        placeholder="{{ __('lang.rank') }}">
                                </td>
                            </tr>
                        `;
                    $('#studentStudyHistory tbody tr:last').after(newRow);
                }

                // Initialize datepicker for the new datepicker fields
                // for (var j = rowCount + 1; j <= rowCount + addRow; j++) {
                //     $("#workdate_start_" + j).datepicker();
                //     $("#workdate_finish_" + j).datepicker();
                // }
            }
            $('#student_study_history_count_tr').val(rowCount + addRow);
        });

        // 2 table student sibling
        $('#studentSiblingTableAddrowBtn').click(function() {
            var addRow = parseInt($('#studentSiblingTableAddrowValue').val());
            var rowCount = $('#studentSiblingTable tbody tr').length;
            // Create a new row with example data
            if (addRow >= 1) {
                for (var i = 1; i <= addRow; i++) {
                    var threeIncrement = i + rowCount;
                    var newRow = `
                            <tr>
                                <td class="field">
                                    <input type="text" name="name_${threeIncrement}"
                                        placeholder="{{ __('lang.name') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="gender_${threeIncrement}"
                                        placeholder="{{ __('lang.gender') }}">
                                </td>
                                <td class="field">
                                    <input type="text"  name="birth_date_${threeIncrement}" id="birth_date_${threeIncrement}"
                                        placeholder="{{ __('lang.birthDate') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="occupation_${threeIncrement}"
                                        placeholder="{{ __('lang.occupation') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="current_add_${threeIncrement}" placeholder="{{ __('lang.current_add') }}">
                                </td>
                                <td class="field">
                                    <input type="text" name="phone_${threeIncrement}"
                                        placeholder="{{ __('lang.phone') }}">
                                </td>
                            </tr>
                        `;
                    $('#studentSiblingTable tbody tr:last').after(newRow);
                }
                for (var j = rowCount + 1; j <= rowCount + addRow; j++) {
                    $("#birth_date_" + j).datepicker();
                }
            }
            $('#student_sibling_count_tr').val(rowCount + addRow);
        });
    });

    $(document).ready(function() {
        var rowCount1 = $('#studentStudyHistory tbody tr').length;
        var rowCount2 = $('#studentSiblingTable tbody tr').length;
        // var rowCount3 = $('#teacherPraiseBlameTable tbody tr').length;
        // var rowCount4 = $('#teacherculturalLevelTable tbody tr').length;
        // var rowCount5 = $('#teacherpedagogyCourseTable tbody tr').length;
        // var rowCount6 = $('#teacherShortCourseTable tbody tr').length;
        // var rowCount7 = $('#teacherForeignlanguageTable tbody tr').length;
        // var rowCount8 = $('#teacherChildrenTable tbody tr').length;

        $('#student_study_history_count_tr').val(rowCount1);
        $('#student_sibling_count_tr').val(rowCount2);

        // $('#teacherPraiseBlameTableCountTr').val(rowCount3);
        // $('#teacherculturalLevelTableCountTr').val(rowCount4);
        // $('#teacherpedagogyCourseTableCountTr').val(rowCount5);
        // $('#teacherShortCourseTableCountTr').val(rowCount6);

        // $('#teacherForeignlanguageTableCountTr').val(rowCount7);
        // $('#teacherChildrenTableCountTr').val(rowCount8);
    });
</script>
@endsection
