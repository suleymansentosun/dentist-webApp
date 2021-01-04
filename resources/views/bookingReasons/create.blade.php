@extends('layouts.admin')

@section('sidebar')
@parent
    </div>
</aside>
@endsection

@section('content')
<div class="col">
<form action="{{ route('bookingReasons.store', app()->getLocale()) }}" method="POST">
    @include('bookingReasons.fields')

    <div class="form-group row">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-primary">{{__('Ekle')}}</button>
        </div>
        <div class="col-sm-9">
            <a href="{{ route('bookingReasons.index', app()->getLocale()) }}" class="btn btn-secondary">{{__('İptal')}}</a>
        </div>
    </div>
</form>
</div>
@endsection