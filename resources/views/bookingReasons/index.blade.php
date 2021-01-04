@extends('layouts.admin')

@section('buttons')
<a href="{{ route('bookingReasons.create', app()->getLocale()) }}" class="btn btn-primary" role="button">{{__('Hasta Şikayet Başlığı Ekle')}}</a>
@endsection

@section('sidebar')
@parent
<a
    href="{{ action('BookingReasonController@create', ['locale' => app()->getLocale()]) }}"
    alt="Create"
    title="Create">
    {{__('Yeni Randevu Gerekçesi Oluştur')}}
</a>
    </div>
</aside>
@endsection

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>{{__('Hasta Şikayet Başlığı')}}</th>
            <th>{{__('Hasta Şikayet Başlığı İngilizce Çevirisi')}}</th>
            <th>{{__('Bu Kaydın Oluşturulma Tarihi')}}</th>
            <th class="Actions">{{__('İşlemler')}}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($bookingReasons as $bookingReason)
            <tr>
                <td>{{ $bookingReason->id }}</td>
                <td>{{ $bookingReason->name }}</td>
                <td>{{ $bookingReason->nameEn }}</td>
                <td>{{ date('F d, Y', strtotime($bookingReason->created_at)) }}</td>
                <td class="actions">
                    <a
                        href="{{ action('BookingReasonController@edit', ['locale' => app()->getLocale(), 'bookingReason' => $bookingReason->id]) }}"
                        alt="Edit"
                        title="Edit">
                      {{__('Düzenle')}}
                    </a>
                    <form action="{{ action('BookingReasonController@destroy', ['locale' => app()->getLocale(), 'bookingReason' => $bookingReason->id]) }}" method="POST">
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
{{ $bookingReasons->links() }}
@endsection