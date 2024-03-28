@section('content')
    <h2>Clients</h2>
    <ul>
        @foreach ($clients as $client->name)
            <li>{{ $client->name }}</li>
        @endforeach
    </ul>
@endsection