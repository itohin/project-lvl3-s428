@extends ('layouts.app')

@section ('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Status Code</th>
            <th scope="col">Content Length</th>
            <th scope="col">H1</th>
            <th scope="col">Keywords</th>
            <th scope="col">Description</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($domains as $domain)
            <tr>
                <th scope="row">{{ $domain->id }}</th>
                <td>
                    <a href="{{ route('domains.show', ['id' => $domain->id]) }}">{{ $domain->name }}</a>
                </td>
                <td>{{ $domain->code }}</td>
                <td>{{ $domain->length }}</td>
                <td>{{ $domain->header }}</td>
                <td>{{ $domain->keywords }}</td>
                <td>{{ $domain->description }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $domains->links() }}
@endsection