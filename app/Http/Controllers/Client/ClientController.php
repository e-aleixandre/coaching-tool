<?php

namespace App\Http\Controllers\Client;

use App\Models\Client;
use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $clients = Client::all();

        return Inertia::render('Client/ListClients', [
            'clients' => $clients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Client/CreateClient');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
           'email' => ['required', 'email', 'unique:clients,email']
        ], ['email.unique' => 'Ya existe un cliente con ese email.']);

        // Mass assignment not set for email, so I have to create it manually instead of using Client::create($validated)
        $client = new Client();
        $client->email = $validated['email'];
        $client->save();

        return Redirect::back()->with([
            'type' => 'success',
            'message' => 'El cliente ha sido creado correctamente.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * TODO: I don't know how to grab notes automatically with model binding without it affecting the other routes,
     *  so I don't use model binding here
     *
     * @param  int $client
     * @return \Inertia\Response
     */
    public function show(int $client)
    {
        $client = Client::with('notes')->findOrFail($client);

        return Inertia::render('Client/ShowClient', [
            'client' => $client
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Inertia\Response
     */
    public function edit(Client $client)
    {
        return Inertia::render('Client/EditClient', [
            'client' => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Inertia\Response
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'birthdate' => ['required', 'date'],
            'phone' => []
        ]);

        // Using fill, so it doesn't automatically update it on the DB
        $client->fill($validated);

        // Update isCreated manually (not fillable)
        $client->isCreated = true;

        // Update the database entry
        $client->save();

        return Inertia::render('Client/ShowClient', [
            'client' => $client
        ])->with([
            'type' => 'success',
            'message' => 'Cliente actualizado correctamente.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        // TODO: Implement softDelete?
        return "Deleted client " . $client->email;
    }
}
