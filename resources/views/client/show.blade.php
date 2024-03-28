<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD Clients</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script></head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/master.js') }}"></script>
    <body>
       
        <div class="container">		
            <div>
                <h1>Client: {{ $client->name }}</h1>
            </div>			
            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" value="{{ $client->name }}" disabled>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" value="{{ $client->email }}" disabled>
            </div>

            <div class="form-group">
                <label>Data de nascimento</label>
                <input type="date" class="form-control" value="{{ $client->date_born }}" disabled>
            </div>

            <div class="form-group">
                <label>CPF</label>
                <input type="text" class="form-control" value="{{ $client->cpf }}" disabled>
            </div>

            @if($client->address)
                <input type="text" class="form-control" value="{{ $client->address->city }}" disabled>

                <div class="form-group">
                    <label>Estado</label>
                    <input type="text" class="form-control" value="{{ $client->address->state }}" disabled>
                </div>

                <div class="form-group">
                    <label>Rua</label>
                    <input class="form-control" value="{{ $client->address->street }}" disabled>
                </div>
                <div class="form-group">
                    <label>CEP</label>
                    <input class="form-control" value="{{ $client->address->cep ? $client->address->cep : '-' }}" disabled>
                </div>
                <div class="form-group">
                    <label>Numero</label>
                    <input type="text" class="form-control"  value="{{ $client->address->number }}" disabled>
                </div>	
            @else
                <p>Sem dados de endereço</p>
            @endif

            <div class="mt-5">						
                <a href="/clients" class="btn btn-warning"><span>Voltar</span></a>
            </div>
        </div>
    </body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>