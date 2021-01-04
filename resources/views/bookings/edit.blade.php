@extends('layouts.app')

@section('content')
<div class="col">
<form class="needs-validation" novalidate action="{{ route('bookings.update', ['locale' => app()->getLocale(), 'booking' => $booking]) }}" method="POST" id="createBooking">
    @csrf
    @method('PUT')
    @include('bookings.fields')

    <div class="form-group row">
        <div class="col-sm-auto">
            <button type="submit" class="btn btn-primary" id="add_booking_btn">{{__('Randevuyu Güncelle')}}</button>
        </div>
        <div class="col-sm-9" id="cancel_btn">
            <a href="{{ route('bookings.index', app()->getLocale()) }}" class="btn btn-secondary">{{__('İptal')}}</a>
        </div>
    </div>
</form>
</div>
@endsection

@section('create_booking_btn')
    <button type="button" class="btn btn-primary btn-lg" style="display:none;" data-toggle="modal" data-target="#firstStageBooking" 
    id="create_booking_btn">{{__('Randevu Ayarla') }}</button>
@endsection

@section('scripts')
    <script src="/js/validate.js"></script>
    <script src="/js/firstStageOfBookingEdit.js"></script>
@endsection