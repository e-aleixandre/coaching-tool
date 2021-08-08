<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Note;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class NoteController extends Controller
{
    public function edit(Client $client, Note $note)
    {
        if ($client->id === $note->client_id) {
            return Inertia::render('Client/Note/EditNote', [
                '_note' => $note
            ]);
        } else {
            return Redirect::route('clients.index');
        }
    }

    public function update(Request $request, Client $client, Note $note)
    {
        if ($client->id === $note->client_id) {
            $validated = $request->validate([
                'title' => ['required', 'string'],
                'content' => ['required', 'string']
            ]);

            $note->update($validated);

            return Redirect::back();
        } else {
            return Redirect::route('clients.index');
        }
    }
}
