@extends('layouts.admin')

@section('rightNavbarLinks')
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->      
      <!-- Notifications Dropdown Menu -->
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
        <li class="nav-item">
          <a href="{{ route('dashboard', app()->getLocale()) }}" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              {{__('Gösterge Paneli')}}
            </p>
          </a>
        </li>        
        <li class="nav-header">{{__('İÇERİK KONTROLÜ')}}</li>

          <li class="nav-item">
            <a href="{{ action('Doctor\DoctorDashboardController@showBookingsOfDoctor', ['locale' => app()->getLocale(), 'id' => $doctor_id]) }}" class="nav-link">
              <p>
                {{__('Randevularım')}}
              </p>
            </a>
          </li>
          <li class="nav-header">{{__('ÇEŞİTLİ')}}</li>
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
            {{ __('Çıkış') }}
            </a>

            <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </li>
      </ul>
    </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ count($bookings) }}</h3>
                <p>{{__('Bugünkü Randevularım')}}</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ action('Doctor\DoctorDashboardController@showBookingsOfDoctor', ['locale' => app()->getLocale(), 'id' => $doctor_id, 'booking_date' => $today]) }}"
              class="small-box-footer">{{__('Randevuları Gör')}}<i class="fas fa-arrow-circle-right ml-1"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  {{__('Randevu Takvimim')}}
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <div id="booking_calendar_doctor" style="max-width: 100%;"></div>
                </div>
              </div><!-- /.card-body -->
            </div>
          </div>
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
<script type="text/javascript" src="/js/visualizeBookingCalendarForDoctor.js"></script>  
@endsection
