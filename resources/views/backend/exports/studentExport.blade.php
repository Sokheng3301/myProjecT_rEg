
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
                <td>{{ $export->fullname_en }}</td>
                <td>{{ $export->birth_date ? \Carbon\Carbon::parse($export->birth_date)->format('m-d-Y') : '' }}</td>
                <td></td>
            </tr>
            {{ $i++ }}
        @endforeach
    </tbody>
</table>
