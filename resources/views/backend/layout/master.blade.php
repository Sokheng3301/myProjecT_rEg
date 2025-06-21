@php
    $data = '';
    $teacher = DB::table('teachers')->where('id_card', @Auth::user()->id_card);
    if ($teacher) {
        $data = $teacher->get()->first();
        // dd($data);
    } else {
        $data = null;
    }

    // dd($data);

@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    {{-- <title>IMS | KSIT</title> --}}
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Student Mangement System" />
    <meta name="author" content="Kampong Speu Institute of Technology" />

    <meta name="description"
        content="Kampong Speu Institute of Technology (KSIT), Cambodia, Student Management System (IMS). វិទ្យាស្ថានបច្ចេកវិទ្យាកំពង់ស្ពឺ (KSIT), Cambodia, Student Management System (IMS). Kampong Speu Institute of Technology (KSIT), កម្ពុជា, ប្រព័ន្ធគ្រប់គ្រងសិស្ស (IMS).">
    <meta name="keywords"
        content="KSIT, Kampong Speu Institute of Technology, Cambodia, Student Management, Education, Technology">
    <meta name="author" content="Kampong Speu Institute of Technology">

    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow" />
    <meta name="google" content="notranslate" />
    <meta name="revisit-after" content="1 days" />
    <meta name="language" content="{{ str_replace('_', '-', app()->getLocale()) }}" />
    <meta name="theme-color" content="#ffffff" />
    <meta name="apple-mobile-web-app-status-bar-style" content="default" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-title" content="Student Mangement System" />
    <meta name="msapplication-TileColor" content="#ffffff" />

    <meta name="keywords"
        content="
        Kampong Speu Institute of Technology,
        KSIT,
        Student Management System,
        Education,
        Technology,
        Cambodia,
        Student Management,
        Student Management System,
        IMS,
        Kampong Speu Institute of Technology (KSIT)," />
    <link rel="shortcut icon" href="{{ asset('dist/assets/img/logo-bran.png') }}" type="image/x-icon">
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="{{ asset('dist/css/index.css') }}"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="{{ asset('dist/css/overlayscrollbars.min.css') }}"
        integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/icons.boostrap.min.css') }}"> --}}
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link rel="stylesheet" href="{{ asset('dist/css/apexcharts.css') }}"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
    <!-- jsvectormap -->
    <link rel="stylesheet" href="{{ asset('dist/css/jsvectormap.min.css') }}"
        integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous" />
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/semantic.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/dataTables.semanticui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/autoFill.semanticui.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('dist/css/dataTables.bootstrap5.min.css') }}">


    <link rel="stylesheet" href="{{ asset('dist/css/jquery-ui.css') }}">

    {{-- <link rel="stylesheet" href="{{ asset('dist/css/autoFill.bootstrap4.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('dist/css/semantic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/my.css.css') }}">
    <title>@yield('title') | REG-KSIT</title>
    <style>
        /* h3.mb-0{
        font-size: x-large !important;
      } */
        #myTable thead th:first-child {
            /* width: 5% !important; */
        }

        .language {
            /* background:#dbdbdb;
        height:  auto !important;
        padding: 0 8px !important;
        line-height: unset;
        margin-top: 7px;
        border-radius: 50px; */

        }

        #scrollTop {
            position: fixed;
            bottom: 35px;
            right: 20px;
            width: 37px;
            height: 37px;
            background-color: #363a3fb5;
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 20px;
            display: none;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0 2px 8px #00000076;
            text-align: center;
        }

        #preload-grettings {
            width: 100%;
            height: 100%;
            position: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffff;
            z-index: 1000000;
            flex-direction: column;
            /* top: -500px; */
        }


        .loader {
            height: 6px;
            width: 200px;
            --c: no-repeat linear-gradient(#7a9b3d 0 0);
            background: var(--c), var(--c), #dadada;
            background-size: 60% 100%;
            animation: l16 3s infinite;
        }

        @keyframes l16 {
            0% {
                background-position: -150% 0, -150% 0
            }

            66% {
                background-position: 250% 0, -150% 0
            }

            100% {
                background-position: 250% 0, 250% 0
            }
        }
        .a-profile{
            text-decoration: none;
            color: #575757;
            font-size: 1.5rem;
            padding: 0.05rem 0.7rem;
        }
        .a-profile:hover{
            color: #313131;
        }
        .fix-height{
            min-height: 100vh !important;
        }

         /* #preload-submit {
            width: 100%;
            height: 100%;
            position: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #48484833;
            z-index: 1000000;
            flex-direction: column;
        }
        .loader-submit {
            width: 70px;
            --b: 17px;
            aspect-ratio: 1;
            border-radius: 50%;
            padding: 1px;
            background: conic-gradient(#0000 10%,#000000) content-box;
            -webkit-mask:
                repeating-conic-gradient(#0000 0deg,#000 1deg 20deg,#0000 21deg 36deg),
                radial-gradient(farthest-side,#0000 calc(100% - var(--b) - 1px),#000 calc(100% - var(--b)));
            -webkit-mask-composite: destination-in;
                    mask-composite: intersect;
            animation:l4 1.5s infinite steps(10);
            }
        @keyframes l4 {to{transform: rotate(1turn)}}
        */


    </style>
    @yield('css')

</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    @if (session('logedin'))
        <div id="preload-grettings">
            <img src="{{ asset('dist/assets/img/logo-bran.png') }}" id="logo-gretting" class="ui small image"
                alt="">
            <h1 class="ui large header mb-4">{{ __('lang.welcomeToSystem') }}</h1>
            <div class="loader"></div>

        </div>
    @endif
    {{-- <div id="preload-submit" class="d-none">
        <div class="loader-submit"></div>
    </div> --}}


    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list" style="font-size: large !important"></i>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
              <p class="nav-link">Hello world</p>
            </li> --}}
                </ul>
                <!--end::Start Navbar Links-->
                <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto">
                    <!--begin::Messages Dropdown Menu-->

                    <li class="nav-item dropdown">
                        <a class="nav-link language" data-bs-toggle="dropdown" href="#">
                            <i class="bi bi-globe"> </i>
                            <span class="navbar-badge badge text-bg-primary d-block ms-5"
                                style="margin-right: -3px !important">
                                @if (session()->has('localization') && session('localization') == 'en')
                                    En
                                @else
                                    {{ __('lang.kh') }}
                                @endif
                            </span>
                            {{-- <span>

                    @if (session()->has('localization') && session('localization') == 'en')
                      {{__('lang.en')}}
                    @else
                      {{__('lang.kh')}}
                    @endif

                </span> --}}
                        </a>

                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                            <a href=" {{ route('lang', ['locale' => 'kh']) }}" class="dropdown-item">
                                <!--begin::Message-->
                                <span> <img src="{{ asset('dist/assets/img/Khmer.png') }}" width="18%"
                                        alt=""> {{ __('lang.kh') }}</span>
                                <!--end::Message-->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('lang', ['locale' => 'en']) }}" class="dropdown-item">
                                <!--begin::Message-->
                                <span> <img src="{{ asset('dist/assets/img/English.png') }}" width="18%"
                                        alt=""> {{ __('lang.en') }}</span>
                                <!--end::Message-->
                            </a>
                        </div>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link" data-bs-toggle="dropdown" href="#">
                            <i class="bi bi-chat-text"></i>
                            <span class="navbar-badge badge text-bg-danger">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <a href="#" class="dropdown-item">
                                <!--begin::Message-->
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="../../dist/assets/img/user1-128x128.jpg" alt="User Avatar"
                                            class="img-size-50 rounded-circle me-3" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <h3 class="dropdown-item-title">
                                            Brad Diesel
                                            <span class="float-end fs-7 text-danger"><i
                                                    class="bi bi-star-fill"></i></span>
                                        </h3>
                                        <p class="fs-7">Call me whenever you can...</p>
                                        <p class="fs-7 text-secondary">
                                            <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                                <!--end::Message-->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!--begin::Message-->
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="../../dist/assets/img/user8-128x128.jpg" alt="User Avatar"
                                            class="img-size-50 rounded-circle me-3" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <h3 class="dropdown-item-title">
                                            John Pierce
                                            <span class="float-end fs-7 text-secondary">
                                                <i class="bi bi-star-fill"></i>
                                            </span>
                                        </h3>
                                        <p class="fs-7">I got your message bro</p>
                                        <p class="fs-7 text-secondary">
                                            <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                                <!--end::Message-->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!--begin::Message-->
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="../../dist/assets/img/user3-128x128.jpg" alt="User Avatar"
                                            class="img-size-50 rounded-circle me-3" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <h3 class="dropdown-item-title">
                                            Nora Silvester
                                            <span class="float-end fs-7 text-warning">
                                                <i class="bi bi-star-fill"></i>
                                            </span>
                                        </h3>
                                        <p class="fs-7">The subject goes here</p>
                                        <p class="fs-7 text-secondary">
                                            <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                                <!--end::Message-->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                        </div>
                    </li>


                    <!--end::Messages Dropdown Menu-->
                    <!--begin::Notifications Dropdown Menu-->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-bs-toggle="dropdown" href="#">
                            <i class="bi bi-bell-fill"></i>
                            <span class="navbar-badge badge text-bg-warning">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <span class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="bi bi-envelope me-2"></i> 4 new messages
                                <span class="float-end text-secondary fs-7">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="bi bi-people-fill me-2"></i> 8 friend requests
                                <span class="float-end text-secondary fs-7">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                                <span class="float-end text-secondary fs-7">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
                        </div>
                    </li>
                    <!--end::Notifications Dropdown Menu-->
                    <!--begin::Fullscreen Toggle-->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                        </a>
                    </li>
                    <!--end::Fullscreen Toggle-->
                    <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ asset($data->profile ?? 'dist/assets/img/avatar3.png') }}"
                                class="user-image rounded-circle shadow" alt="User Image" />
                            <span class="d-none d-md-inline">
                                @if (@$data->gender == 'm')
                                    {{ __('lang.mr')  }}
                                @else
                                    {{ __('lang.mrs') }}
                                @endif
                                @if (session()->has('localization') && session('localization') == 'en')
                                    {{ @$data->fullname_en ?? __('lang.unknown') }}
                                @else
                                    {{ @$data->fullname_kh ?? __('lang.unknown') }}
                                @endif
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!--begin::User Image-->
                            <li class="user-header text-bg-primary">
                                <img src="{{ asset($data->profile ?? 'dist/assets/img/avatar3.png') }}" class="rounded-circle shadow"
                                    alt="User Image" />
                                <p>
                                    @if (@$data->gender == 'm')
                                        {{ __('lang.mr') }}
                                    @else
                                        {{ __('lang.mrs') }}
                                    @endif

                                    @if (session()->has('localization') && session('localization') == 'en')
                                        {{ @$data->fullname_en ?? __('lang.unknown') }}
                                    @else
                                        {{ @$data->fullname_kh ?? __('lang.unknown') }}
                                    @endif
                                    ({{ __("lang.teacher") }})
                                    <small>{{__("lang.idCard") . ' :  ' }} {{@$data->id_card ?? '00000'}}</small>
                                    {{-- <small>{{__("lang.loginAs") . ' :  '. __("lang.teacher")}}</small> --}}
                                    <hr class="my-2">
                                    <small class="d-block">
                                        {{ __("lang.loginDate") . ' : ' . (@Auth::user() && @Auth::user()->last_login_at ? \Carbon\Carbon::parse(@Auth::user()->last_login_at)->format('d-m-Y') : '-') }}
                                    </small>
                                    <small class="d-block">
                                        {{ __("lang.loginTime") . ' : ' . (@Auth::user() && @Auth::user()->last_login_at ? \Carbon\Carbon::parse(@Auth::user()->last_login_at)->format('h:i:s a') : '-') }}
                                    </small>
                                </p>
                            </li>
                            <!--end::User Image-->
                            <!--begin::Menu Body-->
                            {{-- <li class="user-body">
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-4 text-center"><a href="#">Followers</a></div>
                                    <div class="col-4 text-center"><a href="#">Sales</a></div>
                                    <div class="col-4 text-center"><a href="#">Friends</a></div>
                                </div>
                                <!--end::Row-->
                            </li> --}}
                            <!--end::Menu Body-->
                            <!--begin::Menu Footer-->
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                <li class="dropdown-item">
                                    <a href="" class="d-flex align-items-center a-profile">
                                        <i class="bi bi-person-circle me-2"></i>
                                        <span>{{ __('lang.profile') }}</span>
                                    </a>
                                <li class="dropdown-item">
                                    <a href="" class="d-flex align-items-center a-profile">
                                        <i class="bi bi-person-fill me-2"></i>
                                        <span>{{ __('lang.editProfile') }}</span>
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="" class="d-flex align-items-center a-profile">
                                        <i class="bi bi-key-fill me-2"></i>
                                        <span>{{ __('lang.changePassword') }}</span>
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="" class="d-flex align-items-center a-profile">
                                        <i class="bi bi-gear-fill me-2"></i>
                                        <span>{{ __('lang.settings') }}</span>
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="{{ route('logout') }}" class="d-flex align-items-center a-profile">
                                        <i class="bi bi-box-arrow-right me-2"></i>
                                        <span>{{ __('lang.logout') }}</span>
                                    </a>
                                </li>
                            </ul>
                            {{-- <li class="user-footer">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-end">Sign
                                    out</a>
                            </li> --}}
                            <!--end::Menu Footer-->
                        </ul>
                    </li>
                    <!--end::User Menu Dropdown-->
                </ul>
                <!--end::End Navbar Links-->
            </div>
            <!--end::Container-->
        </nav>
        <!--end::Header-->
        <!--begin::Sidebar-->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <!--begin::Sidebar Brand-->
            <div class="sidebar-brand">
                <!--begin::Brand Link-->
                <a href=" {{ route('home') }}" class="brand-link">
                    <!--begin::Brand Image-->
                    <img src="{{ asset('dist/assets/img/logo-bran.png') }}" alt="AdminLTE Logo"
                        class="brand-image opacity-75 shadow" />
                    <!--end::Brand Image-->
                    <!--begin::Brand Text-->
                    <span class="brand-text fw-light">IMS</span>
                    <!--end::Brand Text-->
                </a>
                <!--end::Brand Link-->
            </div>
            <!--end::Sidebar Brand-->
            <!--begin::Sidebar Wrapper-->

            @include('backend.partials.sidebar')

            <!--end::Sidebar Wrapper-->
        </aside>
        <!--end::Sidebar-->
        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0"> @yield('pageTitle') </h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"> {{ __('lang.home') }}
                                    </a></li>
                                <li class="breadcrumb-item active" aria-current="page"> @yield('pageTitle') </li>
                                {{-- <li class="breadcrumb-item active" aria-current="page"> HI </li> --}}
                            </ol>
                        </div>
                    </div>
                    <!--end::Row-->
                    <a href="{{ url()->previous() }}" class="mini ui button  rounded-2"> <i
                            class="bi bi-reply-fill"></i> {{ __('lang.back') }}</a>

                </div>
            </div>
            @yield('content')
            <!--end::App Content-->
        </main>
        <!--end::App Main-->
        <!--begin::Footer-->
        <footer class="app-footer">
            <div id="scrollTop">
                <i class="bi bi-arrow-up"></i>
            </div>
            <!--begin::To the end-->
            <div class="float-end d-none d-sm-inline">{{ config('app.version') }}</div>
            <!--end::To the end-->
            <!--begin::Copyright-->
            <strong>
                {{ __('lang.Copyright') }} &copy; 2025&nbsp;
                <a href="https://ksit.edu.kh/" target="_blank"
                    class="text-decoration-none">{{ __('lang.ksit') }}</a> -
            </strong>
            {{ __('lang.allRightReserve') }}
            <!--end::Copyright-->
        </footer>
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->

    <!--begin::Script-->
    @include('backend.partials.script')
    <!--end::Script-->

    <script>
        $(document).ready(function() {
            // $('#myTable').DataTable();
            $('#myTable').DataTable({
                "language": {
                    "search": "{{ __('lang.search') }}",
                    "lengthMenu": "{{ __('lang.show') }} _MENU_ {{ __('lang.records') }}",
                    "info": "{{ __('lang.showing') }} _START_ {{ __('lang.to') }} _END_ {{ __('lang.of') }} _TOTAL_ {{ __('lang.records') }}",
                    "infoEmpty": "{{ __('lang.noRecordsFound') }}",
                    "paginate": {
                        "next": "{{ __('lang.next') }}",
                        "previous": "{{ __('lang.previous') }}"
                    }
                },
                "order": [[1, 'asc']],
                // "columnDefs": [
                //     { orderable: false, targets: [] }
                // ]

            });


            setTimeout(function() {
                $('#tableReload').fadeOut();
            }, 1000);
        });
    </script>
    @if (session()->has('success'))
        <script>
            $(document).ready(function() {
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
                    title: "{{ session('success') }}"
                });
            });
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            $(document).ready(function() {
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
                    title: "{{ session('error') }}"
                });
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            // Show the button when scrolled down 200px
            // $('#scrollTop').hide();

            $(window).scroll(function() {
                if ($(this).scrollTop() > 200) {
                    $('#scrollTop').css('display', 'flex');
                    $('#scrollTop').fadeIn();
                } else {
                    $('#scrollTop').css('display', 'none');
                    $('#scrollTop').fadeOut();
                }
            });

            // On click, scroll to top
            $('#scrollTop').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 600);
            });
        });

        // Hide the preload-grettings after page load
        $(window).on('load', function() {
            $('#preload-grettings').fadeOut(5000);
        });
    </script>
    @yield('script')


</body>
<!--end::Body-->

</html>
