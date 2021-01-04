@extends('layouts.admin')

@section('sidebar')
@parent
    </div>
</aside>
@endsection

@section('content')
<div class="col">
<form class="needs-validation" novalidate action="{{ route('doctors.store', app()->getLocale()) }}" method="POST" id="createDoctor" enctype="multipart/form-data">
    @include('doctors.fields')
    
    <div class="form-group row">
        <div class="col-sm-auto">
            <button type="submit" class="btn btn-primary">{{__('Doktoru Ekle')}}</button>
        </div>
        <div class="col-sm-9" id="cancel_btn">
            <a href="{{ route('doctors.index', app()->getLocale()) }}" class="btn btn-secondary">{{__('İptal')}}</a>
        </div>
    </div>
</form>
</div>
@endsection

@section('scripts')
    <script src="/js/validate.js"></script>
@endsection