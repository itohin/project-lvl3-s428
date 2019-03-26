@extends ('layouts.app')

@section ('content')
    <div class="jumbotron">
        <h1 class="display-4">Page Analizer</h1>
        <p class="lead">Please enter url you wont to analize</p>
        <hr class="my-4">
        <form action="/domains" method="post">
            <input type="text" id="domain" name="domain" class="form-control mb-3" placeholder="Url" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Analize</button>
        </form>


    </div>
@endsection