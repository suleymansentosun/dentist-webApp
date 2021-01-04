@extends('layouts.admin')

@section('sidebar')
@parent
    </div>
</aside>
@endsection

@section('content')
<dl class="row">
    <dt class="col-sm-3">{{__('Doktor ID')}}</dt>
    <dd class="col-sm-9">{{ $doctor->id }}</dd>

    <dt class="col-sm-3">{{__('Kullanıcı ID')}}</dt>
    <dd class="col-sm-9">{{ $doctor->user_id }}</dd>

    <dt class="col-sm-3">{{__('Doktor Adı')}}</dt>
    <dd class="col-sm-9">{{ $doctor->name }}</dd>

    <dt class="col-sm-3">{{__('Doktor Soyadı')}}</dt>
    <dd class="col-sm-9">{{ $doctor->surname }}</dd>

    <dt class="col-sm-3">{{__('Kaç Yıllık Dişçi')}}</dt>
    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($doctor->graduation_date)->diffInYears(\Carbon\Carbon::now()) }}</dd>

    <dt class="col-sm-3">{{__('Kliniğimizde Kaç Yıldır Çalışıyor?')}}</dt>
    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($doctor->starting_date_employement)->diffInYears(\Carbon\Carbon::now()) }}</dd>

    <dt class="col-sm-3">{{__('Doktor Maaşı')}}</dt>
    <dd class="col-sm-9">{{ $doctor->salary }}</dd>

    <dt class="col-sm-3">{{__('Doktor Uzmanlık Alanları')}}</dt>
    <dd class="col-sm-9">
        <div class="row no-gutters">
            @foreach ($doctor->specialties as $specialty)
                <span class="col-sm-auto">{{ app()->getLocale() == 'tr' ? $specialty->name : $specialty->nameEn  }}&sbquo;&nbsp;</span>
            @endforeach
        </div>
    </dd>

    <dt class="col-sm-3">{{__('Doktor Resmi')}}</dt>
    <dd class="col-sm-9"><img style="width:100%; height:auto; max-width:200px;" src="{{ asset('storage/' . $doctor->profile_picture) }}"></img></dd>

    <dt class="col-sm-3">{{__('Oluşturuldu')}}</dt>
    <dd class="col-sm-9">{{ date('F d, Y', strtotime($doctor->created_at)) }}</dd>

    <dt class="col-sm-3">{{__('Güncellendi')}}</dt>
    <dd class="col-sm-9">{{ date('F d, Y', strtotime($doctor->updated_at)) }}</dd>
</dl>
@endsection