<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Session extends Model
{
    protected $table = 'sessions';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'user_id' => 'integer',
        'last_activity' => 'integer',
    ];

    protected $hidden = [
        'payload',
        'ip_address',
        'user_agent',
    ];

    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'payload',
        'last_activity',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }
}
