@extends('layouts.admin')

@section('sidebar')
@parent
    </div>
</aside>
@endsection

@section('content')
<dl class="row">
    <dt class="col-sm-3">{{__('Kullanıcı Id')}}</dt>
    <dd class="col-sm-9">{{ $user->id }}</dd>

    <dt class="col-sm-3">{{__('Kullanıcı Adı')}}</dt>
    <dd class="col-sm-9">{{ $user->name }}</dd>

    <dt class="col-sm-3">{{__('Email Adresi')}}</dt>
    <dd class="col-sm-9">{{ $user->email }}</dd>

    <dt class="col-sm-3">{{__('Oluşturuldu')}}</dt>
    <dd class="col-sm-9">{{ date('F d, Y', strtotime($user->created_at)) }}</dd>

    <dt class="col-sm-3">{{__('Güncellendi')}}</dt>
    <dd class="col-sm-9">{{ date('F d, Y', strtotime($user->updated_at)) }}</dd>
</dl>
<a
   class="btn btn-primary mr-1"
   role="button" 
   href="{{ action('UserController@edit', ['locale' => app()->getLocale(), 'user' => $user->id]) }}"
   alt="Update"
   title="Update">
   {{__('Güncelle')}}
</a>
<form style="display:inline-block;" action="{{ action('UserController@destroy', ['locale' => app()->getLocale(), 'user' => $user->id]) }}"
    method="POST">
     @method('DELETE')
     @csrf
    <button type="submit" class="btn btn-primary" title="Delete" value="DELETE">
        {{__('Hesabı Sil')}}
    </button>
</form>
@endsection