<?php

namespace Jslmariano\Notelist\Observers;

use Jslmariano\Notelist\Models\Notes;

/**
 * Interface to be notified of a note changes.
 */
class NoteObserver
{
    /**
     * Handle the Notes "creating" event.
     *
     * @param  Jslmariano\Notelist\Models\Notes  $notes
     * @return void
     */
    public function creating(Notes $notes)
    {
        $notes->short_content = str_limit($notes->content, 30, '...');
        $notes->created_user = \Auth::user()->id;
        $notes->updated_user = \Auth::user()->id;
    }

    /**
     * Handle the Notes "updating" event.
     *
     * @param  Jslmariano\Notelist\Models\Notes  $notes
     * @return void
     */
    public function updating(Notes $notes)
    {
        $notes->short_content = str_limit($notes->content, 30, '...');
        $notes->updated_user = \Auth::user()->id;
    }
}