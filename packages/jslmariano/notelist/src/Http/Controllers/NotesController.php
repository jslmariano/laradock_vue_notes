<?php

namespace Jslmariano\Notelist\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Jslmariano\Notelist\Http\Requests\NotesStoreRequest;
use Jslmariano\Notelist\Models\Notes;

/**
 * Controls the data flow into notes object and updates the view whenever data changes.
 */
class NotesController extends Controller
{
    /**
     * Test action
     *
     * @return     JSON  json response
     */
    public function test()
    {
        return array('message' => 'The note api successfully visible');
    }

    /**
     * Index action
     *
     * @return     Array  List of notes
     */
    public function index()
    {
        $notes = Notes::all()->toArray();
        return array_reverse($notes);
    }

    /**
     * Store action
     *
     * @param      \Jslmariano\Notelist\Http\Requests\NotesStoreRequest  $request  The request
     *
     * @return     JSON                                                  Response message
     */
    public function store(NotesStoreRequest $request)
    {

        $validated = $request->validated();

        $note = new Notes([
            'title'   => $request->input('title'),
            'content' => $request->input('content'),
        ]);
        $note->save();

        return array(
            'message' => 'The note successfully added',
            'note' => $note
        );
    }

    /**
     * Edit Actom
     *
     * @param      int  $id     The identifier
     *
     * @return     JSON  Updated data of the note
     */
    public function edit($id)
    {
        $note = Notes::find($id);
        return $note;
    }

    /**
     * Update action
     *
     * @param      int                                                $id       The identifier
     * @param      \Jslmariano\Notelist\Http\Requests\NotesStoreRequest  $request  The request
     *
     * @return     JSON                                                Response message
     */
    public function update($id, NotesStoreRequest $request)
    {
        $validated = $request->validated();

        $note = Notes::find($id);
        $note->update($request->all());

        return array(
            'message' => 'The note successfully updated',
            'note' => $note
        );
    }

    /**
     * Deletes the given identifier.
     *
     * @param      int  $id     The identifier
     *
     * @return     JSON  Response message
     */
    public function delete($id)
    {
        $note = Notes::find($id);

        if (is_null($note)) {
            return array('message' => 'The note already deleted');
        }

        $note->delete();
        return array('message' => 'The note successfully deleted');
    }
}
