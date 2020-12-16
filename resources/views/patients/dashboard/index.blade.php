@extends('layouts.admin')

@section('rightNavbarLinks')
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ asset('dist/img/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ asset('dist/img/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge" id="notification_bell"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header" id="notification_header"></span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary custom-modal w-100" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-users mr-2"></i> <span id="spesific_notification"></span>
            </button>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
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
              <a href="{{ action('Patient\PatientDashboardController@showDashboard')}}" class="nav-link">
                <p>
                  Randevularım
                </p>
                  </a>
            </li>
            <li class="nav-item">
              <a href="https://adminlte.io/docs/3.0" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>Rehber</p>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
        @forelse ($bookingsBelongToThePatient as $booking)
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
                <td class="actions" style="text-align:center;">
                    <a
                        style="text"
                        href="{{ action('BookingController@show', ['booking' => $booking->id]) }}"
                        alt="View"
                        title="View">
                      View
                    </a>
                    <a
                        style="display:{{ (strtotime($booking->booking_date) < time()) ? 'none' : 'default' }}"
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
@endsection

@section('scripts')
<script src="/js/addPatientToDatabase.js"></script>
@endsection
