@extends('layouts.admin')

@section('buttons')
<a class="btn btn-primary" href="{{ route('doctors.create', app()->getLocale()) }}" role="button">Doktor Ekle</a>
@endsection

@section('sidebar')
@parent
    <a
        href="{{ action('DoctorController@create', ['locale' => app()->getLocale()]) }}"
        alt="Create"
        title="Create">
        {{__('Yeni Doktor Oluştur')}}
    </a>
    </div>
</aside>
@endsection

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>{{__('İsim')}}</th>
            <th>{{__('Soyisim')}}</th>
            <th>{{__('Yıl Olarak Meslekte Geçirdiği Süre')}}</th>
            <th>{{__('Yıl Olarak Kliniğimizde Geçirdiği Süre')}}</th>
            <th>{{__('Maaş')}}</th>
            <th>{{__('Bu Kaydın Oluşturulma Tarihi')}}</th>
            <th class="Actions">{{__('İşlemler')}}</th>
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
                        href="{{ action('DoctorController@show', ['locale' => app()->getLocale(), 'doctor' => $doctor->id]) }}"
                        alt="View"
                        title="View">
                      {{__('İncele')}}
                    </a>
                    <a
                        href="{{ action('DoctorController@edit', ['locale' => app()->getLocale(), 'doctor' => $doctor->id]) }}"
                        alt="Edit"
                        title="Edit">
                      {{__('Düzenle')}}
                    </a>
                    <form action="{{ action('DoctorController@destroy', ['locale' => app()->getLocale(), 'doctor' => $doctor->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-link" title="Delete" value="SİL">
                            {{__('Sil')}}
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