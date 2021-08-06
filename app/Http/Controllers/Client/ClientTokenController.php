<?php

namespace App\Http\Controllers\Client;

use App\Mail\ClientProfileCompleted;
use App\Mail\ClientTokenGenerated;
use App\Models\Client;
use App\Models\ClientToken;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ClientTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Inertia\Response
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
     * TEMP!!
     * Renders the page for creating a token for a user
     *
     * @return \Inertia\Response
     */
    public function new()
    {
        return Inertia::render('Client/GenerateToken');
    }

    /**
     * Creates a token for a client and notifies by email.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'email' => ['required', 'email', 'exists:clients']
            ],
            [
                'email.exists' => 'No existe un cliente con ese email.'
            ]);

        // If there's no client with that email, or the email is wrong or not filled
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator);
        }

        // If there's a client we still need to make sure it's not created yet
        $client = Client::where('email',$request->input('email'))->first();

        if ($client->isCreated)
        {
            $validator->getMessageBag()->add('email', 'El usuario ya tiene una ficha creada.');
            return Redirect::back()->withErrors($validator);
        }

        // TODO: If we get here then we can create the token and show it
        $client->token()->firstOrCreate();

        Mail::to($client)->send(new ClientTokenGenerated($client));

        return "Mensaje enviado?";
        /*
        $client = Client::where('email', $validator->["email"])->first();

        if ($client->isCreated)
            return Redirect::back()->withErrors([

            ]);

        $client->token()->firstOrCreate();

        dd($client);*/
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

        // TODO: Email the admin to notify a client has filled its profile

        Mail::send(new ClientProfileCompleted($client));

        return Inertia::render('Client/ProfileCompleted');
    }
}
