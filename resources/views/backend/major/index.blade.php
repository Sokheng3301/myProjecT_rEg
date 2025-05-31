@php
    use Carbon\Carbon;
@endphp
@extends('backend.layout.master')
@section('title')
    {{__('lang.major')}}
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
        {{__('lang.major')}}
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
                            <h3 class="card-title">{{__('lang.majorList')}}</h3>
                            <div class="card-tools">
                                {{-- <span title="3 New Messages" class="badge text-bg-primary"> 3 </span> --}}
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                                <a href="{{ route('major.create') }}"
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
                                    <th scope="col">{{__('lang.code')}}</th>
                                    <th scope="col">{{__('lang.major')}}</th>
                                    <th scope="col">{{__('lang.majorEn')}}</th>
                                    <th scope="col">{{__('lang.department')}}</th>
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
                                    @foreach ($majors as $major)
                                        <tr @if ($major->delete_status	 == 0)
                                            class="text-danger"
                                        @endif>
                                            
                                            <td @if ($major->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif scope="row">{{$i++}}
                                            </td>
                                            <td @if ($major->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif> {{ $major->major_code }} 
                                            </td>

                                            <td @if ($major->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif> {{ $major->major_name_kh }}
                                            </td>
                                            <td @if ($major->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif> {{ $major->major_name_en }}
                                            </td>
                                             <td @if ($major->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif> 
                                                @if (session('localization') == 'kh')
                                                    {{ $major->departments->dep_name_kh }}
                                                @else
                                                    {{ $major->departments->dep_name_en }}
                                                @endif
                                            </td>
                                            <td @if ($major->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif> {{ Carbon::parse($major->created_at)->format('d-m-Y h:i:s a') }} 
                                            </td>
                                            <td @if ($major->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif> {{ $major->deleted_at }}
                                            </td>
                                            <td @if ($major->delete_status	 == 0)
                                                    class="text-danger"
                                                @endif> {{ $major->deleted_by }} 
                                            </td>
                                            <td>
                                                <a href="{{ route('major.edit', $major->id) }}" title="Edit" class="me-2"> <i class="bi bi-pencil-fill"></i></a>
                                                <button type="button" class="border-0 bg-transparent" style="outline: 0;" value="{{ $major->id }}" 
                                                    @if($major->delete_status == 1)
                                                        id="delete_button"
                                                    @else
                                                        id="restore_button"
                                                    @endif
                                                    title=" @if ($major->delete_status == 1)
                                                    Delete
                                                @else
                                                    Restore
                                                @endif "> <i class="bi @if ($major->delete_status == 1)
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
                var url = "{{ route('major.destroy', ':id') }}".replace(':id', id);

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
                var url = "{{ route('major.destroy', ':id') }}".replace(':id', id);

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