@php
    use Carbon\Carbon;
@endphp
@extends('backend.layout.master')
@section('title')
    {{__('lang.semester')}}
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
        {{__('lang.semester')}}
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
                            <h3 class="card-title">{{__('lang.semesterList')}}</h3>
                            <div class="card-tools">
                                {{-- <span title="3 New Messages" class="badge text-bg-primary"> 3 </span> --}}
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                                <a href="{{ route('semester.create') }}"
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
                            <div class="table-responsive position-relative" style="width: 100%;">
                                <div id="tableReload">
                                    <div class="dot"></div>
                                    <div class="dot"></div>
                                    <div class="dot"></div>
                                </div>
                               <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">{{__('lang.no')}}</th>
                                        <th scope="col">{{__('lang.semester')}}</th>
                                        <th scope="col">{{__('lang.startDate')}}</th>
                                        <th scope="col">{{__('lang.finishDate')}}</th>
                                        <th scope="col">{{__('lang.academyYear')}}</th>
                                        <th scope="col">{{__('lang.createdAt')}}</th>
                                        <th scope="col">{{__('lang.finishStatus')}}</th>

                                        {{-- <th scope="col">{{__('lang.studyLevel')}}</th>
                                        <th scope="col">{{__('lang.yearLevel')}}</th>
                                        <th scope="col">{{__('lang.academyYear')}}</th>
                                        <th scope="col">{{__('lang.graduateStatus')}}</th> --}}

                                        <th scope="col">{{__('lang.deletedAt')}}</th>
                                        <th scope="col">{{__('lang.deletedBy')}}</th>
                                        <th scope="col">{{__('lang.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                            $i = 1;
                                    @endphp
                                    @foreach ($semesters as $semester)
                                        <tr @if ($semester->delete_status	 == 0)
                                            class="text-danger"
                                        @endif>
                                            
                                            <td @if ($semester->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif scope="row">{{$i++}}
                                            </td>
                                            <td @if ($semester->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif> 
                                                @if ($semester->semester == 1)
                                                    {{ __("lang.1Semester") }}
                                                @elseif ($semester->semester == 2)
                                                    {{ __("lang.2Semester") }}
                                                @else
                                                    {{ __("lang.3Semester") }}
                                                @endif 
                                            </td>



                                            <td @if ($semester->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif> {{ Illuminate\Support\Carbon::parse($semester->start_date)->format('d-m-Y') }} 
                                            </td>

                                            
                                            <td @if ($semester->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif> {{ \Illuminate\Support\Carbon::parse($semester->finish_date)->format('d-m-Y') }} 
                                            </td>

                                            <td @if ($semester->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif> {{ $semester->academy_year }} 
                                            </td>

                                            
                                            

                                            {{-- <td @if ($semester->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif> {{ $semester->year_level }} 
                                            </td> --}}


                                            <td @if ($semester->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif> {{ Carbon::parse($semester->created_at)->format('d-m-Y h:i:s a') }} 
                                            </td>

                                            <td @if ($semester->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif> 
                                                @if ($semester->finish_status == 1)
                                                    <a class="ui label tiny orange">{{ __("lang.notFinish") }}</a>
                                                @else
                                                    <a class="ui label tiny blue">{{ __("lang.finished") }}</a>
                                                @endif 
                                            </td>

                                            <td @if ($semester->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif> {{ \Illuminate\Support\Carbon::parse($semester->deleted_date)->format('d-m-Y') }}
                                            </td>
                                            <td @if ($semester->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif> {{ $semester->deleted_by }} 
                                            </td>
                                            <td>
                                                {{-- <button type="button" id="detail_button" data-bs-toggle="modal" data-bs-target="#detailModal" class="border-0 bg-transparent me-2" style="outline: 0;" value="{{ $semester->id }}" title="About"> <i class="bi bi-eye-fill text-secondary "></i></button> --}}
                                                <a href="{{ route('semester.edit', $semester->id) }}" title="Edit" class="me-2"> <i class="bi bi-pencil-fill"></i></a>

                                                <button type="button" class="border-0 bg-transparent" style="outline: 0;" value="{{ $semester->id }}"
                                                    @if($semester->delete_status == 1)
                                                        id="delete_button"
                                                    @else
                                                        id="restore_button"
                                                    @endif
                                                    title=" @if ($semester->delete_status == 1)
                                                    Delete
                                                @else
                                                    Restore
                                                @endif "> <i class="bi @if ($semester->delete_status == 1)
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


    <!-- Modal -->
    {{-- <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">{{__("lang.detail")}}</h3>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <div class="row px-3">
                        <div class="col-4 pb-2">{{__('lang.classCode')}}</div> <div class="col-1">:</div> <div class="col-7" id="classCodeValue">  </div>
                        <div class="col-4 pb-2">{{__('lang.department')}}</div> <div class="col-1">:</div> <div class="col-7" id="departmentValue">  </div>
                        <div class="col-4 pb-2">{{__('lang.major')}}</div> <div class="col-1">:</div> <div class="col-7" id="majorValue">  </div>
                        <div class="col-4 pb-2">{{__('lang.studyLevel')}}</div> <div class="col-1">:</div> <div class="col-7" id="studyLevelValue">  </div>
                        <div class="col-4 pb-2">{{__('lang.yearLevel')}}</div> <div class="col-1">:</div> <div class="col-7" id="yearLevelValue">  </div>
                        <div class="col-4 pb-2">{{__('lang.academicYear')}}</div> <div class="col-1">:</div> <div class="col-7" id="academyYearValue">  </div>
                        <div class="col-4 pb-2">{{__('lang.graduated')}}</div> <div class="col-1">:</div> <div class="col-7" id="graduatedValue">  </div>
                        <div class="col-12 my-1">
                        </div>
                    </div>
                    <div class="row px-3 pt-3 text-secondary">
                        <div class="col-4 pb-2">{{__('lang.createdAt')}}</div> <div class="col-1">:</div> <div class="col-7" id="createdAtValue">  </div>
                        <div class="col-4 pb-2">{{__('lang.deletedAt')}}</div> <div class="col-1">:</div> <div class="col-7" id="deletedAtValue">  </div>
                        <div class="col-4 pb-2">{{__('lang.deletedBy')}}</div> <div class="col-1">:</div> <div class="col-7" id="deletedByValue">  </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="mini ui button grey" data-bs-dismiss="modal"> {{ __('lang.close') }} </button>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#delete_button', function() {
                var id = $(this).val();
                var url = "{{ route('semester.destroy', ':id') }}".replace(':id', id);

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
                var url = "{{ route('semester.destroy', ':id') }}".replace(':id', id);
               
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

            // $(document).on('click', '#detail_button', function() {
            //     var id = $(this).val();
            //     var url = "{{ route('class.show', ':id') }}".replace(':id', id);
            //     $.ajax({
            //         type: "GET",
            //         url: url,
            //         data: {
            //             "_token": "{{ csrf_token() }}",
            //             "id": id
            //         },

            //         success:function(data){
            //             $('#classCodeValue').text(data.class_code);
            //             $('#departmentValue').text(data.department);
            //             $('#majorValue').text(data.major);
            //             $('#studyLevelValue').text(data.level_study);
            //             $('#yearLevelValue').text(data.level_year);
            //             $('#academyYearValue').text(data.academy_year);

            //             $('#graduatedValue').text(data.graduate_status);
            //             $('#createdAtValue').text(data.created_at);
            //             $('#deletedAtValue').text(data.deleted_at);
            //             $('#deletedByValue').text(data.deleted_by);

            //         }
            //     });


            //     // alert(id);
            // });

            setTimeout(function() {
                $('#tableReload').fadeOut();
            }, 1000);
        });
    </script>
@endsection