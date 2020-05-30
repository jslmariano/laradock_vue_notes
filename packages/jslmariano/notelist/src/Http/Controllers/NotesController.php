<?php

namespace Jslmariano\Notelist\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jslmariano\Notelist\Models\Notes;

class NotesController extends Controller
{
    // test notes
    public function test()
    {
        return response()->json(array('message' => 'The note api successfully visible'));
    }

    // all notes
    public function index()
    {
        $notes = Notes::all()->toArray();
        return array_reverse($notes);
    }

    // add note
    public function add(Request $request)
    {
        $note = new Notes([
            'title'   => $request->input('title'),
            'content' => $request->input('content'),
        ]);
        $note->save();

        return response()->json('The note successfully added');
    }

    // edit note
    public function edit($id)
    {
        $note = Notes::find($id);
        return response()->json($note);
    }

    // update note
    public function update($id, Request $request)
    {
        $note = Notes::find($id);
        $note->update($request->all());

        return response()->json('The note successfully updated');
    }

    // delete note
    public function delete($id)
    {
        $note = Notes::find($id);
        $note->delete();

        return response()->json('The note successfully deleted');
    }
}
