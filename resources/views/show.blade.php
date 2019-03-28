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
        <tr>
            <th scope="row">{{ $domain->id }}</th>
            <td>{{ $domain->name }}</td>
            <td>{{ $domain->code }}</td>
            <td>{{ $domain->length }}</td>
        </tr>
        </tbody>
    </table>
@endsection