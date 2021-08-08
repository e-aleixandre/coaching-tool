<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class NoteController extends Controller
{
    public function edit(Note $note)
    {
        return Inertia::render('Client/Note/EditNote', [
            '_note' => $note
        ]);
    }

    public function update(Request $request, Note $note)
    {

        $validated = $request->validate([
           'title' => ['required', 'string'],
           'content' => ['required', 'string']
        ]);

        $note->update($validated);

        return Redirect::back();
    }
}
