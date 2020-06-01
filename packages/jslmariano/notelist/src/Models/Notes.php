<?php

namespace Jslmariano\Notelist\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * This class describes notes.
 */
class Notes extends Model
{
    protected $fillable = ['id', 'title', 'content', 'short_content'];
    protected $table    = 'notes';
    protected $appends = array('updated_ago');

    /**
     * Gets the updated ago attribute.
     *
     * @return     string  The updated ago attribute.
     */
    public function getUpdatedAgoAttribute() {
        return str_ireplace(
            [' seconds', ' second', ' minutes', ' minute', ' hours', ' hour', ' days', ' day', ' weeks', ' week'],
            ['s', 's', 'm', 'm', 'h', 'h', 'd', 'd', 'w', 'w'],
            $this->updated_at->diffForHumans()
        );
    }
}
