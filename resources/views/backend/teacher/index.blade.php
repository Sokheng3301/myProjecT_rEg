@php
    use Carbon\Carbon;
@endphp
@extends('backend.layout.master')
@section('title')
    {{__('lang.teacher')}}
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
        {{__('lang.teacher')}}
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
                            <h3 class="card-title">{{__('lang.teacherList')}}</h3>
                            <div class="card-tools">
                                {{-- <span title="3 New Messages" class="badge text-bg-primary"> 3 </span> --}}
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                                <a href="{{ route('teacher.create') }}"
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
                            <div class="table-responsive position-relative fix-height">
                                <div id="tableReload">
                                    <div class="dot"></div>
                                    <div class="dot"></div>
                                    <div class="dot"></div>
                                </div>
                                <table class="table" id="myTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{__('lang.no')}}</th>
                                            <th scope="col">{{__('lang.photoProfile')}}</th>
                                            <th scope="col">{{__('lang.idCard')}}</th>
                                            <th scope="col">{{__('lang.fullnameKh')}}</th>
                                            <th scope="col">{{__('lang.nameEn')}}</th>
                                            <th scope="col">{{__('lang.gender')}}</th>
                                            <th scope="col">{{__('lang.birthDate')}}</th>
                                            <th scope="col">{{__('lang.department')}}</th>
                                            <th scope="col">{{__('lang.phoneNumber')}}</th>
                                            <th scope="col" colspan="2" class="text-center">{{__('lang.accountStatus')}}</th>
                                            {{-- <th scope="col" class="text-center">{{__('lang.action')}}</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $incre = 1;
                                            $i= 1;
                                        @endphp
                                        @foreach ($teachers as $t)
                                            <tr @if ($t->delete_status	 == 0)
                                                class="text-danger"
                                            @endif>
                                                <td @if ($t->delete_status	 == 0)
                                                        class="text-danger"
                                                    @endif scope="row">{{$i++}}
                                                </td>
                                                <td @if ($t->delete_status	 == 0)
                                                        class="text-danger"
                                                    @endif>
                                                    <img class="ui mini circular image" src="{{ asset($t->profile ?: 'dist/assets/img/white-image.png') }}" alt="profile">
                                                </td>

                                                <td @if ($t->delete_status == 0)
                                                        class="text-danger"
                                                    @endif> {{ $t->id_card }}
                                                </td>
                                                <td @if ($t->delete_status == 0)
                                                        class="text-danger"
                                                    @endif> {{ $t->fullname_kh }}
                                                </td>
                                                <td class="@if($t->delete_status == 0)
                                                        text-danger
                                                    @endif text-uppercase"> {{ $t->fullname_en }}
                                                </td>
                                                <td @if ($t->delete_status	 == 0)
                                                        class="text-danger"
                                                    @endif title="@if($t->gender != ''){{ $t->gender == 'm'?__("lang.male"):__('lang.female')}}@endif">
                                                    @if ($t->gender == 'm')
                                                        <i class="bi bi-gender-male" style="color: #0464ff;"></i>
                                                    @else
                                                        <i class="bi bi-gender-female" style="color: #ca0079;"></i>
                                                    @endif
                                                </td>
                                                <td @if ($t->delete_status	 == 0)
                                                        class="text-danger"
                                                    @endif> {{ Carbon::parse($t->birth_date)->format('d-m-Y') }}
                                                </td>
                                                <td @if ($t->delete_status	 == 0)
                                                        class="text-danger"
                                                    @endif>
                                                    @if (session()->has('localization') && session('localization') == 'en')
                                                        {{ $t->department->dep_name_en }}
                                                    @else
                                                        {{ $t->department->dep_name_kh }}
                                                    @endif
                                                </td>
                                                <td @if ($t->delete_status	 == 0)
                                                        class="text-danger"
                                                    @endif> {{ $t->phone_number }}
                                                </td>

                                                <td class="@if ($t->delete_status	 == 0)
                                                        text-danger
                                                    @endif text-end"> <small class="{{ $t->block_status == 1 ? 'ui green label' : 'ui red label' }}"> {{ $t->block_status == 1 ?  __('lang.active') : __('lang.blocked')}} </small>
                                                </td>

                                                <td class="text-center">
                                                    <div class="ui">
                                                        <div class="ui floating dropdown dropdown{{ $incre++ }} icon">
                                                            <i class="bi bi-three-dots-vertical"></i>
                                                            <div class="menu">
                                                                <a title="About" href="{{ route('teacher.show', $t->id) }}" class="item"><i class="bi bi-eye-fill"></i> {{ __('lang.aboutTeacher') }}</a>
                                                                <a title="Update" href="{{ route('teacher.edit', $t->id) }}" class="item"><i class="bi bi-pencil-square"></i> {{ __("lang.update") }}</a>
                                                                <div class="item">
                                                                    <button type="button" class="m-0 p-0 w-100 d-block border-0 bg-transparent text-start"
                                                                        style="outline: 0;"
                                                                        value="{{ $t->id_card }}"
                                                                        id="resetPass_button"
                                                                        title="Reset password">
                                                                        <i class="bi bi-unlock-fill"></i>{{__("lang.resetPassword")}}
                                                                    </button>
                                                                    {{-- <i class="bi bi-unlock-fill"></i> {{__("lang.resetPassword")}} --}}
                                                                </div>

                                                                <div class="item">
                                                                    <button type="button" class="m-0 p-0 w-100 d-block border-0 bg-transparent text-start"
                                                                        style="outline: 0;"
                                                                        value="{{ $t->id }}"
                                                                        id="leave_button"
                                                                        title="Leave">
                                                                        <i class="bi bi-box-arrow-up-left"></i> {{__("lang.leave")}}
                                                                    </button>
                                                                </div>

                                                                <div class="item text-start">
                                                                    <button type="button" class="m-0 p-0 w-100 d-block border-0 bg-transparent
                                                                        {{ $t->block_status == 1 ? 'text-danger' : 'text-success' }} text-start"
                                                                        style="outline: 0;"
                                                                        value="{{ $t->id_card }}"
                                                                        id="{{ $t->block_status == 1 ? 'block_button': 'unblock_button' }}"
                                                                        title="{{ $t->block_status == 1 ? 'Block' : 'Unblock' }}">

                                                                        <i class="bi {{ $t->block_status == 1 ? 'bi-ban text-danger' : 'bi-arrow-repeat text-success' }}"></i>

                                                                        {{ __('lang.' . ($t->block_status == 1 ? 'block' : 'unblock')) }}
                                                                    </button>
                                                                </div>
                                                                <div class="item text-start">
                                                                    <button type="button" class="m-0 p-0 w-100 d-block border-0 bg-transparent @if ($t->delete_status == 1) text-danger @else text-success @endif text-start" style="outline: 0;" value="{{ $t->id }}"
                                                                            @if($t->delete_status == 1)
                                                                                id="delete_button"
                                                                            @else
                                                                                id="restore_button"
                                                                            @endif
                                                                                title="@if ($t->delete_status == 1)
                                                                                Delete
                                                                            @else
                                                                                Restore
                                                                            @endif "> <i class="bi @if ($t->delete_status == 1)
                                                                                bi-trash text-danger
                                                                                @else
                                                                                bi-arrow-clockwise text-success
                                                                            @endif "></i>
                                                                            @if ($t->delete_status == 1)
                                                                                {{__('lang.delete')}}
                                                                            @else
                                                                                {{__('lang.restore')}}
                                                                            @endif
                                                                    </button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <button type="button" id="detail_button" data-bs-toggle="modal" data-bs-target="#detailModal" class="border-0 bg-transparent me-2" style="outline: 0;" value="{{ $t->id }}" title="About"> <i class="bi bi-eye-fill text-secondary "></i></button>
                                                    <a href="{{ route('teacher.edit', $t->id) }}" title="Edit" class="me-2"> <i class="bi bi-pencil-fill"></i></a>
                                                    <button type="button" class="border-0 bg-transparent" style="outline: 0;" value="{{ $t->id }}"
                                                        @if($t->delete_status == 1)
                                                            id="block_button"
                                                        @else
                                                            id="unblock_button"
                                                        @endif
                                                        title=" @if ($t->delete_status == 1)
                                                        Delete
                                                    @else
                                                        Restore
                                                    @endif "> <i class="bi @if ($t->delete_status == 1)
                                                        bi-trash text-danger
                                                        @else
                                                        bi-arrow-clockwise text-success
                                                    @endif "></i> </button>

                                                    <button type="button" class="border-0 bg-transparent" style="outline: 0;" value="{{ $t->id }}"
                                                        @if($t->delete_status == 1)
                                                            id="delete_button"
                                                        @else
                                                            id="restore_button"
                                                        @endif
                                                        title=" @if ($t->delete_status == 1)
                                                        Delete
                                                    @else
                                                        Restore
                                                    @endif "> <i class="bi @if ($t->delete_status == 1)
                                                        bi-ban text-danger
                                                        @else
                                                        bi-arrow-repeat text-success
                                                    @endif "></i> </button> --}}
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

    <!-- Modal Leave Verify -->
    <div class="modal fade" id="leave_verify_form" data-bs-backdrop="static" tabindex="-1" aria-labelledby="readInfoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ui medium header" id="readInfoLabel"></i> {{ __('lang.pleaseEnterFormToVerifyLeave') }} </h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <form action="" id="verifyFormModal" class="ui form" method="POST" autocomplete="off">
                    {{-- <form action="{{ route('teacher.leave') }}" id="verifyFormModal" class="ui form" method="POST" autocomplete="off"> --}}
                    @csrf
                    <div class="modal-body">
                        <div class="field">
                            <label for="datepicker"> {{ __('lang.leaveDate') }} </label>
                            <div class="ui icon left input">
                                <input type="text" id="datepicker"  name="leave_date" placeholder="{{ __('lang.enterleaveDate') }}" required>
                                <i class="bi bi-calendar-fill icon"></i>
                            </div>
                        </div>
                        <div class="field">
                            <label for="leave_reason"> {{ __('lang.leaveReason') }} </label>
                            <div class="ui input">
                                <textarea name="leave_reason" id="leave_reason" cols="30" rows="5" placeholder="{{ __('lang.enterLeaveReason') }}" required></textarea>
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
        $(document).ready(function() {
            $(document).on('click', '#delete_button', function() {
                var id = $(this).val();
                var url = "{{ route('teacher.destroy', ':id') }}".replace(':id', id);

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
                var url = "{{ route('teacher.destroy', ':id') }}".replace(':id', id);

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
                var url = "{{ route('teacher.block', ':id') }}".replace(':id', id);
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
                var url = "{{ route('teacher.block', ':id') }}".replace(':id', id);

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
                var url = "{{ route('teacher.resetPass')}}";

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
                var url = "{{ route('teacher.leave', ':id') }}".replace(':id', id);
                var leaveForm = $('#leave_verify_form');
                var verifyFormModal = $('#verifyFormModal');


                Swal.fire({
                    title: '{{ __("lang.areYouSure") }}',
                    text: '{{ __("lang.doesTeacherHasleaved") }}',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ __("lang.yesLeave") }}',
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
        });

    </script>

    <script>
        @php
            $i = 1;
        @endphp
        @foreach ($teachers as $index => $t)
        $(".ui.dropdown{{ $i++ }}").dropdown();
        @endforeach
    </script>
@endsection
