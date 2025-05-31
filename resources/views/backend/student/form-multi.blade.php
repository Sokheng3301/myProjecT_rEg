@extends('backend.layout.master')
@section('title')
    {{ __('lang.Student') }}
@endsection
@section('css')
    <style>
        #bg-overlay{
            width: 100%;
            height: 100%;
            position: fixed;
            z-index: 1049;
            background: #94949419 !important;
            top: 0;
            left: 0;
            display: none;
        }
    </style>
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
    {{ __('lang.addMultiStudent') }}
@endsection

<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
        <div class="row">
            <!-- Start col -->
            <div class="col-md-7 connectedSortable">

                <!-- /.card -->
                <!-- DIRECT CHAT -->
                <div class="card mb-4">
                    <form class="ui form" method="POST" id="multi_add_form"
                        action="{{ route('student.storeMultiple') }}"
                        enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('POST')

                        <div class="card-header">
                            <h3 class="card-title">
                                {{ __('lang.addMultiStudent') }}
                            </h3>
                            <div class="card-tools">
                                {{-- <span title="3 New Messages" class="badge text-bg-primary"> 3 </span> --}}
                                <a href="{{ route('student.index') }}" class="ui button small">
                                    {{ __('lang.studentList') }}
                                </a>
                                <button type="submit"
                                    class="ui button small primary" title="Save">
                                    {{-- <i class="bi bi-plus-circle-fill"></i> --}}
                                        {{ __('lang.save') }}
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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="field">
                                                    <label>{{ __('lang.numberGenerate') }} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" name="number_student"
                                                        placeholder="{{ __('lang.numberGenerate') }}"
                                                        min="1"
                                                        value="{{ old('number_student') }}">
                                                </div>

                                                <div class="field">
                                                    <label>{{ __('lang.academyYear') }} <span
                                                            class="text-danger">*</span></label>
                                                    <select class="ui search dropdown" name="academy_year" id="academy_year">
                                                        <option value="">{{ __('lang.academyYear') }}
                                                        </option>
                                                        @foreach ($years as $y)
                                                            <option value="{{ $y->year }}"
                                                                @if (old('academy_year') == $y->year) selected @endif>
                                                                {{ $y->year }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="field">
                                                    <label>{{ __('lang.selectclass') }} <span
                                                            class="text-danger">*</span></label>
                                                    <select class="ui search dropdown1" name="class_id" id="class">
                                                        <option value="">{{ __('lang.selectclass') }}
                                                        </option>
                                                        @foreach ($classes as $cl)
                                                            <option value="{{ $cl->id }}"
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
                                            </div>
                                        </div>


                                        {{-- message here  --}}


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

                                        <div class="col-md-12 mt-3">
                                            <div class="ui error message"></div>
                                        </div>
                                        {{-- @if ($errors->any())
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
                                        @endif --}}
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

@if(session()->has('success'))
    <!-- Modal -->
    <div class="modal fade" id="modalListCanExport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalListCanExportLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalListCanExportLabel">{{__('lang.studentList')}} <span class="text-danger">({{ __("lang.authenticate") }})</span></h1>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">{{__("lang.no")}}</th>
                            <th scope="col">{{__('lang.username')}}</th>
                            <th scope="col">{{__("lang.password")}}</th>
                            <th scope="col">{{__("lang.idCard")}}</th>
                            <th scope="col">{{__("lang.fullnameKh")}}</th>
                            <th scope="col">{{__("lang.fullnameEn")}}</th>
                            <th scope="col">{{__("lang.birthDate")}}</th>
                            <th scope="col">{{__("lang.other")}}</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_export">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href="" id="link_export" class="ui button teal">
                    <i class="bi bi-file-earmark-spreadsheet pe-1"></i>
                    {{ __("lang.exportAsExcel")  }}
                </a>
                <button type="button" class="ui button red" id="close_btn">{{__("lang.close")}}</button>
            </div>
            </div>
        </div>
    </div>
@endif

<div id="bg-overlay">

</div>

@endsection
@section('script')
<script>
    // form validator
    $('.ui.form').form({
        fields: {
            number_student: {
                identifier: 'number_student',
                rules: [{
                    type: 'empty',
                    prompt: '{{ __('lang.pleaseEnternumber_student') }}'
                }]
            },
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
        }
    });

    $(document).ready(function () {
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

        // Show the modal using Bootstrap's modal method
        @if (session()->has("success"))
            $('#modalListCanExport').modal('show');
        @endif

        $(document).on('click', '#close_btn', function () {
            $('#bg-overlay').css('display', 'block');
            $('#modalListCanExport').css('zIndex', 1048);
            Swal.fire({
                    toast: true,
                    title: "{{ __('lang.areYouSure') }}",
                    text: "{{ __('lang.doYouWantToCloseWithoutExportData') }}",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "{{ __('lang.yesClose') }}",
                    cancelButtonText: "{{ __('lang.No') }}",
                    zIndex: 100000,
                }).then((result) => {
                if (result.isConfirmed) {
                    $('#bg-overlay').css('display', 'none');
                    $('#modalListCanExport').modal('hide');
                    // Swal.fire({
                    //     title: "Deleted!",
                    //     text: "Your file has been deleted.",
                    //     icon: "success"
                    // });
                }else if (result.isDismissed) {
                    // alert('HI');
                    $('#bg-overlay').css('display', 'none');
                    $('#modalListCanExport').css('zIndex', 1051);
                }
            });
        });
    });


    @if (session()->has('success'))
        $(document).ready(function() {
            // AJAX request on page load
            var route = "{{ route('student.saveExport', session('class_id')) }}";
            $('#link_export').attr('href', route);

            $.ajax({
                url: "{{ route('student.preview', session('class_id')) }}",
                method: 'GET',
                success: function(response) {
                    $('#tbody_export').html(response);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    @endif



</script>
@endsection
