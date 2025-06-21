@php
    use Carbon\Carbon;
@endphp
@extends('backend.layout.master')
@section('title')
    {{__('lang.Student')}}
@endsection
@section('css')
    <style>
        #tableReload{
            background-color: #fafafa;
            width: 100%;
            height: 100%;
            position: absolute;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .dot {
            width: 10px;
            height: 10px;
            background-color: #333;
            border-radius: 50%;
            margin: 0 5px;
            opacity: 0;
            animation: bounce 1s infinite alternate;
        }
        .dot:nth-child(1) { animation-delay: 0s; }
        .dot:nth-child(2) { animation-delay: 0.2s; }
        .dot:nth-child(3) { animation-delay: 0.4s; }

        @keyframes bounce {
            from { opacity: 0.5; transform: translateY(0); }
            to { opacity: 1; transform: translateY(-15px); }
        }
    </style>
@endsection
@section('content')

    {{-- <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">{{__("lang.major")}}</h3></div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#"> {{ __('lang.home') }} </a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('lang.major')}}</li>
                </ol>
                </div>
            </div>
        </div>
    </div> --}}

    @section('pageTitle')
        {{__('lang.Student')}}
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
                        <div class="card-header">
                            <h3 class="card-title"><i class="bi bi-funnel-fill"></i> {{__('lang.filter') . __("lang.Student")}}</h3>
                            <div class="card-tools">
                                {{-- <span title="3 New Messages" class="badge text-bg-primary"> 3 </span> --}}
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                                {{-- <a href="{{ route('student.create') }}"
                                class="ui button small primary"
                                title="Add new">
                                <i class="bi bi-plus-circle-fill"></i>
                                {{ __('lang.addNew') }}
                                </a> --}}
                                {{-- <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                <i class="bi bi-x-lg"></i>
                                </button> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="" class="ui form">
                                <!-- Conversations are loaded here -->
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="field">
                                            <label for="search">{{__('lang.search')}}</label>
                                            <input type="text" name="search" id="search" placeholder="{{ __('lang.search') }}" value="{{ $search ?? old('search') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="field">
                                            <label for="academy_year">{{__("lang.selectacademyYear")}}</label>
                                            <select class="ui search w-100 dropdown" name="academy_year" id="academy_year">
                                                <option value="">{{ __('lang.academyYear') }}
                                                </option>
                                                @foreach ($years as $y)
                                                    <option value="{{ $y->year }}" @if ($year == $y->year) selected  @endif @if (old('academy_year') == $y->year) selected @endif
                                                        @if (old('academy_year') == $y->year) selected @endif>
                                                        {{ $y->year }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5 mb-3">
                                        <div class="field">
                                            <label for="class">{{ __('lang.selectclass') }} <small class="text-danger fw-normal">@if (session()->has('selectClass')) * {{ session('selectClass') }} @endif</small></label>
                                            <select class="ui search dropdown1" name="class_id" id="class">
                                                <option value="">{{ __('lang.selectclass') }}
                                                </option>
                                                @foreach ($classes as $cl)
                                                    <option value="{{ $cl->id }}"
                                                        @if (old('class_id') == $cl->id) selected @endif
                                                        @if ($class_id == $cl->id) selected @endif>
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
                                    {{-- <div class="col-md-5 ms-auto mb-3">
                                        <div class="ui error message"></div>
                                    </div> --}}
                                    <div class="col-md-12 text-end ">
                                        <button type="submit" id="search_btn" class="ui primary button">  {{ __('lang.search') }} </button>
                                        <a href="{{ route('student.index') }}" type="reset" class="ui button"> {{ __('lang.reset') }} </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @if ($students != null)

                    <div class="col-lg-12 connectedSortable">
                        <!-- /.card -->
                        <!-- DIRECT CHAT -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">{{__('lang.studentList')}}</h3>
                                <div class="card-tools">
                                    {{-- <span title="3 New Messages" class="badge text-bg-primary"> 3 </span> --}}
                                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                    </button>
                                    <div class="ui small icon buttons">
                                        {{-- <button class="ui button"><i class="file icon"></i></button> --}}
                                        <button class="ui button fw-normal" title="{{__('lang.print')}}"><i class="bi bi-printer"></i> {{__('lang.print')}}</button>
                                        <a href="{{ route('pdf.student', @$class_id) }}" class="ui red button fw-normal" title="{{ __('lang.exportAsPDF') }}"><i class="bi bi-file-pdf"></i> PDF</a>
                                        <button class="ui teal button fw-normal" title="{{ __("lang.exportAsExcel") }}"><i class="bi bi-file-earmark-spreadsheet"></i> Excel</button>
                                    </div>
                                    {{-- <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                    <i class="bi bi-x-lg"></i>
                                    </button> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Conversations are loaded here -->
                                <div class="table-responsive position-relative">
                                        <div id="tableReload">
                                            <div class="dot"></div>
                                            <div class="dot"></div>
                                            <div class="dot"></div>
                                        </div>
                                    <div class="myresponsive_table">
                                        <table class="table" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">{{__('lang.no')}}</th>
                                                    <th scope="col">{{__('lang.photoProfile')}}</th>
                                                    <th scope="col" class="text-start">{{__('lang.idCard')}}</th>
                                                    <th scope="col">{{__('lang.fullnameKh')}}</th>
                                                    <th scope="col">{{__('lang.nameEn')}}</th>
                                                    <th scope="col">{{__('lang.gender')}}</th>
                                                    <th scope="col">{{__('lang.birthDate')}}</th>
                                                    <th scope="col" class="text-start">{{__('lang.phone')}}</th>
                                                    <th scope="col" colspan="2" class="text-center">{{__('lang.accountStatus')}}</th>

                                                    {{-- <th scope="col" class="text-center">{{__('lang.action')}}</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = $incre = 1;

                                                @endphp
                                                @foreach ($students as $student)
                                                <tr>
                                                    <td class="{{ $student->delete_status == 0 ? 'text-danger' : '' }}">{{$i++}}</td>
                                                    <td><img class="ui mini image" src="{{ asset($student->profile ? $student->profile : 'dist/assets/img/white-image.png') }}" alt=""></td>
                                                    <td class="text-start {{ $student->delete_status == 0 ? 'text-danger' : '' }}">{{$student->id_card}}</td>
                                                    <td class="{{ $student->delete_status == 0 ? 'text-danger' : '' }}">{{$student->fullname_kh}}</td>
                                                    <td class="{{ $student->delete_status == 0 ? 'text-danger' : '' }} text-uppercase">{{$student->fullname_en}}</td>
                                                    <td class="{{ $student->delete_status == 0 ? 'text-danger' : '' }}" title="@if($student->gender != ''){{ $student->gender == 'm'?__("lang.male"):__('lang.female')}}@endif">
                                                        @if ($student->gender == 'm')
                                                            <i class="bi bi-gender-male" style="color: #0464ff;"></i>
                                                        @elseif($student->gender == 'f')
                                                            <i class="bi bi-gender-female" style="color: #ca0079;"></i>
                                                        @else

                                                        @endif

                                                    </td>
                                                    <td class="{{ $student->delete_status == 0 ? 'text-danger' : '' }}">{{$student->birth_date ? \Carbon\Carbon::parse($student->birth_date)->format('d-m-Y') : ''}}</td>
                                                    <td class="text-start {{ $student->delete_status == 0 ? 'text-danger' : '' }}">
                                                        @if ($student->phone)
                                                            <a href="tel:{{ $student->phone }}" class="text-decoration-none text-primary">{{ $student->phone }}</a>
                                                        @endif
                                                    </td>
                                                    <td class="text-end {{ $student->delete_status == 0 ? 'text-danger' : '' }}">
                                                        @if ($student->block_status == 1)
                                                            <span class="ui tiny green label">{{ __('lang.active') }}</span>
                                                        @else
                                                            <span class="ui tiny red label">{{ __('lang.blocked') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="ui d-flex">
                                                            <div class="ui floating dropdown dropdown{{ $incre++ }} icon">
                                                                {{-- <button class="circular ui icon button"></button> --}}
                                                                <i class="bi bi-three-dots-vertical text-muted"></i>
                                                                <div class="menu">
                                                                    <a title="About" href="{{ route('student.show', $student->id) }}" class="item"><i class="bi bi-eye-fill"></i> {{ __('lang.aboutStudent') }}</a>
                                                                    <a title="Update" href="{{ route('student.edit', $student->id) }}" class="item"><i class="bi bi-pencil-square"></i> {{ __("lang.update") }}</a>
                                                                    <div class="item">
                                                                        <button type="button" class="m-0 p-0 w-100 d-block border-0 bg-transparent text-start"
                                                                            style="outline: 0;"
                                                                            value="{{ $student->id_card }}"
                                                                            id="resetPass_button"
                                                                            title="Reset password">
                                                                            <i class="bi bi-unlock-fill"></i>{{__("lang.resetPassword")}}
                                                                        </button>
                                                                        {{-- <i class="bi bi-unlock-fill"></i> {{__("lang.resetPassword")}} --}}
                                                                    </div>

                                                                    <div class="item">
                                                                        <button type="button" class="m-0 p-0 w-100 d-block border-0 bg-transparent text-start"
                                                                            style="outline: 0;"
                                                                            value="{{ $student->id }}"
                                                                            id="leave_button"
                                                                            title="Leave">
                                                                            <i class="bi bi-box-arrow-up-left"></i> {{__("lang.dropOut")}}
                                                                        </button>
                                                                    </div>

                                                                    <div class="item text-start">
                                                                        <button type="button" class="m-0 p-0 w-100 d-block border-0 bg-transparent
                                                                            {{ $student->block_status == 1 ? 'text-danger' : 'text-success' }} text-start"
                                                                            style="outline: 0;"
                                                                            value="{{ $student->id_card }}"
                                                                            id="{{ $student->block_status == 1 ? 'block_button': 'unblock_button' }}"
                                                                            title="{{ $student->block_status == 1 ? 'Block' : 'Unblock' }}">

                                                                            <i class="bi {{ $student->block_status == 1 ? 'bi-ban text-danger' : 'bi-arrow-repeat text-success' }}"></i>

                                                                            {{ __('lang.' . ($student->block_status == 1 ? 'block' : 'unblock')) }}
                                                                        </button>
                                                                    </div>
                                                                    <div class="item text-start">
                                                                        <button type="button" class="m-0 p-0 w-100 d-block border-0 bg-transparent @if ($student->delete_status == 1) text-danger @else text-success @endif text-start" style="outline: 0;" value="{{ $student->id }}"
                                                                                @if($student->delete_status == 1)
                                                                                    id="delete_button"
                                                                                @else
                                                                                    id="restore_button"
                                                                                @endif
                                                                                    title="@if ($student->delete_status == 1)
                                                                                    Delete
                                                                                @else
                                                                                    Restore
                                                                                @endif "> <i class="bi @if ($student->  delete_status == 1)
                                                                                    bi-trash text-danger
                                                                                    @else
                                                                                    bi-arrow-clockwise text-success
                                                                                @endif "></i>
                                                                                @if ($student->delete_status == 1)
                                                                                    {{__('lang.delete')}}
                                                                                @else
                                                                                    {{__('lang.restore')}}
                                                                                @endif
                                                                        </button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif

            </div>
        </div>
    </div>

    <!-- Modal Leave Verify -->
    <div class="modal fade" id="leave_verify_form" data-bs-backdrop="static" tabindex="-1" aria-labelledby="readInfoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ui medium header" id="readInfoLabel"></i> {{ __('lang.pleaseEnterFormToVerifyDropout') }} </h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <form action="" id="verifyFormModal" class="ui form" method="POST" autocomplete="off">
                    {{-- <form action="{{ route('teacher.leave') }}" id="verifyFormModal" class="ui form" method="POST" autocomplete="off"> --}}
                    @csrf
                    <div class="modal-body">
                        <div class="field">
                            <label for="datepicker"> {{ __('lang.dropOutDate') }} </label>
                            <div class="ui icon left input">
                                <input type="text" id="datepicker"  name="leave_date" placeholder="{{ __('lang.m/d/y') }}" required>
                                <i class="bi bi-calendar3 icon"></i>
                            </div>
                        </div>
                        <div class="field">
                            <label for="leave_reason"> {{ __('lang.dropOutReason') }} </label>
                            <div class="ui input">
                                <textarea name="leave_reason" id="leave_reason" cols="30" rows="5" placeholder="{{ __('lang.enterdropOutReason') }}" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="ui tiny primary button"> {{ __('lang.ok') }} </button>
                        <button type="button" class="ui tiny red button " data-bs-dismiss="modal"> {{ __('lang.cancel') }} </button>
                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>


        /////////

        $(document).ready(function() {

                // var search = $('#search').val();
                // if(search == ''){
                //     $(document).on('click', '#search_btn', function () {
                //         $('.ui.form').form({
                //             fields: {
                //                 academy_year: {
                //                     identifier: 'academy_year',
                //                     rules: [
                //                         {
                //                             type   : 'empty',
                //                             prompt : '{{ __('lang.pleaseSelectAcademyYear') }}'
                //                         }
                //                     ]
                //                 },
                //                 class_id: {
                //                     identifier: 'class_id',
                //                     rules: [
                //                         {
                //                             type   : 'empty',
                //                             prompt : '{{ __('lang.pleaseSelectClass') }}'
                //                         }
                //                     ]
                //                 },
                //             }
                //         });
                //     });

                // }else{
                //     alert('search with keyword: ' + search);
                // }






            $(document).on('click', '#delete_button', function() {
                var id = $(this).val();
                var url = "{{ route('student.destroy', ':id') }}".replace(':id', id);

                Swal.fire({
                    title: '{{ __("lang.areYouSure") }}',
                    text: '{{ __("lang.doYouWantToDelete") }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ __("lang.yesDelete") }}',
                    cancelButtonText: '{{ __("lang.cancel") }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": id
                            },

                            success: function(respone) {

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.onmouseenter = Swal.stopTimer;
                                        toast.onmouseleave = Swal.resumeTimer;
                                    }
                                });
                                Toast.fire({
                                    icon: "success",
                                    title: respone.success
                                });

                                setTimeout(() => {
                                    location.reload();

                                }, 1200);
                            },

                            error:function(xhr){
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.onmouseenter = Swal.stopTimer;
                                        toast.onmouseleave = Swal.resumeTimer;
                                    }
                                });
                                Toast.fire({
                                    icon: "error",
                                    title: respone.error
                                });
                            }
                        });
                    }
                });


            });

            $(document).on('click', '#restore_button', function() {
                var id = $(this).val();
                var url = "{{ route('student.destroy', ':id') }}".replace(':id', id);

                Swal.fire({
                    title: '{{ __("lang.areYouSure") }}',
                    text: '{{ __("lang.doYouWantToRestore") }}',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ __("lang.yesRestore") }}',
                    cancelButtonText: '{{ __("lang.cancel") }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": id
                            },

                            success: function(respone) {

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.onmouseenter = Swal.stopTimer;
                                        toast.onmouseleave = Swal.resumeTimer;
                                    }
                                });
                                Toast.fire({
                                    icon: "success",
                                    title: respone.success
                                });

                                setTimeout(() => {
                                    location.reload();

                                }, 1200);
                            },

                            error:function(xhr){
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.onmouseenter = Swal.stopTimer;
                                        toast.onmouseleave = Swal.resumeTimer;
                                    }
                                });
                                Toast.fire({
                                    icon: "error",
                                    title: respone.error
                                });
                            }
                        });
                    }
                });
            });


            ///// Block teacher

            $(document).on('click', '#block_button', function() {
                var id = $(this).val();
                var url = "{{ route('student.block', ':id') }}".replace(':id', id);
                // alert(id);
                Swal.fire({
                    title: '{{ __("lang.areYouSure") }}',
                    text: '{{ __("lang.doYouWantToBlock") }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ __("lang.yesBlock") }}',
                    cancelButtonText: '{{ __("lang.cancel") }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": id
                            },

                            success: function(respone) {

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.onmouseenter = Swal.stopTimer;
                                        toast.onmouseleave = Swal.resumeTimer;
                                    }
                                });
                                Toast.fire({
                                    icon: "success",
                                    title: respone.success
                                });

                                setTimeout(() => {
                                    location.reload();

                                }, 1200);
                            },

                            error:function(xhr){
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.onmouseenter = Swal.stopTimer;
                                        toast.onmouseleave = Swal.resumeTimer;
                                    }
                                });
                                Toast.fire({
                                    icon: "error",
                                    title: respone.error
                                });
                            }
                        });
                    }
                });


            });

            $(document).on('click', '#unblock_button', function() {
                var id = $(this).val();
                var url = "{{ route('student.block', ':id') }}".replace(':id', id);

                Swal.fire({
                    title: '{{ __("lang.areYouSure") }}',
                    text: '{{ __("lang.doYouWantToUnblock") }}',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ __("lang.yesUnblock") }}',
                    cancelButtonText: '{{ __("lang.cancel") }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": id
                            },

                            success: function(respone) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.onmouseenter = Swal.stopTimer;
                                        toast.onmouseleave = Swal.resumeTimer;
                                    }
                                });
                                Toast.fire({
                                    icon: "success",
                                    title: respone.success
                                });

                                setTimeout(() => {
                                    location.reload();

                                }, 1200);
                            },

                            error:function(xhr){
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.onmouseenter = Swal.stopTimer;
                                        toast.onmouseleave = Swal.resumeTimer;
                                    }
                                });
                                Toast.fire({
                                    icon: "error",
                                    title: respone.error
                                });
                            }
                        });
                    }
                });


            });


            ////// Reset password

            $(document).on('click', '#resetPass_button', function() {
                var id = $(this).val();
                var url = "{{ route('student.resetPass')}}";

                Swal.fire({
                    title: '{{ __("lang.areYouSure") }}',
                    text: '{{ __("lang.youWantResetpassword") }}',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ __("lang.reset") }}',
                    cancelButtonText: '{{ __("lang.cancel") }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "{{ __('lang.inputOperatorPassword') }}",
                            input: "password",
                            inputLabel: "{{ __('lang.passwordWill1234') }}",
                            inputPlaceholder: "{{ __('lang.enterYourPassword') }}",
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '{{ __("lang.ok") }}',
                            cancelButtonText: '{{ __("lang.cancel") }}',
                            inputAttributes: {
                                maxlength: "10",
                                autocapitalize: "off",
                                autocomplete: "off",
                                autocorrect: "off"
                            }
                        }).then((inputResult) => {
                            if (inputResult.isConfirmed) {
                                var password = inputResult.value;
                                // alert(password);
                                $.ajax({
                                    type: "POST",
                                    url: url,
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        "id": id,
                                        "password": password
                                    },
                                    success: function(response) {
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: "top-end",
                                            showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast.onmouseenter = Swal.stopTimer;
                                                toast.onmouseleave = Swal.resumeTimer;
                                            }
                                        });
                                        Toast.fire({
                                            icon: "success",
                                            title: response.success
                                        });


                                    },
                                    error: function(xhr) {
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: "top-end",
                                            showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast.onmouseenter = Swal.stopTimer;
                                                toast.onmouseleave = Swal.resumeTimer;
                                            }
                                        });

                                        Toast.fire({
                                            icon: "error",
                                            title: xhr.responseJSON.error || '{{ __("lang.operatorPasswordWrong") }}'
                                        });
                                    }

                                });
                                setTimeout(() => {
                                    location.reload();
                                }, 1200);
                            }
                        });
                    }
                });
            });



            ////// Leave teacher

            $(document).on('click', '#leave_button', function() {
                var id = $(this).val();
                var url = "{{ route('student.leave', ':id') }}".replace(':id', id);
                var leaveForm = $('#leave_verify_form');
                var verifyFormModal = $('#verifyFormModal');


                Swal.fire({
                    title: '{{ __("lang.areYouSure") }}',
                    text: '{{ __("lang.doesStudentHasDropouted") }}',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ __("lang.yesDropout") }}',
                    cancelButtonText: '{{ __("lang.cancel") }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        leaveForm.modal('show');
                        verifyFormModal.attr('action', url);
                    }
                });
            });

            setTimeout(function() {
                $('#tableReload').fadeOut();
            }, 1000);


            // Auto select jquery
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
        });

    </script>

    @if ($students != null)
        <script>
            @php
                $i = 1;
            @endphp
            @foreach ($students as $index => $student)
                $(".ui.dropdown{{ $i++ }}").dropdown();
            @endforeach
        </script>
    @endif

@endsection
