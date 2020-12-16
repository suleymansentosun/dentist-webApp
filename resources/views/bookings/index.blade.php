@extends('layouts.admin')

@section('sidebar')
    @parent
    </div>
    <!-- /.sidebar -->
  </aside>
@endsection

@section('content')
<table class="table" id="bookingsTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Doktor Adı</th>
            <th>Hasta Adı</th>
            <th>Hasta Soyadı</th>
            <th>Randevu Tarihi</th>
            <th>Hasta Şikayeti</th>
            <th>Randevu Gerçekleşti mi?</th>
            <th>Randevu Saati Geçti mi?</th>
            <th>Randevu Oluşturulma Tarihi</th>
            <th>Randevuyu Oluşturan Kullanıcı</th>
            <th>Randevu ile ilgili ekstra notlar</th>
            <th class="Actions">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->doctor->name .' '. $booking->doctor->surname }}</td>
                <td>{{ $booking->patient->name ?? 'Hasta kaydı randevuya gelmediği için silinmiştir.'}}</td>
                <td>{{ $booking->patient->surname ?? 'Hasta kaydı randevuya gelmediği için silinmiştir.'}}</td>
                <td>{{ date('Y-m-d H:i:s', strtotime($booking->booking_date)) }}</td>
                <td>{{ $booking->bookingReason->name }}</td>
                <td>{{ $booking->is_materialized ? 'Evet' : 'Hayır' }}</td>
                <td>{{ (strtotime($booking->booking_date) < time()) ? 'Evet' : 'Hayır' }}</td>
                <td>{{ date('F d, Y', strtotime($booking->created_at)) }}</td>
                <td>{{ $booking->user->name }}</td>
                <td>{{ $booking->notes }}</td>
                <td class="actions">
                    <a
                        href="{{ action('BookingController@show', ['booking' => $booking->id]) }}"
                        alt="View"
                        title="View">
                      View
                    </a>
                    <a                         
                        href="{{ action('BookingController@edit', ['booking' => $booking->id]) }}"
                        alt="Edit"
                        title="Edit">
                      Edit
                    </a>
                    <form action="{{ action('BookingController@destroy', ['booking' => $booking->id]) }}"
                    method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-link" title="Delete" value="DELETE">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
        @endforelse
    </tbody>
</table>
{{ $bookings->links() }}
@endsection
