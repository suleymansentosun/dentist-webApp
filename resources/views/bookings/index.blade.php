@extends('layouts.admin')

@section('sidebar')
    @parent
    </div>
    <!-- /.sidebar -->
  </aside>
@endsection

@section('content')

@if (Session::has('error'))
   <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

<table class="table" id="bookingsTable">
    <thead>
        <tr>
            <th>{{__('ID')}}</th>
            <th>{{__('Doktor Adı')}}</th>
            <th>{{__('Hasta Adı')}}</th>
            <th>{{__('Hasta Soyadı')}}</th>
            <th>{{__('Randevu Tarihi')}}</th>
            <th>{{__('Hasta Şikayeti')}}</th>
            <th>{{__('Randevu Gerçekleşti mi?')}}</th>
            <th>{{__('Randevu Saati Geçti mi?')}}</th>
            <th>{{__('Randevu Oluşturulma Tarihi')}}</th>
            <th>{{__('Randevuyu Oluşturan Kullanıcı')}}</th>
            <th>{{__('Randevu ile ilgili ekstra notlar')}}</th>
            <th class="Actions">{{__('İşlemler')}}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->doctor->name .' '. $booking->doctor->surname }}</td>
                <td>
                    @if (isset($booking->patient->name))
                        {{$booking->patient->name}}
                    @elseif (app()->getLocale() == 'tr')
                        'Hasta kaydı randevuya gelmediği için silinmiştir.'
                    @else
                        'The patient record was deleted because he did not came to the booking'
                    @endif
                 </td>
                <td>
                    @if (isset($booking->patient->surname))
                        {{$booking->patient->surname}}
                    @elseif (app()->getLocale() == 'tr')
                        'Hasta kaydı randevuya gelmediği için silinmiştir.'
                    @else
                        'The patient record was deleted because he did not came to the booking'
                    @endif
                </td>
                <td>{{ date('Y-m-d H:i:s', strtotime($booking->booking_date)) }}</td>
                <td>
                    @if (app()->getLocale() == 'tr')
                        {{$booking->bookingReason->name}}
                    @else
                        {{$booking->bookingReason->nameEn}}
                    @endif
                </td>
                <td>
                    @if (app()->getLocale() == 'tr')                     
                        {{$booking->is_materialized ? 'Evet' : 'Hayır'}}
                    @else 
                        {{$booking->is_materialized ? 'Yes' : 'No'}}
                    @endif
                </td>
                <td>
                    @if (app()->getLocale() == 'tr')                     
                        {{(strtotime($booking->booking_date) < time()) ? 'Evet' : 'Hayır'}}
                    @else 
                        {{(strtotime($booking->booking_date) < time()) ? 'Yes' : 'No'}}
                    @endif                    
                </td>
                <td>{{ date('F d, Y', strtotime($booking->created_at)) }}</td>
                <td>                    
                    @if (app()->getLocale() == 'tr')                     
                        {{$booking->user->name ?? 'Kullanıcı kaydı silinmiştir.'}}
                    @else 
                        {{$booking->user->name ?? 'User account was deleted.'}}
                    @endif
                </td>
                <td>{{ $booking->notes }}</td>
                <td class="actions">
                    <a
                        href="{{ action('BookingController@show', ['locale' => app()->getLocale(), 'booking' => $booking->id]) }}"
                        alt="View"
                        title="View">
                      {{__('Gör')}}
                    </a>
                    <a                         
                        href="{{ action('BookingController@edit', ['locale' => app()->getLocale(), 'booking' => $booking->id]) }}"
                        alt="Edit"
                        title="Edit">
                      {{__('Düzenle')}}
                    </a>
                    <form action="{{ action('BookingController@destroy', ['locale' => app()->getLocale(), 'booking' => $booking->id]) }}"
                    method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-link" title="Delete" value="DELETE" style="padding:0px;">
                            {{__('Sil')}}
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
