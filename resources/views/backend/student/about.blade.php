@extends('backend.layout.master')
@section('title')
    {{__('lang.aboutStudent')}}
@endsection
@section('content')

    {{-- <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">{{__("lang.Major")}}</h3></div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#"> {{ __('lang.home') }} </a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('lang.Major')}}</li>
                </ol>
                </div>
            </div>
        </div>
    </div> --}}

    @section('pageTitle')
        {{__('lang.aboutStudent')}}
    @endsection

    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row">
            <!-- Start col -->
                <div class="col-md-12 connectedSortable">

                <!-- /.card -->
                <!-- DIRECT CHAT -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">{{__('lang.studentProfile')}} </h3>
                        </div>
                        <div class="card-body">
                            <!-- Conversations are loaded here -->
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="row">
                                        <div class="col-md-6 mx-auto">
                                            {{-- <label for="teacher_profile" class="file-upload"> --}}
                                                <img class="ui small image mx-auto bordered" @if ($student->profile)
                                                    src="{{ asset($student->profile) }}"
                                                    @else
                                                    src="{{ asset('dist/assets/img/white-image.png') }}"
                                                    @endif alt="" id="dep_logo_img">
                                                <p class="text-center mt-2">{{__("lang.studentPhoto")}}</p>
                                                <div class="col-md-10 mx-auto">
                                                    {{-- @if($block_info->block_status == 0 || $student->leave_status == 0)
                                                        <div class="ui red message">
                                                            @if($block_info->block_status == 0)
                                                                <p class="fw-bold">{{__("lang.teacherHasBlocked")}}</p>
                                                                <p class="ps-3"> <i class="bi bi-calendar"></i> {{ \Carbon\Carbon::parse($block_info->blocked_date)->format('d-m-Y') }}</p>
                                                                <p class="ps-3"> <i class="bi bi-person"></i> {{ $block_info->blocked_by }}</p>
                                                            @endif
                                                            @if($student->leave_status == 0)
                                                                <p class="fw-bold">{{__("lang.teacherHasLeaved")}}</p>
                                                                <p class="ps-3"> <i class="bi bi-calendar"></i> {{ \Carbon\Carbon::parse($student->leave_date)->format('d-m-Y') }}</p>
                                                                <p class="ps-3"> <i class="bi bi-chat-right-dots"></i> {{ $student->leave_description }}</p>
                                                            @endif
                                                        </div>
                                                    @endif --}}


                                                </div>


                                            {{-- </label> --}}
                                            {{-- <input type="file" name="profile" class="d-none" id="teacher_profile"accept="image/*" onchange="document.getElementById('dep_logo_img').src = window.URL.createObjectURL(this.files[0])"> --}}
                                        </div>
                                    </div>
                                </div>


                            {{-- section 1 --}}
                                <div class="col-md-12 my-3">
                                    <h3 class="pb-2 ui red header border-bottom">1. {{__("lang.studentInfo")}}</h3>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row mb-3">
                                                <div class="col-5 fw-bold">{{ __('lang.idCard') }}</div>
                                                <p class="col-7">{{ $student->id_card ?: __('lang.null') }}</p>

                                                <div class="col-5 fw-bold">{{ __('lang.fullnameKh') }}</div>
                                                <p class="col-7">{{ $student->fullname_kh ?? __('lang.null') }}</p>

                                                <div class="col-5 fw-bold">{{ __('lang.fullnameEn') }}</div>
                                                <p class="col-7 text-uppercase">{{ $student->fullname_en ?? __('lang.null') }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.gender') }}</div>
                                                <p class="col-7">{{ $student->gender == 'm' ? __('lang.male') : __('lang.female') }}</p>

                                                <div class="col-5 fw-bold">{{ __('lang.national') }}</div>
                                                <p class="col-7">{{ $student->national ?: __('lang.null') }}</p>

                                                <div class="col-5 fw-bold">{{ __('lang.nationality') }}</div>
                                                <p class="col-7">{{ $student->nationality ?: __('lang.null') }}</p>

                                                <div class="col-5 fw-bold">{{ __('lang.birthDate') }}</div>
                                                <p class="col-7">{{ $student->birth_date ? \Illuminate\Support\Carbon::parse($student->birth_date)->format('d-m-Y') : __("lang.null") }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.placeBirth') }}</div>
                                                <p class="col-7">{{ $student->place_of_birth ?: __('lang.null') }}</p>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row mb-3">
                                                <div class="col-5 fw-bold">{{ __('lang.department') }}</div>
                                                <p class="col-7">
                                                    @if (session()->has('localization') && session('localization') == 'en')
                                                        {{ $student->class->majors->departments->dep_name_en }}
                                                    @else
                                                        {{ $student->class->majors->departments->dep_name_kh }}
                                                    @endif
                                                </p>

                                                <div class="col-5 fw-bold">{{ __('lang.major') }}</div>
                                                <p class="col-7">
                                                        @if (session()->has('localization') && session('localization') == 'en')
                                                        {{ $student->class->majors->major_name_en }}
                                                    @else
                                                        {{ $student->class->majors->major_name_kh }}
                                                    @endif
                                                </p>
                                                <div class="col-5 fw-bold">{{ __('lang.studyLevel') }}</div>
                                                <p class="col-7">{{ \App\Http\Helpers\AppHelper::studyLevel($student->class->level_study) ?? __("lang.null") }}</p>

                                                <div class="col-5 fw-bold">{{ __('lang.yearLevel') }}</div>
                                                <p class="col-7">{{ \App\Http\Helpers\AppHelper::yearLevel($student->class->year_level) ?? __("lang.null") }}</p>

                                                <div class="col-5 fw-bold">{{ __('lang.startAcademyYear') }}</div>
                                                <p class="col-7">{{ $student->class->academy_year  ?: __("lang.null") }}</p>

                                                <div class="col-5 fw-bold">{{ __('lang.current_add') }}</div>
                                                <p class="col-7"> {{ $student->current_add ?: __('lang.null')}}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.phone_number') }}</div>
                                                <p class="col-7">{{ $student->phone ?: __("lang.null")}}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.email_add') }}</div>
                                                <p class="col-7">{{ $student->email ?: __("lang.null")}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-md-12 my-3">
                                    <div class="ui error message"></div>
                                </div> --}}





                            {{-- section 2 --}}
                                <div class="col-md-12 my-3">
                                    <h3 class="pb-2 ui red header border-bottom">2. {{__("lang.studyHistory ")}} </h3>
                                </div>

                                <div class="col-md-12 table-responsive">
                                    <div class="myresponsive_table">
                                        <table class="table table-sm" id="studentStudyHistory">
                                            <thead>
                                                <tr>
                                                    <th scope="col"> {{ __('lang.levelClass') }} </th>
                                                    <th scope="col"> {{ __('lang.schoolName') }} </th>
                                                    <th scope="col"> {{ __('lang.province') }} </th>
                                                    <th scope="col"> {{ __('lang.startYear') }} </th>
                                                    <th scope="col"> {{ __('lang.endYear') }} </th>
                                                    <th scope="col"> {{ __('lang.certificateRecieve') }} </th>
                                                    <th scope="col"> {{ __('lang.rank') }} </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($student_study_history->isEmpty())
                                                    <tr>
                                                        <td colspan="7" class="text-center">{{ __('lang.noDataAvailable') }}</td>
                                                    </tr>
                                                @else
                                                    @foreach ($student_study_history as $study)
                                                        <tr>
                                                            <td class="field">{{ $study->class_level ?: __('lang.null') }}</td>
                                                            <td class="field">{{ $study->school_name ?: __('lang.null') }}</td>
                                                            <td class="field">{{ $study->province ?: __('lang.null') }}</td>
                                                            <td class="field">{{ $study->start_year ?: __('lang.null') }}</td>
                                                            <td class="field">{{ $study->end_year ?: __('lang.null') }}</td>
                                                            <td class="field">{{ $study->certification ?: __('lang.null') }}</td>
                                                            <td class="field">{{ $study->rank ?: __('lang.null') }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            {{-- section 3 --}}
                                <div class="col-md-12 my-3">
                                    <h3 class="pb-2 ui red header border-bottom">3. {{__("lang.familyInformation")}} </h3>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <h4 class="my-3"> <i class="bi bi-dot text-danger"></i> {{__('lang.aboutFather')}}</h4>
                                            <div class="row mb-3">
                                                <div class="col-5 fw-bold">{{ __('lang.fatherName') }}</div>
                                                <p class="col-7">{{ $student->father_name ?: __('lang.null') }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.age') }}</div>
                                                <p class="col-7">{{ $student->father_age ? $student->father_age . ' ' .__("lang.year") : __('lang.null') }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.occupation') }}</div>
                                                <p class="col-7">{{ $student->father_occupation ?: __('lang.null') }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.phoneNumber') }}</div>
                                                <p class="col-7">{{ $student->father_phone ?: __('lang.null') }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.current_add') }}</div>
                                                <p class="col-7">{{ $student->father_add ?: __('lang.null') }}</p>
                                            </div>
                                        </div>

                                            <div class="col-md-6 mb-2">
                                            <h4 class="my-3"> <i class="bi bi-dot text-danger"></i> {{__('lang.aboutMother')}}</h4>
                                            <div class="row mb-3">
                                                <div class="col-5 fw-bold">{{ __('lang.motherName') }}</div>
                                                <p class="col-7">{{ $student->mother_name ?: __('lang.null') }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.age') }}</div>
                                                <p class="col-7">{{ $student->mother_age ? $student->mother_age . ' ' .__("lang.year") : __('lang.null') }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.occupation') }}</div>
                                                <p class="col-7">{{ $student->mother_occupation ?: __('lang.null') }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.phoneNumber') }}</div>
                                                <p class="col-7">{{ $student->mother_phone ?: __('lang.null') }}</p>
                                                <div class="col-5 fw-bold">{{ __('lang.current_add') }}</div>
                                                <p class="col-7">{{ $student->mother_add ?: __('lang.null') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="row">
                                                <div class="col-5 fw-bold">{{ __('lang.totalSibling') }}</div>
                                                <p class="col-7">{{ $student->sibling ?  $student->sibling .  ' ' . __('lang.person')  : __('lang.null') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="row">
                                                <div class="col-5 fw-bold">{{ __('lang.femaleMemeber') }}</div>
                                                <p class="col-7">{{ $student->female_sibling ? $student->female_sibling . ' '. __('lang.person') : __('lang.null') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12 mt-2 table-responsive">
                                    <div class="myresponsive_table">
                                        <table class="table table-sm" id="studentSiblingTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col"> {{ __('lang.name') }} </th>
                                                    <th scope="col"> {{ __('lang.gender') }} </th>
                                                    <th scope="col"> {{ __('lang.birthDate') }} </th>
                                                    <th scope="col"> {{ __('lang.occupation') }} </th>
                                                    <th scope="col"> {{ __('lang.current_add') }} </th>
                                                    <th scope="col"> {{ __('lang.phone') }} </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($student_sibling->isEmpty())
                                                    <tr>
                                                        <td colspan="6" class="text-center">{{ __('lang.noDataAvailable') }}</td>
                                                    </tr>
                                                @else
                                                    @foreach ($student_sibling as $sibling)
                                                        <tr>
                                                            <td>{{$sibling->name ?: __('lang.null')}}</td>
                                                            <td>{{$sibling->gender ?: __('lang.null')}}</td>
                                                            <td>
                                                                @if($sibling->birth_date != null)
                                                                    {{Carbon\Carbon::parse($sibling->birth_date) -> format('d-m-Y') }}
                                                                @else
                                                                    {{__('lang.null')}}
                                                                @endif
                                                            </td>
                                                            <td>{{$sibling->occupation ?: __('lang.null')}}</td>
                                                            <td>{{$sibling->current_add ?: __('lang.null')}}</td>
                                                            <td>{{$sibling->phone ?: __('lang.null')}}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            {{-- section 4 --}}
                                <div class="col-md-12 my-3">
                                    <h3 class="pb-2 ui red header border-bottom">4. {{__("lang.studentQrCode")}} </h3>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    {{ __('lang.studentQrCodeShowhere') }}
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    @if ($student->qrcode == '')
                                                        <a href="{{ route('qrcode.generate', $student->id) }}" data-id="{{ $student->id }}" id="qrGenerateButton" class="ui basic button text-center d-block mx-auto" style="width: fit-content;">
                                                            <i class="bi bi-qr-code icon"></i>
                                                            {{ __('lang.generateQrcode') }}
                                                        </a>
                                                    @else
                                                        <div class="my-2 mt-3">
                                                            <p id="imgQrcode" class="ui image small mx-auto text-center d-block mb-4">{!! $student->qrcode !!}</p>
                                                        </div>
                                                        <div class="text-center">
                                                            <a href="{{ route('qrcode.download', $student->id) }}" class="text-center"><i class="bi bi-download"></i> {{__('lang.downloadQrcode')}}</a>
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        $(document).ready(function () {
            // $(document).on('click', '#qrGenerateButton', function () {
            //     var studentId = $(this).data('id');
            // });

            // $('#download').click(function() {
            //     const canvas = $('#imgQrcode canvas')[0];
            //     if (canvas) {
            //         const image = canvas.toDataURL("image/png");
            //         const link = document.createElement('a');
            //         link.href = image;
            //         link.download = 'qrcode.png';
            //         link.click();
            //     } else {
            //         alert("Please generate a QR code first.");
            //     }
            // });

             $('#download').click(function() {
            // Create a temporary canvas
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');

            // Get the QR code element
            const qrCodeElement = document.getElementById('imgQrcode');

            // Set canvas size
            canvas.width = qrCodeElement.offsetWidth;
            canvas.height = qrCodeElement.offsetHeight;

            // Render the QR code to the canvas
            const dataUrl = qrCodeElement.querySelector('img').src; // Assuming the QR code is rendered as an <img>
            const img = new Image();
            img.crossOrigin = 'Anonymous'; // Handle CORS if necessary
            img.onload = function() {
                context.drawImage(img, 0, 0);
                const link = document.createElement('a');
                link.href = canvas.toDataURL('image/png');
                link.download = 'qrcode.png';
                link.click();
            };
            img.src = dataUrl; // Set the source of the image
        });
        });
    </script>
@endsection
