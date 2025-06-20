    <div class="sidebar-wrapper">
        <nav class="mt-2">
        <!--begin::Sidebar Menu-->
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="menu"
                data-accordion="false"
                >
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                        {{ __('lang.dashboard') }}
                        </p>
                    </a>
                    {{--
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="./index.html" class="nav-link active">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Dashboard v1</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Dashboard v2</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Dashboard v3</p>
                        </a>
                        </li>
                    </ul> --}}
                </li>

                <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-box-seam-fill"></i>
                    <p>
                     {{ __('lang.masterData') }}
                    <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{ route('department.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p> {{ __('lang.department') }} </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('major.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p> {{ __('lang.major') }} </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('class.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>{{__("lang.class")}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('semester.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>{{__("lang.semester")}}</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('classroom.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>{{__("lang.classroom")}}</p>
                        </a>
                    </li>
                </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>
                        {{ __('lang.teacherManagement') }}
                        {{-- <span class="nav-badge badge text-bg-secondary me-3">6</span> --}}
                        <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="{{ route("teacher.index") }}" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>{{__('lang.teacherList')}}</p>
                        </a>
                        </li>


                        <li class="nav-item">
                        <a href="{{ route('teacher.leaveList') }}" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p> {{ __('lang.teacherLeave') }} </p>
                        </a>
                        </li>
                    </ul>
                </li>
                 <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-mortarboard-fill"></i>
                        <p>
                        {{ __('lang.studentManagement') }}
                        {{-- <span class="nav-badge badge text-bg-secondary me-3">6</span> --}}
                        <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                        <a href="{{ route('student.createMultiple') }}" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p> {{ __('lang.addMultipleStudent') }} </p>
                        </a>
                        </li>


                        <li class="nav-item">
                        <a href="{{ route('student.create') }}" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p> {{ __('lang.addStudent') }} </p>
                        </a>
                        </li>


                        <li class="nav-item">
                        <a href="{{ route('student.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>{{__('lang.studentList')}}</p>
                        </a>
                        </li>

                        <li class="nav-item">
                        <a href="{{ route('student-dropout.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p> {{ __('lang.studentDropOut') }} </p>
                        </a>
                        </li>

                        <li class="nav-item">
                        <a href="{{ route('qrcode.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p> {{ __('lang.qrCode') }} </p>
                        </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('course.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-list-stars"></i>
                        <p>
                        {{ __('lang.courseManagement') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-calendar2-week-fill"></i>
                    <p>
                        {{ __("lang.ScheduleManagement") }}
                    <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="./UI/general.html" class="nav-link">
                        <i class="nav-icon bi bi-circle"></i>
                        <p> {{ __("lang.currentSchedule") }} </p>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a href="./UI/icons.html" class="nav-link">
                        <i class="nav-icon bi bi-circle"></i>
                        <p> {{ __("lang.draftSchedule") }} </p>
                    </a>
                    </li>
                </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon bi bi-calendar2-week-fill"></i>
                        <p>
                        {{ __('lang.yourSchedule') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-clipboard-data-fill"></i>
                    <p>
                    {{ __('lang.studentScore') }}
                    <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="./forms/general.html" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>{{__("lang.inputScore")}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./forms/general.html" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>{{__("lang.draftScore")}}</p>
                        </a>
                    </li>
                </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-list-check"></i>
                        <p>
                        {{ __('lang.scoreSubmitted') }}
                        <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./forms/general.html" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{__("lang.newSubmitted")}}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./forms/general.html" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{__("lang.scoreAccepted")}}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-mailbox2"></i>
                    <p>
                    {{ __('lang.studentRequest') }}
                    <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="./tables/simple.html" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p> {{ __('lang.newRequest') }} </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./tables/simple.html" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p> {{ __('lang.acceptedRequest') }} </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./tables/simple.html" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p> {{ __('lang.rejectedRequest') }} </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./tables/simple.html" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p> {{ __('lang.doneRequest') }} </p>
                        </a>
                    </li>
                </ul>
                </li>
                <li class="nav-header text-uppercase">{{__("lang.systemOperating")}}</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>
                        {{ __('lang.userManagement') }}
                        <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./tables/simple.html" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p> {{ __('lang.userList') }} </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./tables/simple.html" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p> {{ __('lang.blockedList') }} </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-person-fill-gear"></i>
                        <p>
                        {{ __('lang.role&permission') }}
                        <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./tables/simple.html" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p> {{ __('lang.role') }} </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./tables/simple.html" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p> {{ __('lang.permission') }} </p>
                            </a>
                        </li>

                         <li class="nav-item">
                            <a href="./tables/simple.html" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p> {{ __('lang.manageUserRole') }} </p>
                            </a>
                        </li>
                    </ul>
                </li>



                {{-- <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-box-arrow-in-right"></i>
                    <p>
                    Auth
                    <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-box-arrow-in-right"></i>
                        <p>
                        Version 1
                        <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="./examples/login.html" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Login</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="./examples/register.html" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Register</p>
                        </a>
                        </li>
                    </ul>
                    </li>
                    <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-box-arrow-in-right"></i>
                        <p>
                        Version 2
                        <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="./examples/login-v2.html" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Login</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="./examples/register-v2.html" class="nav-link">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Register</p>
                        </a>
                        </li>
                    </ul>
                    </li>
                    <li class="nav-item">
                    <a href="./examples/lockscreen.html" class="nav-link">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Lockscreen</p>
                    </a>
                    </li>
                </ul>
                </li>
                <li class="nav-header">DOCUMENTATIONS</li>
                <li class="nav-item">
                <a href="./docs/introduction.html" class="nav-link">
                    <i class="nav-icon bi bi-download"></i>
                    <p>Installation</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="./docs/layout.html" class="nav-link">
                    <i class="nav-icon bi bi-grip-horizontal"></i>
                    <p>Layout</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="./docs/color-mode.html" class="nav-link">
                    <i class="nav-icon bi bi-star-half"></i>
                    <p>Color Mode</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-ui-checks-grid"></i>
                    <p>
                    Components
                    <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="./docs/components/main-header.html" class="nav-link">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Main Header</p>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a href="./docs/components/main-sidebar.html" class="nav-link">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Main Sidebar</p>
                    </a>
                    </li>
                </ul>
                </li>
                <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-filetype-js"></i>
                    <p>
                    Javascript
                    <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="./docs/javascript/treeview.html" class="nav-link">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Treeview</p>
                    </a>
                    </li>
                </ul>
                </li>
                <li class="nav-item">
                <a href="./docs/browser-support.html" class="nav-link">
                    <i class="nav-icon bi bi-browser-edge"></i>
                    <p>Browser Support</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="./docs/how-to-contribute.html" class="nav-link">
                    <i class="nav-icon bi bi-hand-thumbs-up-fill"></i>
                    <p>How To Contribute</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="./docs/faq.html" class="nav-link">
                    <i class="nav-icon bi bi-question-circle-fill"></i>
                    <p>FAQ</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="./docs/license.html" class="nav-link">
                    <i class="nav-icon bi bi-patch-check-fill"></i>
                    <p>License</p>
                </a>
                </li>
                <li class="nav-header">MULTI LEVEL EXAMPLE</li>
                <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-circle-fill"></i>
                    <p>Level 1</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-circle-fill"></i>
                    <p>
                    Level 1
                    <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Level 2</p>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>
                        Level 2
                        <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-record-circle-fill"></i>
                            <p>Level 3</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-record-circle-fill"></i>
                            <p>Level 3</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-record-circle-fill"></i>
                            <p>Level 3</p>
                        </a>
                        </li>
                    </ul>
                    </li>
                    <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Level 2</p>
                    </a>
                    </li>
                </ul>
                </li>
                <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-circle-fill"></i>
                    <p>Level 1</p>
                </a>
                </li>
                <li class="nav-header">LABELS</li>
                <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-circle text-danger"></i>
                    <p class="text">Important</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-circle text-warning"></i>
                    <p>Warning</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-circle text-info"></i>
                    <p>Informational</p>
                </a>
                </li> --}}
            </ul>
        <!--end::Sidebar Menu-->
        </nav>
    </div>
