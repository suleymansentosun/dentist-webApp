@extends('layouts.admin')

@section('sidebar')
@parent
    </div>
</aside>
@endsection

@section('content')
<dl class="row">
    <dt class="col-sm-3">Kullanıcı Id</dt>
    <dd class="col-sm-9">{{ $user->id }}</dd>

    <dt class="col-sm-3">Kullanıcı Adı</dt>
    <dd class="col-sm-9">{{ $user->name }}</dd>

    <dt class="col-sm-3">Email Adresi</dt>
    <dd class="col-sm-9">{{ $user->email }}</dd>

    <dt class="col-sm-3">Created</dt>
    <dd class="col-sm-9">{{ date('F d, Y', strtotime($user->created_at)) }}</dd>

    <dt class="col-sm-3">Updated</dt>
    <dd class="col-sm-9">{{ date('F d, Y', strtotime($user->updated_at)) }}</dd>
</dl>
@endsection