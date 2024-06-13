<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTrip extends Model
{
    const PENDING   = 'PENDING';
    const CONFIRMED = 'CONFIRMED';
    const COMPLETED = 'COMPLETED';

    const STATUS = [
        self::PENDING => [
            'value' => self::PENDING,
            'text'  => 'Your order is pending.',
        ],
        self::CONFIRMED => [
            'value' => self::CONFIRMED,
            'text'  => 'Your order has been confirmed.',
        ],
        self::COMPLETED => [
            'value' => self::COMPLETED,
            'text'  => 'Your trip has been completed.',
        ]
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_trips';

    protected $casts = [
        'data'       => 'array',
        'order_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id');
    }
}
