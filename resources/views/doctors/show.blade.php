@extends('layouts.admin')

@section('sidebar')
@parent
    </div>
</aside>
@endsection

@section('content')
<dl class="row">
    <dt class="col-sm-3">Doktor ID</dt>
    <dd class="col-sm-9">{{ $doctor->id }}</dd>

    <dt class="col-sm-3">User ID</dt>
    <dd class="col-sm-9">{{ $doctor->user_id }}</dd>

    <dt class="col-sm-3">Doktor Adı</dt>
    <dd class="col-sm-9">{{ $doctor->name }}</dd>

    <dt class="col-sm-3">Doktor Soyadı</dt>
    <dd class="col-sm-9">{{ $doctor->surname }}</dd>

    <dt class="col-sm-3">Kaç Yıllık Dişçi</dt>
    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($doctor->graduation_date)->diffInYears(\Carbon\Carbon::now()) }}</dd>

    <dt class="col-sm-3">Kliniğimizde Kaç Yıldır Çalışıyor?</dt>
    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($doctor->starting_date_employement)->diffInYears(\Carbon\Carbon::now()) }}</dd>

    <dt class="col-sm-3">Doktor Maaşı</dt>
    <dd class="col-sm-9">{{ $doctor->salary }}</dd>

    <dt class="col-sm-3">Doktor Uzmanlık Alanları</dt>
    <dd class="col-sm-9">
        <div class="row no-gutters">
            @foreach ($doctor->specialties as $specialty)
                <span class="col-sm-auto">{{ $specialty->name  }}&sbquo;&nbsp;</span>
            @endforeach
        </div>
    </dd>

    <dt class="col-sm-3">Doktor Resmi</dt>
    <dd class="col-sm-9"><img style="width:100%; height:auto; max-width:200px;" src="{{ asset('storage/' . $doctor->profile_picture) }}"></img></dd>

    <dt class="col-sm-3">Created</dt>
    <dd class="col-sm-9">{{ date('F d, Y', strtotime($doctor->created_at)) }}</dd>

    <dt class="col-sm-3">Updated</dt>
    <dd class="col-sm-9">{{ date('F d, Y', strtotime($doctor->updated_at)) }}</dd>
</dl>
@endsection