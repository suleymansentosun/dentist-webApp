@extends('layouts.admin')

@section('buttons')
<a href="{{ route('bookingReasons.create') }}" class="btn btn-primary" role="button">Hasta Şikayet Başlığı Ekle</a>
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
            <th>ID</th>
            <th>Hasta Şikayet Başlığı</th>
            <th>Bu Kaydın Oluşturulma Tarihi</th>
            <th class="Actions">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($bookingReasons as $bookingReason)
            <tr>
                <td>{{ $bookingReason->id }}</td>
                <td>{{ $bookingReason->name }}</td>
                <td>{{ date('F d, Y', strtotime($bookingReason->created_at)) }}</td>
                <td class="actions">
                    <a
                        href="{{ action('BookingReasonController@edit', ['bookingReason' => $bookingReason->id]) }}"
                        alt="Edit"
                        title="Edit">
                      Düzenle
                    </a>
                    <form action="{{ action('BookingReasonController@destroy', ['bookingReason' => $bookingReason->id]) }}" method="POST">
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
{{ $bookingReasons->links() }}
@endsection