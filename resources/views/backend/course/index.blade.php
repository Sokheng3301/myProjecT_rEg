@php
    use Carbon\Carbon;
@endphp
@extends('backend.layout.master')
@section('title')
    {{__('lang.course')}} | {{__('lang.department')}}
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
        {{__('lang.course')}}
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
                            <h3 class="card-title">{{__('lang.courseList')}}</h3>
                            <div class="card-tools">
                                {{-- <span title="3 New Messages" class="badge text-bg-primary"> 3 </span> --}}
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                                <a href="{{ route('course.create') }}"
                                class="ui button small primary"
                                title="Add new"
                                {{-- data-lte-toggle="chat-pane" --}}
                                >
                                <i class="bi bi-plus-circle-fill"></i>
                                {{ __('lang.addNew') }}
                                </a>
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
                                            <th scope="col" class="text-start">{{__('lang.no')}}</th>
                                            <th scope="col">{{__('lang.course')}}</th>
                                            {{-- <th scope="col">{{__('lang.courseType')}}</th> --}}
                                            <th scope="col">{{__('lang.createdAt')}}</th>
                                            <th scope="col">{{__('lang.deletedAt')}}</th>
                                            <th scope="col">{{__('lang.deletedBy')}}</th>
                                            <th scope="col">{{__('lang.action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                    $i = 1;
                                            @endphp
                                            @foreach ($courses as $course)
                                                <tr class="{{ $course->delete_status == 0 ? 'bg-danger' : ''}}">
                                                    <td scope="row" class="text-start {{ $course->delete_status == 0 ? 'text-danger' : ''}}"><span class="m-auto mt-3 d-block">{{ $i++ }}</span></td>
                                                    <td class="text {{ $course->delete_status == 0 ? 'text-danger' : ''}}">
                                                        <p class="text-primary fw-bold {{ $course->delete_status == 0 ? 'text-danger' : ''}}"><span class="fw-normal {{ $course->delete_status == 0 ? 'text-danger' : 'text-black'}}">{{ __("lang.code")  }} : </span> {{ $course->course_code}}</p>
                                                        <p class="fw-bold">
                                                            {{-- @if(session()->has('localization') && session('localization') == 'en') --}}
                                                            <span class="{{ $course->delete_status == 0 ? 'text-danger' : 'text-black'}} fw-normal">{{ __("lang.course")  }} : </span> {{  $course->course_name_kh . ' - '. $course->course_name_en }}
                                                        </p>
                                                        <p class="fw-bold">
                                                            <span class="{{ $course->delete_status == 0 ? 'text-danger' : 'text-black'}} fw-normal">{{ __("lang.credit")  }} : </span> {{ $course->course_credit .' ('. $course->course_theory . '.'. $course->course_execute. '.'. $course->course_apply . ')' }}
                                                        </p>
                                                        <p class="fw-bold">
                                                            <span class="{{ $course->delete_status == 0 ? 'text-danger' : 'text-black'}} fw-normal">{{ __("lang.department")  }} : </span>
                                                            @if(session()->has('localization') && session('localization') == 'en')
                                                                {{ $course->department->dep_name_en }}
                                                            @else
                                                                {{ $course->department->dep_name_kh }}
                                                            @endif
                                                        </p>
                                                        <p class="fw-bold">
                                                            <span class="{{ $course->delete_status == 0 ? 'text-danger' : 'text-black'}} fw-normal">{{ __("lang.duration")  }} : </span> {{ $course->course_duration . ' ' . __('lang.hours') }}
                                                        </p>
                                                        <p class="mt-2 {{ $course->delete_status == 0 ? 'text-muted' : 'text-muted'}}">
                                                           {{ \App\Http\Helpers\AppHelper::courseType($course->course_type) }}
                                                        </p>
                                                    </td>

                                                    <td class="{{ $course->delete_status == 0 ? 'text-danger' : ''}}">
                                                        {{ Carbon::parse($course->created_at)->format('d-m-Y H:m:i a') }}
                                                    </td>
                                                    <td class="{{ $course->delete_status == 0 ? 'text-danger' : ''}}">
                                                            {{ $course->deleted_at ? Carbon::parse($course->deleted_at)->format('d-m-Y') : ''}}
                                                    </td>
                                                    <td class="{{ $course->delete_status == 0 ? 'text-danger' : ''}}">
                                                        {{ $course->deleted_by ? $course->deleted_by : '' }}
                                                    </td>
                                                    <td>
                                                        {{-- <a data-bs-toggle="modal" data-bs-target="#courseDetail" type="button" data-id="{{ $course->id }}" title="Detail" class="me-2"><i class="bi bi-eye-fill"></i></a> --}}
                                                        <a id="courseButtonDetail" type="button" data-id="{{ $course->id }}" title="Detail" class="me-2"><i class="bi bi-eye-fill"></i></a>
                                                        <a href="{{ route('course.edit', $course->id) }}" title="Edit" class="me-2"> <i class="bi bi-pencil-fill"></i></a>
                                                        <button type="button" class="border-0 bg-transparent" style="outline: 0;" value="{{ $course->id }}"
                                                            @if($course->delete_status == 1)
                                                                id="delete_button"
                                                            @else
                                                                id="restore_button"
                                                            @endif
                                                            title=" @if ($course->delete_status == 1)
                                                            Delete
                                                        @else
                                                            Restore
                                                        @endif "> <i class="bi @if ($course->delete_status == 1)
                                                            bi-trash text-danger
                                                            @else
                                                            bi-arrow-clockwise text-success
                                                        @endif "></i> </button>
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
            </div>
        </div>
    </div>

    <!-- Modal Course Detail -->
    <div class="modal fade" id="courseDetail" tabindex="-1" aria-labelledby="courseDetail" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="courseDetail">{{__('lang.aboutCourse')}}</h1>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body p-3">
                    <div class="row px-3">
                        <div class="col-4 col-md-3 pb-2">{{__('lang.code')}}</div> <div class="col-1">:</div> <div class="col-7 col-md-8 text-primary" id="courseCode">  </div>
                        <div class="col-4 col-md-3 pb-2">{{__('lang.course')}}</div> <div class="col-1">:</div> <div class="col-7 col-md-8" id="courseName">  </div>
                        <div class="col-4 col-md-3 pb-2">{{__('lang.credit')}}</div> <div class="col-1">:</div> <div class="col-7 col-md-8" id="courseCredit">  </div>
                        <div class="col-4 col-md-3 pb-2">{{__('lang.courseType')}}</div> <div class="col-1">:</div> <div class="col-7 col-md-8" id="courseType">  </div>
                        <div class="col-4 col-md-3 pb-2">{{__('lang.department')}}</div> <div class="col-1">:</div> <div class="col-7 col-md-8" id="department">  </div>
                        <div class="col-4 col-md-3 pb-2">{{__('lang.duration')}}</div> <div class="col-1">:</div> <div class="col-7 col-md-8" id="courseDuration">  </div>

                        <div class="col-4 col-md-3 pb-2">{{__('lang.purpose')}}</div> <div class="col-1">:</div> <div class="col-7 col-md-8" id="coursePurpose">  </div>
                        <div class="col-4 col-md-3 pb-2">{{__('lang.expectedOutcome')}}</div> <div class="col-1">:</div> <div class="col-7 col-md-8" id="courseExpectedOutcome">  </div>
                        <div class="col-4 col-md-3 pb-2">{{__('lang.description')}}</div> <div class="col-1">:</div> <div class="col-7 col-md-8" id="coursedescription">  </div>


                        <div class="col-12 mt-3">
                            <div class="row text-muted">
                                <div class="col-4 col-md-3 pb-2">{{__('lang.createdAt')}}</div> <div class="col-1">:</div> <div class="col-7 col-md-8" id="createdAtValue">  </div>
                                <div class="col-4 col-md-3 pb-2">{{__('lang.deletedAt')}}</div> <div class="col-1">:</div> <div class="col-7 col-md-8" id="deletedAtValue">  </div>
                                <div class="col-4 col-md-3 pb-2">{{__('lang.deletedBy')}}</div> <div class="col-1">:</div> <div class="col-7 col-md-8" id="deletedByValue">  </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="ui tiny button" data-bs-dismiss="modal">{{__('lang.close')}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            // detail modal
            $(document).on('click', '#courseButtonDetail', function () {
                $('#courseDetail').modal('show');
                var id = $(this).data('id');
                var url = "{{ route('course.show', ':id') }}".replace(':id', id);

                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    success: function (response) {
                        $('#courseCode').text(response.data.course_code);
                        $('#courseName').text(response.data.course_name_kh + ' - ' + response.data.course_name_en);
                        $('#courseCredit').text(response.data.course_credit + ' (' + response.data.course_theory + '.' + response.data.course_execute + '.' + response.data.course_apply + ')');
                        $('#courseType').text(response.courseType);
                        $('#department').text(response.data.department.dep_name_kh + ' - ' + response.data.department.dep_name_en);
                        $('#courseDuration').text(response.data.course_duration + ' {{ __('lang.hours') }}');
                        $('#coursePurpose').text(response.data.course_purpose);
                        $('#courseExpectedOutcome').text(response.data.course_outcome);
                        $('#coursedescription').text(response.data.course_description);
                        $('#createdAtValue').text(response.createdAt);
                        $('#deletedAtValue').text(response.deletedAt);
                        $('#deletedByValue').text(response.deletedBy);
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });



            $(document).on('click', '#delete_button', function() {
                var id = $(this).val();
                var url = "{{ route('course.destroy', ':id') }}".replace(':id', id);

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
                var url = "{{ route('course.destroy', ':id') }}".replace(':id', id);

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

            setTimeout(function() {
            $('#tableReload').fadeOut();
        }, 1000);
        });
    </script>
@endsection
