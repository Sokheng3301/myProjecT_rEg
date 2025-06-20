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
    </style>
</head>
<body>
    
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">{{ __('lang.no') }}</th>
                <th scope="col">{{ __('lang.username') }}</th>
                <th scope="col">{{ __('lang.password') }}</th>
                <th scope="col">{{ __('lang.idCard') }}</th>
                <th scope="col">{{ __('lang.fullnameKh') }}</th>
                <th scope="col">{{ __('lang.fullnameEn') }}</th>
                <th scope="col">{{ __('lang.birthDate') }}</th>
                <th scope="col">{{ __('lang.other') }}</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($list_exports as $export)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $export->id_card }}</td>
                    <td class="text-danger">{{ $export->hint_password }}</td>
                    <td>{{ $export->id_card }}</td>
                    <td>{{ $export->fullname_kh }}</td>
                    <td class="text-uppercase">{{ $export->fullname_en }}</td>
                    <td>{{ $export->birth_date ? \Carbon\Carbon::parse($export->birth_date)->format('m-d-Y') : '' }}</td>
                    <td></td>
                </tr>
                {{ $i++ }}
            @endforeach
        </tbody>
    </table>
</body>
</html>
