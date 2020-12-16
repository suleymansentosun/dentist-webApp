@extends('layouts.admin')

@section('sidebar')
    @parent
        </div>
    </aside>
@endsection

@section('content')
<dl class="row">
    <dt class="col-sm-3">Randevu Id'si</dt>
    <dd class="col-sm-9">{{ $booking->id }}</dd>

    <dt class="col-sm-3">İlgili Doktor</dt>
    <dd class="col-sm-9">{{ $booking->doctor->name }}</dd>

    <dt class="col-sm-3">İlgili Hasta</dt>
    <dd class="col-sm-9">{{ isset($booking->patient->name) ? $booking->patient->name . ' ' . $booking->patient->surname : 
    'İlgili kişi randevuya gelmediği için hasta kaydı bulunmamaktadır.' }}</dd>

    <dt class="col-sm-3">Randevu Tarihi</dt>
    <dd class="col-sm-9">{{ date('Y-m-d H:i:s', strtotime($booking->booking_date)) }}</dd>

    <dt class="col-sm-3">Randevuyu Ayarlayan Kullanıcı</dt>
    <dd class="col-sm-9">{{ $booking->user->name }}</dd>

    <dt class="col-sm-3">Randevu Gerekçesi</dt>
    <dd class="col-sm-9">{{ $booking->bookingReason->name }}</dd>

    <dt class="col-sm-3">Randevu Gerçekleşti mi?</dt>
    <dd class="col-sm-9">{{ $booking->is_materialized ? 'Evet' : 'Hayır' }}</dd>

    <dt class="col-sm-3">Randevu İle İlgili Ekstra Notlar</dt>
    <dd class="col-sm-9">{{ $booking->notes ?? 'Ekstra not yok.' }}</dd>

    <dt class="col-sm-3">Randevu Oluşturulma Tarihi</dt>
    <dd class="col-sm-9">{{ date('Y-m-d H:i:s', strtotime($booking->created_at)) }}</dd>

    <dt class="col-sm-3">Randevu Güncellenme Tarihi</dt>
    <dd class="col-sm-9">{{ date('Y-m-d H:i:s', strtotime($booking->updated_at)) }}</dd>
</dl>
@endsection