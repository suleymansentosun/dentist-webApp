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
            <th>Kullanıcı Adı</th>
            <th>Rolü</th>
            <th>E-Mail Adresi</th>
            <th class="Actions">Actions</th>
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
                        href="{{ action('UserController@show', ['user' => $user->id]) }}"
                        alt="View"
                        title="View">
                      Gör
                    </a>
                    <a
                        href="{{ action('UserController@edit', ['user' => $user->id]) }}"
                        alt="Edit"
                        title="Edit">
                      Düzenle
                    </a>
                    <form action="{{ action('UserController@destroy', ['user' => $user->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-link" title="Delete" value="SİL">
                            Sil
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