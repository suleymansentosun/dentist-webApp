@extends('layouts.admin')

@section('buttons')
<a class="btn btn-primary" href="{{ route('specialties.create') }}" role="button">Doktor Uzmanlık Alanı Ekle</a>
@endsection

@section('sidebar')
@parent
    </div>
</aside>
@endsection

@section('content')
<table class="table" id="bookingsTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Doktor Uzmanlık Alanı</th>
            <th>Oluşturulma Tarihi</th>
            <th class="Actions">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($specialties as $specialty)
            <tr>
                <td>{{ $specialty->id }}</td>
                <td>{{ $specialty->name }}</td>
                <td>{{ date('F d, Y', strtotime($specialty->created_at)) }}</td>
                <td class="actions">
                    <a
                        href="{{ route('specialties.edit', $specialty->id) }}"
                        alt="Edit"
                        title="Edit">
                      Düzenle
                    </a>
                    <form action="{{ route('specialties.destroy', $specialty->id) }}" method="POST">
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
{{ $specialties->links() }}
@endsection