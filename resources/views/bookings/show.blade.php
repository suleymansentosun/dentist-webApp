@extends('layouts.admin')

@section('sidebar')
    @parent
        </div>
    </aside>
@endsection

@section('content')
<dl class="row">
    <dt class="col-sm-3">{{__('Randevu Id no')}}</dt>
    <dd class="col-sm-9">{{ $booking->id }}</dd>

    <dt class="col-sm-3">{{__('İlgili Doktor')}}</dt>
    <dd class="col-sm-9">{{ $booking->doctor->name }}</dd>

    <dt class="col-sm-3">{{__('İlgili Hasta')}}</dt>
    <dd class="col-sm-9">
        @if (isset($booking->patient->name))
            {{ $booking->patient->name . ' ' . $booking->patient->surname }}
        @elseif (app()->getLocale() == 'tr')
            {{__('İlgili kişi randevuya gelmediği için hasta kaydı bulunmamaktadır.')}}
        @else
            {{__('Since the related person did not come to the booking, there is no patient record.')}}
        @endif
     </dd>

    <dt class="col-sm-3">{{__('Randevu Tarihi')}}</dt>
    <dd class="col-sm-9">{{ date('Y-m-d H:i:s', strtotime($booking->booking_date)) }}</dd>

    <dt class="col-sm-3">{{__('Randevuyu Ayarlayan Kullanıcı')}}</dt>
    <dd class="col-sm-9">{{ $booking->user->name }}</dd>

    <dt class="col-sm-3">{{__('Randevu Gerekçesi')}}</dt>
    <dd class="col-sm-9">{{ app()->getLocale() == 'tr' ? $booking->bookingReason->name : $booking->bookingReason->nameEn}}</dd>

    <dt class="col-sm-3">{{__('Randevu Gerçekleşti mi?')}}</dt>
    <dd class="col-sm-9">
        @if ($booking->is_materialized && app()->getLocale() == 'tr')
            {{ __('Evet') }}
        @elseif ($booking->is_materialized && app()->getLocale() == 'en')
            {{__('Yes')}}
        @elseif (!$booking->is_materialized && app()->getLocale() == 'tr')
            {{__('Hayır')}}
        @elseif (!$booking->is_materialized && app()->getLocale() == 'en')
            {{__('No')}}
        @else
            {{__('No')}}
        @endif
    </dd>

    <dt class="col-sm-3">{{__('Randevu İle İlgili Ekstra Notlar')}}</dt>
    <dd class="col-sm-9"> 
        @if (app()->getLocale() == 'tr' && !isset($booking->notes))
        {{'Ekstra not yok.'}}
        @elseif (app()->getLocale() == 'en' && !isset($booking->notes))
        {{'No extra notes'}}
        @else
        @endif
    </dd>

    <dt class="col-sm-3">{{__('Randevu Oluşturulma Tarihi')}}</dt>
    <dd class="col-sm-9">{{ date('Y-m-d H:i:s', strtotime($booking->created_at)) }}</dd>

    <dt class="col-sm-3">{{__('Randevu Güncellenme Tarihi')}}</dt>
    <dd class="col-sm-9">{{ date('Y-m-d H:i:s', strtotime($booking->updated_at)) }}</dd>
</dl>
@endsection