<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();

        return view('Clients\Index', compact('clients') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('Clients\Create', ['client' => new Client(), 'client_type' => Client::getType($request->client_type)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->_validate($request);
        $data['defaulter'] = $request->has('defaulter');
        $data['client_type'] = Client::getType($request->client_type);

        Client::create($data);

        return redirect()->route('clients.index')->with('message', 'Cliente Cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('Clients\show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $client_type = $client->client_type;
        return view('Clients\Edit', compact('client', 'client_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $data = $this->_validate($request);
        $data['defaulter'] = $request->has('defaulter');

        $client->fill($data);
        $client->save();

        return redirect()->route('clients.index')->with('message', 'Cliente atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')->with('message', 'Cliente excluído com sucesso');
    }

    protected function _validate(Request $request)
    {
        $clientType = Client::getType($request->client_type);
        $documentType = $clientType == Client::TYPE_INDIVIDUAL ? 'cpf' : 'cnpj';
        $client = $request->route('client');
        $clientId = $client instanceOf Client ? $client->id : null;

        $rules = [
            'name' => 'required|max:255',
            'document_number' => "required|unique:clients,document_number,$clientId|document_number:$documentType",
            'email' => 'required|email',
            'phone' => 'required',
        ];

        $maritalStatus = implode(',', array_keys(Client::MARITAL_STATUS));

        $rulesIndividual = [
            'date_birth' => 'required|date',
            'sex' => 'required|in:m,f',
            'marital_status' => "required|in:$maritalStatus",
            'physical_disability' => 'max:255',
        ];

        $rulesLegal = [
            'company_name' => 'required|max:255',
        ];

       return $this->validate($request, $clientType == Client::TYPE_INDIVIDUAL ? 
            $rules + $rulesIndividual : $rules + $rulesLegal);
    }
}
