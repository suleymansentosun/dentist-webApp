@extends('layouts.admin')

@section('sidebar')
@parent
    </div>
</aside>
@endsection

@section('content')
<div class="col">
<form action="{{ route('specialties.update', ['locale' => app()->getLocale(), 'specialty' => $specialty]) }}" method="POST">
    @method('PUT')
    @include('specialties.fields')

    <div class="form-group row">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-primary">{{__('Güncelle')}}</button>
        </div>
        <div class="col-sm-9">
            <a href="{{ route('bookings.index', app()->getLocale()) }}" class="btn btn-secondary">{{__('İptal')}}</a>
        </div>
    </div>
</form>
</div>
@endsection