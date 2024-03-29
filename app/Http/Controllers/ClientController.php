<?php

namespace App\Http\Controllers;

use Validator;
use Carbon\Carbon;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    public readonly Client $client;
    //descomente para validar os campos
    public $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|unique:clients|email|max:255',
        // 'cpf' => 'required|string|unique:clients|max:14',
        // 'street' => 'required|string|max:255',
        // 'city' => 'required|string|max:255',
        // 'state' => 'required|string|max:255',
        // 'cep' => 'required|string|max:10',
        // 'number' => 'required|string|max:20',
    ];

    public function __construct(Client $client){
        $this->client = $client;
    }   


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $clients = $this->client->with('address')->select('id', 'name', 'cpf', 'email', 'date_born')->orderBy('created_at', 'desc')->paginate(10);
        
        if (View::exists('client.clients')) {
            return view('client.clients', ['clients' => $clients]);
        } else {
            return view('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Client $client)
    {
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $client->fill($request->only(['name', 'email', 'cpf', 'date_born']));
            $client->save();
        
            if ($client->wasRecentlyCreated) {
                $client->address()->create([
                    'street' => $request->input('street'),
                    'city' => $request->input('city'),
                    'state' => $request->input('state'),
                    'cep' => $request->input('cep'),
                    'number' => $request->input('number'),
                ]);
            }
        } catch (\Throwable $th) {
            Log::error('Erro ao tentar salvar cliente:'. $th);
            return redirect()->back()->withInput()->withErrors(['error' => 'Ocorreu um erro ao salvar o cliente.']);
        }

        return redirect()->route('clients.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $client = $client->load('address');
        return view('client.show', ['client' => $client]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $rules = $this->rules;
        $rules['email'] = 'required|email|max:255|email';
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $client->name = $request->input('name');
            $client->email = $request->input('email');
            $client->cpf = $request->input('cpf');
            $client->date_born = $request->input('date_born');
            $client->save();
        } catch (\Throwable $th) {
            Log::error('Erro ao tentar atualizar cliente:'. $th);
        }

        $this->updateOrCreateAddress($client, $request->all());

        return redirect()->route('clients.index');
    }


    private function updateOrCreateAddress(Client $client, array $data): void
    {
        $addressData = [
            'street' => $data['street'],
            'city' => $data['city'],
            'state' => $data['state'],
            'cep' => $data['cep'],
            'number' => $data['number'],
        ];


        try {
            $address = $client->address;
            if ($address) {
                $address->update($addressData);
            } else {
                $client->address()->create($addressData);
            }        
        } catch (\Throwable $th) {
            Log::error('Erro ao tentar criar/atualizar endereço do cliente:'. $th);
        }
       
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        try {
            $client->delete();
        } catch (\Throwable $th) {
            Log::error('Erro ao tentar deletar cliente:'. $th);
        }

        return redirect()->route('clients.index');    
    }

    public function filter(Request $request)
    {
        $filteredClients = $this->client
            ->with('address')
            ->where('name', 'like', '%' . $request->input('text') . '%')
            ->orWhere('email', 'like', '%' . $request->input('text') . '%')
            ->orWhere('cpf', 'like', '%' . $request->input('text') . '%')
            ->select('id', 'name', 'cpf', 'email', 'date_born')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if(count($filteredClients) != 0){
            return view('client.clients', ['clients' => $filteredClients]);
        } else {
            return redirect()->route('clients.index');    
        }
    }
}