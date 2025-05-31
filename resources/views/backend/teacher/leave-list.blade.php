@php
    use Carbon\Carbon;
@endphp
@extends('backend.layout.master')
@section('title')
    {{__('lang.leaveTeacher')}}
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
        {{__('lang.leaveTeacher')}}
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
                            <h3 class="card-title">{{__('lang.leaveTeacherList')}}</h3>
                            <div class="card-tools">
                                {{-- <span title="3 New Messages" class="badge text-bg-primary"> 3 </span> --}}
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>

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
                                            <th scope="col">{{__('lang.blocked')}}</th>
                                            <th scope="col" class="text-center">{{__('lang.action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $incre = 1;
                                            $i= 1;
                                        @endphp
                                        @foreach ($teachers as $t)
                                            <tr @if ($t->leave_status	 == 0)
                                                class="text-danger"
                                            @endif>
                                                <td @if ($t->leave_status	 == 0)
                                                        class="text-danger"
                                                    @endif scope="row">{{$i++}}
                                                </td>
                                                <td @if ($t->leave_status	 == 0)
                                                        class="text-danger"
                                                    @endif>
                                                    <img class="ui mini circular image" src="{{ asset($t->profile ?: 'dist/assets/img/white-image.png') }}" alt="profile">
                                                </td>

                                                <td @if ($t->leave_status	 == 0)
                                                        class="text-danger"
                                                    @endif> {{ $t->id_card }}
                                                </td>
                                                <td @if ($t->leave_status	 == 0)
                                                        class="text-danger"
                                                    @endif> {{ $t->fullname_kh }}
                                                </td>
                                                <td @if ($t->leave_status	 == 0)
                                                        class="text-danger"
                                                    @endif> {{ $t->fullname_en }}
                                                </td>
                                                <td @if ($t->leave_status	 == 0)
                                                        class="text-danger"
                                                    @endif>
                                                    @if ($t->gender == 'm')
                                                        <i class="bi bi-gender-male" style="color: #0464ff;"></i>
                                                    @else
                                                        <i class="bi bi-gender-female" style="color: #ca0079;"></i>
                                                    @endif
                                                </td>
                                                <td @if ($t->leave_status	 == 0)
                                                        class="text-danger"
                                                    @endif> {{ Carbon::parse($t->birth_date)->format('d-m-Y') }}
                                                </td>
                                                <td @if ($t->leave_status	 == 0)
                                                        class="text-danger"
                                                    @endif>
                                                    @if (session()->has('localization') && session('localization') == 'en')
                                                        {{ $t->department->dep_name_en }}
                                                    @else
                                                        {{ $t->department->dep_name_kh }}
                                                    @endif
                                                </td>
                                                <td @if ($t->leave_status	 == 0)
                                                        class="text-danger"
                                                    @endif> {{ $t->phone_number }}
                                                </td>

                                                <td @if ($t->leave_status	 == 0)
                                                        class="text-danger"
                                                    @endif> <small class="{{ $t->block_status == 1 ? 'ui green label' : 'ui red label' }}"> {{ $t->block_status == 1 ?  __('lang.none') : __('lang.blocked')}} </small>
                                                </td>

                                                <td class="text-center">
                                                    <div class="ui">
                                                        <div class="ui floating dropdown dropdown{{ $incre++ }} icon">
                                                            <i class="bi bi-gear"></i>
                                                            <div class="menu">
                                                                <a title="About" href="{{ route('teacher.show', $t->id) }}" class="item"><i class="bi bi-eye-fill"></i> {{ __('lang.aboutTeacher') }}</a>
                                                                <a title="Update" href="{{ route('teacher.edit', $t->id) }}" class="item"><i class="bi bi-pencil-square"></i> {{ __("lang.update") }}</a>
                                                                {{-- <div class="item">
                                                                    <button type="button" class="m-0 p-0 w-100 d-block border-0 bg-transparent text-start"
                                                                        style="outline: 0;"
                                                                        value="{{ $t->id_card }}"
                                                                        id="resetPass_button"
                                                                        title="Reset password">
                                                                        <i class="bi bi-unlock-fill"></i>{{__("lang.resetPassword")}}
                                                                    </button>
                                                                </div> --}}

                                                                {{-- <div class="item">
                                                                    <button type="button" class="m-0 p-0 w-100 d-block border-0 bg-transparent text-start"
                                                                        style="outline: 0;"
                                                                        value="{{ $t->id }}"
                                                                        id="leave_button"
                                                                        title="Reset password">
                                                                        <i class="bi bi-box-arrow-up-left"></i> {{__("lang.leave")}}
                                                                    </button>
                                                                </div> --}}

                                                                {{-- <div class="item text-start">
                                                                    <button type="button" class="m-0 p-0 w-100 d-block border-0 bg-transparent
                                                                        {{ $t->block_status == 1 ? 'text-danger' : 'text-success' }} text-start"
                                                                        style="outline: 0;"
                                                                        value="{{ $t->id_card }}"
                                                                        id="{{ $t->block_status == 1 ? 'block_button': 'unblock_button' }}"
                                                                        title="{{ $t->block_status == 1 ? 'Block' : 'Unblock' }}">

                                                                        <i class="bi {{ $t->block_status == 1 ? 'bi-ban text-danger' : 'bi-arrow-repeat text-success' }}"></i>

                                                                        {{ __('lang.' . ($t->block_status == 1 ? 'block' : 'unblock')) }}
                                                                    </button>
                                                                </div> --}}
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
