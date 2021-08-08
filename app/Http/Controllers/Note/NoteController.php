<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Inertia\Inertia;

class NoteController extends Controller
{
    public function edit()
    {
        $note = Note::first();
        return Inertia::render('Client/Note/EditNote', [
            'note' => $note
        ]);
    }
}
