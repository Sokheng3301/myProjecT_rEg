@php
    use Carbon\Carbon;
@endphp
@extends('backend.layout.master')
@section('title')
    {{__('lang.classroom')}}
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
        {{__('lang.classroom')}}
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
                            <h3 class="card-title">{{__('lang.classroomList')}}</h3>
                            <div class="card-tools">
                                {{-- <span title="3 New Messages" class="badge text-bg-primary"> 3 </span> --}}
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                                <a href="{{ route('classroom.create') }}"
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
                                        <th scope="col">{{__('lang.classroom')}}</th>
                                        <th scope="col">{{__('lang.classroomEn')}}</th>
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
                                    @foreach ($classrooms as $classroom)
                                        <tr @if ($classroom->delete_status	 == 0)
                                            class="text-danger"
                                        @endif>
                                            
                                            <td @if ($classroom->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif scope="row">{{$i++}}
                                            </td>
                                            
                                            <td @if ($classroom->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif scope="row">{{$classroom->class_room}}
                                            </td>
                                            <td @if ($classroom->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif scope="row">{{$classroom->classroom_en}}
                                            </td>

                                            <td @if ($classroom->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif> {{ \Illuminate\Support\Carbon::parse($classroom->created_at)->format('d-m-Y h:i:s a') }} 
                                            </td>

                                            

                                            <td @if ($classroom->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif> 
                                                {{-- {{ Carbon::parse($classroom->deleted_date)->format('d-m-Y') }} --}}
                                                @if ($classroom->deleted_date != '')
                                                    {{ \Illuminate\Support\Carbon::parse($classroom->deleted_date)->format('d-m-Y') }}
                                                @endif
                                            </td>

                                            <td @if ($classroom->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif> {{ $classroom->deleted_by }} 
                                            </td>
                                            <td>
                                                {{-- <button type="button" id="detail_button" data-bs-toggle="modal" data-bs-target="#detailModal" class="border-0 bg-transparent me-2" style="outline: 0;" value="{{ $classroom->id }}" title="About"> <i class="bi bi-eye-fill text-secondary "></i></button> --}}
                                                <a href="{{ route('classroom.edit', $classroom->id) }}" title="Edit" class="me-2"> <i class="bi bi-pencil-fill"></i></a>

                                                <button type="button" class="border-0 bg-transparent" style="outline: 0;" value="{{ $classroom->id }}"
                                                    @if($classroom->delete_status == 1)
                                                        id="delete_button"
                                                    @else
                                                        id="restore_button"
                                                    @endif
                                                    title=" @if ($classroom->delete_status == 1)
                                                    Delete
                                                @else
                                                    Restore
                                                @endif "> <i class="bi @if ($classroom->delete_status == 1)
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
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#delete_button', function() {
                var id = $(this).val();
                var url = "{{ route('classroom.destroy', ':id') }}".replace(':id', id);

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
                var url = "{{ route('classroom.destroy', ':id') }}".replace(':id', id);
               
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