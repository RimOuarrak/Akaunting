<?php

namespace Modules\MyCalendar\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $fillable = [
        'title',
        'start',
        'end',
        'color',
        'textColor',
            // Add any other fields you need
    ];

    // Define any relationships or additional methods as needed
}
