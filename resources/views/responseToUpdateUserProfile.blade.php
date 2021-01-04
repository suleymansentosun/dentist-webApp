@extends('layouts.admin')

@section('sidebar')
@parent
    </div>
</aside>
@endsection

@section('content')
<div class="jumbotron">
  <h1 class="display-12">{{__('Tamamdır.')}}</h1>
  <p class="lead">{{__('Bilgileriniz başarıyla güncellendi.')}}</p>
  <hr class="my-4">
</div>
@endsection