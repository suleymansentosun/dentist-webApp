@extends('layouts.admin')

@section('content')
<div class="col">
<form action="{{ route('bookingReasons.store') }}" method="POST">
    @include('bookingReasons.fields')

    <div class="form-group row">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-primary">Ekle</button>
        </div>
        <div class="col-sm-9">
            <a href="{{ route('bookingReasons.index') }}" class="btn btn-secondary">İptal</a>
        </div>
    </div>
</form>
</div>
@endsection