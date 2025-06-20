@php
    use Carbon\Carbon;
@endphp
@extends('backend.layout.master')
@section('title')
    {{__('lang.qrCode')}}
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
        {{__('lang.qrCode')}}
    @endsection

    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row">
            <!-- Start col -->
                <div class="col-md-4 connectedSortable">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="card-title">{{__('lang.generateQrcode')}}</h4>

                        </div>
                        <div class="card-body d-flex justify-content-center flex-column">
                            <h2 class="ui icon header text-center">
                                <i class="icon bi bi-qr-code"></i>
                            </h2>
                            <a href="{{ route('qrcode.create') }}" class="ui tiny button">{{__('lang.generateQrcode')}}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 connectedSortable">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="card-title">{{__('lang.readQrcode')}}</h4>

                        </div>
                        <div class="card-body d-flex justify-content-center flex-column">
                            <h2 class="ui icon header text-center">
                                <i class="ui blue icon bi bi-qr-code-scan"></i>
                            </h2>
                            <a href="" class="ui primary tiny button">{{__('lang.readQrcode')}}</a>
                        </div>
                    </div>
                </div>
                {!! @$qrCode !!}
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
