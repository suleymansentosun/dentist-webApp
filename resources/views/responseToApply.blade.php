@extends('layouts.app')

@section('content')
<div class="jumbotron">
  <h1 class="display-4">{{__('Tebrikler!')}}</h1>
  <p class="lead">{{__('Randevu alma işleminiz başarıyla gerçekleşmiştir.')}}</p>
  <hr class="my-4">
  <p>{{__('Hesabınıza girerek randevunuzu görebilir ve güncelleyebilirsiniz. Şimdiden geçmiş olsun.')}}</p>
</div>
@endsection