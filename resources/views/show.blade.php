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
        <tr>
            <th scope="row">{{ $domain->id }}</th>
            <td>{{ $domain->name }}</td>
            <td>{{ $domain->code }}</td>
            <td>{{ $domain->length }}</td>
            <td>{{ $domain->header }}</td>
            <td>{{ $domain->keywords }}</td>
            <td>{{ $domain->description }}</td>
        </tr>
        </tbody>
    </table>
@endsection