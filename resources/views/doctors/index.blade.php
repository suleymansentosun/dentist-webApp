@extends('layouts.admin')

@section('buttons')
<a class="btn btn-primary" href="{{ route('doctors.create') }}" role="button">Doktor Ekle</a>
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
            <th>Meslekte Geçirdiği Süre(Yıl)</th>
            <th>Kliniğimizde Geçirdiği Süre(Yıl)</th>
            <th>Maaşı</th>
            <th>Bu Kaydın Oluşturulma Tarihi</th>
            <th class="Actions">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($doctors as $doctor)
            <tr>
                <td>{{ $doctor->name }}</td>
                <td>{{ $doctor->surname }}</td>
                <td>{{ \Carbon\Carbon::parse($doctor->graduation_date)->diffInYears(\Carbon\Carbon::now()) }}</td>
                <td>{{ \Carbon\Carbon::parse($doctor->starting_date_employement)->diffInYears(\Carbon\Carbon::now()) }}</td>
                <td>{{ $doctor->salary }}</td>
                <td>{{ date('F d, Y', strtotime($doctor->created_at)) }}</td>
                <td class="actions">
                    <a
                        href="{{ action('DoctorController@show', ['doctor' => $doctor->id]) }}"
                        alt="View"
                        title="View">
                      İncele
                    </a>
                    <a
                        href="{{ action('DoctorController@edit', ['doctor' => $doctor->id]) }}"
                        alt="Edit"
                        title="Edit">
                      Düzenle
                    </a>
                    <form action="{{ action('DoctorController@destroy', ['doctor' => $doctor->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-link" title="Delete" value="SİL">
                            Sil
                        </button>
                    </form>
                </td>
            </tr>
        @empty
        @endforelse
    </tbody>
</table>
{{ $doctors->links() }}
@endsection