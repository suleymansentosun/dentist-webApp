@extends('layouts.admin')

@section('sidebar')
@parent
    </div>
</aside>
@endsection

@section('content')
<div class="col">
<form action="{{ route('specialties.update', ['specialty' => $specialty]) }}" method="POST">
    @method('PUT')
    @include('specialties.fields')

    <div class="form-group row">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-primary">Güncelle</button>
        </div>
        <div class="col-sm-9">
            <a href="{{ route('bookings.index') }}" class="btn btn-secondary">İptal</a>
        </div>
    </div>
</form>
</div>
@endsection