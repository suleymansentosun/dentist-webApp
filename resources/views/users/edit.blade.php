@extends('layouts.admin')

@section('sidebar')
@parent
    </div>
</aside>
@endsection

@section('content')
<div class="card-body">
   <form method="POST" action="{{ route('users.update', ['locale' => app()->getLocale(), 'user' => $user]) }}">
       @method('PUT')
       @csrf

       <div class="form-group row">
           <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Kullanıcı Adınız') }}</label>

           <div class="col-md-6">
               <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

               @error('name')
                   <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
               @enderror
           </div>
       </div>

       <div class="form-group row">
           <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Adresiniz') }}</label>

           <div class="col-md-6">
               <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

               @error('email')
                   <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
               @enderror
           </div>
       </div>

       <div class="form-group row mb-0">
           <div class="col-md-12 offset-md-4">
               <button type="submit" class="btn btn-primary">
                   {{ __('Güncelle') }}
               </button>
           </div>
       </div>
   </form>
</div>
@endsection