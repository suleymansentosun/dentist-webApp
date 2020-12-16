@extends('layouts.admin')

@section('content')
<div class="col">
<form action="{{ route('doctors.store') }}" method="POST" id="createDoctor" enctype="multipart/form-data">
    @include('doctors.fields')
    
    <div class="form-group row">
        <div class="col-sm-auto">
            <button type="submit" class="btn btn-primary">Doktoru Ekle</button>
        </div>
        <div class="col-sm-9" id="cancel_btn">
            <a href="{{ route('doctors.index') }}" class="btn btn-secondary">İptal</a>
        </div>
    </div>
</form>
</div>
@endsection