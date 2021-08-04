<?php

namespace App\Http\Controllers\Client;

use App\Models\ClientToken;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Inertia\Response
     */
    public function index(String $clientToken)
    {
        /**
         * FUNCTIONALITY:
         * If a client that's not yet created and has a token is found, it should render a form for filling all the info
         *
         * NOTE: If we reach this function it means a token exists. And if everything is working correctly we can
         * assume the client is not created yet, because it shouldn't have a token if it wasn't.
         */
        $token = ClientToken::firstWhere('token', $clientToken);

        if ($token)
            // The token exists, the Client can fill the form
            return Inertia::render('Client/CompleteProfile', ['clientToken' => $token->token ]);
        else
            // The token doesn't exist, redirect to root
            return redirect('/');
    }

    /**
     * Generates a new profile for the client, sets it as created and deletes the token
     *
     * @return \Inertia\Response
     */
    public function completeProfile(Request $request, ClientToken $clientToken)
    {
        $client = $clientToken->client;

        $validated = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'birthdate' => ['required', 'date'],
            'phone' => []
        ]);

        $client->isCreated = true;
        $client->update($validated);
        $clientToken->delete();

        dd($client);
    }
}
