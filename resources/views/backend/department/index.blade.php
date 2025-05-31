@php
    use Carbon\Carbon;
@endphp
@extends('backend.layout.master')
@section('title')
    {{__('lang.department')}}
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
        {{__('lang.department')}}
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
                            <h3 class="card-title">{{__('lang.departmentList')}}</h3>
                            <div class="card-tools">
                                {{-- <span title="3 New Messages" class="badge text-bg-primary"> 3 </span> --}}
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                                <a href="{{ route('department.create') }}"
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
                               <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                    <th scope="col">{{__('lang.no')}}</th>
                                    <th scope="col">{{__('lang.logo')}}</th>
                                    <th scope="col">{{__('lang.code')}}</th>
                                    <th scope="col">{{__('lang.department')}}</th>
                                    <th scope="col">{{__('lang.departmentEN')}}</th>
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
                                    @foreach ($departments as $department)
                                        <tr @if ($department->delete_status	 == 0)
                                            class="text-danger"
                                        @endif>
                                            
                                            <td @if ($department->delete_status	 == 0)
                                            class="text-danger"
                                        @endif scope="row">{{$i++}}</td>
                                            <td @if ($department->delete_status	 == 0)
                                            class="text-danger"
                                        @endif><img class="ui mini image" src="{{ asset($department->dep_logo) }}" alt=""></td>
                                            <td @if ($department->delete_status	 == 0)
                                            class="text-danger"
                                        @endif> {{ $department->dep_code }} </td>
                                            <td @if ($department->delete_status	 == 0)
                                            class="text-danger"
                                        @endif> {{ $department->dep_name_kh }} </td>
                                            <td @if ($department->delete_status	 == 0)
                                            class="text-danger"
                                        @endif> {{ $department->dep_name_en }} </td>
                                            <td @if ($department->delete_status	 == 0)
                                            class="text-danger"
                                        @endif> {{ Carbon::parse($department->created_at)->format('d-m-Y h:i:s a') }} </td>
                                            <td @if ($department->delete_status	 == 0)
                                            class="text-danger"
                                        @endif> {{ $department->deleted_at }} </td>
                                            <td @if ($department->delete_status	 == 0)
                                            class="text-danger"
                                        @endif> {{ $department->deleted_by }} </td>
                                            <td>
                                                <a href="{{ route('department.edit', $department->id) }}" title="Edit" class="me-2"> <i class="bi bi-pencil-fill"></i></a>
                                                <button type="button" class="border-0 bg-transparent" style="outline: 0;" value="{{ $department->id }}" 
                                                    @if($department->delete_status == 1)
                                                        id="delete_button"
                                                    @else
                                                        id="restore_button"
                                                    @endif
                                                    title=" @if ($department->delete_status == 1)
                                                    Delete
                                                @else
                                                    Restore
                                                @endif "> <i class="bi @if ($department->delete_status == 1)
                                                    bi-trash text-danger
                                                    @else
                                                    bi-arrow-clockwise text-success 
                                                @endif "></i> </button>
                                                {{-- <a href="" title="Restore"> <i class="bi "></i> </a> --}}
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
                var url = "{{ route('department.destroy', ':id') }}".replace(':id', id);

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
                var url = "{{ route('department.destroy', ':id') }}".replace(':id', id);

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