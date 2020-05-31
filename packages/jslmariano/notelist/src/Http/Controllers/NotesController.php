<?php

namespace Jslmariano\Notelist\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Jslmariano\Notelist\Http\Requests\NotesStoreRequest;
use Jslmariano\Notelist\Models\Notes;

class NotesController extends Controller
{
    public function test()
    {
        return response()->json(array('message' => 'The note api successfully visible'));
    }

    public function index()
    {
        $notes = Notes::all()->toArray();
        return array_reverse($notes);
    }

    public function store(NotesStoreRequest $request)
    {

        $validated = $request->validated();

        $note = new Notes([
            'title'   => $request->input('title'),
            'content' => $request->input('content'),
        ]);
        $note->save();

        return response()->json('The note successfully added');
    }

    public function edit($id)
    {
        $note = Notes::find($id);
        return response()->json($note);
    }

    public function update($id, Request $request)
    {
        $note = Notes::find($id);
        $note->update($request->all());

        return response()->json('The note successfully updated');
    }

    public function delete($id)
    {
        $note = Notes::find($id);

        if (is_null($note)) {
            return response()->json('The note already deleted');
        }

        $note->delete();

        return response()->json('The note successfully deleted');
    }
}
