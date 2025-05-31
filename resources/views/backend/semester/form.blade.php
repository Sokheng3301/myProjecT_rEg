@php
    
@endphp
@extends('backend.layout.master')
@section('title')
    {{__('lang.semester')}}
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
            {{__('lang.updateSemester')}}
        @else
            {{__('lang.addSemester')}}
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
                                    {{ route('semester.update', $semester->id) }}
                                @else
                                    {{ route('semester.store') }}
                                @endif" enctype="multipart/form-data" autoComplete="off">
                            @csrf
                            @method($update ? 'PUT' : 'POST')

                            <div class="card-header">
                                <h3 class="card-title">
                                    @if ($update)
                                    {{ __('lang.updateSemester') }}
                                    @else
                                    {{__('lang.addSemester')}}
                                    @endif
                                </h3>
                                <div class="card-tools">
                                    {{-- <span title="3 New Messages" class="badge text-bg-primary"> 3 </span> --}}
                                    <a href="{{ route('semester.index') }}" class="ui button small">
                                        {{ __('lang.cancel') }}
                                    </a>
                                    <button type="submit" class="ui button small @if ($update)
                                        {{-- {{ $semester->dep_code }} --}}
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
                                            <label>{{ __('lang.semester') }}</label>
                                            <input type="number" name="semester" min="1" max="3" placeholder="{{ __('lang.semester') }}" value="@if ($update){{ $semester->semester }}@else{{ old('semester') }}@endif">
                                        </div>
                                        {{-- @error('class_code')
                                            <div class="text-danger mb-2">
                                               {{ __('lang.classCodeMessage') }}
                                            </div>
                                        @enderror --}}
                                        
                                        <div class="field">
                                            <label>{{ __('lang.startDate') }}</label>
                                            <input type="text" name="start_date" id="datepicker" placeholder="{{ __('lang.startDate') }}" value="@if ($update){{ \Illuminate\Support\Carbon::parse($semester->start_date)->format('m/d/Y') }}@else{{ old('start_date') }}@endif">
                                        </div>

                                        <div class="field">
                                            <label>{{ __('lang.finishDate') }}</label>
                                            <input type="text" name="finish_date" id="datepicker1" placeholder="{{ __('lang.finishDate') }}" value="@if ($update){{ \Illuminate\Support\Carbon::parse($semester->finish_date)->format('m/d/Y') }}@else{{ old('finish_date') }}@endif">
                                        </div>



                                       

                                        {{-- <div class="field">
                                            <label>{{__('lang.yearLevel')}}</label>
                                            <select class="ui search dropdown2" name="year_level">
                                                <option value="">{{__('lang.selectYearLevel')}}</option>
                                                @foreach (App\Http\Helpers\AppHelper::getYearLevel() as $key => $year_level)
                                                    <option value="{{ $key }}" 
                                                        @if($update)
                                                            @if ($key == $semester->year_level)
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
                                        </div> --}}

                                        <div class="field">
                                            <label>{{__('lang.academyYear')}}</label>
                                            <select class="ui search dropdown3" name="academy_year">
                                                <option value="">{{__('lang.selectacademyYear')}}</option>
                                                @foreach ($years as $y)
                                                    <option value="{{ $y->year }}" 
                                                        @if($update)
                                                            @if ($y->year == $semester->academy_year)
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
                semester: {
                    identifier: 'semester',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : '{{__("lang.pleaseEnterSemester")}}'
                        }
                    ]
                },
                start_date: {
                    identifier: 'start_date',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : '{{ __("lang.pleaseEnterStartDate") }}'
                        }
                    ]
                },
                finish_date: {
                    identifier: 'finish_date',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : '{{ __("lang.pleaseEnterFinishDate") }}'
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