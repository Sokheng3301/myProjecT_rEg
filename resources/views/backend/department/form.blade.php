@extends('backend.layout.master')
@section('title')
    {{__('lang.department')}}
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
            {{__('lang.updateDepartment')}}
        @else
            {{__('lang.addDepartment')}}
        @endif
    @endsection

    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row">
            <!-- Start col -->
                <div class="col-lg-12 connectedSortable">
                    
                <!-- /.card -->
                <!-- DIRECT CHAT -->
                    <div class="card mb-4">
                        <form class="ui form" method="POST" action="
                                @if ($update)
                                    {{ route('department.update', $department->id) }}
                                @else
                                    {{ route('department.store') }}
                                @endif" enctype="multipart/form-data" autoComplete="off">
                            @csrf
                            @method($update ? 'PUT' : 'POST')

                            <div class="card-header">
                                <h3 class="card-title">
                                    @if ($update)
                                        {{__('lang.updateDepartment')}}
                                    @else
                                        {{__('lang.addDepartment')}}
                                    @endif
                                </h3>
                                <div class="card-tools">
                                    {{-- <span title="3 New Messages" class="badge text-bg-primary"> 3 </span> --}}
                                    <a href="{{ route('department.index') }}" class="ui button small">
                                        {{ __('lang.cancel') }}
                                    </a>
                                    <button type="submit" class="ui button small @if ($update)
                                        {{-- {{ $department->dep_code }} --}}
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
                                    <div class="col-md-6">
                                        <input type="file" class="d-none" name="dep_logo" id="dep_logo" accept="image/*" onchange="document.getElementById('dep_logo_img').src = window.URL.createObjectURL(this.files[0])">
                                        <label for="dep_logo" class="file-upload">
                                            <img class="ui small image" @if ($update && $department->dep_logo)
                                                src="{{ asset($department->dep_logo) }}"
                                                @else
                                                src="{{ asset('dist/assets/img/white-image.png') }}"
                                                @endif alt="" id="dep_logo_img">
                                            <p class="text-center mt-3">{{__("lang.choseAlogoFileToUpload")}}</p>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="field">
                                            <label>{{ __('lang.departmentCode') }}</label>
                                            <input type="text" name="dep_code" placeholder="{{ __('lang.departmentCode') }}" value="@if ($update){{ $department->dep_code }}@else{{ old('dep_code') }}@endif">
                                        </div>
                                        @error('dep_code')
                                            <div class="text-danger mb-2">
                                               {{ __('lang.departmentCodeHasUsedAlaredy') }}
                                            </div>
                                        @enderror
                                        <div class="field">
                                            <label>{{ __('lang.departmentNameKh') }}</label>
                                            <input type="text" name="dep_name_kh" placeholder=" {{ __('lang.departmentNameKh') }} " value="@if ($update){{ $department->dep_name_kh }}@else{{ old('dep_name_kh') }}@endif">
                                        </div>
                                        <div class="field">
                                            <label>{{ __('lang.departmentNameEn') }}</label>
                                            <input type="text" name="dep_name_en" placeholder=" {{ __('lang.departmentNameEn') }} " value="@if ($update){{ $department->dep_name_en }}@else{{ old('dep_name_en') }}@endif">
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
            dep_code: {
                identifier: 'dep_code',
                rules: [
                    {
                        type   : 'empty',
                        prompt : '{{__("lang.pleaseEnterDepartmentCode")}}'
                    }
                ]
            },
            dep_name_kh: {
                identifier: 'dep_name_kh',
                rules: [
                    {
                        type   : 'empty',
                        prompt : '{{ __("lang.pleaseEnterDepartmentNameKh") }}'
                    }
                ]
            },
            dep_name_en: {
                identifier: 'dep_name_en',
                rules: [
                    {
                        type   : 'empty',
                        prompt : '{{ __("lang.pleaseEnterDepartmentNameEn") }}'
                    }
                ]
            },
            }
        });
    </script>
@endsection