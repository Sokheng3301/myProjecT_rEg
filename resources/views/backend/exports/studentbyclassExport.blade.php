<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student list Export</title>
    <style>

        @font-face {
            font-family: 'KhmerOS';
            src: url("{{ asset('fonts/khmerOS.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        * {
            font-family: 'KhmerOS', sans-serif !important;
            margin: 0 !important;
            padding: 0 !important;
            box-sizing: border-box !important;
        }
        h1,h2,h3,h4,h5,h6,p,span{
            font-family: 'KhmerOS', sans-serif !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        h1{
            font-size: 13px !important;
        }
        p{
            font-size: 11px !important;
            margin: 0 !important;
            line-height: 18px !important;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th,td {
            font-family: 'KhmerOS', sans-serif !important;
            padding: 5px  10px !important;
            border: 0.5px solid #000 !important;
            font-size: 11px !important;
        }
        .text-uppercase{
            text-transform: uppercase !important;
        }
        .text-start, td{
            text-align: start !important;
        }
        .text-center{
            text-align: center !important;
        }
        .d-flex{
            display: flex;
            align-items: center;
        }
        .my-3{
            margin: 10px 0;
        }
    </style>
</head>
<body>
    {{-- <img src="{{ asset('dist/assets/img/logo-bran.png') }}" alt=""> --}}
    <h1 class="text-center">{{__('lang.studentList')}}</h1>
    <div class="d-flex">
        <p>{{__('lang.classCode')}} : {{$class_info->class_code}}</p>
        <p>{{__('lang.department')}} :
            @if(session()->has('localization'))
                {{ session('localization') == 'kh' ? $class_info->majors->departments->dep_name_kh : class_info->majors->departments->dep_name_en}}
            @else
                  {{ $class_info->majors->departments->dep_name_kh}}
            @endif
        </p>
        <p>{{__('lang.major')}} :
            @if(session()->has('localization'))
                {{ session('localization') == 'kh' ? $class_info->majors->major_name_kh : $class_info->majors->major_name_en}}
            @else
                {{ $class_info->majors->major_name_kh }}
            @endif
        </p>
        <p>{{__('lang.studyLevel')}} : {{App\Http\Helpers\AppHelper::studyLevel($class_info->level_study)}}</p>
        <p>{{__('lang.yearLevel')}} : {{App\Http\Helpers\AppHelper::yearLevel($class_info->year_level)}}</p>
        <p>{{__('lang.academicYear')}} : {{$class_info->academy_year}}</p>
    </div>

    <table class="table table-striped table-hover my-3">
        <thead>
            <tr>
                <th scope="col" class="text-start">{{ __('lang.no') }}</th>
                <th scope="col" class="text-start">{{ __('lang.idCard') }}</th>
                <th scope="col" class="text-start">{{ __('lang.fullnameKh') }}</th>
                <th scope="col" class="text-start">{{ __('lang.fullnameEn') }}</th>
                <th scope="col" class="text-start">{{ __('lang.gender') }}</th>
                <th scope="col" class="text-start">{{ __('lang.birthDate') }}</th>
                <th scope="col" class="text-start">{{__('lang.phone')}}</th>
                <th scope="col" class="text-start">{{ __('lang.other') }}</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($list_exports as $export)
                <tr>
                    <td>{{ $i }}</td>
                    <td class="text-start">{{ $export->id_card }}</td>
                    <td>{{ $export->fullname_kh }}</td>
                    <td class="text-uppercase">{{ $export->fullname_en }}</td>
                    <td>
                        @if($export->gender != '')
                            {{ $export->gender == 'm' ? __('lang.male') : __('lang.female') }}
                        @endif
                    </td>
                    <td>{{ $export->birth_date ? \Carbon\Carbon::parse($export->birth_date)->format('d-m-Y') : '' }}</td>
                    <td>{{ $export->phone }}</td>
                    <td></td>
                </tr>
                {{ $i++ }}
            @endforeach
        </tbody>
    </table>

    <div class="d-flex">
        <p>{{__('lang.totalStudent')}} : {{$total_student ?? __('lang.na') }} {{ __("lang.person") }} , {{__('lang.femaleStudent')}} : {{$total_female_student ?? __('lang.na')}} {{__("lang.person")}}</p>
    </div>
</body>
</html>
