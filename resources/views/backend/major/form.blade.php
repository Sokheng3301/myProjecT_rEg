@extends('backend.layout.master')
@section('title')
    {{__('lang.major')}}
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
            {{__('lang.updateMajor')}}
        @else
            {{__('lang.addMajor')}}
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
                                    {{ route('major.update', $major->id) }}
                                @else
                                    {{ route('major.store') }}
                                @endif" enctype="multipart/form-data" autoComplete="off">
                            @csrf
                            @method($update ? 'PUT' : 'POST')

                            <div class="card-header">
                                <h3 class="card-title">
                                    @if ($update)
                                    {{ __('lang.updateMajor') }}
                                    @else
                                    {{__('lang.addMajor')}}
                                    @endif
                                </h3>
                                <div class="card-tools">
                                    {{-- <span title="3 New Messages" class="badge text-bg-primary"> 3 </span> --}}
                                    <a href="{{ route('major.index') }}" class="ui button small">
                                        {{ __('lang.cancel') }}
                                    </a>
                                    <button type="submit" class="ui button small @if ($update)
                                        {{-- {{ $major->dep_code }} --}}
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
                                            <label>{{ __('lang.majorCode') }}</label>
                                            <input type="text" name="major_code" placeholder="{{ __('lang.majorCode') }}" value="@if ($update){{ $major->major_code }}@else{{ old('major_code') }}@endif">
                                        </div>
                                        @error('major_code')
                                            <div class="text-danger mb-2">
                                               {{ __('lang.majorCodeHasUsedAlaredy') }}
                                            </div>
                                        @enderror
                                        <div class="field">
                                            <label>{{ __('lang.majorNameKh') }}</label>
                                            <input type="text" name="major_name_kh" placeholder=" {{ __('lang.majorNameKh') }} " value="@if ($update){{ $major->major_name_kh }}@else{{ old('major_name_kh') }}@endif">
                                        </div>
                                        <div class="field">
                                            <label>{{ __('lang.majorNameEn') }}</label>
                                            <input type="text" name="major_name_en" placeholder=" {{ __('lang.majorNameEn') }} " value="@if ($update){{ $major->major_name_en }}@else{{ old('major_name_en') }}@endif">
                                        </div>
                                        <div class="field">
                                            <label>{{__('lang.department')}}</label>
                                            <select class="ui search dropdown" name="department_id">
                                            <option value="">{{__('lang.selectDepartment')}}</option>
                                            @foreach ($departments as $d)
                                                <option value="{{ $d->id }}" 
                                                    @if($update)
                                                        @if ($d->id == $major->department_id)
                                                            selected
                                                        @endif
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
                major_code: {
                    identifier: 'major_code',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : '{{__("lang.pleaseEntermajorCode")}}'
                        }
                    ]
                },
                major_name_kh: {
                    identifier: 'major_name_kh',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : '{{ __("lang.pleaseEntermajorNameKh") }}'
                        }
                    ]
                },
                major_name_en: {
                    identifier: 'major_name_en',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : '{{ __("lang.pleaseEntermajorNameEn") }}'
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