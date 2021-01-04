@extends('layouts.admin')

@section('sidebar')
@parent
    </div>
</aside>
@endsection

@section('content')
<div class="col">
<form class="needs-validation" novalidate action="{{ route('doctors.update', ['locale' => app()->getLocale(), 'doctor' => $doctor]) }}" method="POST" id="createDoctor" enctype="multipart/form-data">
    @method('PUT')
    @include('doctors.fields')

    <div class="form-group row">
        <div class="col-sm-auto">
            <button type="submit" class="btn btn-primary">Kaydet</button>
        </div>
        <div class="col-sm-9" id="cancel_btn">
            <a href="{{ route('doctors.index', app()->getLocale()) }}" class="btn btn-secondary">İptal</a>
        </div>
    </div>
</form>
</div>
@endsection

@section('scripts')
    <script src="/js/validate.js"></script>
@endsection