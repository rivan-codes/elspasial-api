<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trips';

    protected $casts = [
        'data'       => 'array',
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];
}
