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
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tree"></i>
            <p>
              {{__('Obje Kontrolü')}}
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ action('DoctorController@index', ['locale' => app()->getLocale()]) }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('Doktor Kontrolü')}}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ action('UserController@index', ['locale' => app()->getLocale()]) }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('Kullanıcı Kontrolü')}}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ action('BookingController@index', ['locale' => app()->getLocale()]) }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('Randevu Kontrolü')}}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ action('BookingReasonController@index', ['locale' => app()->getLocale()]) }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('Randevu Gerekçesi Kontrolü')}}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ action('SpecialtyController@index', ['locale' => app()->getLocale()]) }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('Doktor Uzmanlık Alanı Kontrolü')}}</p>
              </a>
            </li>
          </ul>
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

                <p>{{__('Bugün Ayarlanan Randevu Sayısı')}}</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ action('BookingController@index', ['locale' => app()->getLocale()])}}"
              class="small-box-footer">{{__('Tüm Randevuları Gör')}}<i class="fas fa-arrow-circle-right ml-1"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ count($registeredPatientsForTheFirstTime) }}</h3>

                <p>{{__('Bugün Kazanılan Hasta Sayısı')}}</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ action('PatientController@index', ['locale' => app()->getLocale()])}}" class="small-box-footer">{{__('Tüm Hastaları Gör')}}<i class="fas fa-arrow-circle-right ml-1"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ count($users) }}</h3>

                <p>{{__('Bugün Sitemize Kaydolan Kullanıcı Sayısı')}}</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ action('UserController@index', ['locale' => app()->getLocale()]) }}" class="small-box-footer">{{__('Tüm Kullanıcıları Gör')}}<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  {{__('Veri Görselleri')}}
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link" href="#revenue-chart" id="dailyData_btn" data-toggle="tab">{{__('Günlük')}}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="" id="weeklyData_btn" data-toggle="tab">{{__('Haftalık')}}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" id="monthlyData_btn" data-toggle="tab">{{__('Aylık')}}</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <div id="daily_booking_datas" style="max-width: 100%;"></div>
                  <hr>
                  <div id="daily_patient_datas" style="max-width: 100%;"></div>
                  <hr>
                  <div id="instrumentalFactorsInFinding" style="max-width: 100%; margin-top: 40px"></div>
                  <div id="instrumentalFactorsInFindingPieChart" style="width: 550px; height: 300px;"></div>
                  <hr>
                  <div id="bookingReasonsCounts" style="width: 550px; height: 300px;"></div>
                  <hr>
                  <div id="doctorsBookingCounts" style="max-width: 100%; margin-top: 40px"></div>
                  <div id="bookingPatientCountsBelongToDoctors" style="max-width: 100%; margin-top: 40px; height: 350px;"></div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->      
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script type="text/javascript" src="/js/visualizeBookingCounts.js"></script>
    <script type="text/javascript" src="/js/visualizePatientCounts.js"></script>
    <script type="text/javascript" src="/js/visualizeInstrumentalFactorsInFindingDentist.js"></script>
    <script type="text/javascript" src="/js/visualizeInstrumentalFactorsInFindingDentistPieChart.js"></script>
    <script type="text/javascript" src="/js/visualizeBookingReasons.js"></script>
    <script type="text/javascript" src="/js/visualizeDoctorPerformance.js"></script>
    <script type="text/javascript" src="/js/visualizeBookingPatientCountsBelongToDoctors.js"></script>
@endsection

