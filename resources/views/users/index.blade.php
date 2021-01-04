@extends('layouts.admin')

@section('sidebar')
@parent
    </div>
</aside>
@endsection

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>{{__('Kullanıcı Adı')}}</th>
            <th>{{__('Kullanıcı Rolü')}}</th>
            <th>{{__('Email Adresi')}}</th>
            <th class="Actions">{{__('İşlemler')}}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>
                    @foreach ($user->roles as $role)
                        <span class="col-sm-auto">{{ $role->name  }}&sbquo;&nbsp;</span>
                    @endforeach
                </td>
                <td>{{ $user->email }}</td>
                <td class="actions">
                    <a
                        href="{{ action('UserController@show', ['locale' => app()->getLocale(), 'user' => $user->id]) }}"
                        alt="View"
                        title="View">
                      {{__('Gör')}}
                    </a>
                    <form style="display:inline-block;" action="{{ action('UserController@destroy', ['locale' => app()->getLocale(), 'user' => $user->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-link" title="Delete" value="SİL">
                            {{__('Sil')}}
                        </button>
                    </form>
                </td>
            </tr>
        @empty
        @endforelse
    </tbody>
</table>
{{ $users->links() }}
@endsection