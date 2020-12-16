@extends('layouts.app')

@section('content')
<div class="col">
<form action="{{ route('roles.store') }}" method="POST">
    @include('roles.fields')

    <div class="form-group row">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-primary">Ekle</button>
        </div>
        <div class="col-sm-9">
            <a href="{{ route('bookings.index') }}" class="btn btn-secondary">İptal</a>
        </div>
    </div>
</form>
</div>
@endsection