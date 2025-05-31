@extends('backend.layout.master')
@section('title')
    {{ __('lang.teacher') }}
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
    @if ($update)
        {{ __('lang.updateTeacher') }}
    @else
        {{ __('lang.addTeacher') }}
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
                                @if ($update) {{ route('teacher.update', $teacher->id) }}
                                @else
                                    {{ route('teacher.store') }} @endif"
                        enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method($update ? 'PUT' : 'POST')

                        <div class="card-header">
                            <h3 class="card-title">
                                @if ($update)
                                    {{ __('lang.updateTeacher') }}
                                @else
                                    {{ __('lang.addTeacher') }}
                                @endif
                            </h3>
                            <div class="card-tools">
                                {{-- <span title="3 New Messages" class="badge text-bg-primary"> 3 </span> --}}
                                <a href="@if($teacher && $teacher->leave_status == 0)
                                    {{ route('teacher.leaveList') }}
                                @else
                                    {{ route('teacher.index') }}
                                @endif" class="ui button small">
                                    {{ __('lang.cancel') }}
                                </a>
                                <button type="submit"
                                    class="ui button small @if ($update) {{-- {{ $teacher->dep_code }} --}}
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
                                                    @if ($update && $teacher->profile) src="{{ asset($teacher->profile) }}"
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
                                        @if ($update)
                                            {{-- update here  --}}
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="field">
                                                        <label>{{ __('lang.fullnameKh') }} <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="fullname_kh"
                                                            placeholder="{{ __('lang.fullnameKh') }}"
                                                            value="@if($update){{ $teacher->fullname_kh }}@else{{ old('fullname_kh') }} @endif">
                                                    </div>
                                                    <div class="field">
                                                        <label>{{ __('lang.fullnameEn') }} <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="fullname_en"
                                                            placeholder="{{ __('lang.fullnameEn') }}"
                                                            value="@if($update){{ $teacher->fullname_en }}@else{{ old('fullname_en') }} @endif">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="field">
                                                        <label>{{ __('lang.gender') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select class="ui search dropdown1" name="gender">
                                                            <option value="">{{ __('lang.selectGender') }}
                                                            </option>
                                                            <option value="f"
                                                                @if ($update) @if ('f' == $teacher->gender)
                                                                            selected @endif
                                                            @else
                                                                @if (old('gender') == 'f') selected @endif
                                                                @endif
                                                                >{{ __('lang.female') }}</option>
                                                            <option value="m"
                                                                @if ($update) @if ('m' == $teacher->gender)
                                                                            selected @endif
                                                            @else
                                                                @if (old('gender') == 'm') selected @endif
                                                                @endif
                                                                >{{ __('lang.male') }}</option>
                                                        </select>
                                                    </div>

                                                    <div class="field">
                                                        <label>{{ __('lang.department') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select class="ui search dropdown" name="department_id">
                                                            <option value="">{{ __('lang.selectDepartment') }}
                                                            </option>
                                                            @foreach ($departments as $d)
                                                                <option value="{{ $d->id }}"
                                                                    @if ($update) @if ($d->id == $teacher->department_id)
                                                                                selected @endif
                                                                @else
                                                                    @if (old('department_id') == $d->id) selected @endif
                                                                    @endif
                                                                    >
                                                                    {{ $d->dep_code }} -
                                                                    @if (session()->has('localization') && session('localization') == 'en')
                                                                        {{ $d->dep_name_en }}
                                                                    @else
                                                                        {{ $d->dep_name_kh }}
                                                                    @endif
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            {{-- add here  --}}
                                            <div class="col-md-6">
                                                <div class="field">
                                                    <label>{{ __('lang.idCard') }} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="id_card"
                                                        placeholder="{{ __('lang.idCard') }}"
                                                        value="{{ old('id_card') }}">
                                                </div>

                                                <div class="field">
                                                    <label>{{ __('lang.username') }} <span class="text-danger">*</span>
                                                        @if ($errors->has('username'))
                                                            <small
                                                                class="fw-normal text-danger">{{ $errors->first('username') }}</small>
                                                        @endif
                                                    </label>
                                                    <input type="text" name="username"
                                                        placeholder="{{ __('lang.username') }}"
                                                        value="{{ old('username') }}">

                                                </div>


                                                <div class="field">
                                                    <label>{{ __('lang.password') }} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="password" name="password"
                                                        placeholder="{{ __('lang.password') }}"
                                                        value="{{ old('password') }}">
                                                </div>

                                                <div class="field">
                                                    <label>{{ __('lang.confirmPassword') }} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="password" name="confirm_password"
                                                        placeholder="{{ __('lang.confirmPassword') }}"
                                                        value="">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="field">
                                                        <label>{{ __('lang.fullnameKh') }} <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="fullname_kh"
                                                            placeholder="{{ __('lang.fullnameKh') }}"
                                                            value="{{ old('fullname_kh') }}">
                                                    </div>
                                                    <div class="field">
                                                        <label>{{ __('lang.fullnameEn') }} <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="fullname_en"
                                                            placeholder="{{ __('lang.fullnameEn') }}"
                                                            value="{{ old('fullname_en') }}">
                                                    </div>
                                                    <div class="field">
                                                        <label>{{ __('lang.gender') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select class="ui search dropdown1" name="gender">
                                                            <option value="">{{ __('lang.selectGender') }}</option>
                                                            <option value="f" @if (old('gender') == 'f') selected @endif>{{ __('lang.female') }}</option>
                                                            <option value="m" @if (old('gender') == 'm') selected @endif>{{ __('lang.male') }}</option>
                                                        </select>
                                                    </div>

                                                    <div class="field">
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
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        {{-- message here  --}}
                                        <div class="col-md-12 mt-3">
                                            <div class="ui error message"></div>
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




                                {{-- section 2 --}}
                                <div class="col-md-12 my-3">
                                    <h3 class="pb-2 ui red header border-bottom">2. {{ __('lang.profileInfomation') }}
                                        <small class="text-dark">( {{ __('lang.optional') }} )</small>
                                    </h3>
                                </div>

                                <div class="col-md-6">
                                    <div class="field">
                                        <label>{{ __('lang.birthDate') }}</label>
                                        <input type="text" name="birth_date" id="datepicker"
                                            placeholder="{{ __('lang.birthDate') }}"
                                            value="@if($update){{ $teacher->birth_date }}@else{{ old('birth_date') }}@endif">
                                    </div>


                                    <div class="field">
                                        <label>{{ __('lang.nationality') }}</label>
                                        <input type="text" name="nationality"
                                            placeholder="{{ __('lang.nationality') }}"
                                            value="@if($update){{ $teacher->nationality }}@else{{ old('nationality') }}@endif">
                                    </div>

                                    <div class="field">
                                        <label>{{ __('lang.disability') }}</label>
                                        <input type="text" name="disability"
                                            placeholder="{{ __('lang.disability') }}"
                                            value="@if($update){{ $teacher->disability }}@else{{ old('disability') }}@endif">
                                    </div>

                                    <div class="field">
                                        <label>{{ __('lang.idNumber') }}</label>
                                        <input type="text" name="id_number"
                                            placeholder="{{ __('lang.idNumber') }}"
                                            value="@if($update){{ $teacher->id_number }}@else{{ old('id_number') }}@endif">
                                    </div>
                                    <div class="field">
                                        <label>{{ __('lang.position') }}</label>
                                        <input type="text" name="position"
                                            placeholder="{{ __('lang.position') }}"
                                            value="@if($update){{ $teacher->position }}@else{{ old('position') }}@endif">
                                    </div>
                                    <div class="field">
                                        <label>{{ __('lang.office') }}</label>
                                        <input type="text" name="office" placeholder="{{ __('lang.office') }}"
                                            value="@if($update){{ $teacher->office }}@else{{ old('office') }}@endif">
                                    </div>
                                    <div class="field">
                                        <label>{{ __('lang.placeBirth') }}</label>
                                        <textarea name="place_fo_birth" id="" cols="30" rows="5"
                                            placeholder="{{ __('lang.placeBirth') }}">
@if ($update){{ $teacher->place_fo_birth }}@else{{ old('place_fo_birth') }}@endif
</textarea>
                                        {{-- <input type="text" name="place_fo_birth" placeholder="{{ __('lang.placeBirth') }}" value="@if($update){{ teacher->place_fo_birth }}@else{{ old('place_fo_birth') }}@endif"> --}}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="field">
                                            <label>{{ __('lang.payrollAcc') }}</label>
                                            <input type="text" name="payroll_acc"
                                                placeholder="{{ __('lang.payrollAcc') }}"
                                                value="@if($update){{ $teacher->payroll_acc }}@else{{ old('payroll_acc') }}@endif">
                                        </div>
                                        <div class="field">
                                            <label>{{ __('lang.memberBcc') }}</label>
                                            <input type="text" name="memeber_bcc"
                                                placeholder="{{ __('lang.memberBcc') }}"
                                                value="@if($update){{ $teacher->memeber_bcc }}@else{{ old('memeber_bcc') }}@endif">
                                        </div>

                                        <div class="field">
                                            <label>{{ __('lang.employment_date') }}</label>
                                            <input type="text" id="datepicker1" name="employment_date"
                                                placeholder="{{ __('lang.employment_date') }}"
                                                value="@if($update){{ $teacher->employment_date }}@else{{ old('employment_date') }}@endif">
                                        </div>
                                        <div class="field">
                                            <label>{{ __('lang.soup_date') }}</label>
                                            <input type="text" id="datepicker2" name="soup_date"
                                                placeholder="{{ __('lang.soup_date') }}"
                                                value="@if($update){{ $teacher->soup_date }}@else{{ old('soup_date') }}@endif">
                                        </div>

                                        <div class="field">
                                            <label>{{ __('lang.anountment') }}</label>
                                            <input type="text" name="anountment"
                                                placeholder="{{ __('lang.anountment') }}"
                                                value="@if($update){{ $teacher->anountment }}@else{{ old('anountment') }}@endif">
                                        </div>

                                        <div class="field">
                                            <label>{{ __('lang.working_unit') }}</label>
                                            <input type="text" name="working_unit"
                                                placeholder="{{ __('lang.working_unit') }}"
                                                value="@if($update){{ $teacher->working_unit }}@else{{ old('working_unit') }}@endif">
                                        </div>

                                        <div class="field">
                                            <label>{{ __('lang.working_unit_add') }}</label>
                                            <textarea name="working_unit_add" placeholder="{{ __('lang.working_unit_add') }}" cols="30" rows="5">
@if ($update){{ $teacher->working_unit_add }}@else{{ old('working_unit_add') }}@endif
</textarea>
                                        </div>
                                    </div>
                                </div>


                                {{-- section 3 --}}
                                <div class="col-md-12 my-3 mt-4">
                                    <h3 class="pb-2 ui red header border-bottom">3.
                                        {{ __('lang.teacherProfessional') }} <small class="text-dark">(
                                            {{ __('lang.optional') }} )</small></h3>
                                </div>

                                <div class="col-md-12 table-responsive">
                                    <table class="table table-sm" id="teacherProfessionalTable">
                                        <thead>
                                            <tr>
                                                <th scope="col"> {{ __('lang.typeProfessional') }} </th>
                                                <th scope="col"> {{ __('lang.description') }} </th>
                                                <th scope="col"> {{ __('lang.numberAnountment') }} </th>
                                                <th scope="col"> {{ __('lang.recieveDate') }} </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($update)
                                                @php
                                                    $increment = 1;
                                                @endphp
                                                @foreach ($teacher_professionals as $professional)
                                                    <tr>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="type_professional_{{ $increment }}"
                                                                placeholder="{{ __('lang.typeProfessional') }}"
                                                                value="{{ $professional->type_professional }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="description_{{ $increment }}"
                                                                placeholder="{{ __('lang.description') }}"
                                                                value="{{ $professional->description }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="number_anountment_{{ $increment }}"
                                                                placeholder="{{ __('lang.numberAnountment') }}"
                                                                value="{{ $professional->number_anountment }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                id="professional_recieve_date_{{ $increment }}"
                                                                name="professional_recieve_date_{{ $increment }}"
                                                                placeholder="{{ __('lang.recieveDate') }}"
                                                                value="{{ $professional->professional_recieve_date }}">
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $increment++;
                                                    @endphp
                                                @endforeach
                                            @elseif (old('trTableProfessional'))
                                                @for ($i = 1; $i <= old('trTableProfessional'); $i++)
                                                    <tr>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="type_professional_{{ $i }}"
                                                                placeholder="{{ __('lang.typeProfessional') }}"
                                                                value="{{ old('type_professional_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="description_{{ $i }}"
                                                                placeholder="{{ __('lang.description') }}"
                                                                value="{{ old('description_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="number_anountment_{{ $i }}"
                                                                placeholder="{{ __('lang.numberAnountment') }}"
                                                                value="{{ old('number_anountment_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                id="professional_recieve_date_{{ $i }}"
                                                                name="professional_recieve_date_{{ $i }}"
                                                                placeholder="{{ __('lang.recieveDate') }}"
                                                                value="{{ old('professional_recieve_date_' . $i) }}">
                                                        </td>
                                                    </tr>
                                                @endfor
                                            @else
                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="type_professional_1"
                                                            placeholder="{{ __('lang.typeProfessional') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="description_1"
                                                            placeholder="{{ __('lang.description') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="number_anountment_1"
                                                            placeholder="{{ __('lang.numberAnountment') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="professional_recieve_date_1"
                                                            name="professional_recieve_date_1"
                                                            placeholder="{{ __('lang.recieveDate') }}">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="type_professional_2"
                                                            placeholder="{{ __('lang.typeProfessional') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="description_2"
                                                            placeholder="{{ __('lang.description') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="number_anountment_2"
                                                            placeholder="{{ __('lang.numberAnountment') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="professional_recieve_date_2"
                                                            name="professional_recieve_date_2"
                                                            placeholder="{{ __('lang.recieveDate') }}">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="type_professional_3"
                                                            placeholder="{{ __('lang.typeProfessional') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="description_3"
                                                            placeholder="{{ __('lang.description') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="number_anountment_3"
                                                            placeholder="{{ __('lang.numberAnountment') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="professional_recieve_date_3"
                                                            name="professional_recieve_date_3"
                                                            placeholder="{{ __('lang.recieveDate') }}">
                                                    </td>
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>

                                    <div class="two wide field ui mini action input mb-3">
                                        <input type="number" id="teacherProfessionalTableAddrowValue" value="1"
                                            min="1" max="5">
                                        <button type="button" class="mini ui button"
                                            id="teacherProfessionalTableAddrowBtn"> <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="field">
                                        <label>{{ __('lang.rankAndClass') }}</label>
                                        <input type="text" name="rank_class" id="datepicker"
                                            placeholder="{{ __('lang.rankAndClass') }}"
                                            value="@if($update){{ $teacher->rank_class }}@else{{ old('rank_class') }}@endif">
                                    </div>


                                    <div class="field">
                                        <label>{{ __('lang.refer') }}</label>
                                        <input type="text" name="refer" placeholder="{{ __('lang.refer') }}"
                                            value="@if($update){{ $teacher->refer }}@else{{ old('refer') }}@endif">
                                    </div>

                                    <div class="field">
                                        <label>{{ __('lang.numbering') }}</label>
                                        <input type="text" name="numbering"
                                            placeholder="{{ __('lang.numbering') }}"
                                            value="@if($update){{ $teacher->numbering }}@else{{ old('numbering') }}@endif">
                                    </div>

                                    <div class="field">
                                        <label>{{ __('lang.dateLastIncreSalary') }}</label>
                                        <input type="text" id="last_interest_date1" name="last_interest_date"
                                            placeholder="{{ __('lang.dateLastIncreSalary') }}"
                                            value="@if($update){{ $teacher->last_interest_date }}@else{{ old('last_interest_date') }}@endif">
                                    </div>

                                    <div class="field">
                                        <label>{{ __('lang.dated') }}</label>
                                        <input type="text" id="dated" name="dated"
                                            placeholder="{{ __('lang.dated') }}"
                                            value="@if($update){{ $teacher->dated }}@else{{ old('dated') }}@endif">
                                    </div>

                                    <div class="field">
                                        <label>{{ __('lang.teachInYear') }}</label>
                                        <input type="text" name="teach_in_year"
                                            placeholder="{{ __('lang.teachInYear') }}"
                                            value="@if($update){{ $teacher->teach_in_year }}@else{{ old('teach_in_year') }}@endif">
                                    </div>

                                    <div class="field">
                                        <label>{{ __('lang.englishTeach') }}</label>
                                        <input type="text" name="english_teach"
                                            placeholder="{{ __('lang.englishTeach') }}"
                                            value="@if($update){{ $teacher->english_teach }}@else{{ old('english_teach') }}@endif">
                                    </div>

                                    <div class="field">
                                        <label>{{ __('lang.threeCombine') }}</label>
                                        <input type="text" name="three_level_combine"
                                            placeholder="{{ __('lang.threeCombine') }}"
                                            value="@if($update){{ $teacher->three_level_combine }}@else{{ old('three_level_combine') }}@endif">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="field">
                                            <label>{{ __('lang.technicTeamLeader') }}</label>
                                            <input type="text" name="technic_team_leader"
                                                placeholder="{{ __('lang.technicTeamLeader') }}"
                                                value="@if($update){{ $teacher->technic_team_leader }}@else{{ old('technic_team_leader') }}@endif">
                                        </div>
                                        <div class="field">
                                            <label>{{ __('lang.help_teach') }}</label>
                                            <input type="text" id="datepicker2" name="help_teach"
                                                placeholder="{{ __('lang.help_teach') }}"
                                                value="@if($update){{ $teacher->help_teach }}@else{{ old('help_teach') }}@endif">
                                        </div>

                                        <div class="field">
                                            <label>{{ __('lang.two_class') }}</label>
                                            <input type="text" name="two_class"
                                                placeholder="{{ __('lang.two_class') }}"
                                                value="@if($update){{ $teacher->two_class }}@else{{ old('two_class') }}@endif">
                                        </div>

                                        <div class="field">
                                            <label>{{ __('lang.class_charge') }}</label>
                                            <input type="text" name="class_charge"
                                                placeholder="{{ __('lang.class_charge') }}"
                                                value="@if($update){{ $teacher->class_charge }}@else{{ old('class_charge') }}@endif">
                                        </div>

                                        <div class="field">
                                            <label>{{ __('lang.cross_school') }}</label>
                                            <input type="text" name="cross_school"
                                                placeholder="{{ __('lang.cross_school') }}"
                                                value="@if($update){{ $teacher->cross_school }}@else{{ old('cross_school') }}@endif">
                                        </div>
                                        <div class="field">
                                            <label>{{ __('lang.overtime') }}</label>
                                            <input type="text" name="overtime"
                                                placeholder="{{ __('lang.overtime') }}"
                                                value="@if($update){{ $teacher->overtime }}@else{{ old('overtime') }}@endif">
                                        </div>

                                        <div class="field">
                                            <label>{{ __('lang.coupling_class') }}</label>
                                            <input type="text" name="coupling_class"
                                                placeholder="{{ __('lang.coupling_class') }}"
                                                value="@if($update){{ $teacher->coupling_class }}@else{{ old('coupling_class') }}@endif">
                                        </div>

                                        <div class="field">
                                            <label>{{ __('lang.two_lang') }}</label>
                                            <input type="text" name="two_lang"
                                                placeholder="{{ __('lang.two_lang') }}"
                                                value="@if($update){{ $teacher->two_lang }}@else{{ old('two_lang') }}@endif">
                                        </div>
                                    </div>
                                </div>


                                {{-- section 4 --}}
                                <div class="col-md-12 my-3 mt-4">
                                    <h3 class="pb-2 ui red header border-bottom">4. {{ __('lang.workHistory') }}
                                        <small class="text-dark">( {{ __('lang.optional') }} )</small>
                                    </h3>
                                </div>

                                <div class="col-md-6">
                                    <div class="field">
                                        <label>{{ __('lang.work_status') }}</label>
                                        <input type="text" name="work_status" id="datepicker"
                                            placeholder="{{ __('lang.work_status') }}"
                                            value="@if($update){{ $teacher->work_status }}@else{{ old('work_status') }}@endif">
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3 table-responsive">
                                    <table class="table table-sm" id="teacherWorkHistoryTable">
                                        <thead>
                                            <tr>
                                                <th scope="col"> {{ __('lang.workContinue') }} </th>
                                                <th scope="col"> {{ __('lang.currentWorkingUnit') }} </th>
                                                <th scope="col"> {{ __('lang.startDate') }} </th>
                                                <th scope="col"> {{ __('lang.finishDate') }} </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($update)
                                                @php
                                                    $increment = 1;
                                                @endphp
                                                @foreach ($teacher_workhistories as $workHistory)
                                                    <tr>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="work_continue_{{ $increment }}"
                                                                placeholder="{{ __('lang.workContinue') }}"
                                                                value="{{ $workHistory->work_continue }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="current_working_{{ $increment }}"
                                                                placeholder="{{ __('lang.currentWorkingUnit') }}"
                                                                value="{{ $workHistory->current_working }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                id="workStartdate{{ $increment }}"
                                                                name="work_start_date_{{ $increment }}"
                                                                placeholder="{{ __('lang.startDate') }}"
                                                                value="{{ $workHistory->work_start_date }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                id="workFinishdate{{ $increment + 1 }}"
                                                                name="work_finish_date_{{ $increment }}"
                                                                placeholder="{{ __('lang.finishDate') }}"
                                                                value="{{ $workHistory->work_finish_date }}">
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $increment++;
                                                    @endphp
                                                @endforeach
                                            @elseif (old('trTableWorkHistory'))
                                                @for ($i = 1; $i <= old('trTableWorkHistory'); $i++)
                                                    <tr>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="work_continue_{{ $i }}"
                                                                placeholder="{{ __('lang.workContinue') }}"
                                                                value="{{ old('work_continue_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="current_working_{{ $i }}"
                                                                placeholder="{{ __('lang.currentWorkingUnit') }}"
                                                                value="{{ old('current_working_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                id="workStartdate{{ $i }}"
                                                                name="work_start_date_{{ $i }}"
                                                                placeholder="{{ __('lang.startDate') }}"
                                                                value="{{ old('work_start_date_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                id="workFinishdate{{ $i + 1 }}"
                                                                name="work_finish_date_{{ $i }}"
                                                                placeholder="{{ __('lang.finishDate') }}"
                                                                value="{{ old('work_finish_date_' . $i) }}">
                                                        </td>
                                                    </tr>
                                                @endfor
                                            @else
                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="work_continue_1"
                                                            placeholder="{{ __('lang.workContinue') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="current_working_1"
                                                            placeholder="{{ __('lang.currentWorkingUnit') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="workdate1" name="start_date_1"
                                                            placeholder="{{ __('lang.startDate') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="workdate2" name="finish_date_1"
                                                            placeholder="{{ __('lang.finishDate') }}">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="work_continue_2"
                                                            placeholder="{{ __('lang.workContinue') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="current_working_2"
                                                            placeholder="{{ __('lang.currentWorkingUnit') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="workdate3" name="start_date_2"
                                                            placeholder="{{ __('lang.startDate') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="workdate4" name="finish_date_2"
                                                            placeholder="{{ __('lang.finishDate') }}">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="work_continue_3"
                                                            placeholder="{{ __('lang.workContinue') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="current_working_3"
                                                            placeholder="{{ __('lang.currentWorkingUnit') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="workdate5" name="start_date_3"
                                                            placeholder="{{ __('lang.startDate') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="workdate6" name="finish_date_3"
                                                            placeholder="{{ __('lang.finishDate') }}">
                                                    </td>
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>

                                    <div class="two wide field ui mini action input mb-3">
                                        <input type="number" id="teacherWorkHistoryTableAddrowValue" value="1"
                                            min="1" max="5">
                                        <button type="button" class="mini ui button"
                                            id="teacherWorkHistoryTableAddrowBtn"> <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                </div>


                                {{-- section 5 --}}
                                <div class="col-md-12 my-3">
                                    <h3 class="pb-2 ui red header border-bottom">5. {{ __('lang.praiseBlame') }}
                                        <small class="text-dark">( {{ __('lang.optional') }} )</small>
                                    </h3>
                                </div>

                                <div class="col-md-12  table-responsive">
                                    <table class="table table-sm" id="teacherPraiseBlameTable">
                                        <thead>
                                            <tr>
                                                <th scope="col"> {{ __('lang.typePraiseBlame') }} </th>
                                                <th scope="col"> {{ __('lang.providedBy') }} </th>
                                                <th scope="col"> {{ __('lang.recieveDate') }} </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($update)
                                                @php
                                                    $increment = 1;
                                                @endphp
                                                @foreach ($teacher_praiseblames as $praiseBlame)
                                                    <tr>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="type_praiseblame_{{ $increment }}"
                                                                placeholder="{{ __('lang.typePraiseBlame') }}"
                                                                value="{{ $praiseBlame->type_praiseblame }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="provided_by_{{ $increment }}"
                                                                placeholder="{{ __('lang.providedBy') }}"
                                                                value="{{ $praiseBlame->provided_by }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                id="PraiseBlamerecieveDate{{ $increment }}"
                                                                name="praise_blame_recieve_date_{{ $increment }}"
                                                                placeholder="{{ __('lang.recieveDate') }}"
                                                                value="{{ $praiseBlame->praise_blame_recieve_date }}">
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $increment++;
                                                    @endphp
                                                @endforeach
                                            @elseif (old('trTablePraiseBlame'))
                                                @for ($i = 1; $i <= old('trTablePraiseBlame'); $i++)
                                                    <tr>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="type_praiseblame_{{ $i }}"
                                                                placeholder="{{ __('lang.typePraiseBlame') }}"
                                                                value="{{ old('type_praiseblame_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="provided_by_{{ $i }}"
                                                                placeholder="{{ __('lang.providedBy') }}"
                                                                value="{{ old('provided_by_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                id="PraiseBlamerecieveDate{{ $i }}"
                                                                name="praise_blame_recieve_date_{{ $i }}"
                                                                placeholder="{{ __('lang.recieveDate') }}"
                                                                value="{{ old('praise_blame_recieve_date_' . $i) }}">
                                                        </td>
                                                    </tr>
                                                @endfor
                                            @else
                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="type_praiseblame_1"
                                                            placeholder="{{ __('lang.typePraiseBlame') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="provided_by_1"
                                                            placeholder="{{ __('lang.providedBy') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="PraiseBlamerecieveDate1"
                                                            name="praise_blame_recieve_date_1"
                                                            placeholder="{{ __('lang.recieveDate') }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="type_praiseblame_2"
                                                            placeholder="{{ __('lang.typePraiseBlame') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="provided_by_2"
                                                            placeholder="{{ __('lang.providedBy') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="PraiseBlamerecieveDate2"
                                                            name="praise_blame_recieve_date_2"
                                                            placeholder="{{ __('lang.recieveDate') }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="type_praiseblame_3"
                                                            placeholder="{{ __('lang.typePraiseBlame') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="provided_by_3"
                                                            placeholder="{{ __('lang.providedBy') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="PraiseBlamerecieveDate3"
                                                            name="praise_blame_recieve_date_3"
                                                            placeholder="{{ __('lang.recieveDate') }}">
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>

                                    <div class="two wide field ui mini action input mb-3">
                                        <input type="number" id="teacherPraiseBlameTableAddrowValue" value="1"
                                            min="1" max="5">
                                        <button type="button" class="mini ui button"
                                            id="teacherPraiseBlameTableAddrowBtn"> <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                </div>



                                {{-- section 6 --}}
                                <div class="col-md-12 my-3">
                                    <h3 class="pb-2 ui red header border-bottom">6. {{ __('lang.culturalLevel') }}
                                        <small class="text-dark">( {{ __('lang.optional') }} )</small>
                                    </h3>
                                </div>

                                <div class="col-md-12  table-responsive">
                                    <table class="table table-sm" id="teacherculturalLevelTable">
                                        <thead>
                                            <tr>
                                                <th scope="col"> {{ __('lang.culturalLevel') }} </th>
                                                <th scope="col"> {{ __('lang.majorName') }} </th>
                                                <th scope="col"> {{ __('lang.recieveDate') }} </th>
                                                <th scope="col"> {{ __('lang.country') }} </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($update)
                                                @php
                                                    $increment = 1;
                                                @endphp
                                                @foreach ($teacher_culturallevels as $cultural)
                                                    <tr>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="cultural_level_{{ $increment }}"
                                                                placeholder="{{ __('lang.culturalLevel') }}"
                                                                value="{{ $cultural->cultural_level }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="culturalLevel_major_name_{{ $increment }}"
                                                                placeholder="{{ __('lang.majorName') }}"
                                                                value="{{ $cultural->culturalLevel_major_name }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                id="cultural_recieveDate{{ $increment }}"
                                                                name="culturalLevel_recieve_date_{{ $increment }}"
                                                                placeholder="{{ __('lang.recieveDate') }}"
                                                                value="{{ $cultural->culturalLevel_recieve_date }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text" name="country_{{ $increment }}"
                                                                placeholder="{{ __('lang.country') }}"
                                                                value="{{ $cultural->country }}">
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $increment++;
                                                    @endphp
                                                @endforeach
                                            @elseif (old('trTableCulturalLevel'))
                                                @for ($i = 1; $i <= old('trTableCulturalLevel'); $i++)
                                                    <tr>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="cultural_level_{{ $i }}"
                                                                placeholder="{{ __('lang.culturalLevel') }}"
                                                                value="{{ old('cultural_level_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="culturalLevel_major_name_{{ $i }}"
                                                                placeholder="{{ __('lang.majorName') }}"
                                                                value="{{ old('culturalLevel_major_name_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                id="cultural_recieveDate{{ $i }}"
                                                                name="culturalLevel_recieve_date_{{ $i }}"
                                                                placeholder="{{ __('lang.recieveDate') }}"
                                                                value="{{ old('culturalLevel_recieve_date_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text" name="country_{{ $i }}"
                                                                placeholder="{{ __('lang.country') }}"
                                                                value="{{ old('country_' . $i) }}">
                                                        </td>
                                                    </tr>
                                                @endfor
                                            @else
                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="cultural_level_1"
                                                            placeholder="{{ __('lang.culturalLevel') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="culturalLevel_major_name_1"
                                                            placeholder="{{ __('lang.majorName') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="cultural_recieveDate1"
                                                            name="culturalLevel_recieve_date_1"
                                                            placeholder="{{ __('lang.recieveDate') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="country_1"
                                                            placeholder="{{ __('lang.country') }}">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="cultural_level_2"
                                                            placeholder="{{ __('lang.culturalLevel') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="culturalLevel_major_name_2"
                                                            placeholder="{{ __('lang.majorName') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="cultural_recieveDate2"
                                                            name="recieve_date_2"
                                                            placeholder="{{ __('lang.recieveDate') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="country_2"
                                                            placeholder="{{ __('lang.country') }}">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="cultural_level_3"
                                                            placeholder="{{ __('lang.culturalLevel') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="culturalLevel_major_name_3"
                                                            placeholder="{{ __('lang.majorName') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="cultural_recieveDate3"
                                                            name="recieve_date_3"
                                                            placeholder="{{ __('lang.recieveDate') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="country_3"
                                                            placeholder="{{ __('lang.country') }}">
                                                    </td>
                                                </tr>
                                            @endif


                                        </tbody>
                                    </table>

                                    <div class="two wide field ui mini action input mb-3">
                                        <input type="number" id="teacherculturalLevelTableAddrowValue"
                                            value="1" min="1" max="5">
                                        <button type="button" class="mini ui button"
                                            id="teacherculturalLevelTableAddrowBtn"> <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                </div>



                                {{-- section 7 --}}
                                <div class="col-md-12 my-3">
                                    <h3 class="pb-2 ui red header border-bottom">7. {{ __('lang.pedagogyCourse') }}
                                        <small class="text-dark">( {{ __('lang.optional') }} )</small>
                                    </h3>
                                </div>

                                <div class="col-md-12  table-responsive">
                                    <table class="table table-sm" id="teacherpedagogyCourseTable">
                                        <thead>
                                            <tr>
                                                <th scope="col"> {{ __('lang.ProfessionalLevel') }} </th>
                                                <th scope="col"> {{ __('lang.Specialty1') }} </th>
                                                <th scope="col"> {{ __('lang.Specialty2') }} </th>
                                                <th scope="col"> {{ __('lang.TrainingSystem') }} </th>
                                                <th scope="col"> {{ __('lang.recieveDate') }} </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($update)
                                                @php
                                                    $increment = 1;
                                                @endphp
                                                @foreach ($teacher_pedagogyCourses as $pedagogyCourse)
                                                    <tr>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="professional_level_{{ $increment }}"
                                                                placeholder="{{ __('lang.ProfessionalLevel') }}"
                                                                value="{{ $pedagogyCourse->professional_level }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="specialty_first_{{ $increment }}"
                                                                placeholder="{{ __('lang.Specialty1') }}"
                                                                value="{{ $pedagogyCourse->specialty_first }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="specialty_second_{{ $increment }}"
                                                                placeholder="{{ __('lang.Specialty2') }}"
                                                                value="{{ $pedagogyCourse->specialty_second }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="training_system_{{ $increment }}"
                                                                placeholder="{{ __('lang.TrainingSystem') }}"
                                                                value="{{ $pedagogyCourse->training_system }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                id="pedagogyCourse{{ $increment }}"
                                                                name="pedagogyCourse_recieve_date_{{ $increment }}"
                                                                placeholder="{{ __('lang.recieveDate') }}"
                                                                value="{{ $pedagogyCourse->pedagogyCourse_recieve_date }}">
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $increment++;
                                                    @endphp
                                                @endforeach
                                            @elseif (old('trTablePedagogyCourse'))
                                                @for ($i = 1; $i <= old('trTablePedagogyCourse'); $i++)
                                                    <tr>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="professional_level_{{ $i }}"
                                                                placeholder="{{ __('lang.ProfessionalLevel') }}"
                                                                value="{{ old('professional_level_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="specialty_first_{{ $i }}"
                                                                placeholder="{{ __('lang.Specialty1') }}"
                                                                value="{{ old('specialty_first_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="specialty_second_{{ $i }}"
                                                                placeholder="{{ __('lang.Specialty2') }}"
                                                                value="{{ old('specialty_second_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="training_system_{{ $i }}"
                                                                placeholder="{{ __('lang.TrainingSystem') }}"
                                                                value="{{ old('training_system_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                id="pedagogyCourse{{ $i }}"
                                                                name="pedagogyCourse_recieve_date_{{ $i }}"
                                                                placeholder="{{ __('lang.recieveDate') }}"
                                                                value="{{ old('pedagogyCourse_recieve_date_' . $i) }}">
                                                        </td>
                                                    </tr>
                                                @endfor
                                            @else
                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="professional_level_1"
                                                            placeholder="{{ __('lang.ProfessionalLevel') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="specialty_first_1"
                                                            placeholder="{{ __('lang.Specialty1') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="specialty_second_1"
                                                            placeholder="{{ __('lang.Specialty2') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="training_system_1"
                                                            placeholder="{{ __('lang.TrainingSystem') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="pedagogyCourse1"
                                                            name="pedagogyCourse_recieve_date_1"
                                                            placeholder="{{ __('lang.recieveDate') }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="professional_level_2"
                                                            placeholder="{{ __('lang.ProfessionalLevel') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="specialty_first_2"
                                                            placeholder="{{ __('lang.Specialty1') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="specialty_second_2"
                                                            placeholder="{{ __('lang.Specialty2') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="training_system_2"
                                                            placeholder="{{ __('lang.TrainingSystem') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="pedagogyCourse2"
                                                            name="pedagogyCourse_recieve_date_2"
                                                            placeholder="{{ __('lang.recieveDate') }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="professional_level_3"
                                                            placeholder="{{ __('lang.ProfessionalLevel') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="specialty_first_3"
                                                            placeholder="{{ __('lang.Specialty1') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="specialty_second_3"
                                                            placeholder="{{ __('lang.Specialty2') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="training_system_3"
                                                            placeholder="{{ __('lang.TrainingSystem') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="pedagogyCourse3"
                                                            name="pedagogyCourse_recieve_date_3"
                                                            placeholder="{{ __('lang.recieveDate') }}">
                                                    </td>
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>

                                    <div class="two wide field ui mini action input mb-3">
                                        <input type="number" id="teacherpedagogyCourseTableAddrowValue"
                                            value="1" min="1" max="5">
                                        <button type="button" class="mini ui button"
                                            id="teacherpedagogyCourseTableAddrowBtn"> <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                {{-- section 8 --}}
                                <div class="col-md-12 my-3">
                                    <h3 class="pb-2 ui red header border-bottom">8. {{ __('lang.shortCourse') }}
                                        <small class="text-dark">( {{ __('lang.optional') }} )</small>
                                    </h3>
                                </div>

                                <div class="col-md-12  table-responsive">
                                    <table class="table table-sm" id="teacherShortCourseTable">
                                        <thead>
                                            <tr>
                                                <th scope="col"> {{ __('lang.section') }} </th>
                                                <th scope="col"> {{ __('lang.majorName') }} </th>
                                                <th scope="col"> {{ __('lang.startDate') }} </th>
                                                <th scope="col"> {{ __('lang.finishDate') }} </th>
                                                <th scope="col"> {{ __('lang.duration') }} </th>
                                                <th scope="col"> {{ __('lang.prepareBy') }} </th>
                                                <th scope="col"> {{ __('lang.supportBy') }} </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($update)
                                                @php
                                                    $increment = 1;
                                                @endphp
                                                @foreach ($teacher_shortcourses as $shortCourse)
                                                    <tr>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="course_section_{{ $increment }}"
                                                                placeholder="{{ __('lang.section') }}"
                                                                value="{{ $shortCourse->course_section }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="course_major_name_{{ $increment }}"
                                                                placeholder="{{ __('lang.majorName') }}"
                                                                value="{{ $shortCourse->course_major_name }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                id="course_start_date{{ $increment }}"
                                                                name="course_start_date_{{ $increment }}"
                                                                placeholder="{{ __('lang.startDate') }}"
                                                                value="{{ $shortCourse->course_start_date }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                id="course_finish_date{{ $increment + 1 }}"
                                                                name="course_finish_date_{{ $increment }}"
                                                                placeholder="{{ __('lang.finishDate') }}"
                                                                value="{{ $shortCourse->course_finish_date }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="course_duration_{{ $increment }}"
                                                                placeholder="{{ __('lang.duration') }}"
                                                                value="{{ $shortCourse->course_duration }}">
                                                        </td>

                                                        <td class="field">
                                                            <input type="text"
                                                                name="course_prepare_by_{{ $increment }}"
                                                                placeholder="{{ __('lang.prepareBy') }}"
                                                                value="{{ $shortCourse->course_prepare_by }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="course_support_by_{{ $increment }}"
                                                                placeholder="{{ __('lang.supportBy') }}"
                                                                value="{{ $shortCourse->course_support_by }}">
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $increment++;
                                                    @endphp
                                                @endforeach
                                            @elseif (old('trTableShortCourse'))
                                                @for ($i = 1; $i <= old('trTableShortCourse'); $i++)
                                                    <tr>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="course_section_{{ $i }}"
                                                                placeholder="{{ __('lang.section') }}"
                                                                value="{{ old('course_section_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="course_major_name_{{ $i }}"
                                                                placeholder="{{ __('lang.majorName') }}"
                                                                value="{{ old('course_major_name_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                id="course_start_date{{ $i }}"
                                                                name="course_start_date_{{ $i }}"
                                                                placeholder="{{ __('lang.startDate') }}"
                                                                value="{{ old('course_start_date_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                id="course_finish_date{{ $i + 1 }}"
                                                                name="course_finish_date_{{ $i }}"
                                                                placeholder="{{ __('lang.finishDate') }}"
                                                                value="{{ old('course_finish_date_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="course_duration_{{ $i }}"
                                                                placeholder="{{ __('lang.duration') }}"
                                                                value="{{ old('course_duration_' . $i) }}">
                                                        </td>

                                                        <td class="field">
                                                            <input type="text"
                                                                name="course_prepare_by_{{ $i }}"
                                                                placeholder="{{ __('lang.prepareBy') }}"
                                                                value="{{ old('course_prepare_by_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="course_support_by_{{ $i }}"
                                                                placeholder="{{ __('lang.supportBy') }}"
                                                                value="{{ old('course_support_by_' . $i) }}">
                                                        </td>
                                                    </tr>
                                                @endfor
                                            @else
                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="course_section_1"
                                                            placeholder="{{ __('lang.section') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="course_major_name_1"
                                                            placeholder="{{ __('lang.majorName') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="course_start_date1"
                                                            name="course_start_date_1"
                                                            placeholder="{{ __('lang.startDate') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="course_finish_date2"
                                                            name="course_finish_date_1"
                                                            placeholder="{{ __('lang.finishDate') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="course_duration_1"
                                                            placeholder="{{ __('lang.duration') }}">
                                                    </td>

                                                    <td class="field">
                                                        <input type="text" name="course_prepare_by_1"
                                                            placeholder="{{ __('lang.prepareBy') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="course_support_by_1"
                                                            placeholder="{{ __('lang.supportBy') }}">
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="course_section_2"
                                                            placeholder="{{ __('lang.section') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="course_major_name_2"
                                                            placeholder="{{ __('lang.majorName') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="course_start_date3"
                                                            name="course_start_date_2"
                                                            placeholder="{{ __('lang.startDate') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="course_finish_date4"
                                                            name="course_finish_date_2"
                                                            placeholder="{{ __('lang.finishDate') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="course_duration_2"
                                                            placeholder="{{ __('lang.duration') }}">
                                                    </td>

                                                    <td class="field">
                                                        <input type="text" name="course_prepare_by_2"
                                                            placeholder="{{ __('lang.prepareBy') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="course_support_by_2"
                                                            placeholder="{{ __('lang.supportBy') }}">
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="course_section_3"
                                                            placeholder="{{ __('lang.section') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="course_major_name_3"
                                                            placeholder="{{ __('lang.majorName') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="course_start_date5"
                                                            name="course_start_date_3"
                                                            placeholder="{{ __('lang.startDate') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="course_finish_date6"
                                                            name="course_finish_date_3"
                                                            placeholder="{{ __('lang.finishDate') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="course_duration_3"
                                                            placeholder="{{ __('lang.duration') }}">
                                                    </td>

                                                    <td class="field">
                                                        <input type="text" name="course_prepare_by_3"
                                                            placeholder="{{ __('lang.prepareBy') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="course_support_by_3"
                                                            placeholder="{{ __('lang.supportBy') }}">
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>

                                    <div class="two wide field ui mini action input mb-3">
                                        <input type="number" id="teacherShortCourseTableAddrowValue"
                                            value="1" min="1" max="5">
                                        <button class="mini ui button" id="teacherShortCourseTableAddrowBtn"> <i
                                                class="bi bi-plus"></i> </button>
                                    </div>
                                </div>



                                {{-- section 9 --}}
                                <div class="col-md-12 my-3">
                                    <h3 class="pb-2 ui red header border-bottom">9. {{ __('lang.Foreignlanguage') }}
                                        <small class="text-dark">( {{ __('lang.optional') }} )</small>
                                    </h3>
                                </div>

                                <div class="col-md-12  table-responsive">
                                    <table class="table table-sm" id="teacherForeignlanguageTable">
                                        <thead>
                                            <tr>
                                                <th scope="col"> {{ __('lang.language') }} </th>
                                                <th scope="col"> {{ __('lang.reading') }} </th>
                                                <th scope="col"> {{ __('lang.writing') }} </th>
                                                <th scope="col"> {{ __('lang.conversation') }} </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($update)
                                                @php
                                                    $increment = 1;
                                                @endphp
                                                @foreach ($teacher_foriegnlangs as $foreignlanguage)
                                                    <tr>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="language_{{ $increment }}"
                                                                placeholder="{{ __('lang.language') }}"
                                                                value="{{ $foreignlanguage->language }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="reading_{{ $increment }}"
                                                                placeholder="{{ __('lang.reading') }}"
                                                                value="{{ $foreignlanguage->reading }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="writing_{{ $increment }}"
                                                                placeholder="{{ __('lang.writing') }}"
                                                                value="{{ $foreignlanguage->writing }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="conversation_{{ $increment }}"
                                                                placeholder="{{ __('lang.conversation') }}"
                                                                value="{{ $foreignlanguage->conversation }}">
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $increment++;
                                                    @endphp
                                                @endforeach
                                            @elseif (old('trTableForeignlanguage'))
                                                @for ($i = 1; $i <= old('trTableForeignlanguage'); $i++)
                                                    <tr>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="language_{{ $i }}"
                                                                placeholder="{{ __('lang.language') }}"
                                                                value="{{ old('language_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="reading_{{ $i }}"
                                                                placeholder="{{ __('lang.reading') }}"
                                                                value="{{ old('reading_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="writing_{{ $i }}"
                                                                placeholder="{{ __('lang.writing') }}"
                                                                value="{{ old('writing_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="conversation_{{ $i }}"
                                                                placeholder="{{ __('lang.conversation') }}"
                                                                value="{{ old('conversation_' . $i) }}">
                                                        </td>
                                                    </tr>
                                                @endfor
                                            @else
                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="language_1"
                                                            placeholder="{{ __('lang.language') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="reading_1"
                                                            placeholder="{{ __('lang.reading') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="writing_1"
                                                            placeholder="{{ __('lang.writing') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="conversation_1"
                                                            placeholder="{{ __('lang.conversation') }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="language_2"
                                                            placeholder="{{ __('lang.language') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="reading_2"
                                                            placeholder="{{ __('lang.reading') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="writing_2"
                                                            placeholder="{{ __('lang.writing') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="conversation_2"
                                                            placeholder="{{ __('lang.conversation') }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="language_3"
                                                            placeholder="{{ __('lang.language') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="reading_3"
                                                            placeholder="{{ __('lang.reading') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="writing_3"
                                                            placeholder="{{ __('lang.writing') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="conversation_3"
                                                            placeholder="{{ __('lang.conversation') }}">
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>

                                    <div class="two wide field ui mini action input mb-3">
                                        <input type="number" id="teacherForeignlanguageTableAddrowValue"
                                            value="1" min="1" max="5">
                                        <button type="button" class="mini ui button"
                                            id="teacherForeignlanguageTableAddrowBtn"> <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                </div>



                                {{-- section 9 --}}
                                <div class="col-md-12 my-3">
                                    <h3 class="pb-2 ui red header border-bottom">10. {{ __('lang.familyStatus') }}
                                        <small class="text-dark">( {{ __('lang.optional') }} )</small>
                                    </h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="field">
                                        <label>{{ __('lang.familyStatus') }}</label>
                                        <input type="text" name="family_status"
                                            placeholder="{{ __('lang.familyStatus') }}"
                                            value="@if($update){{ $teacher->family_status }}@else{{ old('family_status') }}@endif">
                                    </div>
                                    <div class="field">
                                        <label>{{ __('lang.mustBe') }}</label>
                                        <input type="text" name="must_be"
                                            placeholder="{{ __('lang.mustBe') }}"
                                            value="@if($update){{ $teacher->must_be }}@else{{ old('must_be') }}@endif">
                                    </div>
                                    <div class="field">
                                        <label>{{ __('lang.occupation') }}</label>
                                        <input type="text" name="occupation"
                                            placeholder="{{ __('lang.occupation') }}"
                                            value="@if($update){{ $teacher->occupation }}@else{{ old('occupation') }}@endif">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="field">
                                        <label>{{ __('lang.name_confederate') }}</label>
                                        <input type="text" name="name_confederate"
                                            placeholder="{{ __('lang.name_confederate') }}"
                                            value="@if($update){{ $teacher->name_confederate }}@else{{ old('name_confederate') }}@endif">
                                    </div>
                                    <div class="field">
                                        <label>{{ __('lang.confederation') }}</label>
                                        <input type="text" name="confederation"
                                            placeholder="{{ __('lang.confederation') }}"
                                            value="@if($update){{ $teacher->confederation }}@else{{ old('confederation') }}@endif">
                                    </div>
                                    <div class="two fields">
                                        <div class="field">
                                            <label>{{ __('lang.birth_date_spouse') }}</label>
                                            <input type="text" id="birth_date_spouse" name="birth_date_spouse"
                                                placeholder="{{ __('lang.birth_date_spouse') }}"
                                                value="@if($update){{ $teacher->birth_date_spouse }}@else{{ old('birth_date_spouse') }}@endif">
                                        </div>
                                        <div class="field">
                                            <label>{{ __('lang.wife_salary') }}</label>
                                            <input type="text" name="wife_salary"
                                                placeholder="{{ __('lang.wife_salary') }}"
                                                value="@if($update){{ $teacher->wife_salary }}@else{{ old('wife_salary') }}@endif">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-2 table-responsive">
                                    <table class="table table-sm" id="teacherChildrenTable">
                                        <thead>
                                            <tr>
                                                <th scope="col"> {{ __('lang.childName') }} </th>
                                                <th scope="col"> {{ __('lang.gender') }} </th>
                                                <th scope="col"> {{ __('lang.birthDate') }} </th>
                                                <th scope="col"> {{ __('lang.occupation') }} </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($update)
                                                @php
                                                    $increment = 1;
                                                @endphp
                                                @foreach ($teacher_childrens as $children)
                                                    <tr>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="child_name_{{ $increment }}"
                                                                placeholder="{{ __('lang.childName') }}"
                                                                value="{{ $children->child_name }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="chile_gender_{{ $increment }}"
                                                                placeholder="{{ __('lang.gender') }}"
                                                                value="{{ $children->gender }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                id="childBirthDate{{ $increment }}"
                                                                name="child_birth_date_{{ $increment }}"
                                                                placeholder="{{ __('lang.birthDate') }}"
                                                                value="{{ $children->birth_date }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="child_occupation_{{ $increment }}"
                                                                placeholder="{{ __('lang.occupation') }}"
                                                                value="{{ $children->occupation }}">
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $increment++;
                                                    @endphp
                                                @endforeach
                                            @elseif (old('trTableChildren'))
                                                @for ($i = 1; $i <= old('trTableChildren'); $i++)
                                                    <tr>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="child_name_{{ $i }}"
                                                                placeholder="{{ __('lang.childName') }}"
                                                                value="{{ old('child_name_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="chile_gender_{{ $i }}"
                                                                placeholder="{{ __('lang.gender') }}"
                                                                value="{{ old('chile_gender_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                id="childBirthDate{{ $i }}"
                                                                name="child_birth_date_{{ $i }}"
                                                                placeholder="{{ __('lang.birthDate') }}"
                                                                value="{{ old('child_birth_date_' . $i) }}">
                                                        </td>
                                                        <td class="field">
                                                            <input type="text"
                                                                name="child_occupation_{{ $i }}"
                                                                placeholder="{{ __('lang.occupation') }}"
                                                                value="{{ old('child_occupation_' . $i) }}">
                                                        </td>
                                                    </tr>
                                                @endfor
                                            @else
                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="child_name_1"
                                                            placeholder="{{ __('lang.childName') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="chile_gender_1"
                                                            placeholder="{{ __('lang.gender') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="childBirthDate1"
                                                            name="child_birth_date_1"
                                                            placeholder="{{ __('lang.birthDate') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="child_occupation_1"
                                                            placeholder="{{ __('lang.occupation') }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="child_name_2"
                                                            placeholder="{{ __('lang.childName') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="child_gender_2"
                                                            placeholder="{{ __('lang.gender') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="childBirthDate2"
                                                            name="child_birth_date_2"
                                                            placeholder="{{ __('lang.birthDate') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="child_occupation_2"
                                                            placeholder="{{ __('lang.occupation') }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="field">
                                                        <input type="text" name="child_name_3"
                                                            placeholder="{{ __('lang.childName') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="child_gender_3"
                                                            placeholder="{{ __('lang.gender') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" id="childBirthDate3"
                                                            name="child_birth_date_3"
                                                            placeholder="{{ __('lang.birthDate') }}">
                                                    </td>
                                                    <td class="field">
                                                        <input type="text" name="child_occupation_3"
                                                            placeholder="{{ __('lang.occupation') }}">
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>

                                    <div class="two wide field ui mini action input mb-3">
                                        <input type="number" id="teacherChildrenTableAddrowValue" value="1"
                                            min="1" max="5">
                                        <button type="button" class="mini ui button"
                                            id="teacherChildrenTableAddrowBtn"> <i class="bi bi-plus"></i> </button>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-2">
                                    <div class="two fields">
                                        <div class="field">
                                            <label>{{ __('lang.phone_number') }}</label>
                                            <input type="text" name="phone_number"
                                                placeholder="{{ __('lang.phone_number') }}"
                                                value="@if($update){{ $teacher->phone_number }}@else{{ old('phone_number') }}@endif">
                                        </div>
                                        <div class="field">
                                            <label>{{ __('lang.email_add') }}</label>
                                            <input type="email" name="email_add"
                                                placeholder="{{ __('lang.email_add') }}"
                                                value="@if($update){{ $teacher->email_add }}@else{{ old('email_add') }}@endif">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label>{{ __('lang.current_add') }}</label>
                                        <textarea name="current_add" placeholder="{{ __('lang.current_add') }}" cols="30" rows="5">
@if ($update){{ $teacher->current_add }}@else{{ old('current_add') }}@endif
</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 d-none">
                                    <div class="two fields">
                                        <div class="field"><input type="hidden" class="d-none"
                                                name="trTableProfessional" id="teacherProfessionalTableCountTr"
                                                value=""></div>
                                        <div class="field"><input type="hidden" class="d-none"
                                                name="trTableWorkHistory" id="teacherWorkHistoryTableCountTr"
                                                value=""></div>
                                        <div class="field"><input type="hidden" class="d-none"
                                                name="trTablePraiseBlame" id="teacherPraiseBlameTableCountTr"
                                                value=""></div>
                                        <div class="field"><input type="hidden" class="d-none"
                                                name="trTableCulturalLevel" id="teacherculturalLevelTableCountTr"
                                                value=""></div>
                                        <div class="field"><input type="hidden" class="d-none"
                                                name="trTablePedagogyCourse" id="teacherpedagogyCourseTableCountTr"
                                                value=""></div>
                                        <div class="field"><input type="hidden" class="d-none"
                                                name="trTableShortCourse" id="teacherShortCourseTableCountTr"
                                                value=""></div>
                                        <div class="field"><input type="hidden" class="d-none"
                                                name="trTableForeignlanguage"
                                                id="teacherForeignlanguageTableCountTr" value=""></div>
                                        <div class="field"><input type="hidden" class="d-none"
                                                name="trTableChildren" id="teacherChildrenTableCountTr"
                                                value=""></div>
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
            id_card: {
                identifier: 'id_card',
                rules: [{
                    type: 'empty',
                    prompt: '{{ __('lang.pleaseEnterid_card') }}'
                }]
            },
            username: {
                identifier: 'username',
                rules: [{
                    type: 'empty',
                    prompt: '{{ __('lang.pleaseEnterusername') }}'
                }]
            },
            password: {
                identifier: 'password',
                rules: [{

                    type: 'minLength[4]',
                    prompt: '{{ __('lang.pleaseEnterpasswordLest4Charecter') }}'
                }]
            },
            confirm_password: {
                identifier: 'confirm_password',
                rules: [{
                    type: 'match[password]',
                    prompt: '{{ __('lang.pleaseEnterconfirm_passwordAndMatchWithPassword') }}'
                }]
            },

            department_id: {
                identifier: 'department_id',
                rules: [{
                    type: 'empty',
                    prompt: '{{ __('lang.pleaseSelectDepartment') }}'
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

    $(document).ready(function() {
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
