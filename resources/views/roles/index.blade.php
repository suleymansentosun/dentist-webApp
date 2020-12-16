@extends('layouts.app')

@section('buttons')
<a class="btn btn-primary" href="{{ route('roles.create') }}" role="button">Rol Ekle</a>
@endsection

@section('content')
<table class="table" id="bookingsTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Kullanıcı Rol Tipi</th>
            <th>Rol Açıklaması</th>
            <th>Oluşturulma Tarihi</th>
            <th class="Actions">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->description }}</td>
                <td>{{ date('F d, Y', strtotime($role->created_at)) }}</td>
                <td class="actions">
                    <a
                        href="{{ action('RoleController@edit', ['role' => $role->id]) }}"
                        alt="Edit"
                        title="Edit">
                      Düzenle
                    </a>
                    <form action="{{ action('RoleController@destroy', ['role' => $role->id]) }}" method="POST">
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
{{ $roles->links() }}
@endsection