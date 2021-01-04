@extends('layouts.app')

@section('content')
<div class="col">
<form action="{{ route('roles.update', ['locale' => app()->getLocale(), 'role' => $role]) }}" method="POST">
    @method('PUT')
    @include('roles.fields')

    <div class="form-group row">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-primary">Güncelle</button>
        </div>
        <div class="col-sm-9">
            <a href="{{ route('bookings.index', app()->getLocale()) }}" class="btn btn-secondary">İptal</a>
        </div>
    </div>
</form>
</div>
@endsection