@extends('layouts.admin')

@section('sidebar')
@parent
    </div>
</aside>
@endsection

@section('content')
<div class="col">
<form action="{{ route('bookingReasons.update', ['locale' => app()->getLocale(), 'bookingReason' => $bookingReason]) }}" method="POST">
    @method('PUT')
    @include('bookingReasons.fields')

    <div class="form-group row">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
        </div>
        <div class="col-sm-9">
            <a href="{{ route('bookingReasons.index', app()->getLocale()) }}" class="btn btn-secondary">{{__('İptal')}}</a>
        </div>
    </div>
</form>
</div>
@endsection