<?php

namespace Jslmariano\Notelist\Observers;

use Jslmariano\Notelist\Models\Notes;

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
    }
}