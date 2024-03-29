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
        <div class="container mt-5 border">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>CRUD <b>Clients</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addClientModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add Novo Cliente</span></a>
                        </div>
                    </div>
                </div>
                @if (count($clients) != 0)
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    {{-- <span class="custom-checkbox">
                                        <input type="checkbox" id="selectAll">
                                        <label for="selectAll"></label>
                                    </span> --}}
                                </th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Idade</th>
                                <th>Data de nascimento</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                            <tr>
                                <td>
                                    {{-- <span class="custom-checkbox">
                                        <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                        <label for="checkbox1"></label>
                                    </span> --}}
                                </td>
                                <td>
                                    <a href="{{ route('clients.show', ['client' => $client->id]) }}" target="_self" class="border">
                                        {{ $client->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('clients.show', ['client' => $client->id]) }}" target="_self" class="border">
                                        {{ $client->cpf }}
                                    </a>
                                </td>
                                <td>idade</td>
                                <td>{{ \Carbon\Carbon::parse($client->date_born)->format('d/m/Y') }}</td>
                                <td>
                                    <a href="#editClientModal" class="edit" data-client="{{ $client }}"  data-id="{{$client->id }}" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                    <a href="#deleteClientModal" data-id="{{$client->id }}" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="clearfix">
                        <div>
                            Página {{ $clients->currentPage() }} de {{ $clients->lastPage() }} Total de {{ $clients->total() }} clientes
                        </div>
                        <ul class="pagination">
                            <li class="page-item"><a href="{{ '/clients?page=' . ($clients->currentPage() - 1) }}">Voltar</a></li>
                            @for ($i = 0; $i < $clients->lastPage(); $i++)
                            @if ($i == $clients->currentPage())
                                <li class="page-item active"><a href="{{ '/clients?page=' . $i }}" class="page-link">{{ $i }}</a></li>
                            @else
                                <li class="page-item"><a href="{{ '/clients?page=' . $i }}" class="page-link">{{ $i }}</a></li>
                            @endif
                            @endfor
                            <li class="page-item"><a href="{{ '/clients?page=' . ($clients->currentPage() + 1) }}">Avançar</a></li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>












        <!-- add Modal HTML -->
        <div id="addClientModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('clients.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">						
                            <h4 class="modal-title">Add Client</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">					
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="name">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>

                            <div class="form-group">
                                <label>Data de nascimento</label>
                                <input type="date" class="form-control" name="date_born">
                            </div>

                            <div class="form-group">
                                <label>CPF</label>
                                <input type="text" class="form-control" name="cpf">
                            </div>

                            <div class="form-group">
                                <label>Cidade</label>
                                <input type="text" class="form-control" name="city">
                            </div>

                            <div class="form-group">
                                <label>Estado</label>
                                <input type="text" class="form-control" name="state">
                            </div>

                            <div class="form-group">
                                <label>Rua</label>
                                <textarea class="form-control" name="street"></textarea>
                            </div>
                            <div class="form-group">
                                <label>CEP</label>
                                <textarea class="form-control" name="cep"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Numero</label>
                                <input type="text" class="form-control"  name="number">
                            </div>	
                            
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-success" value="Add">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal HTML -->
        <div id="editClientModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editForm" data-edit-action="{{ route('clients.update', ['client' => '__ID__']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">						
                            <h4 class="modal-title">Editar Cliente</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">					
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" value="" id="name" name="name">
                            </div>
                
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" id="email" value="" name="email">
                            </div>
                
                            <div class="form-group">
                                <label>Data de nascimento</label>
                                <input type="date" class="form-control" id="date_born" value="" name="date_born">
                            </div>
                
                            <div class="form-group">
                                <label>CPF</label>
                                <input type="text" class="form-control" id="cpf" value="" name="cpf">
                            </div>
                
                            <div class="form-group">
                                <label>Cidade</label>
                                <input type="text" class="form-control" id="city" value="" name="city">
                            </div>
                
                            <div class="form-group">
                                <label>Estado</label>
                                <input type="text" class="form-control" id="state" value="" name="state">
                            </div>
                
                            <div class="form-group">
                                <label>Rua</label>
                                <input type="text" class="form-control" id="street" value="" name="street">
                            </div>
                            <div class="form-group">
                                <label>CEP</label>
                                <input type="number" class="form-control" id="cep" value="" name="cep">
                            </div>
                            <div class="form-group">
                                <label>Numero</label>
                                <input type="text" class="form-control"  id="number" value="" name="number">
                            </div>	
                            
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-success" value="Editar">
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- Delete Modal HTML -->
        <div id="deleteClientModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    {{-- <form action="{{ route('clients.destroy', ['client' => $client->id]) }}" method="POST"> --}}
                    <form id="deleteForm" action="{{ route('clients.destroy', ['client' => '__ID__']) }}" method="POST">

                        @csrf
                        @method('DELETE')
                        <div class="modal-header">						
                            <h4 class="modal-title">Deletar Cliente</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">					
                            <p>Tem certeza que deseja excluir?</p>
                            <p class="text-warning"><small>Essa açao não poderá ser desfeita.</small></p>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="client_id" id="client_id" value="">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                            <input type="submit" class="btn btn-danger" value="Deletar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>