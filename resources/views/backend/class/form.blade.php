@php
    
@endphp
@extends('backend.layout.master')
@section('title')
    {{__('lang.class')}}
@endsection
@section('content')

    {{-- <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">{{__("lang.class")}}</h3></div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#"> {{ __('lang.home') }} </a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('lang.class')}}</li>
                </ol>
                </div>
            </div>
        </div>
    </div> --}}
    
    @section('pageTitle')
        @if ($update)
            {{__('lang.updateclass')}}
        @else
            {{__('lang.addclass')}}
        @endif
    @endsection

    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row">
            <!-- Start col -->
                <div class="col-md-8 connectedSortable">
                    
                <!-- /.card -->
                <!-- DIRECT CHAT -->
                    <div class="card mb-4">
                        <form class="ui form" method="POST" action="
                                @if ($update)
                                    {{ route('class.update', $class->id) }}
                                @else
                                    {{ route('class.store') }}
                                @endif" enctype="multipart/form-data" autoComplete="off">
                            @csrf
                            @method($update ? 'PUT' : 'POST')

                            <div class="card-header">
                                <h3 class="card-title">
                                    @if ($update)
                                    {{ __('lang.updateclass') }}
                                    @else
                                    {{__('lang.addclass')}}
                                    @endif
                                </h3>
                                <div class="card-tools">
                                    {{-- <span title="3 New Messages" class="badge text-bg-primary"> 3 </span> --}}
                                    <a href="{{ route('class.index') }}" class="ui button small">
                                        {{ __('lang.cancel') }}
                                    </a>
                                    <button type="submit" class="ui button small @if ($update)
                                        {{-- {{ $class->dep_code }} --}}
                                            green
                                        @else
                                            primary
                                    @endif"  title="Save" >
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
                                    {{-- <div class="col-md-6">
                                        
                                    </div> --}}
                                    <div class="col-md-12 mx-auto">
                                        <div class="field">
                                            <label>{{ __('lang.classCode') }}</label>
                                            <input type="text" name="class_code" placeholder="{{ __('lang.classCode') }}" value="@if ($update){{ $class->class_code }}@else{{ old('class_code') }}@endif">
                                        </div>
                                        @error('class_code')
                                            <div class="text-danger mb-2">
                                               {{ __('lang.classCodeMessage') }}
                                            </div>
                                        @enderror
                                        
                                        <div class="field">
                                            <label>{{__('lang.major')}}</label>
                                            <select class="ui search dropdown" name="major_id">
                                                <option value="">{{__('lang.selectMajor')}}</option>
                                                @foreach ($majors as $m)
                                                    <option value="{{ $m->id }}" 
                                                        @if($update)
                                                            @if ($m->id == $class->major_id)
                                                                selected
                                                            @endif
                                                        @else
                                                            @if (old('major_id') == $m->id)
                                                                selected                                                                
                                                            @endif
                                                        @endif
                                                        
                                                    >
                                                        {{ $m->major_code }} - 
                                                        @if (session()->has('localization') && session('localization') == 'en')
                                                        {{ $m->major_name_en }} ( {{ $m->departments->dep_name_en }} )
                                                        @else
                                                        {{ $m->major_name_kh }} ( {{ $m->departments->dep_name_kh }} )
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="field">
                                            <label>{{__('lang.studyLevel')}}</label>
                                            <select class="ui search dropdown1" name="level_study">
                                                <option value="">{{__('lang.selectLevelStudy')}}</option>
                                                @foreach (App\Http\Helpers\AppHelper::getStudyLevel() as $key => $level)
                                                    <option value="{{ $key }}" 
                                                        @if($update && $key == $class->level_study)
                                                            selected
                                                        @else
                                                            @if (old('level_study') == $key)
                                                                selected
                                                            @endif
                                                        @endif
                                                    >
                                                        {{ $level }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="field">
                                            <label>{{__('lang.yearLevel')}}</label>
                                            <select class="ui search dropdown2" name="year_level">
                                                <option value="">{{__('lang.selectYearLevel')}}</option>
                                                @foreach (App\Http\Helpers\AppHelper::getYearLevel() as $key => $year_level)
                                                    <option value="{{ $key }}" 
                                                        @if($update)
                                                            @if ($key == $class->year_level)
                                                                selected
                                                            @endif
                                                        @else
                                                            @if (old('year_level') == $key)
                                                                selected
                                                            @endif
                                                        @endif
                                                        
                                                    >
                                                        {{ $year_level }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="field">
                                            <label>{{__('lang.academyYear')}}</label>
                                            <select class="ui search dropdown3" name="academy_year">
                                                <option value="">{{__('lang.selectacademyYear')}}</option>
                                                @foreach ($years as $y)
                                                    <option value="{{ $y->year }}" 
                                                        @if($update)
                                                            @if ($y->year == $class->academy_year)
                                                                selected
                                                            @endif
                                                        @else
                                                            @if (old('academy_year') == $y->year)
                                                                selected
                                                            @endif
                                                        @endif
                                                    >
                                                        {{ $y->year }}
                                                        
                                                    </option>
                                                @endforeach
                                            </select>
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
                class_code: {
                    identifier: 'class_code',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : '{{__("lang.pleaseEnterclassCode")}}'
                        }
                    ]
                },
                major_id: {
                    identifier: 'major_id',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : '{{ __("lang.selectMajor") }}'
                        }
                    ]
                },
                year_level: {
                    identifier: 'year_level',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : '{{ __("lang.selectYearLevel") }}'
                        }
                    ]
                },
                level_study: {
                    identifier: 'level_study',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : '{{ __("lang.selectLevelStudy") }}'
                        }
                    ]
                },
                academy_year: {
                    identifier: 'academy_year',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : '{{ __("lang.selectacademyYear") }}'
                        }
                    ]
                },
            }
        });
    </script>
@endsection