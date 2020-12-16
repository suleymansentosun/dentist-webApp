@extends('layouts.admin')

@section('buttons')
@endsection

@section('sidebar')
@parent
    </div>
</aside>
@endsection

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Adı</th>
            <th>Soyadı</th>
            <th>Telefon Numarası</th>
            <th>Bu Kaydın Oluşturulma Tarihi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($patients as $patient)
            <tr>
                <td>{{ $patient->name }}</td>
                <td>{{ $patient->surname }}</td>
                <td>{{ $patient->phone_number }}</td>
                <td>{{ date('F d, Y', strtotime($patient->created_at)) }}</td>
            </tr>
        @empty
        @endforelse
    </tbody>
</table>
{{ $patients->links() }}
@endsection