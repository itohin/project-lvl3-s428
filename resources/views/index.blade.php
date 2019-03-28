@extends ('layouts.app')

@section ('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Status Code</th>
            <th scope="col">Content Length</th>
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
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $domains->links() }}
@endsection