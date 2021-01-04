@extends('layouts.admin')

@section('buttons')
<a class="btn btn-primary" href="{{ route('specialties.create', app()->getLocale()) }}" role="button">{{__('Doktor Uzmanlık Alanı Ekle')}}</a>
@endsection

@section('sidebar')
@parent
<a
    href="{{ action('SpecialtyController@create', ['locale' => app()->getLocale()]) }}"
    alt="Create"
    title="Create">
    {{__('Yeni Uzmanlık Alanı Oluştur')}}
</a>
    </div>
</aside>
@endsection

@section('content')
<table class="table" id="bookingsTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>{{__('Doktor Uzmanlık Alanı')}}</th>
            <th>{{__('Doktor Uzmanlık Alanı Tercümesi')}}</th>
            <th>{{__('Oluşturulma Tarihi')}}</th>
            <th class="Actions">{{__('İşlemler')}}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($specialties as $specialty)
            <tr>
                <td>{{ $specialty->id }}</td>
                <td>{{ $specialty->name }}</td>
                <td>{{ $specialty->nameEn }}</td>
                <td>{{ date('F d, Y', strtotime($specialty->created_at)) }}</td>
                <td class="actions">
                    <a
                        href="{{ action('SpecialtyController@edit', ['locale' => app()->getLocale(), 'specialty' => $specialty->id]) }}"
                        alt="Edit"
                        title="Edit">
                      {{__('Düzenle')}}
                    </a>
                    <form action="{{ action('SpecialtyController@destroy', ['locale' => app()->getLocale(), 'specialty' => $specialty->id]) }}" method="POST">
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
{{ $specialties->links() }}
@endsection