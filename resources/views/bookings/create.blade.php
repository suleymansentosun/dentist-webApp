@extends('layouts.app')

@section('content')
<div class="col">
<form action="{{ route('bookings.store') }}" method="POST" id="createBooking">
    @include('bookings.fields')

    <div class="form-group row">
        <div class="col-sm-auto">
            <button type="submit" class="btn btn-primary" id="add_booking_btn">Randevuyu Ekle</button>
        </div>
        <div class="col-sm-9" id="cancel_btn">
            <a href="{{ route('bookings.index') }}" class="btn btn-secondary">İptal</a>
        </div>
    </div>
</form>
</div>
@endsection

@section('create_booking_btn')

@endsection