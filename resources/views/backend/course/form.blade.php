@extends('backend.layout.master')
@section('title')
    {{__('lang.course')}}
@endsection
@section('content')

    {{-- <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">{{__("lang.department")}}</h3></div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#"> {{ __('lang.home') }} </a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('lang.department')}}</li>
                </ol>
                </div>
            </div>
        </div>
    </div> --}}

    @section('pageTitle')
        @if ($update)
            {{__('lang.updateCourse')}}
        @else
            {{__('lang.addCourse')}}
        @endif
    @endsection

    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row">
            <!-- Start col -->
                <div class="col-md-9 connectedSortable">

                <!-- /.card -->
                <!-- DIRECT CHAT -->
                    <div class="card mb-4">
                        <form class="ui form" method="POST" action="
                                @if ($update)
                                    {{ route('course.update', $course->id) }}
                                @else
                                    {{ route('course.store') }}
                                @endif" enctype="multipart/form-data" autoComplete="off">
                            @csrf
                            @method($update ? 'PUT' : 'POST')

                            <div class="card-header">
                                <h3 class="card-title">
                                    @if ($update)
                                        {{__('lang.updateCourse')}}
                                    @else
                                        {{__('lang.addCourse')}}
                                    @endif
                                </h3>
                                <div class="card-tools">
                                    {{-- <span title="3 New Messages" class="badge text-bg-primary"> 3 </span> --}}
                                    <a href="{{ route('course.index') }}" class="ui button small">
                                        {{ __('lang.cancel') }}
                                    </a>
                                    <button type="submit" class="ui button small @if($update) green @else primary @endif"  title="Save" >
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
                                    <div class="col-md-12">
                                        <div class="field {{ $errors->has('course_code') ? 'error' : '' }}">
                                            <label>{{ __('lang.courseCode') }} <span class="text-danger">*</span>
                                                @error('course_code')
                                                    <span class="text-danger ps-1">
                                                    {{ __('lang.courseCodeHasUsedAlaredy') }}
                                                    </span>
                                                @enderror
                                            </label>
                                             <input type="text" name="course_code" autofocus
                                                    placeholder="{{ __('lang.courseCode') }}"
                                                    value="@if($update){{$course->course_code}}@else{{old('course_code')}}@endif">
                                        </div>


                                        <div class="two fields">
                                            <div class="field">
                                                <label>{{ __('lang.courseNameKh') }} <span class="text-danger">*</span></label>
                                                <input type="text" name="course_name_kh" placeholder=" {{ __('lang.courseNameKh') }} " value="@if ($update){{ $course->course_name_kh }}@else{{ old('course_name_kh') }}@endif">
                                            </div>
                                            <div class="field">
                                                <label>{{ __('lang.courseNameEn') }} <span class="text-danger">*</span></label>
                                                <input type="text" name="course_name_en" placeholder=" {{ __('lang.courseNameEn') }} " value="@if ($update){{ $course->course_name_en }}@else{{ old('course_name_en') }}@endif">
                                            </div>
                                        </div>

                                        <div class="four fields">
                                            <div class="field">
                                                <label>{{ __('lang.credit') }} <span class="text-danger">*</span></label>
                                                <input type="number" min="0" name="course_credit" placeholder=" {{ __('lang.credit') }} " value="@if ($update){{ $course->course_credit }}@else{{ old('course_credit') }}@endif">
                                            </div>

                                            <div class="field">
                                                <label>{{ __('lang.theory') }} <span class="text-danger">*</span></label>
                                                <input type="number" min="0" name="course_theory" placeholder=" {{ __('lang.theory') }} " value="@if ($update){{ $course->course_theory }}@else{{ old('course_theory') }}@endif">
                                            </div>

                                            <div class="field">
                                                <label>{{ __('lang.execute') }} <span class="text-danger">*</span></label>
                                                <input type="number" min="0" name="course_execute" placeholder=" {{ __('lang.execute') }} " value="@if ($update){{ $course->course_execute }}@else{{ old('course_execute') }}@endif">
                                            </div>

                                            <div class="field">
                                                <label>{{ __('lang.apply') }} <span class="text-danger">*</span></label>
                                                <input type="number" min="0" name="course_apply" placeholder=" {{ __('lang.apply') }} " value="@if ($update){{ $course->course_apply }}@else{{ old('course_apply') }}@endif">
                                            </div>
                                        </div>

                                        <div class="two fields">
                                            <div class="field">
                                                <label>{{__('lang.department')}} <span class="text-danger">*</span></label>
                                                <select class="ui search icon dropdown" name="department_id">
                                                    <option value="">{{__('lang.selectDepartment')}}</option>
                                                    @foreach ($departments as $d)
                                                        <option value="{{ $d->id }}"
                                                            @if($update)
                                                                @if ($d->id == $course->department_id)
                                                                    selected
                                                                @endif
                                                            @else
                                                                {{ old('department_id') == $d->id ? 'selected' : '' }}
                                                            @endif>
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

                                            <div class="field">
                                                <label>{{__('lang.courseType')}} <span class="text-danger">*</span></label>
                                                <select class="ui search dropdown1" name="course_type">
                                                    <option value="">{{__('lang.selectcourseType')}}</option>
                                                    @foreach(\App\Http\Helpers\AppHelper::getCourseType() as $key => $value)
                                                        <option
                                                            @if($update)
                                                                {{ $key == $course->course_type ? 'selected' : '' }}
                                                            @else
                                                                {{ old('course_type') == $key ? 'selected' : '' }}
                                                            @endif
                                                            value="{{ $key }}">{{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label>{{ __('lang.duration') }} <span class="text-danger">*</span> </label>
                                            <div class="ui right labeled input">
                                                <input type="number" min="0" name="course_duration" placeholder="{{ __('lang.duration') }}" value="@if ($update){{ $course->course_duration }}@else{{ old('course_duration') }}@endif">
                                                <div class="ui label">
                                                    {{ __('lang.hours') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label for="course_purpose">{{ __('lang.purpose') }}</label>
                                            <textarea name="course_purpose" id="course_purpose" rows="3" placeholder="{{ __('lang.purpose') }}...">@if ($update){{ $course->course_purpose }}@else{{ old('course_purpose') }}@endif</textarea>
                                        </div>
                                        <div class="field">
                                            <label for="course_outcome">{{ __('lang.expectedOutcome') }}</label>
                                            <textarea name="course_outcome" id="course_outcome" rows="3" placeholder="{{ __('lang.expectedOutcome') }}...">@if ($update){{ $course->course_outcome }}@else{{ old('course_outcome') }}@endif</textarea>
                                        </div>
                                        <div class="field">
                                            <label for="course_description">{{ __('lang.description') }}</label>
                                            <textarea name="course_description" id="course_description" rows="3" placeholder="{{ __('lang.description') }}...">@if ($update){{ $course->course_description }}@else{{ old('course_description') }}@endif</textarea>
                                        </div>
                                        <div class="ui error message"></div>
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
        $('.ui.form').form({
            fields: {
            course_code: {
                identifier: 'course_code',
                rules: [
                    {
                        type   : 'empty',
                        prompt : '{{__("lang.pleaseEntercourse_code")}}'
                    }
                ]
            },
            course_name_kh: {
                identifier: 'course_name_kh',
                rules: [
                    {
                        type   : 'empty',
                        prompt : '{{ __("lang.pleaseEntercourse_name_kh") }}'
                    }
                ]
            },
            course_name_en: {
                identifier: 'course_name_en',
                rules: [
                    {
                        type   : 'empty',
                        prompt : '{{ __("lang.pleaseEntercourse_name_en") }}'
                    }
                ]
            },
            course_credit: {
                identifier: 'course_credit',
                rules: [
                    {
                        type   : 'empty',
                        prompt : '{{ __("lang.pleaseEntercourse_credit") }}'
                    }
                ]
            },
            course_theory: {
                identifier: 'course_theory',
                rules: [
                    {
                        type   : 'empty',
                        prompt : '{{ __("lang.pleaseEntercourse_theory") }}'
                    }
                ]
            },
            course_execute: {
                identifier: 'course_execute',
                rules: [
                    {
                        type   : 'empty',
                        prompt : '{{ __("lang.pleaseEntercourse_execute") }}'
                    }
                ]
            },

            course_apply: {
                identifier: 'course_apply',
                rules: [
                    {
                        type   : 'empty',
                        prompt : '{{ __("lang.pleaseEntercourse_apply") }}'
                    }
                ]
            },

            course_duration: {
                identifier: 'course_duration',
                rules: [
                    {
                        type   : 'empty',
                        prompt : '{{ __("lang.pleaseEntercourse_duration") }}'
                    }
                ]
            },

            course_type: {
                identifier: 'course_type',
                rules: [
                    {
                        type   : 'empty',
                        prompt : '{{ __("lang.pleaseSelectCourseType") }}'
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
            }
        });
    </script>
@endsection
