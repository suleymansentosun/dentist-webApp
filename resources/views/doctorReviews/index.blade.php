@extends('layouts.app')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>İlgili Doktor</th>
            <th>Yorum Yapan Kullanıcı</th>
            <th>Yorum Başlığı</th>
            <th>Yorum İçeriği</th>
            <th>İlgili Doktora Verilen Puan</th>
            <th>Yorum Onaylandı mı?</th>
            <th>Yorum Oluşturulma Tarihi</th>
            <th class="Actions">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($doctorReviews as $doctorReview)
            <tr>
                <td>{{ $doctorReview->id }}</td>
                <td>{{ $doctorReview->doctor_id }}</td>
                <td>{{ $doctorReview->user_id }}</td>
                <td>{{ $doctorReview->headline }}</td>
                <td>{{ $doctorReview->comment }}</td>
                <td>{{ $doctorReview->rating }}</td>
                <td>{{ $doctorReview->approve ? 'Yes' : 'No' }}</td>
                <td>{{ date('F d, Y', strtotime($booking->created_at)) }}</td>
                <td class="actions">
                    <a
                        href="{{ action('BookingController@show', ['locale' => app()->getLocale(), 'booking' => $booking->id]) }}"
                        alt="View"
                        title="View">
                      View
                    </a>
                    <a
                        href="{{ action('BookingController@edit', ['locale' => app()->getLocale(), 'booking' => $booking->id]) }}"
                        alt="Edit"
                        title="Edit">
                      Edit
                    </a>
                    <form action="{{ action('DoctorReviewController@edit', ['locale' => app()->getLocale()]) }}">
                        <input name="is_approved" type="checkbox" class="form-check-input" value="1" {{ $doctorReview->approve ? 'checked' : '' }}/> 
                        <label class="form-check-label" for="is_approved">Onayla</label>
                    </form>
                </td>
            </tr>
        @empty
        @endforelse
    </tbody>
</table>
{{ $doctorReviews->links() }}
@endsection
