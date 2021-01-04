@extends('layouts.admin')

@section('rightNavbarLinks')
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge" id="notification_bell"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header" id="notification_header"></span>
          <div class="dropdown-divider"></div>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary custom-modal w-100" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-users mr-2"></i> <span id="spesific_notification"></span>
            </button>
          </a>
          <div class="dropdown-divider"></div>
          <div class="dropdown-divider"></div>
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
              <a href="{{ route('dashboard', app()->getLocale()) }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                {{__('Gösterge Paneli')}}
              </p>
              </a>
          </li>          
          <li class="nav-header">{{__('İÇERİK KONTROLÜ')}}</li>

          <li class="nav-item">
            <a href="{{ action('BookingController@index', ['locale' => app()->getLocale()])}}" class="nav-link">
              <p>
                {{__('Randevular')}}
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
                <p>{{__('Bugünkü Randevular')}}</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ action('Employee\EmployeeDashboardController@getTodaysBookings', ['locale' => app()->getLocale()]) }}"
              class="small-box-footer">{{__('Randevuları Gör')}}<i class="fas fa-arrow-circle-right ml-1"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{__('Randevu Takip Onay Formu')}}</h5>
            <div class="form-check ml-auto">
              <input class="form-check-input" type="checkbox" value="" id="selectAll">
              <label class="form-check-label" for="selectAll">
                {{__('Tümünü Seç')}}
              </label>
            </div>
            <button type="button" class="close" id="getOut_notification" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ action('FinalizeBookingController@finalizeAndUpdateBooking', ['locale' => app()->getLocale()]) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="modal-body" id="check_booking_materialized">
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" id="exit_notification">{{__('İptal')}}</button>
              <button type="submit" class="btn btn-primary">{{__('Değişiklikleri Kaydet')}}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.content -->
@endsection

@section('scripts')
<script src="/js/addPatientToDatabase.js"></script>
@endsection
