@php
    
@endphp
@extends('backend.layout.master')
@section('title')
    {{__('lang.classroom')}}
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
            {{__('lang.updateClassroom')}}
        @else
            {{__('lang.addClassroom')}}
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
                                    {{ route('classroom.update', $classroom->id) }}
                                @else
                                    {{ route('classroom.store') }}
                                @endif" enctype="multipart/form-data" autoComplete="off">
                            @csrf
                            @method($update ? 'PUT' : 'POST')

                            <div class="card-header">
                                <h3 class="card-title">
                                    @if ($update)
                                    {{ __('lang.updateClassroom') }}
                                    @else
                                    {{__('lang.addClassroom')}}
                                    @endif
                                </h3>
                                <div class="card-tools">
                                    {{-- <span title="3 New Messages" class="badge text-bg-primary"> 3 </span> --}}
                                    <a href="{{ route('classroom.index') }}" class="ui button small">
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
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mx-auto">
                                        <div class="field">
                                            <label>{{ __('lang.classroom') }}</label>
                                            <input type="text" name="class_room" placeholder="{{ __('lang.classroom') }}" value="@if ($update){{ $classroom->class_room }}@else{{ old('class_room') }}@endif">
                                        </div>
                                        <div class="field">
                                            <label>{{ __('lang.classroomEn') }}</label>
                                            <input type="text" name="classroom_en" placeholder="{{ __('lang.classroomEn') }}" value="@if ($update){{ $classroom->classroom_en }}@else{{ old('classroom_en') }}@endif">
                                        </div>

                                        @error('classroom_en')
                                            <div class="text-danger">
                                               {{ __('lang.classroomEnglishHasUsed') }}
                                            </div>
                                        @enderror
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
                class_room: {
                    identifier: 'class_room',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : '{{__("lang.pleaseEnterClassroomInKhmer")}}'
                        }
                    ]
                },
                classroom_en: {
                    identifier: 'classroom_en',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : '{{ __("lang.pleaseEnterClassroomInEnglish") }}'
                        }
                    ]
                },
            }
        });
    </script>
@endsection