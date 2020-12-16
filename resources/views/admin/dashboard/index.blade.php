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
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Gösterge Paneli
            </p>
          </a>
        </li>
        <li class="nav-header">İÇERİK KONTROLÜ</li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tree"></i>
            <p>
              Obje Kontrolü
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ action('DoctorController@index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Doktor Kontrolü</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ action('UserController@index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Kullanıcı Kontrolü</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ action('BookingController@index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Randevu Kontrolü</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ action('BookingReasonController@index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Randevu Gerekçesi Kontrolü</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ action('SpecialtyController@index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Doktor Uzmanlık Alanı Kontrolü</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">ÇEŞİTLİ</li>
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
                        {{ __('Çıkış') }}
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

                <p>Bugün Ayarlanan Randevu Sayısı</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ action('BookingController@index')}}"
              class="small-box-footer">Tüm Randevuları Gör<i class="fas fa-arrow-circle-right ml-1"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ count($registeredPatientsForTheFirstTime) }}</h3>

                <p>Bugün Kazanılan Hasta Sayısı</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ action('PatientController@index')}}" class="small-box-footer">Tüm Hastaları Gör<i class="fas fa-arrow-circle-right ml-1"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ count($users) }}</h3>

                <p>Bugün Sitemize Kaydolan Kullanıcı Sayısı</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ action('UserController@index') }}" class="small-box-footer">Tüm Kullanıcıları Gör<i class="fas fa-arrow-circle-right"></i></a>
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
                  Veri Görselleri
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link" href="#revenue-chart" id="dailyData_btn" data-toggle="tab">Günlük</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="" id="weeklyData_btn" data-toggle="tab">Haftalık</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" id="monthlyData_btn" data-toggle="tab">Aylık</a>
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

