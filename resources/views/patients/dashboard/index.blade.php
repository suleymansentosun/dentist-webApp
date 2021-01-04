@extends('layouts.admin')

@section('rightNavbarLinks')
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->      
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
@endsection

@section('sidebar')
      @parent

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="{{ action('Patient\PatientDashboardController@showDashboard', app()->getLocale())}}" class="nav-link">
                <p>
                  {{__('Randevularım')}}
                </p>
                  </a>
            </li>
            <li class="nav-item">
              <a href="https://adminlte.io/docs/3.0" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>{{__('Rehber')}}</p>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout', app()->getLocale()) }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" style="display: none;">
                      @csrf
              </form>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
@endsection

@section('content')
<table class="table" id="bookingsTable">
    <thead>
        <tr>
            <th>ID</th>
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
        @forelse ($bookingsBelongToThePatient as $booking)
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
                <td>{{ $booking->user->name }}</td>
                <td>{{ $booking->notes }}</td>
                <td class="actions" style="text-align:center;">
                    <a
                        style="text"
                        href="{{ action('BookingController@show', ['locale' => app()->getLocale(), 'booking' => $booking->id]) }}"
                        alt="View"
                        title="View">
                      {{__('View')}}
                    </a>
                    <a
                        style="display:{{ (strtotime($booking->booking_date) < time()) ? 'none' : 'default' }}"
                        href="{{ action('BookingController@edit', ['locale' => app()->getLocale(), 'booking' => $booking->id]) }}"
                        alt="Edit"
                        title="Edit">
                      {{__('Edit')}}
                    </a>
                    <form action="{{ action('BookingController@destroy', ['locale' => app()->getLocale(), 'booking' => $booking->id]) }}"
                    method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-link" title="Delete" value="DELETE">
                            {{__('Delete')}}
                        </button>
                    </form>
                </td>
            </tr>
        @empty
        @endforelse
    </tbody>
</table>
@endsection

@section('scripts')
<script src="/js/addPatientToDatabase.js"></script>
@endsection
